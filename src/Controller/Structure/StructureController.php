<?php

declare(strict_types=1);

namespace App\Controller\Structure;

use App\Controller\BaseController;
use App\Entity\User;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use App\Service\Admin\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class StructureController extends BaseController
{
    /**
     * @Route("/structure", defaults={"page": "1"}, methods={"GET"}, name="structure")
     */
    public function index(UserRepository $repository): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $curt_user = $this->get('security.token_storage')->getToken()->getUser();
        $curt_user_agce_id = $curt_user->getAgenceId()->getId();
        $curt_user_str_id = $curt_user->getAgenceId()->getStructureId()->getId();
        $countTenant = $repository->CountL($curt_user_agce_id, $curt_user_str_id);
        $countOwner = $repository->CountP($curt_user_agce_id, $curt_user_str_id);

        //dd($countTenant);

        return $this->render('structure/structure/index.html.twig', [
            'site' => $this->site(),
            'countTenant' => $countTenant,
            'countOwner' => $countOwner,
        ]);
    }

    /**
     * @Route("/structure/new", name="structure_new")
     */
    public function new(Request $request): Response
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
                return $this->redirectToRoute('structure_new');
            }

            return $this->redirectToRoute('structure');
        }

        return $this->render('structure/new.html.twig', [
            'site' => $this->site(),
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/structure/{id<\d+>}/edit",methods={"GET", "POST"}, name="structure_edit")
     */
    public function edit(Request $request, User $user, UserService $service): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->update($user);
            return $this->redirectToRoute('structure');
        }

        return $this->render('structure/edit.html.twig', [
            'site' => $this->site(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes an Structure entity.
     *
     * @Route("/structure/{id<\d+>}/delete", methods={"POST"}, name="structure_delete")
     * 
     */
    public function delete(Request $request, User $user, UserService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('structure');
        }

        $service->remove($user);

        return $this->redirectToRoute('structure');
    }
}