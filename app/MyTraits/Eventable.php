<?php 

namespace App\MyTraits;

use App\Event;

trait Eventable
{
    public function event()
    {
          return $this->hasMany(Event::class);
    }

    public function publishEvent($event)
    {
          return $this->event()->create($event);
    }
    public function updateEvent($event)
    {
          return $this->event()->update($event);
    }
}
