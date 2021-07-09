<?php

namespace App\Controller;

use App\Entity\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoRouteController extends AbstractController
{
    /**
     * @Route("/exo/onEnAGros", name="onEnAGros")
     */
    public function onEnAGros(): Response
    {
        $str = 'On en a gros !';
        return $this->render('exo_route/index.html.twig', [
            'controller_name' => 'ExoRouteController',
            'str' => $str
        ]);
    }

    /**
     * @Route("/exo/OwnerAttributePrint/{param}", name="OwnerAttributePrint")
     */
    public function OwnerAttributePrint(string $param): Response
    {
        $owner = new Owner();
        $owner->setFirstName($param);
        return $this->render('exo_route/index.html.twig', [
            'controller_name' => 'ExoRouteController',
            'str' => $owner->getFirstName()
        ]);
    }

    /**
     * @Route("/exo/operation/{firstNmbr}/{operator}/{secondNmbr}", name="operation")
     */
    public function operation(int $firstNmbr, string $operator, int $secondNmbr): Response
    {
        if($operator == 'add'){
            $result=$firstNmbr + $secondNmbr;
        }elseif($operator == 'divide'){
            $result=$firstNmbr/$secondNmbr;
        }elseif($operator == 'substract'){
            $result=$firstNmbr - $secondNmbr;
        }elseif($operator == 'multiply'){
            $result=$firstNmbr * $secondNmbr;
        }
        return $this->render('exo_route/index.html.twig', [
            'controller_name' => 'ExoRouteController',
            'str' => $result
        ]);
    }

    /**
     * @Route("/exo/exo4", name="exo4")
     */
    public function exo4(): Response
    {
        return $this->redirectToRoute('onEnAGros');
    }

    /**
     * @Route("/exo/exo5", name="exo5")
     */
    public function exo5(): Response
    {
        return $this->redirectToRoute('OwnerAttributePrint',array('param' => 'june'));
    }

    /**
     * @Route("/exo/exo6{param}", name="exo6")
     */
    public function exo6($param = null): Response
    {
        $str = 'Pas d\'erreur :) !';
        return $this->render('exo_route/index.html.twig', [
            'controller_name' => 'ExoRouteController',
            'str' => $str
        ]);
    }
}
