@extends('template')
@section('title')
    Ver ticket
@endsection

@section('body')
    <section class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-between align-items-center my-5 col-6">
            <h1 class="text-center">Visualizar venta</h1>
            <a href="{{route('ticketOrder.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-light text-white"><h4>Nombre del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_name}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Apellido del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_lastname}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>DNI del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_dni}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Cantida de tickets comprados:</h4> <span class="fw-bold">{{$ticketOrder->ticket_ammount}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Evento de los tickets comprados:</h4> <span class="fw-bold">{{$event->name}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Comprobante de pago:</h4><img src="{{$ticketOrder->pay_info_path}}" alt="" class="img-fluid"></li>
                </ul>
            </div>
        </div>
    </section>
@endsection