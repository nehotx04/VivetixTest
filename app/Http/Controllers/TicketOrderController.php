<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketOrderStore;
use App\Models\Event;
use App\Models\TicketOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TicketOrderController extends Controller
{
    public function store(TicketOrderStore $request){
        $ticketSubstract = $this->ticketSubstract($request->event_id,$request->ticket_ammount); 
        if($ticketSubstract){
            $request->validate([
                'pay_info' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            $imageNameRandomizer = time().'.'.$request->pay_info->extension();

            $request->pay_info->move(public_path('images'), $imageNameRandomizer);

            $imageName = "/images/".$imageNameRandomizer;

            $ticketOrder = TicketOrder::create([
                'buyer_name' => $request->buyer_name,
                'buyer_lastname' => $request->buyer_lastname,
                'buyer_dni' => $request->buyer_dni,
                'ticket_ammount' => $request->ticket_ammount,
                'event_id' => $request->event_id,
                'pay_info' =>  $imageNameRandomizer,
                'pay_info_path' =>  $imageName
                
            ]);
        }else{
            return redirect(route('ticketOrder.create'))->withErrors('Ha ocurrido un error intente de nuevo');
        }

        return redirect(route('ticketOrder.show', $ticketOrder));
    }
    
    public function create(){
        $events = Event::all();
        return view('ticketOrders.create',compact('events'));
    }

    public function show($ticketOrder){
        $ticketOrder = TicketOrder::find($ticketOrder);
        $event = Event::find($ticketOrder->event_id);
        return view('ticketOrders.show',compact('ticketOrder','event'));
    }

    public function index(){
        $ticketOrders = TicketOrder::select('ticket_orders.*', 'events.name as event_name')
        ->join('events', 'ticket_orders.event_id', '=', 'events.id')->paginate(10);

        return view('ticketOrders.index',compact('ticketOrders'));
    }

    public function destroy(TicketOrder $ticketOrder){
        $ticketDevolution = $this->ticketDevolution($ticketOrder->event_id,$ticketOrder->ticket_ammount);
        if($ticketDevolution){
            File::delete($ticketOrder->pay_info);
            $ticketOrder->delete();
            return redirect(route('ticketOrder.index'));
        }else{
            return redirect(route('ticketOrder.index'))->withErrors('Ocurrio un error intentalo de nuevo');

        }

    }

    public function delete($ticketOrder){
        $ticketOrder = TicketOrder::find($ticketOrder);
        $event = Event::find($ticketOrder->event_id);
        return view('ticketOrders.delete',compact('ticketOrder','event'));
    }

    //Ticket functions start
    
    private function ticketDevolution($event_id,$ticket_ammount){
        $event = Event::find($event_id);
        if(!$event){
            throw 'event not found';
        }

        $result = $event->tickets += $ticket_ammount;
        $event->save();
        return $result;
    }

    private function ticketSubstract($event_id,$ticket_ammount){
        $event = Event::find($event_id);
        if(!$event){
            throw 'event not found';
        }
        if($event->tickets < $ticket_ammount){
            throw 'The ticket ammount to buy is greater than the avaliable';
        }else{
            $result = $event->tickets -= $ticket_ammount;
            $event->save();
            return $result;
        }
    }

    //Ticket functions end

    public function filter(Request $request){
        if($request->event_name){
        $ticketOrders = TicketOrder::select('ticket_orders.*', 'events.name as event_name')
        ->join('events', 'ticket_orders.event_id', '=', 'events.id')
        ->where('events.name', 'like', $request->event_name)->paginate(10);
        }else{
            $ticketOrders = TicketOrder::select('ticket_orders.*', 'events.name as event_name')
            ->join('events', 'ticket_orders.event_id', '=', 'events.id')->paginate(10);
        }
        return view('ticketOrders.index',compact('ticketOrders'));
    }

    public function edit($ticketOrder){
        $ticketOrder = TicketOrder::find($ticketOrder);
        $events = Event::all();
        return view('ticketOrders.edit',compact('ticketOrder','events'));
    }

    public function update(Request $request, TicketOrder $ticketOrder){
        if (!$request->pay_info) {
            $ticketOrder->pay_info = $ticketOrder->pay_info;
            $ticketOrder->pay_info_path = $ticketOrder->pay_info_path;
        }else{
            $imageNameRandomizer = time().'.'.$request->pay_info->extension();

            $request->pay_info->move(public_path('images'), $imageNameRandomizer);

            $imageName = "/images/".$imageNameRandomizer;

            $ticketOrder->pay_info = $imageNameRandomizer;
            $ticketOrder->pay_info_path = $imageName;

        }
        
        $ticketOrder->buyer_name = $request->buyer_name;
        $ticketOrder->buyer_lastname = $request->buyer_lastname;
        $ticketOrder->buyer_dni = $request->buyer_dni;
        
        if($request->ticket_ammount != $ticketOrder->ticket_ammount & $ticketOrder->event_id == $request->event_id){
            $devolution = $this->ticketDevolution($ticketOrder->event_id,$ticketOrder->ticket_ammount);
            if($devolution){
                $this->ticketSubstract($ticketOrder->event_id,$request->ticket_ammount);
                $ticketOrder->ticket_ammount = $request->ticket_ammount;
        }
    }
    if($request->event_id != $ticketOrder->event_id){
        $devolution = $this->ticketDevolution($ticketOrder->event_id,$ticketOrder->ticket_ammount);
        if($devolution){
            $this->ticketSubstract($request->event_id,$request->ticket_ammount);
            $ticketOrder->event_id = $request->event_id;
        }
        }

        $ticketOrder->save();

        return redirect(route('ticketOrder.show',$ticketOrder));
    }
}
