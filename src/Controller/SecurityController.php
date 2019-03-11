<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\PasswordResetNewType;
use App\Form\PasswordResetRequestType;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Services\FlashMessage;
use App\Services\TokenPassword;
use App\Services\User\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $checker;

    /**
     * @var FlashMessage
     */
    private $flashMessage;

    /**
     * @var UserManager
     */
    private $manager;

    /**
     * @var TranslatorInterface
     */
    private $trans;

    public function __construct(
        AuthenticationUtils $authenticationUtils,
        AuthorizationCheckerInterface $checker,
        UserManager $manager,
        FlashMessage $flashMessage,
        TranslatorInterface $trans
    ) {
        $this->authenticationUtils = $authenticationUtils;
        $this->checker = $checker;
        $this->flashMessage = $flashMessage;
        $this->manager = $manager;
        $this->trans = $trans;
    }

    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        if ($this->manager->isLogin()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(LoginType::class);
        $lastUserName = $this->authenticationUtils->getLastUsername();
        $error = $this->authenticationUtils->getLastAuthenticationError();

        return $this->render('blog/security/login/login.html.twig', [
            'form' => $form->createView(),
            'lastUserName' => $lastUserName,
            'error' => $error,
        ]);
    }
}
