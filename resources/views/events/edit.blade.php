@extends('template')
@section('title')
    Editar un evento
@endsection

@section('body')
    <section class="d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex justify-content-between align-items-center my-5 col-6">
            <h1 class="text-center">Editando evento</h1>
            <a href="{{ route('event.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <form method="POST" action="{{ route('event.update',$event) }}" class="col-6">
            @method('PUT')
            @csrf

            <label for="name" class="text-white fw-bold">Nombre del evento</label>
            @error('name')
            <small class="text-white">*{{ $message }}</small>
            <br>
            @enderror
            <input type="text" value="{{$event->name}}" class="form-control mb-3" name="name" placeholder="Nombre del evento">
            

            <label for="tickets" class="text-white fw-bold">Tickets disponibles</label>
            @error('tickets')
            <small class="text-white">*{{ $message }}</small>
            <br>
            @enderror
            <input type="number" value="{{$event->tickets}}" class="form-control mb-3" name="tickets" placeholder="Cantidad de tickets disponible">
            
            <label for="event_date" class="text-white fw-bold">Fecha del evento</label>
            @error('event_date')
            <small class="text-white">*{{ $message }}</small>
            <br>
            @enderror
            <input type="date" value="{{$event->event_date}}" class="form-control mb-3" name="event_date">

            
            <label for="name" class="text-white fw-bold">Descripcion del evento</label>
            @error('description')
            <small class="text-white">*{{ $message }}</small>
            <br>
            @enderror
            <div class="form-floating">
                <textarea class="form-control mb-3" name="description" placeholder="Descripcion del evento" id="floatingTextarea2" style="height: 100px">{{$event->description}}</textarea>
                <label for="floatingTextarea2">Descripcion...</label>
            </div>
            
            <button type="submit" class="btn btn-success col-12">Editar</button>

        </form>
    </section>
@endsection