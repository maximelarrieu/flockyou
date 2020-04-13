<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Livraison;
use App\Entity\PasswordEdit;
use App\Entity\Users;
use App\Form\AccountType;
use App\Form\LivraisonType;
use App\Form\PasswordEditType;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use GuzzleHttp\Psr7\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\Extractor\ObjectPropertyListExtractor;

class AccountController extends AbstractController
{
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'hasError' => $error != null,
            'username' => $username
        ]);
    }

    public function logout() {
        // Noting
    }

    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $cart = new Cart();

        $user = new Users();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setBudget(200);
            $user->setCart($cart);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @IsGranted("ROLE_USER")
     */
    public function editAccount(Request $request, objectManager $manager) {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('account', [
                'username' => $user->getUsername()
            ]);
        }

        return $this->render("account/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager) {
        $user = $this->getUser();
        $passwordEdit = new PasswordEdit();

        $form = $this->createForm(PasswordEditType::class, $passwordEdit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!password_verify($passwordEdit->getOldPassword(), $user->getPassword())) {
                $form->get('oldPassword')->addError(new FormError("Le mot de passe saisi n'est pas correct"));
            } else {
                $newPassword = $passwordEdit->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($password);

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('home');
            }
        }
        return $this->render('account/editPassword.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAccount(Users $user, ObjectManager $manager) {

        $manager->remove($user);
        $manager->flush();

        $session = $this->get('session');
        $session = new Session();
        $session->invalidate();

        return $this->redirectToRoute('home');
    }
}
