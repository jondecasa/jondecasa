<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Models\Registros;
use Auth;
use Carbon\Carbon;

class PaypalController extends Controller
{
    public function paypalPayment(){
        $paypalConfig = Config::get('paypal');
        $urlVolver = url("/paypal/status");

        try {
            $respuesta = $this->clientePaypal()->post('/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => number_format($paypalConfig['precio'], 2, '.', ''),
                    ],
                ]],
                'payment_source' => [
                    'paypal' => [
                        'experience_context' => [
                            'return_url' => $urlVolver,
                            'cancel_url' => $urlVolver,
                            'user_action' => 'PAY_NOW',
                        ],
                    ],
                ],
            ])->throw()->json();

            $urlAprobacion = data_get(
                collect($respuesta['links'] ?? [])->firstWhere('rel', 'payer-action'),
                'href'
            ) ?: data_get(
                collect($respuesta['links'] ?? [])->firstWhere('rel', 'approve'),
                'href'
            );

            if (!$urlAprobacion) {
                throw new \RuntimeException('PayPal no devolvió una URL de aprobación.');
            }

            return redirect()->away($urlAprobacion);
        } catch (\Throwable $ex) {
            report($ex);

            return redirect('/')->withErrors(['paypal' => 'No se pudo iniciar el pago con PayPal.']);
        }
    }
    
    public function paypalStatus(Request $request){
        $pedidoId = $request->input("token");

        if (!$pedidoId) {
            $success = "No se pudo proceder con el pago a través de Paypal";
            return redirect("/")->with(compact("success"));
        }

        try {
            $resultado = $this->clientePaypal()
                ->post('/v2/checkout/orders/'.$pedidoId.'/capture', [])
                ->throw()
                ->json();
        } catch (\Throwable $ex) {
            report($ex);

            return redirect('/')->withErrors(['paypal' => 'No se pudo confirmar el pago con PayPal.']);
        }

        if (($resultado['status'] ?? null) === 'COMPLETED') {
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
        } else {
            $success = "Lo sentimos, el pago no se ha realizado correctamente";
            return redirect("/bot")->withErrors(compact("success"));
        }
    }

    private function clientePaypal()
    {
        $config = Config::get('paypal');
        $baseUrl = $config['mode'] === 'live'
            ? 'https://api-m.paypal.com'
            : 'https://api-m.sandbox.paypal.com';

        $token = Http::asForm()
            ->withBasicAuth($config['client_id'], $config['secret'])
            ->post($baseUrl.'/v1/oauth2/token', ['grant_type' => 'client_credentials'])
            ->throw()
            ->json('access_token');

        return Http::baseUrl($baseUrl)->withToken($token)->acceptJson();
    }
}
