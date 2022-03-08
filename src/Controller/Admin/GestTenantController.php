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

final class GestTenantController extends BaseController
{

    /**
     * @Route("/admin/gest-tenant", name="admin_gest_tenants")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $tenants = $repository->nbr_of_Tenant();
        //dd($tenants);
        return $this->render('admin/gest_tenant/index.html.twig', [
            'site' => $this->site(),
            'tenants' => $tenants
        ]);
    }

    /**
     * @Route("/admin/gest-tenant-val", name="admin_gest_tenant_val")
     */
    public function validate(UserRepository $TenantsRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $tenants = $TenantsRepository->activeTenant($id);

        return $this->redirectToRoute('admin_gest_tenants');
    }

    /**
     * @Route("/admin/gest-tenant-cancel", name="admin_gest_tenant_cancel")
     */
    public function annulation(UserRepository $TenantsRepository): Response
    {

        $id = $_GET['id'];
        //dd($id);
        $tenants = $TenantsRepository->desactiveTenant($id);

        return $this->redirectToRoute('admin_gest_tenants');
    }
}