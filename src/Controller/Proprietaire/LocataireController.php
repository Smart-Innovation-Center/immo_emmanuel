<?php

declare(strict_types=1);

namespace App\Controller\Proprietaire;

use App\Controller\BaseController;
use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use App\Service\Admin\UserService;
use App\Service\Proprietaire\LocataireService;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LocataireController extends BaseController
{
    /**
     * @Route("/proprietaire/locataire", defaults={"page": "1"}, methods={"GET"}, name="proprietaire_locataire")
     */
   public function index(UserRepository $repository): Response
    {
        $users = $repository->findAll();
        //->where("users.role =ROLE_ADMIN");

        return $this->render('proprietaire/locataire/index.html.twig', [
            'site' => $this->site(),
            'users' => $users,
        ]);
    }

    /**
     * @Route("/proprietaire/locataire/new", name="proprietaire_locataire_new")
     */
    public function new(Request $request, LocataireService $service): Response
    {
        $user = new User();

        dd($user);
        $form = $this->createForm(UserType::class, $user)
            ->add('saveAndCreateNew', SubmitType::class);
        $form->handleRequest($request);

        //dd($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->create($user);

            /** @var ClickableInterface $button */
            $button = $form->get('saveAndCreateNew');
            if ($button->isClicked()) {
                return $this->redirectToRoute('proprietaire_locataire_new');
            }

            return $this->redirectToRoute('proprietaire_locataire');
        }

        return $this->render('proprietaire/locataire/new.html.twig', [
            'site' => $this->site(),
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

     /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/proprietaire/locataire/{id<\d+>}/edit",methods={"GET", "POST"}, name="proprietaire_locataire_edit")
    */
    public function edit(Request $request, User $user, UserService $service): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->update($user);
            return $this->redirectToRoute('proprietaire_locataire');
        }

        return $this->render('proprietaire/locataire/edit.html.twig', [
            'site' => $this->site(),
            'form' => $form->createView(),
        ]);
    }

     /**
     * Deletes an Locataire entity.
     *
     * @Route("/proprietaire/locataire/{id<\d+>}/delete", methods={"POST"}, name="proprietaire_locataire_delete")
     * 
    */
    public function delete(Request $request, User $user, UserService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('proprietaire_locataire');
        }

        $service->remove($user);

        return $this->redirectToRoute('proprietaire_locataire');
    }
}