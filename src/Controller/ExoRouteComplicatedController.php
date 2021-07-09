<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Entity\Animal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExoRouteComplicatedController extends AbstractController
{
    /**
     * @Route("/exo-complicated/exo1", name="exo-complicated-1")
     */
    public function exoComplicated1(): Response
    {
        $owner = new Owner();
        $animal= new Animal();

        $owner->setFirstName('june le S');
        $owner->setLastName('DZ');

        $animal->setNickName('jeremims');
        $animal->setType('dog');

        $owner->addAnimal($animal);
        $animal->setOwner($owner);

        return $this->render('exo_route_complicated/index.html.twig', [
            'controller_name' => 'ExoRouteComplicatedController',
            'animal' => $animal
        ]);
    }

    /**
     * @Route("/exo-complicated/exo2/{route}", name="exo-complicated-2")
     */
    public function exoComplicated2(string $route): Response
    {
        if($route == 'bidule'){
            return $this->render('exo_route_complicated/bidule.html.twig');

        }elseif($route == 'machin'){
            return $this->render('exo_route_complicated/machin.html.twig');
  
        }elseif($route == 'pignouf'){
            return $this->render('exo_route_complicated/pignouf.html.twig');
  
        }elseif($route == 'truc'){
            return $this->render('exo_route_complicated/truc.html.twig');
  
        }
        
    }

    /**
     * @Route("/exo-complicated/exo3/{nbAnimal}", name="exo-complicated-3")
     */
    public function exoComplicated3(int $nbAnimal): Response
    {
        $owner=new Owner();
        for($i=0;$i<$nbAnimal;$i++){
            $animal= new Animal();
            $animal->setNickName('number'.$i);
            $animal->setType('cat');
            $owner->addAnimal($animal);
        }
        return $this->render('exo_route_complicated/exo3.html.twig', [
            'controller_name' => 'ExoRouteComplicatedController',
            'owner' => $owner
        ]);        
    }

    /**
     * @Route("/exo-complicated/exo4", name="exo-complicated-4")
     */
    public function exoComplicated4(Request $request): Response
    {

        return $this->render('exo_route_complicated/exo4.html.twig', [
            'controller_name' => 'ExoRouteComplicatedController',
            'getParam' => $request->query->get('name')
        ]);        
    }

    /**
     * @Route("/exo-complicated/exo5", name="exo-complicated-5")
     */
    public function exoComplicated5(): Response
    {
        $response = new JsonResponse(['data' => 'machin']);

        return $response;        
    }
}
