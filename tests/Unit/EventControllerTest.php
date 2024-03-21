<?php
use Tests\TestCase;

use App\Http\Controllers\EventController;
use App\Http\Requests\EventStore;
use App\Models\Event;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        // Create a mock EventStore request with the required data
        $requestData = [
            'name' => 'New Event Name',
            'description' => 'New Event Description',
            'event_date' => '2024-12-31',
            'tickets' => 100,
        ];
        $request = new EventStore($requestData);

        // Create an instance of the controller
        $controller = new EventController();

        // Call the store method of the controller
        $response = $controller->store($request);

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the redirect is to the event show route for the newly created event
        $event = Event::where('name', 'New Event Name')->first();
        $this->assertEquals(route('event.show', $event), $response->getTargetUrl());
    }

    public function testIndex()
    {
        $controller = new EventController();
        $response = $controller->index();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('events', $response->getData());
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()['events']);
    }

    public function testShow()
    {
        // Crear un evento de ejemplo
        $event = new Event();
        $event->id = 150;
        $event->name = 'Ejemplo de evento';
        $event->description = 'Ejemplo de evento';
        $event->tickets = 100;
        $event->event_date = Carbon::now();
        $event->save();

        // Crear una instancia del controlador
        $controller = new EventController();

        // Crear una solicitud (request) simulada
        $request = Request::create('/events/150', 'GET');

        // Llamar a la función show del controlador
        $response = $controller->show(150);

        // Verificar que se devuelve una instancia de la vista
        $this->assertInstanceOf(View::class, $response);

        // Verificar que la vista 'events.show' se devuelve
        $this->assertEquals('events.show', $response->name());

        // Verificar que la variable $event se pasa a la vista
        $this->assertEquals($event->id, $response->getData()['event']->id);
        $this->assertEquals($event->name, $response->getData()['event']->name);
    }

    public function testUpdate()
    {
        // Create an example event using the EventFactory
        $event = Event::factory()->create();

        // Create an instance of the EventStore request with the required data
        $request = new EventStore([
            'name' => 'Nuevo nombre del evento',
            'description' => 'Nueva descripción del evento',
            'event_date' => '2024-11-10',
            'tickets' => 150,
        ]);

        // Create an instance of the controller
        $controller = new EventController();

        // Call the update method of the controller
        $response = $controller->update($event, $request);

        // Add an assertion to verify the expected behavior
        $this->assertEquals('Nuevo nombre del evento', $event->fresh()->name);
        // Add more assertions as needed to verify the update

        // Example assertion for redirect
        $this->assertEquals(route('event.show', $event), $response->getTargetUrl());
    }

    public function testDestroy()
    {
        // Create a mock event
        $event = Event::factory()->create();

        // Create an instance of the controller
        $controller = new EventController();

        // Call the destroy method of the controller
        $response = $controller->destroy($event);

        // Assert that the event is deleted
        $this->assertNull(Event::find($event->id));

        // Assert that the response is a redirect
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the redirect is to the event index route
        $this->assertEquals(route('event.index'), $response->getTargetUrl());
    }

    public function testGetEventJsonExistingEvent()
    {
        // Create a mock event
        $event = Event::factory()->create();

        // Create an instance of the controller
        $controller = new EventController();

        // Call the getEventJson method of the controller with the existing event ID
        $response = $controller->getEventJson($event->id);

        // Assert that the response is a JSON response
        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    public function testGetEventJsonNonExistingEvent()
    {
        // Create an instance of the controller
        $controller = new EventController();

        // Call the getEventJson method of the controller with a non-existing event ID
        $response = $controller->getEventJson(9999); // Assuming 9999 is a non-existing event ID

        // Assert that the response is a plain text response with "Event not found"
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('Event not found', $response->getContent());
    }

}
