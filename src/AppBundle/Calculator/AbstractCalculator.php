<?php

namespace AppBundle\Calculator;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Model\Change;

abstract class AbstractCalculator implements CalculatorInterface
{
    /**
     * @var string
     */
    protected $automateModel;

    abstract public function getAvailableBucks(): array;

    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {
        return $this->automateModel;
    }

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {
        $change = new Change;

        $bucks = $this->getAvailableBucks();

        for($i=0; $i<count($bucks); $i++)
        {
            if ($amount >= $bucks[$i])
            {
                switch($bucks[$i])
                {
                    case 10:
                        $change->bill10 = (int)($amount / $bucks[$i]);
                        break;
                    case 5:
                        $change->bill5 = (int)($amount / $bucks[$i]);
                        break;
                    case 2:
                        $change->coin2 = (int)($amount / $bucks[$i]);
                        break;
                    case 1:
                        $change->coin1 = (int)($amount / $bucks[$i]);
                        break;
                }
                $amount %= $bucks[$i];
            }
        }

        if ($amount != 0) return null;
        return $change;
    }
}
?>