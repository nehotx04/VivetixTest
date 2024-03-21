@extends('template')
@section('title')
    Borrar evento
@endsection

@section('body')
    <section class="d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-white">Estas a punto de borrar este evento!</h1>
        <div class="col-6 my-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-light text-white"><h4>Nombre del evento:</h4> <span class="fw-bold">{{$event->name}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Tickets disponibles:</h4> <span class="fw-bold">{{$event->tickets}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Fecha del evento:</h4> <span class="fw-bold">{{$event->event_date}}</span></li>
                    <li class="list-group-item list-group-item-light text-white"><h4>Descripcion del evento:</h4> <span class="fw-bold">{{$event->description}}</span></li>
                </ul>
            </div>
            <div class="d-flex flex-row">
                <form class="col-6" action="{{ route('event.destroy', $event) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger col-12 mt-4">Eliminar</button>
                </form>                
                <a href="{{route('event.index')}}" class="btn btn-primary col-6 mt-4">Volver</a>


            </div>
        </div>
    </section>
@endsection