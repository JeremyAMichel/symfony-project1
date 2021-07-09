<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Entity\Animal;
use App\Repository\OwnerRepository;
use App\Entity\Owner;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExoRepositoryController extends AbstractController
{

    /**
     * @var AnimalRepository
     */
    private $animalRepository;


    /**
     * @var OwnerRepository
     */
    private $ownerRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $em, OwnerRepository $ownerRepository)
    {
        $this->animalRepository=$animalRepository;
        $this->em=$em;
        $this->ownerRepository=$ownerRepository;
    }

    /**
     * @Route("/exoRepository/exo7", name="exo_repository7")
     */
    public function exo7(): Response
    {
        $owners=$this->ownerRepository->findAll();
        dump($owners);
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }

    /**
     * @Route("/exoRepository/exo8/{id}", name="exo_repository8")
     */
    public function exo8(string $id): Response
    {
        $owner=$this->ownerRepository->find($id);
        dump($owner);
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }

    /**
     * @Route("/exoRepository/exo9/{name}", name="exo_repository9")
     */
    public function exo9(string $name): Response
    {
        $owner=$this->ownerRepository->findOneBy(['firstName' => $name]);
        dump($owner);
        $animalsOfOwner=$this->animalRepository->findBy(['owner' => $owner->getId()]);
        dump($animalsOfOwner);
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }

    /**
     * @Route("/exoRepository/exo10/{firstName}/{lastName}", name="exo_repository10")
     */
    public function exo10(string $firstName, string $lastName): Response
    {
        $owner=new Owner();
        $owner->setFirstName($firstName);
        $owner->setLastName($lastName);

        $this->em->persist($owner);
        $this->em->flush();

        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }

    /**
     * @Route("/exoRepository/exo11/{idOwner}", name="exo_repository11")
     */
    public function exo11(int $idOwner): Response
    {
        $owner=$this->ownerRepository->find($idOwner);
        $owner->setFirstName('Alexandre');

        $this->em->persist($owner);
        $this->em->flush();
        
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }


    /**
     * @Route("/exoRepository/exo12/{name}", name="exo_repository12")
     */
    public function exo12(string $name): Response
    {
        $owners=$this->ownerRepository->findBy(['firstName' => $name]);

        foreach($owners as $owner){
            $this->em->remove($owner);
            $this->em->flush();
        }
        
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }


    /**
     * @Route("/exoRepository/exo13/{id}", name="exo_repository13")
     */
    public function exo13(int $id): Response
    {
        $owner=$this->ownerRepository->find($id);
        $animalsOfOwner=$this->animalRepository->findBy(['owner' => $owner->getId()]);
        foreach($animalsOfOwner as $animal){
            $animal->setOwner(null);
            $this->em->persist($owner);
            
        }
        $this->em->flush();
        
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }

    /**
     * @Route("/exoRepository/exo14/{ageMin}/{ageMax}", name="exo_repository14")
     */
    public function exo14(int $ageMin, int $ageMax): Response
    {
        $animals=$this->animalRepository->findByAgeMinAgeMax($ageMin,$ageMax);
        dump($animals);
        
        return $this->render('exo_repository/index.html.twig', [
            'controller_name' => 'ExoRepositoryController',
        ]);
    }
}
