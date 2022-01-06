<?php
declare(strict_types=1);

namespace App\Controller\Structure;

use App\Controller\BaseController;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\ClickableInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

final class ProprietaireController extends BaseController
{
    /**
     * @Route("/structure/proprietaire", name="structure_proprietaire")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findAll();
        $curt_user = $this->get('security.token_storage')->getToken()->getUser();
        $curt_user_agce_id=$curt_user->getAgenceId()->getId();
        $curt_user_str_id = $curt_user->getAgenceId()->getStructureId()->getId();
       // dd($curt_user_str_id);
        $users_pro=$repository->findByRoleThatSucksLess('ROLE_PROPRIETAIRE',$curt_user_agce_id,$curt_user_str_id);
        dd($users_pro);

        return $this->render('structure/proprietaire/index.html.twig', [
            'site' => $this->site(),
            'users' => $users,
            'controller_name' => 'users',
        ]);
    }   
}