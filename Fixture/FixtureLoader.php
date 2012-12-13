<?php

namespace Funddy\Component\Fixture\Fixture;

use Funddy\Component\Fixture\Observer\Observable;

class FixtureLoader extends Observable
{
    private $fixtures;
    private $lastLoadedFixtureName;

    public function addFixture(Fixture $fixture)
    {
        $this->fixtures[] = $fixture;
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
        $this->lastLoadedFixtureName = $fixture->getName();
        $this->notify();
    }

    public function lastLoadedFixtureName()
    {
        return $this->lastLoadedFixtureName;
    }
}
