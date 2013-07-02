<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Fixture\Fixture\FixtureLinker;

class FixtureLinkerTest extends \PHPUnit_Framework_TestCase
{
    const IRRELEVANT_FIXTURE_REFERENCE_NAME = 'XXX';
    const IRRELEVANT_FIXTURE_OBJECT = 'XXXX';

    private $fixtureLinker;

    protected function setUp()
    {
        $this->fixtureLinker = new FixtureLinker();
    }

    /**
     * @test
     */
    public function getASetObject()
    {
        $this->fixtureLinker->add(self::IRRELEVANT_FIXTURE_REFERENCE_NAME, self::IRRELEVANT_FIXTURE_OBJECT);

        $fixture = $this->fixtureLinker->get(self::IRRELEVANT_FIXTURE_REFERENCE_NAME);

        $this->assertThat($fixture, $this->identicalTo(self::IRRELEVANT_FIXTURE_OBJECT));
    }

    /**
     * @test
     */
    public function hasName()
    {
        $this->fixtureLinker->add(self::IRRELEVANT_FIXTURE_REFERENCE_NAME, self::IRRELEVANT_FIXTURE_OBJECT);

        $has = $this->fixtureLinker->has(self::IRRELEVANT_FIXTURE_REFERENCE_NAME);

        $this->assertThat($has, $this->isTrue());
    }

    /**
     * @test
     */
    public function hasNoName()
    {
        $has = $this->fixtureLinker->has(self::IRRELEVANT_FIXTURE_REFERENCE_NAME);

        $this->assertThat($has, $this->isFalse());
    }
}
