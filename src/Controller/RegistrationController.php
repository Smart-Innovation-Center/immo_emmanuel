<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Structures;
use App\Entity\Agences;
use App\Form
\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        
        $user = new User();
        $structure = new Structures();
        $agence = new Agences();
        
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        

        if ($form->isSubmitted()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            if (\in_array('ROLE_ADMIN', $user->getRoles(), true)) {
                $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
            } elseif($_POST['type_compte']==1) {
                $user->setRoles(['ROLE_USER']);
            }elseif($_POST['type_compte']==2) {
                $user->setRoles(['ROLE_PROPRIETAIRE']);
            }elseif($_POST['type_compte']==3) {

                
                $user->setRoles(['ROLE_STRUCTURE']);
                $structure->setNumeroRegisteDeCommerce($_POST['NumeroRegisteDeCommerce']);
                $structure->setLibelle($_POST['libelle']);
                $structure->setAdresse($_POST['adresse']);
                $structure->setContact($_POST['contact']);
                $structure->setEmail($_POST['email']);
                $structure->setSiteWeb($_POST['siteWeb']);

                $entityManager->persist($structure);
                $entityManager->flush();
                $id_structure = $structure->getId();
                
                $agence->setLibelle($_POST['libelle_agence']);
                $agence->setEmail($_POST['email_agence']);
                $agence->setContact($_POST['contact_agence']);
                $agence->setAdresse($_POST['siteWeb_agence']);

                
           $structuress=$entityManager->getRepository(Structures::class)->find($id_structure);
          // dd($structuress);

           
               // $agence->setStructureId(Structures::class, $id_structure);

                $agence->setStructureId($entityManager->getReference(Structures::class, $id_structure));
                //$agence->setStructureId($structure->getId());
                
                $entityManager->persist($agence);
                $entityManager->flush();
                $id_agence = $agence->getId();

                //$user->setAgenceId($id_agence);
                $user->setAgenceId($entityManager->getReference(Agences::class, $id_agence));
                
                $entityManager->flush();
            }


            $entityManager->persist($user);
            $entityManager->flush();
            
            

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('abeudev@gmail.com', 'SIC IMMOBILIER'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('default_route');
        }
//dd($form);
        return $this->render('registration/register.html.twig', [

            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }
        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}