<?php

namespace App\DataFixtures;

use App\Entity\ParkingSpot;
use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Running all fixtures: php bin/console doctrine:fixtures:load
 */
class ParkingSpotFixtures extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $result = $this->createParkingSpotGarage(114, 1, 'G3', '19E');

        if (!$result) {
            throw new ServiceException(new ServiceExceptionData(404, 'Could not generate G3'));
        }

        $result = $this->createParkingSpotGarage(163, 1, 'G2', '19');

        if (!$result) {
            throw new ServiceException(new ServiceExceptionData(404, 'Could not generate G2'));
        }

        $result = $this->createParkingSpotGarage(149, 2, 'G1', '22');

        if (!$result) {
            throw new ServiceException(new ServiceExceptionData(404, 'Could not generate G1'));
        }

        $this->manager->flush();
    }


    /**
     * @throws \Exception
     */
    private function createParkingSpotGarage(int $spotNumber, string $stage, string $garage, string $nearestStaircase): bool
    {
        for ($i = 1; $i <= $spotNumber; $i++) {

            $parkingSpot = $this->createParkingSpot();

            $parkingSpot->setStage($stage);
            $parkingSpot->setGarage($garage);
            $parkingSpot->setNearestStaircase($nearestStaircase);

            $parkingSpot->setSpot(1);
            $parkingSpot->setCode($parkingSpot->getGarage() . '.' . $parkingSpot->getSpot());

            $this->manager->persist($parkingSpot);
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