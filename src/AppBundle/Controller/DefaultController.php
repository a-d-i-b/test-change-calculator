<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Model\Change;
use AppBundle\Registry\CalculatorRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    private $registry;
    
    public function __construct()
    {
        $this->registry = new CalculatorRegistry;
    }

    /**
     * @Route("/automaton/{mk}/change/{amount}")
     */
    public function automatonMk(string $mk, int $amount)
    {
        $response = null;

        $calculator = $this->registry->getCalculatorFor($mk);

        if ($calculator == null)
        {
            $response = new Response(
                json_encode(null),
                Response::HTTP_OK,
                array('Content-Type', 'application/json')
            );
        }
        else
        {
            $change = $this->registry->getCalculatorFor($mk)->getChange($amount);

            $response = new Response(
                json_encode($change),
                Response::HTTP_OK,
                array('Content-Type', 'application/json')
            );
        }

        $response->send();
    }
}
