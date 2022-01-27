<?php

declare(strict_types=1);

namespace App\Controller\Structure;

use App\Controller\BaseController;
use App\Entity\Location;
use App\Entity\User;
use App\Service\Structure\LocationService;
use App\Form\Type\LocationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Length;

final class LocationController extends BaseController
{
    /**
     * @Route("/structure/location", name="structure_location")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);

        $location = $repository->findAll();

        return $this->render('structure/location/index.html.twig', [
            'site' => $this->site(),
            'locations' => $location,
            'controller_name' => 'structure_location',
        ]);
    }

    /**
     * @Route("/structure/location/new", name="structure_location_new")
     */
    public function new(Request $request, LocationService $service, EntityManagerInterface $entityManager): Response
    {
        $location = new Location();

        $repository = $this->getDoctrine()->getRepository(User::class);

        $curt_user = $this->get('security.token_storage')->getToken()->getUser();
        $curt_user_agce_id = $curt_user->getAgenceId()->getId();
        $curt_user_str_id = $curt_user->getAgenceId()->getStructureId()->getId();

        $user = $repository->testUserL($curt_user_agce_id, $curt_user_str_id);


        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        //dd($_POST);

        if ($form->isSubmitted()) {
            $location->setUser($entityManager->getReference(User::class, $_POST['user']));
            $location->setRecorder($entityManager->getReference(User::class, $_POST['recorder']));
            $entityManager->persist($location);
            $entityManager->flush();
            $service->create($location);
            return $this->redirectToRoute('structure_location');
        }

        return $this->render('structure/location/new.html.twig', [
            'site' => $this->site(),
            'locations' => $location,
            'users' => $user,
            'form' => $form->createView(),
            'controller_name' => 'structure_location',
        ]);
    }

    /**
     * Displays a form to edit an existing Location entity.
     *
     * @Route("/structure/location/{id<\d+>}/edit",methods={"GET", "POST"}, name="structure_location_edit")
     */
    public function edit(Request $request, Location $location, LocationService $service): Response
    {
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $service->update($location);
            return $this->redirectToRoute('structure_location');
        }

        return $this->render('structure/location/edit.html.twig', [
            'site' => $this->site(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a Location entity.
     *
     * @Route("/structure/location{id<\d+>}/delete", methods={"POST"}, name="structure_location_delete")
     *
     */
    public function delete(Request $request, Location $location, LocationService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('structure_location');
        }
        $service->remove($location);
        return $this->redirectToRoute('structure_location');
    }
}