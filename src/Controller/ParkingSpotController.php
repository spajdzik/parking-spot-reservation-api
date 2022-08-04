<?php

namespace App\Controller;

use App\Entity\ParkingSpot;
use App\Repository\ParkingSpotRepository;
use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ParkingSpotController extends AbstractController
{

    public function __construct(
        private readonly ParkingSpotRepository $repository
    )
    {
    }

    /**
     * @throws \Exception
     */
    #[Route('/parking-spot/generator', methods: 'POST')]
    public function generator(): JsonResponse
    {
        throw new ServiceException(new ServiceExceptionData(404, 'Parking spot generator is disabled'));

        $result = $this->createParkingSpotGarage(114, 1, 'G3', '19E');

        if (!$result) {
            throw new \Exception('Could not generate G3');
        }

        $result = $this->createParkingSpotGarage(163, 1, 'G2', '19');

        if (!$result) {
            throw new \Exception('Could not generate G2');
        }

        $result = $this->createParkingSpotGarage(149, 2, 'G1', '22');

        if (!$result) {
            throw new \Exception('Could not generate G1');
        }

        return new JsonResponse(data: 'data generated successfully', json: true);
    }

    /**
     * @throws \Exception
     */
    private function createParkingSpotGarage(int $spotNumber, string $stage, string $garage, string $nearestStaircase): bool
    {
        try {

            for ($i = 1; $i <= $spotNumber; $i++) {

                $parkingSpot = $this->createParkingSpot();

                $parkingSpot->setStage($stage);
                $parkingSpot->setGarage($garage);
                $parkingSpot->setNearestStaircase($nearestStaircase);

                $parkingSpot->setSpot(1);
                $parkingSpot->setCode($parkingSpot->getGarage() . '.' . $parkingSpot->getSpot());

                $this->repository->add($parkingSpot, $i === $spotNumber);
            }
        }
        catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
        return true;
    }

    private function createParkingSpot(): ParkingSpot
    {
        $parkingSpot = new ParkingSpot();
        $parkingSpot->setAvailable(false);

        return $parkingSpot;
    }
}