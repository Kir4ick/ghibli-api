<?php

namespace App\Controller;

use App\Attributes\RequestBody;
use App\Request\Authentication\SignInRequest;
use App\Services\Authentication\Interfaces\AuthenticationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    public function __construct(
        private readonly AuthenticationInterface $authentication
    ){}

    #[Route(path: '/', methods: ['GET'])]
    public function signIn(#[RequestBody] SignInRequest $request): JsonResponse
    {
        return $this->json($request);
    }
}
