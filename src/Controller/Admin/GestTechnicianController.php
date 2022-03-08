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

final class GestTechnicianController extends BaseController
{

    /**
     * @Route("/admin/gest-technician", name="admin_gest_technicians")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $technicians = $repository->nbr_of_Technician();
        //dd($technicians);
        return $this->render('admin/gest_technician/index.html.twig', [
            'site' => $this->site(),
            'technicians' => $technicians
        ]);
    }

    /**
     * @Route("/admin/gest-technician-val", name="admin_gest_technician_val")
     */
    public function validate(UserRepository $TechniciansRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $technicians = $TechniciansRepository->activeTechnician($id);

        return $this->redirectToRoute('admin_gest_technicians');
    }

    /**
     * @Route("/admin/gest-technician-cancel", name="admin_gest_technician_cancel")
     */
    public function annulation(UserRepository $TechniciansRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $technicians = $TechniciansRepository->desactiveTechnician($id);

        return $this->redirectToRoute('admin_gest_technicians');
    }
}