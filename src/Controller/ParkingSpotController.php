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
//        private readonly ParkingSpotRepository $repository
    )
    {
    }
}