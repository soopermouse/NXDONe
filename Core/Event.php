<?php
namespace Core;
class Event
{
    public $event_type;
    public $user_id;
    Public $start_time;
    public $end_time;
    public $event_state;
    public $imei;
    public static $event_id;

    public function __construct($user_id, $event_type, $start_time,$imei)
    {
        $this->user_id = $user_id;
        $this->event_type = $event_type;
        $this->start_time = $start_time;
        $this->event_state = "started";
        $this->imei=$imei;
        $this->event_id = EventModel::CreateEvent();



}

    public function __endEvent()
    {
        if (isset($this->end_time)) {
            $this->event_state = "completed";

        }

        return $this->event_state;


    }

    public function getState()
    {
        return $this->event_state;

    }

    public function getEvents()
    {


    }

}
