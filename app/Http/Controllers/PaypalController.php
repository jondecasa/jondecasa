<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Registros;
use Auth;
use Carbon\Carbon;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\PaymentExecution;

class PaypalController extends Controller
{
    private $apiContext;
    
    public function __construct() {
        $paypalConfig = Config::get('paypal');
        
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                    $paypalConfig["client_id"],
                    $paypalConfig["secret"],
                )
            );
    }
    
    public function paypalPayment(){
        $paypalConfig = Config::get('paypal');
                
        $urlVolver = url("/paypal/status");
        
        $pagador = new Payer();
        $pagador->setPaymentMethod("paypal");
        
        $cantidad = new Amount();
        $cantidad->setTotal($paypalConfig["precio"]);
        $cantidad->setCurrency("EUR");
        
        $transaction = new Transaction();
        $transaction->setAmount($cantidad);
        
        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl($urlVolver)->setCancelUrl($urlVolver);
        
        $pago = new Payment();
        $pago->setIntent("sale")
                ->setPayer($pagador)
                ->setTransactions(array($transaction))
                ->setRedirectUrls($redirectUrl);
        
        try{
            $pago->create($this->apiContext);
            
            return redirect()->away($pago->getApprovalLink());
            
        }catch(PayPalConnectionException $ex){
            
        }
              
    }
    
    public function paypalStatus(Request $request){
        $pagoId = $request->input("paymentId");
        $pagadorId = $request->input("PayerID");
        $token = $request->input("token");
        
        if(!$pagoId || !$pagadorId || !$token){
            $success = "No se pudo proceder con el pago a través de Paypal";
            return redirect("/")->with(compact("success"));
        }
        
        $pago = Payment::get($pagoId, $this->apiContext);
        
        $ejecucion = new PaymentExecution();
        $ejecucion->setPayerId($pagadorId);
        
        $resultado = $pago->execute($ejecucion, $this->apiContext);
        
        if($resultado->getState() === "approved"){
            $registro = Registros::where("user_id", Auth::user()->id)->orderBy("fechaFin", "desc")->first();
        
            //Si ya hay registros, creo cojo el anterior
            if(isset($registro)){
                $fechaFin = new Carbon($registro->fechaFin);
                $fechaFin->addDays(30);

                $nuevoReg = new Registros();
                $nuevoReg->user_id = Auth::user()->id;
                $nuevoReg->fechaInicio = $registro->fechaFin;
                $nuevoReg->fechaFin = $fechaFin;
                $nuevoReg->save();
            }else{
                $fechaFin = Carbon::now();
                $fechaFin->addDays(30);

                $nuevoReg = new Registros();
                $nuevoReg->user_id = Auth::user()->id;
                $nuevoReg->fechaInicio = Carbon::now();
                $nuevoReg->fechaFin = $fechaFin;
                $nuevoReg->save();
            }
            $success = "El pago se ha realizado correctamente";
            return redirect("/bot")->with(compact("success"));
        }else{
            $success = "Lo sentimos, el pago no se ha realizado correctamente";
            return redirect("/bot")->withErrors(compact("success"));
        }
        
        
    }
}
