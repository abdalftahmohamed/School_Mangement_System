<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }


    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);

    }


    public function eventDrop($event, $oldEvent)
    {
        if(empty($event['id']))
            $event['id']=Event::where('title',$oldEvent['title'])->orWhere('start',$oldEvent['start'])->pluck('id')->first();
        $eventdata = Event::find($event['id']);
        $eventdata->start = $event['start'];
        $eventdata->save();

    }


    public function deleteEvent($event, $oldEvent)
        {
            $eventdata = Event::find($event['id']);
            $eventdata->destroy($eventdata->id);

//            $this->emit('eventDeleted');
        }

    public function render()
    {
        $events = Event::select('id','title','start')->get();
        $this->events = json_encode($events);

        return view('livewire.calendar',['events']);

    }

}
