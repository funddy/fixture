Funddy Fixture
==============

[![Build Status](https://secure.travis-ci.org/funddy/fixture.png?branch=master)](http://travis-ci.org/funddy/fixture)

Very simple fixtures library.

Setup and Configuration
-----------------------
Add the following to your composer.json file:
```json
{
    "require": {
        "funddy/fixture": "2.0.*"
    }
}
```

Update the vendor libraries:

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

Usage
-----
```php
<?php

require 'vendor/autoload.php';

use Funddy\Fixture\Fixture\Fixture;
use Funddy\Fixture\Fixture\FixtureLinker;
use Funddy\Fixture\Fixture\FixtureLoader;

class HelloFixture extends Fixture
{
    public function load()
    {
        echo 'Hello!';
        $this->setReference('var', 'var');
    }

    public function getOrder()
    {
        return 0;
    }
}

class FooFixture extends Fixture
{
    private $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function load()
    {
        echo $this->foo;
        echo $this->getReference('var');
    }

    public function getOrder()
    {
        return 1;
    }
}

$fixtureLoader = new FixtureLoader();
$fixtureLinker = new FixtureLinker();

$helloFixture = new HelloFixture();
$helloFixture->setFixtureLinker($fixtureLinker);
$fixtureLoader->addFixture($helloFixture);

$fooFixture = new FooFixture('foo');
$fooFixture->setFixtureLinker($fixtureLinker);
$fixtureLoader->addFixture($fooFixture);

$fixtureLoader->loadAll();//Hello!foovar
```