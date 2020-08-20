<?php

namespace App\Controller;

use App\Entity\Apple;
use App\Entity\AppleSearch;
use App\Form\AppleSearchType;
use App\Repository\AppleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @param Request $request
     * @param AppleRepository $appleRepository
     * @return Response
     */
    public function index(Request $request, AppleRepository $appleRepository)
    {
        $search = new AppleSearch();
        $form = $this->createForm(AppleSearchType::class, $search);
        //dd($request);
        $form->handleRequest($request);
        $apples = $appleRepository->findAppleFiltered($search);

        return $this->render('public/index.html.twig', [
            'apples' => $apples,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("pomme/{id<[0-9]+>}", name="app_public_apples_show", methods={"GET"})
     * @param Apple $apple
     * @return Response
     */
    public function show(Apple $apple) : Response
    {

        return $this->render('public/show.html.twig', compact('apple'));
    }
}
