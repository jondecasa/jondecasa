<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        
 
        <link rel="stylesheet" href="{{ public_path(). ('/css/bootstrap4.css') }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        
        <link rel="stylesheet" href="{{ public_path(). ('/css/estilos_back.css') }}">
        <style>
            table thead{
                background-color: #ffa07c;
            }       
            th{
                background:#ffa07c;
                color:black;
            }
            .table-borderless > tbody > tr > td,
            .table-borderless > tbody > tr > th,
            .table-borderless > tfoot > tr > td,
            .table-borderless > tfoot > tr > th,
            .table-borderless > thead > tr > td,
            .table-borderless > thead > tr > th {
                border: none;
            }
            #datos tr{
                line-height: 0.7;
            }
            .borde{
                border: 1px solid #ffa07c;
                font-size: 0.8em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            
            <div style="width: 100%;">
                <div style="width: 40%;left:0;float:left">
                    <div style="width:100%">
                        <table class="table table-hover table-borderless" cellpadding="0" id="datos">
                            <tbody>
                                <tr>
                                    <td class="border-top-0">
                                        <img src="{{ public_path().("/img/logo.png") }}" alt="" width="50"> 
                                        <h6 style="float:right;">Jon Ander <br>de Casa Lombilla</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Calle Severo Ochoa 8, D 2-2</td>
                                </tr>
                                <tr>
                                    <td>28232, Las Rozas Madrid</td>
                                </tr>
                                <tr>
                                    <td>NIF: 0258968T</td>
                                </tr>
                                <tr>
                                    <td>https://jondecasa.com</td>
                                </tr>
                                <tr>
                                    <td>contacto@jondecasa.com</td>
                                </tr>
                                <tr>
                                    <td>Tel: 676123223</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="width: 40%;right:0;float: right">
                    <div style="width: 100%">
                        <h6 class="text-right">Factura</h6>
                        <table class="table table-hover table-borderless">
                            <tbody>
                                <tr>
                                    <td class="border-top-0">{{$factura->cliente->nombre}}</td>
                                </tr>
                                <tr>
                                    <td>{{$factura->cliente->direccion}}</td>
                                </tr>
                                <tr>
                                    <td>NIF: {{$factura->cliente->dni}}</td>
                                </tr>

                            </tbody>
                        </table>
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Nº Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{date('d/m/Y', strtotime($factura->fecha))}}</td>
                                    <td>{{$factura->numFactura}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div style="width:100%;clear:both;">
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <th class="text-right">Cantidad</th>
                                <th class="text-right">Importe</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factura->detalle as $detalle)
                            <tr>
                                <td width="50%">{{$detalle->concepto}}</td>
                                <td width="10%" class="text-right">{{number_format($detalle->cantidad, 2, ",", ".")}}</td>
                                <td width="20%" class="text-right">{{number_format($detalle->importe, 2, ",", ".")}}</td>
                                <td width="20%" class="text-right">{{number_format($detalle->total, 2, ",", ".")}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="width: 100%">
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Base Imponible</th>
                                <th>Retención (%)</th>
                                <th>Retención (Importe)</th>
                                <th>IVA (%)</th>
                                <th>IVA (Importe)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{number_format($factura->base, 2, ",", ".")}}</td>
                                <td>{{number_format($factura->retencion, 2, ",", ".")}}</td>
                                <td>{{number_format($factura->base * $factura->retencion / 100, 2, ",", ".")}}</td>
                                <td>{{number_format($factura->iva, 2, ",", ".")}}</td>
                                <td>{{number_format($factura->base * $factura->iva / 100, 2, ",", ".")}}</td>
                                <td>{{number_format($factura->total, 2, ",", ".")}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($factura->observaciones) && $factura->observaciones != "")
            <div style="width: 100%">
                <table class="table table-hover borderless borde">
                    <tbody>
                        <tr>
                            <td class="border-top-0">{{$factura->observaciones}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        
        <script type="text/php">
            if(isset($pdf)){
                $font = $fontMetrics->get_font("helvetica", "bold");
                $pdf->page_text(500, 810, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
            }
        </script>
    </body>
</html>

