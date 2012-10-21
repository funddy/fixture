<?php

namespace Funddy\Component\Fixture\Fixture;

class FixtureLinker
{
    private $objects = array();

    public function add($name, $object)
    {
        $this->objects[$name] = $object;
    }

    public function get($name)
    {
        return $this->objects[$name];
    }
}
