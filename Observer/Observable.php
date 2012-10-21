<?php

namespace Funddy\Component\Fixture\Observer;

abstract class Observable
{
    protected $observers;

    public function __construct()
    {
        $this->observers = array();
    }

    public function attach(Observer $observer)
    {
        if(!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
        }
    }

    public function detach(Observer $observer)
    {
        $key = array_search($observer, $this->observers);

        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}
