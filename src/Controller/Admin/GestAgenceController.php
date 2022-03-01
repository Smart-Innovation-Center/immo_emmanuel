<?php

declare(strict_types=1);


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Agences;
use App\Service\Admin\AgenceService;
use App\Form\Type\AgenceType;
use App\Repository\AgencesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class GestAgenceController extends BaseController
{
    /**
     * @Route("/admin/gest-agence", name="admin_gest_agence")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Agences::class);

        $agences = $repository->findAll();
        //dd($agences);
        return $this->render('admin/gest_agence/index.html.twig', [
            'site' => $this->site(),
            'agences' => $agences
        ]);
    }

    /**
     * @Route("/admin/gest-agence-val", name="admin_gest_agence_val")
     */
    public function validate(AgencesRepository $AgenceRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $agences = $AgenceRepository->activeAgence($id);

        return $this->redirectToRoute('admin_gest_agence');
    }

    /**
     * @Route("/admin/gest-agence-cancel", name="admin_gest_agence_cancel")
     */
    public function annulation(AgencesRepository $AgenceRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $agences = $AgenceRepository->desactiveAgence($id);

        return $this->redirectToRoute('admin_gest_agence');
    }
}