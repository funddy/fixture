<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Component\Fixture\Fixture\FixtureLoader;
use Mockery as m;

class FixtureLoaderTest extends \PHPUnit_Framework_TestCase
{
    private $fixtureLoader;

    protected function setUp()
    {
        $this->fixtureLoader = new FixtureLoader();
    }

    /**
     * @test
     */
    public function shouldNotifyObserversWhileLoadFixtures()
    {
        $fixture = $this->createFixtureMockForLoaderWithNameAndOrder('fixture1', 0);
        $this->fixtureLoader->addFixture($fixture);
        $this->fixtureLoader->loadAll();

        $this->assertThat('fixture1', $this->identicalTo($this->fixtureLoader->lastLoadedFixtureName()));
    }

    private function createFixtureMockForLoaderWithNameAndOrder($name, $order)
    {
        $fixture = m::mock('Funddy\Component\Fixture\Fixture\Fixture');
        $fixture->shouldReceive('load')->withNoArgs()->once();
        $fixture->shouldReceive('getName')->withNoArgs()->once()->andReturn($name);
        $fixture->shouldReceive('getOrder')->withNoArgs()->andReturn($order);

        return $fixture;
    }

    /**
     * @test
     */
    public function fixturesShouldBeLoadedInOrder()
    {
        $this->fixtureLoader->addFixture(
            $this->createFixtureMockForLoaderWithNameAndOrder('fixture1', 0)
        );
        $this->fixtureLoader->addFixture(
            $this->createFixtureMockForLoaderWithNameAndOrder('fixture2', 1)
        );
        $this->fixtureLoader->loadAll();

        $this->assertThat('fixture2', $this->identicalTo($this->fixtureLoader->lastLoadedFixtureName()));
    }
}
