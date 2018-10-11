<?php

namespace AppBundle\Calculator;

use AppBundle\Calculator\AbstractCalculator;

class Mk1Calculator extends AbstractCalculator
{

    public function __construct()
    {
        $this->automateModel = 'mk1';
    }

    public function getAvailableBucks(): array
    {
        return [1];
    }
}

?>