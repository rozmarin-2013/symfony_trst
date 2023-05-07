<?php

declare(strict_types=1);

namespace App\AUTH\Presentation\Http;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\HttpFoundation\Response;

class ApiLoginController extends AbstractController
{
    #[Route('/login', name: 'api_login', methods: ['POST'])]
   public function __invoke(#[CurrentUser] ?User $user): Response
   {
       if (null === $user) {
           return $this->json([
               'message' => 'missing credentials',
               ], Response::HTTP_UNAUTHORIZED);
       }

       $token= bin2hex(random_bytes(60));

       return $this->json([
           'user'  => $user->getUserIdentifier(),
           'token' => $token,
       ]);
   }
}
