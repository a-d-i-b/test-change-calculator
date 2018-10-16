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
    /**
     * @Route("/automaton/{mk}/change/{amount}")
     */
    public function automatonMk(string $mk, int $amount)
    {
        $response = new Response();

        $calculator = $this->get('calculator')->getCalculatorFor($mk);

        if ($calculator != null)
        {
            $change = $calculator->getChange($amount);
            
            if ($change != null)
            {
                $response->setContent(json_encode($change));
                $response->setStatusCode(Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
            }
            else
            {
                $response->setStatusCode(Response::HTTP_NO_CONTENT);
            }
        }
        else
        {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $response;
    }
}
