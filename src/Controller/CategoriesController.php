<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Utils\FlashMessages;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoriesController
 * @package App\Controller
 * @Route(path="/admin", name="app_categories_")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="list", methods={"GET"})
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository) : Response
    {
        $categories = $categoryRepository->findBy([], ['createdAt' => 'DESC']);
        return $this->render('categories/index.html.twig', compact('categories'));
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserRepository $userRepository
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em, UserRepository $userRepository) : Response
    {
        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();
            $category->setUser($user);
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', FlashMessages::createSuccessMessage('catégorie', 'créée'));

            return $this->redirectToRoute('app_categories_list');
        }

        return $this->render('categories/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/categories/{id<[0-9]+>}/edit", name="edit", methods={"GET", "PUT"} )
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Category $category
     * @param UserRepository $userRepository
     * @return Response
     *
     */
    public function edit(Request $request, EntityManagerInterface $em, Category $category, UserRepository $userRepository) : Response
    {
        $form = $this->createForm(CategoryType::class, $category, ['method' => "PUT"]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $this->getUser();
            $category->setUser($user);
            $em->flush();
            $this->addFlash('success', FlashMessages::createSuccessMessage('catégorie', 'modifiée'));
            return $this->redirectToRoute('app_categories_list');
        }

        return $this->render('categories/edit.html.twig', [
            'form' => $form->createView(),
            'apple' => $category
        ]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Category $category
     * @return Response
     * @Route("/categories/{id<[0-9]+>}/delete", name="delete", methods={"DELETE"} )
     */
    public function delete(Request $request, EntityManagerInterface $em, Category $category) : Response
    {

        if($this->isCsrfTokenValid($category->getId(), $request->request->get('_token')))
        {
            $em->remove($category);
            $em->flush();
            $this->addFlash('success', FlashMessages::createSuccessMessage('catégorie', 'supprimée'));

            return $this->redirectToRoute('app_categories_list');
        }
    }
}
