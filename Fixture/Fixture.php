<?php

namespace Funddy\Component\Fixture\Fixture;

abstract class Fixture
{
    private $fixtureLinker;

    public function setFixtureLinker($fixtureLinker)
    {
        $this->fixtureLinker = $fixtureLinker;
    }

    public function addReference($object, $name)
    {
        $this->fixtureLinker->add($name, $object);
    }

    public function getReference($name)
    {
        return $this->fixtureLinker->get($name);
    }

    public function getName()
    {
        return get_called_class();
    }

    abstract public function load();
    abstract public function getOrder();
}
