@extends('template')

@section('title')
    Lista de eventos
@endsection

@section('body')
<section class="col-12 d-flex justify-content-center align-items-center flex-column">
    <div class="col-10">
        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="text-center">Lista de eventos</h1>
            <a href="/" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        @if($events->count() > 0)

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tickets</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <th scope="row">{{ $event->id }}</th>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->tickets }}</td>
                        <td>{{ $event->event_date }}</td>
                        <td>
                            <a href="{{route('event.show',$event)}}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{route('event.edit',$event)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('event.delete',$event)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @else

        <div class="d-flex flex-column justify-content-center align-items-center my-5">
            <h1 class="text-center text-white opacity-50">Aun no hay eventos</h1>
            <h4 class="text-center text-white opacity-50">Crea el primer evento</h4>
        </div>
        @endif
        <div class="col-12 mt-4">    
            <a href="{{route('event.create')}}" class="fw-bold btn btn-primary col-12"><i class="fa-solid fa-plus"></i></a>
        </div>
        </div>
        
        @if($events->count() > 0)
        <!-- Paginator -->
        <div class="flex flex-column align-items-center justify-content-center my-5">
            <!-- Help text -->
            <span>
                Mostrando de <span class="text-white fw-bold">
                    {{$events->firstItem()}}</span> a <span class="text-white fw-bold">
                        {{$events->lastItem()}}</span> de <span class="text-white fw-bold">
                            {{$events->total()}}</span>
            </span>
            <div class="d-flex justify-content-center mt-2">
              <!-- Buttons -->
              <a href="{{ $events->previousPageUrl() }}" class="btn btn-primary mx-2">
                <i class="fa-solid fa-arrow-left"></i>
              </a>
              <a href="{{ $events->nextPageUrl() }}" class="btn btn-primary mx-2">
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>
        @endif

    </section>
@endsection
