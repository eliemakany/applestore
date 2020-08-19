<?php

namespace App\Controller;

use App\Entity\Apple;
use App\Form\AppleType;
use App\Repository\AppleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApplesController
 * @package App\Controller
 * @Route(path="/admin")
 */
class ApplesController extends AbstractController
{
    /**
     * @Route("/apples", name="app_apples")
     */
    public function index(AppleRepository $appleRepository) : Response
    {
        $apples = $appleRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('apples/index.html.twig', compact('apples'));
    }

    /**
     * @Route("/apples/create", name="app_apples_create", methods={"GET", "POST"})
     */
    public function create(Request $request, EntityManagerInterface $em, UserRepository $userRepository) : Response
    {
        $apple = new Apple();
        $form = $this->createForm(AppleType::class, $apple);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();
            $apple->setUser($user);
            $em->persist($apple);
            $em->flush();

            $this->addFlash('success', 'La pomme a été ajoutée avec succès !');

            return $this->redirectToRoute('app_apples');
        }

        return $this->render('apples/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/apples/{id<[0-9]+>}", name="app_apples_show", methods={"GET"})
     */
    public function show(Apple $apple) : Response
    {

        return $this->render('apples/show.html.twig', compact('apple'));
    }

    /**
     * @Route("/apples/{id<[0-9]+>}/edit", name="app_apples_edit", methods={"GET", "PUT"} )
     */
    public function edit(Request $request, EntityManagerInterface $em, Apple $apple, UserRepository $userRepository) : Response
    {
        $form = $this->createForm(AppleType::class, $apple, ['method' => "PUT"]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();
            $apple->setUser($user);
            $em->flush();
            $this->addFlash('success', 'La pomme a été modifié avec succès !');
            return $this->redirectToRoute('app_apples');
        }

        return $this->render('apples/edit.html.twig', [
            'form' => $form->createView(),
            'apple' => $apple
        ]);
    }

    /**
     * @Route("/apples/{id<[0-9]+>}/delete", name="app_apples_delete", methods={"DELETE"} )
     */
    public function delete(Request $request, EntityManagerInterface $em, Apple $apple) : Response
    {

        if($this->isCsrfTokenValid($apple->getId(), $request->request->get('_token')))
        {
            $em->remove($apple);
            $em->flush();
            $this->addFlash('success', 'La pomme a été supprimé avec succès !');

            return $this->redirectToRoute('app_apples');
        }
    }
}
