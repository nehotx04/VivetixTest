@extends('template')

@section('title')
    Lista de ordenes de compra
@endsection

@section('body')
<section class="col-12 d-flex justify-content-center align-items-center flex-column">
    <div class="col-10">
        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="text-center">Lista de ordenes de compras</h1>
            <a href="/" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        @if($ticketOrders->count() > 0)
        <div>
            <form action="{{route('ticketOrder.filter')}}" method="POST" class="col-12 d-flex align-items-center justify-content-end my-4">
                @csrf
                <div class="col-3">
                    <input type="text" name="event_name" placeholder="Nombre de evento" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre del comprador</th>
                    <th scope="col">Nombre del evento</th>
                    <th scope="col">Tickets comprados</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ticketOrders as $ticketOrder)
                    <tr>
                        <th scope="row">{{ $ticketOrder->id }}</th>
                        <td>{{ $ticketOrder->buyer_name }}</td>
                        <td>{{ $ticketOrder->event_name }}</td>
                        <td>{{ $ticketOrder->ticket_ammount }}</td>
                        <td>
                            <a href="{{route('ticketOrder.show',$ticketOrder)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{route('ticketOrder.edit',$ticketOrder)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('ticketOrder.delete',$ticketOrder)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @else

        <div class="d-flex flex-column justify-content-center align-items-center my-5">
            <h1 class="text-center text-white opacity-50">Aun no hay Ordenes de compra</h1>
            <h4 class="text-center text-white opacity-50">Crea la primera orden de compra</h4>
        </div>
        @endif
        <div class="col-12 mt-4">    
            <a href="{{route('ticketOrder.create')}}" class="fw-bold btn btn-primary col-12"><i class="fa-solid fa-plus"></i></a>
        </div>
        </div>
        
        @if($ticketOrders->count() > 0)
        <!-- Paginator -->
        <div class="flex flex-column align-items-center justify-content-center my-5">
            <!-- Help text -->
            <span>
                Mostrando de <span class="text-white fw-bold">
                    {{$ticketOrders->firstItem()}}</span> a <span class="text-white fw-bold">
                        {{$ticketOrders->lastItem()}}</span> de <span class="text-white fw-bold">
                            {{$ticketOrders->total()}}</span>
            </span>
            <div class="d-flex justify-content-center mt-2">
              <!-- Buttons -->
              <a href="{{ $ticketOrders->previousPageUrl() }}" class="btn btn-primary mx-2">
                <i class="fa-solid fa-arrow-left"></i>
              </a>
              <a href="{{ $ticketOrders->nextPageUrl() }}" class="btn btn-primary mx-2">
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        @endif

    </section>
@endsection
