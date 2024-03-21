<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStore;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(EventStore $request)
    {
        $event = Event::create($request->all());
        return redirect(route('event.show', $event));
    }

    public function create()
    {
        return view('events.create');
    }

    public function index()
    {
        $events = Event::paginate(10);
        return view('events.index', compact('events'));
    }

    public function show($event)
    {
        $event = Event::find($event);
        return view('events.show', compact('event'));
    }

    public function update(Event $event, EventStore $request)
    {
        $event->name = $request->name;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->tickets = $request->tickets;
        $event->save();

        return redirect(route('event.show', $event));
    }

    public function edit($event){
        $event = Event::find($event);
        return view('events.edit', compact('event'));
    }

    public function delete($event)
    {
        $event = Event::find($event);
        return view('events.delete', compact('event'));
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect(route('event.index'));
    }

    public function getEventJson($event){
        $event = Event::find($event);
        if ($event) {
            return response()->json($event);
        }else{
            return response('Event not found');
        }
    }

}
