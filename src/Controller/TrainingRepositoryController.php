<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingRepositoryController extends AbstractController
{
    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;


    // public function __construct(AnimalRepository $animalRepository)
    // {
    //     $this->animalRepository=$animalRepository;
    // }

    public function __construct(AnimalRepository $animalRepository, EntityManagerInterface $em)
    {
        $this->animalRepository=$animalRepository;
        $this->em=$em;
    }

    /**
     * @Route("/training/repository", name="training_repository")
     */
    public function index(): Response
    {
        // $animal=$this->animalRepository->find(1);
        // dump($animal);

        // $animal=$this->animalRepository->findOneBy(['nickName' => 'roger']);
        // dump($animal);

        // $animals=$this->animalRepository->findAll();
        // dump($animals);

        // $animals=$this->animalRepository->findBy(['nickName' => 'roger']);
        // dump($animals);

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }


    /**
     * @Route("/create-animal", name="create_animal")
     */
    public function createAnimal()
    {
        $animalEntity = new Animal();
        $animalEntity->setNickName('loulou');
        $animalEntity->setType('loutre');
        $this->em->persist($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

     /**
     * @Route("/update-animal/{id}", name="update_animal")
     */
    public function updateAnimal(string $id)
    {
        $animalEntity = $this->animalRepository->find($id);
        $animalEntity->setNickName('loulou2');
        $this->em->persist($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }

    /**
     * @Route("/remov-animal/{id}", name="remove_animal")
     */
    public function removeAnimal(string $id)
    {
        $animalEntity = $this->animalRepository->find($id);
        $this->em->remove($animalEntity);
        $this->em->flush();

        return $this->render('training_repository/index.html.twig', [
            'controller_name' => 'TrainingRepositoryController',
        ]);
    }
}
