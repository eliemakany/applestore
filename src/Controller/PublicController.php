<?php

namespace App\Controller;

use App\Repository\AppleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(AppleRepository $appleRepository)
    {
        $apples = $appleRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('public/index.html.twig', compact('apples'));
    }
}
