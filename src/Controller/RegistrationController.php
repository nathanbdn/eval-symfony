<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\SecurityControllerAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    #[IsGranted('ROLE_USER')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $benevole = $userRepository->findOneBy(['email' => $user->getEmail()]);

            if (!$benevole) {
                $form->get('email')->addError(new FormError("Cette adresse n'est pas enregistrée comme bénévole."));
            } elseif ($benevole->getPassword() !== null) {
                $form->get('email')->addError(new FormError('Ce compte est déjà activé, connecte-toi.'));
            } else {
                $plainPassword = $form->get('plainPassword')->getData();
                $benevole->setPassword($userPasswordHasher->hashPassword($benevole, $plainPassword));
                $entityManager->flush();

                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
