<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(name: 'user_')]
class DefaultController extends AbstractController
{

    const users = [
        [
            'id' => 12,
            'name' => 'Paul'
        ],
        [
            'id' => 14,
            'name' => 'Jean'
        ],
        [
            'id' => 22,
            'name' => 'Marie'
        ],
        [
            'id' => 1,
            'name' => 'Sophie'
        ],
    ];

    #[Route(path: '/', name: 'index')]
    public function index(): Response
    {
        return $this->render('index.html.twig', ['users' => self::users]);
    }

    #[Route('/{id}', name: 'profile')]
    public function profile(string $id): Response
    {
        $userIndex = array_search($id, array_column(self::users, 'id'));
        if ($userIndex === false) {
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas !');
        }
        return $this->render('user/user_profile.html.twig', ['user' => self::users[$userIndex]]);
    }
}
