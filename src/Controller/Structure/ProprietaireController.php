<?php

declare(strict_types=1);

namespace App\Controller\Structure;

use App\Controller\BaseController;
use App\Entity\User;
use App\Entity\Agences;
use App\Service\Admin\UserService;
use App\Form\Type\UserProprietaireType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ProprietaireController extends BaseController
{
    /**
     * @Route("/structure/proprietaire", name="structure_proprietaire")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findAll();
        $curt_user = $this->get('security.token_storage')->getToken()->getUser();
        $curt_user_agce_id = $curt_user->getAgenceId()->getId();
        $curt_user_str_id = $curt_user->getAgenceId()->getStructureId()->getId();
        $users_pro = $repository->testUser($curt_user_agce_id, $curt_user_str_id);
        //dd($users_pro);

        return $this->render('structure/proprietaire/index.html.twig', [
            'site' => $this->site(),
            'users' => $users_pro,
            'controller_name' => 'users',
        ]);
    }

    /**
     * @Route("/structure/proprietaire/{id<\d+>}/property",methods={"GET", "POST"}, name="structure_proprietaire_property")
     */
    public function property(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $curt_user = $this->get('security.token_storage')->getToken()->getUser();
        $curt_user_agce_id = $curt_user->getAgenceId()->getId();
        $curt_user_str_id = $curt_user->getAgenceId()->getStructureId()->getId();
        $users_pro = $repository->testUser($curt_user_agce_id, $curt_user_str_id);
        //dd($users_pro[0]);

        return $this->render('structure/proprietaire/index.html.twig', [
            'site' => $this->site(),
            'users' => $users_pro,
            'controller_name' => 'users',
        ]);
    }
    /**
     * @Route("/structure/proprietaire/new", name="structure_proprietaire_new")
     */
    public function new(Request $request,  UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = new User();

        $repository = $this->getDoctrine()->getRepository(Agences::class);

        $agences = $repository->findAll();


        $form = $this->createForm(UserProprietaireType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(['ROLE_PROPRIETAIRE']);
            $user->setUsername($_POST['user_proprietaire']['username']);
            $user->setEmail($_POST['user_proprietaire']['email']);
            $user->setAgenceId($entityManager->getReference(Agences::class, $_POST['agence']));

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('structure/proprietaire/new.html.twig', [
            'site' => $this->site(),
            'users' => $user,
            'agences' => $agences,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Proprietaire entity.
     *
     * @Route("/structure/proprietaire/{id<\d+>}/edit",methods={"GET", "POST"}, name="structure_proprietaire_edit")
     */
    public function edit(Request $request, User $user, UserService $service, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        /*if (!empty($_POST)) {
            dd($_POST);
        }*/

        $form = $this->createForm(UserProprietaireType::class, $user);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(Agences::class);

        $agences = $repository->findAll();


        if ($form->isSubmitted()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(['ROLE_PROPRIETAIRE']);
            $user->setAgenceId($entityManager->getReference(Agences::class, $_POST['agence']));
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('structure_proprietaire');
        }

        return $this->render('structure/proprietaire/edit.html.twig', [
            'site' => $this->site(),
            'agences' => $agences,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a Proprietaire entity.
     *
     * @Route("structure/proprietaire{id<\d+>}/delete", methods={"POST"}, name="structure_proprietaire_delete")
     * @IsGranted("ROLE_STRUCTURE")
     */
    public function delete(Request $request, User $user, UserService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('structure_proprietaire');
        }
        $service->remove($user);
        return $this->redirectToRoute('structure_proprietaire');
    }
}