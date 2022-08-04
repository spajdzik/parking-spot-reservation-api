<?php

namespace App\Controller;

use App\Repository\ParkingSpotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/parking-spot', name: 'parking_spot')]
class ParkingSpotController extends AbstractController
{

    public function __construct(
        private readonly ParkingSpotRepository $repository
    )
    {
    }

    #[Route('/')]
    public function getParkingSpot(): JsonResponse
    {
        $parkingSpots = $this->repository->findAll();
        $return = [];
        foreach ($parkingSpots as $parkingSpot) {
            $return[] = [
                $parkingSpot->getCode(),
                $parkingSpot->getOwners(),
            ];
        }
        return new JsonResponse($return);
    }
}