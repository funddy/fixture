<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Component\Fixture\Observer\Observer;
use Funddy\Component\Fixture\Observer\Observable;

class ConcreteObservable extends Observable
{
}

class ConcreteObserver implements Observer
{
    private $wasNotified = false;

    public function update()
    {
        $this->wasNotified = true;
    }

    public function wasNotified()
    {
        return $this->wasNotified;
    }
}

class ObservableTest extends \PHPUnit_Framework_TestCase
{
    private $observable;
    private $observer;

    protected function setUp()
    {
        $this->observable = new ConcreteObservable();
        $this->observer = new ConcreteObserver();
    }

    /**
     * @test
     */
    public function observerShouldBeNotified()
    {
        $this->observable->attach($this->observer);
        $this->observable->notify();

        $this->assertTrue($this->observer->wasNotified());
    }
}
