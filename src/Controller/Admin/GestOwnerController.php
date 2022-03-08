<?php

declare(strict_types=1);


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\User;
use App\Service\Admin\UserService;
use App\Form\Type\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GestOwnerController extends BaseController
{

    /**
     * @Route("/admin/gest-owner", name="admin_gest_owners")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $owners = $repository->nbr_of_owner();
        //dd($owners);
        return $this->render('admin/gest_owner/index.html.twig', [
            'site' => $this->site(),
            'owners' => $owners
        ]);
    }

    /**
     * @Route("/admin/gest-owner-val", name="admin_gest_owner_val")
     */
    public function validate(UserRepository $OwnersRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $owners = $OwnersRepository->activeOwner($id);

        return $this->redirectToRoute('admin_gest_owners');
    }

    /**
     * @Route("/admin/gest-owner-cancel", name="admin_gest_owner_cancel")
     */
    public function annulation(UserRepository $OwnersRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $owners = $OwnersRepository->desactiveOwner($id);

        return $this->redirectToRoute('admin_gest_owners');
    }
}