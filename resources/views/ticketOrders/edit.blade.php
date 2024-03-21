@extends('template')
@section('title')
    Editar una venta de ticket
@endsection

@section('body')
    <section class="d-flex justify-content-center align-items-center flex-column">
        <div class="d-flex justify-content-between align-items-center my-5 col-6">
            <h1 class="text-center">Editando venta de ticket</h1>
            <a href="{{route('ticketOrder.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <form action="{{ route('ticketOrder.update',$ticketOrder) }}" enctype="multipart/form-data" method="post" class="col-6">
            @csrf
            @method("PUT")

            <label for="event_id" class="fw-bold">Nombre del evento</label>
            @error('event_id')
                <small class="text-white">*{{ $message }}</small>
                <br>
            @enderror
            <select name="event_id" class="form-select mb-3" id="event_select">
                @if ($events->count() > 0)
                    <option disabled>--</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                @else
                    <option disabled>Aun no hay eventos creados</option>
                @endif
            </select>


            <label for="buyer_name" class="fw-bold">Nombre del comprador</label>
            @error('buyer_name')
                <small class="text-white">*{{ $message }}</small>
                <br>
            @enderror
            <input type="text" placeholder="Fernando" value="{{$ticketOrder->buyer_name}}" name="buyer_name" class="form-control mb-3">

            <label for="buyer_lastname" class="fw-bold">Apellido del comprador</label>
            @error('buyer_lastname')
                <small class="text-white">*{{ $message }}</small>
                <br>
            @enderror
            <input type="text" placeholder="Lopez" value="{{$ticketOrder->buyer_lastname}}" name="buyer_lastname" class="form-control mb-3">

            <label for="buyer_dni" class="fw-bold">Dni del comprador</label>
            @error('buyer_dni')
                <small class="text-white">*{{ $message }}</small>
                <br>
            @enderror
            <input type="text" placeholder="E-12345678" value="{{$ticketOrder->buyer_dni}}" name="buyer_dni" class="form-control mb-3">

            <label for="ticket_ammount" class="fw-bold">Cantidad de tickets</label>
            @error('ticket_ammount')
                <small class="text-white">*{{ $message }}</small>
                <br>
            @enderror
            <span>- max = <span id="valorSpan"></span></span>
            <input type="number" value="{{$ticketOrder->ticket_ammount}}" placeholder="15" name="ticket_ammount" class="form-control mb-3">

            <label for="pay_info" class="fw-bold">Comprobante de pago (dejar vacio si no cambio)</label>

            <input type="file" accept="image/*" name="pay_info" class="form-control mb-3">

            <button type="submit" class="btn btn-success col-12 mt-3">Crear</button>
        </form>
    </section>

    <script>
        const select = document.getElementById('event_select');
        const valorSpan = document.getElementById('valorSpan');

        select.addEventListener('change', function() {
            // Obtener el valor seleccionado
            var selectedValue = select.options[select.selectedIndex].value;

            // Realizar una solicitud GET a la ruta de la API de Laravel
            fetch(`/events/json/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    // Actualizar el contenido del span con el valor de tickets obtenido
                    valorSpan.textContent = data.tickets;
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
        });
    </script>
@endsection
