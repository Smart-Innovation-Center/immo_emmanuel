<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PrisedeRDV;
use App\Form\Type\PriseRdvType;


use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\FilterRepository;
use App\Repository\PropertyRepository;
use App\Repository\SlideRepository;
use App\Repository\CategoriesRepository;
use App\Repository\TypePropertyRepository;
use App\Repository\SimilarRepository;
use App\Service\URLService;
use App\Transformer\RequestToArrayTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PropertyController extends BaseController
{
    /**
     * @Route("/", defaults={"page": "1"}, methods={"GET"}, name="property")
     */
    public function search(Request $request, FilterRepository $repository,
    SlideRepository $slideRepository, CategoriesRepository $categoryRepository,
     TypePropertyRepository $typePropertyRepository, RequestToArrayTransformer $transformer): Response
    {


        $searchParams = $transformer->transform($request);
//dd($searchParams);

        $properties = $repository->findByFilter($searchParams);
        $slides = $slideRepository->findAll($searchParams);
        $categories = $categoryRepository->findAll($searchParams);
        $typeProperty = $typePropertyRepository->findAll($searchParams);
        return $this->render('property/index.html.twig',
            [
                'site' => $this->site(),
                'properties' => $properties,
                'slides' => $slides,
                'categories' => $categories,
                'types' => $typeProperty,
                'searchParams' => $searchParams,

            ]
        );
    }

    /**
     * @Route("/interesse",  methods={"POST"}, name="property_interesse")
     */
    public function interesse(Request $request): Response
    {

        $params = $_POST;

       /* $params['fullname']=$request->query->$_POST
        $params['contact']=$request->query->post('contact');
        $params['date']=$request->query->get('date');*/

        //$data_interesse = $transformer->transform($request);
       dd($params);
        /*$searchParams = $transformer->transform($request);
//dd($searchParams);

        $properties = $repository->findByFilter($searchParams);

        return $this->render('property/index.html.twig',
            [
                'site' => $this->site(),
                'properties' => $properties,
                'searchParams' => $searchParams,
            ]
        );*/
    }

    /**
     * @Route("/map", methods={"GET"}, name="map_view")
     */
    public function mapView(PropertyRepository $repository): Response
    {
        return $this->render('property/map.html.twig',
            [
                'site' => $this->site(),
                'properties' => $repository->findAllPublished(),
            ]
        );
    }

      /**
     * @Route("/checkrdvdate", methods={"GET"}, name="rdv_date")
     */
    public function rdvdate(Request $request,PropertyRepository $repository): Response
    {
        $donn= $_GET['rdvheure'];
        $arrayCollection = array('slug' =>$donn);
        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/{citySlug}/{slug}/{id<\d+>}", methods={"GET"}, name="property_show")
     * @IsGranted("PROPERTY_VIEW", subject="property", message="Properties can only be shown to their owners.")
     */
    public function propertyShow(Request $request, URLService $url, Property $property, SimilarRepository $repository): Response
    {
        if (!$url->isCanonical($property, $request)) {
            return $this->redirect($url->generateCanonical($property), 301);
        } elseif ($url->isRefererFromCurrentHost($request)) {
            $show_back_button = true;
        }

        $priserdv = new PrisedeRDV();
        $form = $this->createForm(PriseRdvType::class, $priserdv);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->create($priserdv);
            return $this->redirectToRoute('/');
        }
        return $this->render('property/show.html.twig',
            [
                'site' => $this->site(),
                'property' => $property,
                'properties' => $repository->findSimilarProperties($property),
                'number_of_photos' => \count($property->getPhotos()),
                'show_back_button' => $show_back_button ?? false,
                'form' => $form->createView(),

            ]
        );
    }
}
