<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly JWTEncoderInterface $jwtEncoder)
    {
    }

    /**
     * @throws JWTEncodeFailureException
     */
    #[Route('/register', name: 'app_auth_register')]
    public function register(): JsonResponse
    {
        $credentials = [
            'email' => 'grzegorz@spayda.pl',
            'password' => 'test',
        ];
        $data = $this->jwtEncoder->encode($credentials);

        return new JsonResponse($data);
    }

    /**
     * @throws JWTEncodeFailureException
     */
    #[Route('/login', name: 'app_auth_login')]
    public function login(): JsonResponse
    {
        $credentials = [
            'email' => 'grzegorz@spayda.pl',
            'password' => 'test',
        ];
        $data = $this->jwtEncoder->encode($credentials);

        return new JsonResponse($data);
    }
}