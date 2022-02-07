<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Structures;
use App\Repository\AgencesRepository;
use App\Repository\FilterRepository;
use App\Repository\PhotoRepository;
use App\Repository\PropertyRepository;
use App\Repository\StructuresRepository;
use App\Repository\TransferRepository;
use App\Repository\TypePropertyRepository;
use App\Repository\TypeTransferRepository;
use App\Repository\UserRepository;
use App\Service\Admin\DashboardService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Transformer\RequestToArrayTransformer;
use Symfony\Component\HttpFoundation\Request;

final class DashboardController extends BaseController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(DashboardService $service, StructuresRepository $repositoryStructure, AgencesRepository $repositoryAgency, UserRepository $repositoryUser, PropertyRepository $repositoryProperty, TransferRepository $repositoryTransfer): Response
    {
        $properties = $service->countProperties();

        $cities = $service->countCities();

        $dealTypes = $service->countDealTypes();

        $categories = $service->countCategories();

        $pages = $service->countPages();

        $users = $service->countUsers();

        $nbr_structure = $repositoryStructure->findAll();

        $nbr_agency = $repositoryAgency->findAll();

        $nbr_tenant = $repositoryUser->nbr_of_Tenant();

        $nbr_owner = $repositoryUser->nbr_of_Owner();

        $nbr_property = $repositoryProperty->findAll();

        $nbr_transfer = $repositoryTransfer->findAll();


        return $this->render('admin/dashboard/index.html.twig', [
            'site' => $this->site(),
            'number_of_properties' => $properties,
            'number_of_cities' => $cities,
            'number_of_deal_types' => $dealTypes,
            'number_of_categories' => $categories,
            'number_of_pages' => $pages,
            'number_of_users' => $users,
            'number_of_structure' => count($nbr_structure),
            'number_of_agency' => count($nbr_agency),
            'nbr_of_tenant' => count($nbr_tenant),
            'nbr_of_owner' => count($nbr_owner),
            'nbr_of_property' => count($nbr_property),
            'nbr_of_transfer' => count($nbr_transfer),
        ]);
    }

    /**
     * @Route("/admin/tenant", name="admin_tenant")
     */
    public function tenant(UserRepository $repositoryUser): Response
    {
        $nbr_tenant = $repositoryUser->nbr_of_Tenant();
        return $this->render('admin/dashboard/tenant.html.twig', [
            'site' => $this->site(),
            'tenants' => $nbr_tenant,
        ]);
    }
    /**
     * @Route("/admin/owner", name="admin_owner")
     */
    public function owner(UserRepository $repositoryUser): Response
    {
        $nbr_owner = $repositoryUser->nbr_of_Owner();
        return $this->render('admin/dashboard/owner.html.twig', [
            'site' => $this->site(),
            'owners' => $nbr_owner,
        ]);
    }

    /**
     * @Route("/admin/type-property", name="admin_TypeProperty")
     */
    public function property(PropertyRepository $repositoryProperty, TypePropertyRepository $repositoryTypeProperty): Response
    {
        $nbr_property = $repositoryProperty->findAll();
        $nbr_typeProperty = $repositoryTypeProperty->findAll();

        return $this->render('admin/dashboard/bien/property.html.twig', [
            'site' => $this->site(),
            'properties' => $nbr_property,
            'type_properties' => $nbr_typeProperty,
        ]);
    }

    /**
     * @Route("/admin/property_by_type", name="admin_property_by_type")
     */
    public function typeProperty(PropertyRepository $repositoryProperty, PhotoRepository $repositoryPhoto): Response
    {

        $id = $_GET['id'];
        $nbr_property_by_type = $repositoryProperty->typeProperty($id);

        //dd($nbr_property_by_type);

        //dd($nbr_property_by_type);
        if (count($nbr_property_by_type) == 0) {
            return $this->redirectToRoute('admin_TypeProperty');
        } else {
            return $this->render('admin/dashboard/bien/type_property.html.twig', [
                'site' => $this->site(),
                '$nbr_property_by_type' => count($nbr_property_by_type),
                'properties_by_type' => $nbr_property_by_type,
            ]);
        }
    }

    /**
     * @Route("/admin/type-transfer", name="admin_TypeTransfer")
     */
    public function transfer(TypeTransferRepository $repositoryTypeTransfer): Response
    {
        $nbr_transfer = $repositoryTypeTransfer->findAll();
        // dd($nbr_transfer);

        return $this->render('admin/dashboard/transfer/transfer.html.twig', [
            'site' => $this->site(),
            'Type_transfers' => $nbr_transfer,
        ]);
    }

    /**
     * @Route("/admin/transfer_by_type", name="admin_transfer_by_type")
     */
    public function typeTransfer(TransferRepository $repositoryTransfer): Response
    {

        $id = $_GET['id'];
        $nbr_transfer_by_type = $repositoryTransfer->typeTransfer($id);

        dd($nbr_transfer_by_type);

        if (count($nbr_transfer_by_type) == 0) {
            return $this->redirectToRoute('admin_TypeTransfer');
        } else {
            return $this->render('admin/dashboard/transfer/type_transfer.html.twig', [
                'site' => $this->site(),
                '$nbr_transfer_by_type' => count($nbr_transfer_by_type),
                'transfers_by_type' => $nbr_transfer_by_type,
            ]);
        }
    }
}