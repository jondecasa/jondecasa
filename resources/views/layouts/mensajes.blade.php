@if ($errors->any())
    <div class="alert alert-danger alert-dismissible text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif
@if($mensaje = Session::get("success"))
<div id="mensaje" class="alert alert-success alert-dismissible text-center">
    {{ $mensaje }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif