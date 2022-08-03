<?php

namespace App\Controller;

use App\Entity\ParkingSpot;
use App\Repository\ParkingSpotRepository;
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
        try {

            $parkingSpot = $this->createParkingSpot();

            $this->repository->add($parkingSpot);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }

        return new JsonResponse(data: 'data generated successfully', json: true);
    }

    private function createParkingSpot(): ParkingSpot
    {
        $parkingSpot = new ParkingSpot();
        $parkingSpot->setStage(1);
        $parkingSpot->setGarage('G3');
        $parkingSpot->setSpot(1);
        $parkingSpot->setCode($parkingSpot->getGarage() . '.' . $parkingSpot->getSpot());
        $parkingSpot->setAvailable(false);
        $parkingSpot->setNearestStaircase('19E');

        return $parkingSpot;
    }
}