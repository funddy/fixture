<?php

namespace Funddy\Fixture\Fixture;

abstract class Fixture
{
    private $fixtureLinker;

    public function setFixtureLinker(FixtureLinker $fixtureLinker)
    {
        $this->fixtureLinker = $fixtureLinker;
    }

    public function addReference($object, $name)
    {
        $this->fixtureLinker->add($name, $object);
    }

    public function getReference($name)
    {
        if (!$this->fixtureLinker->has($name)) {
            throw new ReferenceNotFound($name, $this->getName());
        }

        return $this->fixtureLinker->get($name);
    }

    public function getName()
    {
        return get_called_class();
    }

    abstract public function load();

    abstract public function getOrder();
}
