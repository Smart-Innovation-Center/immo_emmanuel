<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Entity\Structures;
use App\Entity\Transfer;
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
use Doctrine\ORM\EntityManagerInterface;

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

        $nbr_technician = $repositoryUser->nbr_of_Technician();

        $nbr_property = $repositoryProperty->findAll();

        $nbr_transfer = $repositoryTransfer->findAll();

        $nbr_userAc = $repositoryUser->actUser();

        $nbr_NoUserAc = $repositoryUser->NoActUser();


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
            'nbr_of_Technician' => count($nbr_technician),
            'nbr_of_property' => count($nbr_property),
            'nbr_of_transfer' => count($nbr_transfer),
            'nbr_of_userAc' => count($nbr_userAc),
            'nbr_of_NoUserAc' => count($nbr_NoUserAc),
        ]);
    }

    /**
     * @Route("/admin/tenant", name="admin_tenant")
     */
    public function tenant(UserRepository $repositoryUser): Response
    {
        $nbr_tenant = $repositoryUser->nbr_of_Tenant();

        if (count($nbr_tenant) == 0) {
            return $this->redirectToRoute('admin_dashboard');
        } else {
            return $this->render('admin/dashboard/tenant.html.twig', [
                'site' => $this->site(),
                'technicians' => $nbr_tenant,
            ]);
        }
    }

    /**
     * @Route("/admin/owner", name="admin_owner")
     */
    public function owner(UserRepository $repositoryUser): Response
    {
        $nbr_owner = $repositoryUser->nbr_of_Owner();

        if (count($nbr_owner) == 0) {
            return $this->redirectToRoute('admin_dashboard');
        } else {
            return $this->render('admin/dashboard/owner.html.twig', [
                'site' => $this->site(),
                'technicians' => $nbr_owner,
            ]);
        }
    }

    /**
     * @Route("/admin/technician", name="admin_technician")
     */
    public function technician(UserRepository $repositoryUser): Response
    {
        $nbr_technician = $repositoryUser->nbr_of_Technician();

        if (count($nbr_technician) == 0) {
            return $this->redirectToRoute('admin_dashboard');
        } else {
            return $this->render('admin/dashboard/technician.html.twig', [
                'site' => $this->site(),
                'technicians' => $nbr_technician,
            ]);
        }
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
    public function typeProperty(PropertyRepository $repositoryProperty): Response
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
        $nbr_transfer_by_type = $repositoryTransfer->TypeTransfer($id);

        //dd($nbr_transfer_by_type);

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

    /**
     * Displays a form to edit an existing Transfer entity.
     *
     * @Route("/admin/transfer/{id<\d+>}/valid",methods={"GET", "POST"}, name="admin_transfer_valid")
     */
    public function val(TransferRepository $repositoryTransfer, Request $request): Response
    {
        //$id = $_GET['id'];
        $id = $request->attributes->get('id');
        //dd($request);
        $trans = $repositoryTransfer->validateTrans($id);
        //dd($trans);
        return $this->redirectToRoute('admin_transfer_by_type', array("id" => $id));
    }
    /**
     * Displays a form to edit an existing Transfer entity.
     *
     * @Route("/admin/transfer/{id<\d+>}/annul",methods={"GET", "POST"}, name="admin_transfer_annul")
     */
    public function cancel(TransferRepository $repositoryTransfer, Request $request): Response
    {
        //$id = $_GET['id'];
        $id = $request->attributes->get('id');
        //dd($request);
        $trans = $repositoryTransfer->cancelTrans($id);
        //dd($trans);
        return $this->redirectToRoute('admin_transfer_by_type', array("id" => $id));
    }

    /**
     * @Route("/admin/user-act", name="admin_UserAct")
     */
    public function userAct(UserRepository $repositoryUser): Response
    {
        $userAc = $repositoryUser->actUser();

        //dd($userAc);

        return $this->render('admin/dashboard/user/user-act.html.twig', [
            'site' => $this->site(),
            'User_Acts' => $userAc,
        ]);
    }

    /**
     * @Route("/admin/user-block", name="admin_UserBlock")
     */
    public function userBlock(UserRepository $repositoryUser): Response
    {
        $userBlock = $repositoryUser->NoActUser();

        //dd($userBlock);

        return $this->render('admin/dashboard/user/user-block.html.twig', [
            'site' => $this->site(),
            'User_Blocks' => $userBlock,
        ]);
    }


    /**
     * Displays a form to edit an existing Transfer entity.
     *
     * @Route("/admin/user-block/{id<\d+>}/block",methods={"GET", "POST"}, name="admin_block_user")
     */
    public function blocUser(UserRepository $repositoryUser, Request $request): Response
    {
        //$id = $_GET['id'];
        $id = $request->attributes->get('id');
        //dd($request);
        $userBlock = $repositoryUser->blockUser($id);
        //dd($trans);
        return $this->redirectToRoute('admin_UserAct', array("id" => $id));
    }

    /**
     * Displays a form to edit an existing Transfer entity.
     *
     * @Route("/admin/user-act/{id<\d+>}/act",methods={"GET", "POST"}, name="admin_act_user")
     */
    public function actUser(UserRepository $repositoryUser, Request $request): Response
    {
        //$id = $_GET['id'];
        $id = $request->attributes->get('id');
        //dd($request);
        $userActive = $repositoryUser->activeUser($id);
        //dd($trans);
        return $this->redirectToRoute('admin_UserBlock', array("id" => $id));
    }
}