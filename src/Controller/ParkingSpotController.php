<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ParkingSpotController extends AbstractController
{

    public function __construct(
        private ParkingSpotRepository $repository
    )
    {
    }

    #[Route('/parking-spot/generator', methods: 'POST')]
    public function generator()
    {
//        $this->repository->findAll();
        return new JsonResponse(data: 'data generated successfully', json: true);
    }
}