<?php

namespace Funddy\Fixture\Fixture;

class FixtureLinker
{
    private $objects = array();

    public function add($name, $object)
    {
        $this->objects[$name] = $object;
    }

    public function has($name)
    {
        return isset($this->objects[$name]);
    }

    public function get($name)
    {
        return $this->objects[$name];
    }
}
