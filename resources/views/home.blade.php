@extends('template')
@section('title')
   Inicio 
@endsection

@section('body')
    <section class="d-flex justify-content-center align-items-center flex-column">
        <h1>Inicio</h1>
        <div class="d-flex justify-content-around align-items-center flex-row col-12">
            <a href="{{route('event.index')}}" class="btn btn-primary col-4 my-4 mx-2">Ir a Eventos</a>
            <a href="{{route('ticketOrder.index')}}" class="btn btn-success col-4 my-4 mx-2">Ir a Tickets</a>
        </div>
    </section>
@endsection