<?php

declare(strict_types=1);


namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Structures;
use App\Service\Admin\StructureService;
use App\Form\Type\StructureType;
use App\Repository\StructuresRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


final class GestStructureController extends BaseController
{
    /**
     * @Route("/admin/gest-structure", name="admin_gest_structures")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Structures::class);

        $structures = $repository->findAll();
            //dd($structures);
        return $this->render('admin/gest_structure/index.html.twig', [
            'site' => $this->site(),
            'structure' => $structures
        ]);
    }

    /**
     * @Route("/admin/gest-structure-val", name="admin_gest_structure_val")
     */
    public function validate(StructuresRepository $StructuresRepository): Response
    {

        $id = $_GET['id'];
            //dd($id);
        $structures = $StructuresRepository->activeStructure($id);

        return $this->redirectToRoute('admin_gest_structures');
    }

    /**
     * @Route("/admin/gest-structure-cancel", name="admin_gest_structure_cancel")
     */
    public function annulation(StructuresRepository $StructuresRepository): Response
    {

        $id = $_GET['id'];
         //dd($id);
        $structures = $StructuresRepository->desactiveStructure($id);

        return $this->redirectToRoute('admin_gest_structures');
    }
}