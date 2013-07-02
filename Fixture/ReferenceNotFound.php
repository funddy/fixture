<?php

namespace Funddy\Fixture\Fixture;

class ReferenceNotFound extends \RuntimeException
{
    public function __construct($reference, $fixture)
    {
        parent::__construct(sprintf(
            'Undefined fixture reference "%s" at fixture "%s". Your fixtures need to be ordered?', $reference, $fixture
        ));
    }
}