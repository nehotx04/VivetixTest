@extends('template')
@section('title')
    Ver ticket
@endsection

@section('body')
    <section class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-between align-items-center my-5 col-6">
            <h1 class="text-center">Borrando venta:</h1>
        </div>
        <div class="col-6 my-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-light text-white"><h4>Nombre del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_name}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Apellido del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_lastname}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>DNI del comprador:</h4> <span class="fw-bold">{{$ticketOrder->buyer_dni}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Cantida de tickets comprados:</h4> <span class="fw-bold">{{$ticketOrder->ticket_ammount}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Evento de los tickets comprados:</h4> <span class="fw-bold">{{$event->name}}</span></li>
                </ul>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center align-items-center col-12">
            <form class="col-3" action="{{ route('ticketOrder.destroy', $ticketOrder) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger col-12 mt-4">Eliminar</button>
            </form>                
            <a href="{{route('ticketOrder.index')}}" class="btn btn-primary col-3 mt-4">Volver</a>


        </div>
    </section>
@endsection