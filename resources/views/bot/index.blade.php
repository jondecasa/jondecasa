
<x-app-layout>


    <div class="container-xl mt-2 py-2">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card ">
                    <div class="card-header">
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            </ul>
                        </div> <!-- End -->
                        <!-- Credit card form content -->
                        <div class="tab-content">
                            
                            <!-- Paypal info -->
                            <div id="paypal" class="tab-pane fade pt-3 active show">
                                <h2 class="pb-2">Producto: </h2>
                                <p>Bot alertas de entradas en criptomonedas con Binance</p>
                                <p>Precio 20.00€</p>
                                <p> <a href="{{url("/paypal/pagar")}}">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fab fa-paypal mr-2"></i> Pagar</button> 
                                    </a>
                                </p>
                                <p class="text-muted"> Nota: El pago se procesará y se añadirán 30 días desde el momento del pago. </p>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            @if(count($registros) > 0 )
            <div class="col-lg-6 mx-auto">
                <p>Periodos de pagos pasados:</p>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaRegistros">
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $registro)

                            <tr>
                                <td>{{\Carbon\Carbon::parse($registro->fechaInicio)->format('d/m/Y H:i')}}</td>
                                <td>{{\Carbon\Carbon::parse($registro->fechaFin)->format('d/m/Y H:i')}}</td>
                                <td>
                                    <form id="borrar_{{$registro->id}}" class="" action="#" method="POST">

                                        <a href="#" class="btn text-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn text-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

<script>
    
</script>


</x-app-layout>