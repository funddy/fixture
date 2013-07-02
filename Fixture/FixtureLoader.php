<?php

namespace Funddy\Fixture\Fixture;

class FixtureLoader
{
    protected $observers = array();
    private $fixtures;

    public function addFixture(Fixture $fixture)
    {
        $this->fixtures[] = $fixture;
    }

    public function attach($observer)
    {
        if (!in_array($observer, $this->observers)) {
            $this->observers[] = $observer;
        }
    }

    public function loadAll()
    {
        foreach ($this->orderFixtures() as $fixture) {
            $this->loadFixture($fixture);
        }
    }

    private function orderFixtures()
    {
        $orderedFixtures = $this->fixtures;
        //@ is for preventing PHP bug https://bugs.php.net/bug.php?id=50688
        @usort($orderedFixtures, function (Fixture $f1, Fixture $f2) {
            if ($f1->getOrder() === $f2->getOrder()) {
                return 0;
            }
            return ($f1->getOrder() < $f2->getOrder()) ? -1 : 1;
        });
        return $orderedFixtures;
    }

    private function loadFixture(Fixture $fixture)
    {
        $fixture->load();
        $this->notifyFixtureLoaded($fixture->getName());
    }

    private function notifyFixtureLoaded($fixtureName)
    {
        foreach ($this->observers as $observer) {
            $observer->fixtureLoaded($fixtureName);
        }
    }
}
