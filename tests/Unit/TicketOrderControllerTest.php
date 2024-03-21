<?php

use Tests\TestCase;
use App\Http\Controllers\TicketOrderController;
use App\Models\TicketOrder;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
// use League\Flysystem\FilesystemAdapter;

class TicketOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testStore()
    {
        $eventData = [
            'id' => 1,
            'name' => 'New Event Name',
            'description' => 'New Event Description',
            'event_date' => '2024-12-31',
            'tickets' => 100,
        ];
    
        $event = Event::create($eventData);

        $response = $this->post('/ticket-order/create', [
            'event_id' => 1,
            'ticket_ammount' => 2,
            'buyer_name' => 'John',
            'buyer_lastname' => 'Doe',
            'buyer_dni' => '12345678',
            'pay_info' => 'png.png',
        ]);
    
        $response->assertStatus(302); 
    }
    public function testDestroy()
    {
        $ticketOrder = TicketOrder::factory()->create();

        $this->delete(route('ticketOrder.destroy', $ticketOrder));

        $this->assertDatabaseMissing('ticket_orders', ['id' => $ticketOrder->id]);
    }

    public function testUpdate()
    {

        $eventData = [
            'id' => 1,
            'name' => 'New Event Name',
            'description' => 'New Event Description',
            'event_date' => '2024-12-31',
            'tickets' => 100,
        ];
    
        $event = Event::create($eventData);

        $ticketOrder = [
            'id' => 1,
            'event_id' => 1,
            'ticket_ammount' => 2,
            'buyer_name' => 'John',
            'buyer_lastname' => 'Doe',
            'buyer_dni' => '12345678',
            'pay_info' => 'png.png',
            'pay_info_path' => 'png',
        ];
    
        $ticketOrder = TicketOrder::create($ticketOrder);

        $ticketOrder = TicketOrder::find(1);

        $response = $this->put('/ticket-order/update/1', [
            'event_id' => 1,
            'ticket_ammount' => 3,
            'buyer_name' => 'John',
            'buyer_lastname' => 'Doe',
            'buyer_dni' => '12345678',
        ]);
    
        $ticketOrder = $ticketOrder->fresh();
    
        $this->assertEquals('John', $ticketOrder->buyer_name);
        $this->assertEquals('Doe', $ticketOrder->buyer_lastname);
        $this->assertEquals('12345678', $ticketOrder->buyer_dni);
        $this->assertEquals(3, $ticketOrder->ticket_ammount); 
        $this->assertEquals(1, $ticketOrder->event_id);
    
        $response->assertStatus(302);
    }
}
