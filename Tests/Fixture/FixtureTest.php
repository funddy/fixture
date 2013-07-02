<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Fixture\Fixture\Fixture;
use Mockery as m;

class ConcreteFixture extends Fixture {

    public function load() {}

    public function getOrder() {
        return 0;
    }
}

class FixtureTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_FIXTURE_REFERENCE_NAME = 'X';
    const IRRELEVANT_FIXTURE_OBJECT = 'XX';

    private $fixtureLinkerMock;
    private $fixture;

    public function setUp()
    {
        $this->fixtureLinkerMock = m::mock('Funddy\Fixture\Fixture\FixtureLinker');
        $this->fixture = new ConcreteFixture();
        $this->fixture->setFixtureLinker($this->fixtureLinkerMock);
    }

    /**
     * @test
     */
    public function addsReference()
    {
        $this->fixtureLinkerMock->shouldReceive('add')
            ->with(self::IRRELEVANT_FIXTURE_REFERENCE_NAME, self::IRRELEVANT_FIXTURE_OBJECT)->once();

        $this->fixture->addReference(self::IRRELEVANT_FIXTURE_OBJECT, self::IRRELEVANT_FIXTURE_REFERENCE_NAME);
    }

    /**
     * @test
     */
    public function getsReference()
    {
        $this->fixtureLinkerMock->shouldReceive('has')
            ->with(self::IRRELEVANT_FIXTURE_REFERENCE_NAME)->once()->andReturn(true);
        $this->fixtureLinkerMock->shouldReceive('get')
            ->with(self::IRRELEVANT_FIXTURE_REFERENCE_NAME)->once()->andReturn(self::IRRELEVANT_FIXTURE_OBJECT);

        $object = $this->fixture->getReference(self::IRRELEVANT_FIXTURE_REFERENCE_NAME);

        $this->assertThat($object, $this->identicalTo(self::IRRELEVANT_FIXTURE_OBJECT));
    }

    /**
     * @test
     * @expectedException Funddy\Fixture\Fixture\ReferenceNotFound
     */
    public function throwsExceptionIfReferenceWasNotFound()
    {
        $this->fixtureLinkerMock->shouldReceive('has')
            ->with(self::IRRELEVANT_FIXTURE_REFERENCE_NAME)->once()->andReturn(false);

        $this->fixture->getReference(self::IRRELEVANT_FIXTURE_REFERENCE_NAME);
    }
}
