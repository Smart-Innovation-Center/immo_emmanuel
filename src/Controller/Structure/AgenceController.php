<?php
declare(strict_types=1);

namespace App\Controller\Structure;

use App\Controller\BaseController;
use App\Entity\Agences;
use App\Entity\Structures;
use App\Entity\User;
use App\Service\Structure\AgenceService;
use App\Form\Type\AgenceStructureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

final class AgenceController extends BaseController
{
    /**
     * @Route("/structure/agence", name="structure_agence")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Agences::class);

        $agences = $repository->findAll();

        return $this->render('structure/agence/index.html.twig', [
            'site' => $this->site(),
            'agences' => $agences,
            'controller_name' => 'Agences',
        ]);
    }

    /**
     * @Route("/structure/agence/new", name="structure_agence_new")
     */
     public function new (Request $request, AgenceService $service, EntityManagerInterface $entityManager): Response
    {
       
        $agences = new Agences();
         if(!empty($_POST)){
            $id_structure= $_POST['structure_id'];
        }
        

        $form = $this->createForm(AgenceStructureType::class, $agences)
            ->add('saveAndCreateNew', SubmitType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agences->setStructureId($entityManager->getReference(Structures::class, $id_structure));
            $service->create($agences);

            /** @var ClickableInterface $button */
            $button = $form->get('saveAndCreateNew');
            if ($button->isClicked()) {
                return $this->redirectToRoute('structure_agence_new');
            }
            return $this->redirectToRoute('structure_agence_new');
        }
        
        return $this->render('structure/agence/new.html.twig', [
            'site' => $this->site(),
            'agences' => $agences,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Agences entity.
     *
     * @Route("/structure/agence/{id<\d+>}/edit",methods={"GET", "POST"}, name="structure_agence_edit")
     */
    public function edit(Request $request, Agences $agences, AgenceService $service): Response
    {
        
        $form = $this->createForm(AgenceStructureType::class, $agences);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $service->update($agences);
            return $this->redirectToRoute('structure_agence');
        }
    
        return $this->render('structure/agence/edit.html.twig', [
            'site' => $this->site(),
            'form' => $form->createView(),
        ]);
    }

   /**
     * Deletes a Agence entity.
     *
     * @Route("structure/agence{id<\d+>}/delete", methods={"POST"}, name="structure_agence_delete")
     * @IsGranted("ROLE_STRUCTURE")
     */
    public function delete(Request $request, Agences $agences, AgenceService $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('structure_agence');
        }
        $service->remove($agences);
        return $this->redirectToRoute('structure_agence');
    }

}