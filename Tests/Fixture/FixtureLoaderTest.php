<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Component\Fixture\Fixture\FixtureLoader;
use Mockery as m;

class FixtureLoaderTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_FIXTURE_NAME = 'XXXX';
    const IRRELEVANT_FIXTURE_NAME2 = 'XXXXX';

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
        $fixture = $this->createFixtureMockForLoaderWithNameAndOrder(self::IRRELEVANT_FIXTURE_NAME, 0);
        $this->fixtureLoader->addFixture($fixture);
        $this->fixtureLoader->loadAll();

        $this->assertThat(self::IRRELEVANT_FIXTURE_NAME, $this->identicalTo($this->fixtureLoader->lastLoadedFixtureName()));
    }

    private function createFixtureMockForLoaderWithNameAndOrder($name, $order)
    {
        $fixture = m::mock('Funddy\Component\Fixture\Fixture\Fixture');
        $fixture->shouldReceive('load')->withNoArgs()->once();
        $fixture->shouldReceive('getName')->withNoArgs()->once()->andReturn($name);
        $fixture->shouldReceive('getOrder')->withNoArgs()->times(3)->andReturn($order);

        return $fixture;
    }

    /**
     * @test
     */
    public function fixturesShouldBeLoadedInOrder()
    {
        $this->fixtureLoader->addFixture(
            $this->createFixtureMockForLoaderWithNameAndOrder(self::IRRELEVANT_FIXTURE_NAME, 0)
        );
        $this->fixtureLoader->addFixture(
            $this->createFixtureMockForLoaderWithNameAndOrder(self::IRRELEVANT_FIXTURE_NAME2, 1)
        );
        $this->fixtureLoader->loadAll();

        $this->assertThat(self::IRRELEVANT_FIXTURE_NAME2, $this->identicalTo($this->fixtureLoader->lastLoadedFixtureName()));
    }
}
