<?php

namespace Funddy\Module\CoreModule\Tests\Application\Fixture;

use Funddy\Component\Fixture\Fixture\FixtureLinker;

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
    public function shouldGetAnObjectPreviouslySetted()
    {
        $this->fixtureLinker->add(self::IRRELEVANT_FIXTURE_REFERENCE_NAME, self::IRRELEVANT_FIXTURE_OBJECT);

        $this->assertThat(self::IRRELEVANT_FIXTURE_OBJECT, $this->identicalTo($this->fixtureLinker->get(self::IRRELEVANT_FIXTURE_REFERENCE_NAME)));
    }
}
