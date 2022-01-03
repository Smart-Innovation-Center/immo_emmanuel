<?php

declare(strict_types=1);

namespace App\Controller\Proprietaire;

use App\Controller\BaseController;
use App\Entity\Property;
use App\Entity\User;
use App\Form\Type\PropertyType;
use App\Repository\UserPropertyRepository;
use App\Service\Admin\PropertyService as AdminPropertyService;
use App\Service\User\PropertyService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProprietaireController extends BaseController
{
    /**
     * @Route("/proprietaire/property", defaults={"page": "1"}, methods={"GET"}, name="proprietaire_property")
     */
    public function index(Request $request, PropertyService $service): Response
    {

        $properties = $service->getUserProperties($request);

        //dd($properties);
        return $this->render('proprietaire/home/index.html.twig', [
            'properties' => $properties,
            'site' => $this->site(),
        ]);
    }
}