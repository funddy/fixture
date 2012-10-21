<?php

namespace Funddy\Component\Fixture\Fixture;

use Funddy\Component\Fixture\Observer\Observable;

class FixtureLoader extends Observable
{
    private $fixtures;
    private $lastLoadedFixtureName;

    public function addFixture(Fixture $fixture)
    {
        if (!isset($this->fixtures[$fixture->getOrder()])) {
            $this->fixtures[$fixture->getOrder()] = array();
        }

        $this->fixtures[$fixture->getOrder()][] = $fixture;
    }

    public function loadAll()
    {
        foreach ($this->fixtures as $fixtureArray) {
            foreach ($fixtureArray as $fixture) {
                $this->loadFixture($fixture);
            }
        }
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
