<?php

namespace AppBundle\Calculator;

use AppBundle\Calculator\AbstractCalculator;

class Mk2Calculator extends AbstractCalculator
{
    public function __construct()
    {
        $this->automateModel = 'mk2';
    }

    public function getAvailableBucks(): array
    {
        return [10, 5, 2];
    }
}

?>