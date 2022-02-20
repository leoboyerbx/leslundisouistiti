<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AuthenticationEntryPoint implements AuthenticationEntryPointInterface
{

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private FlashBagInterface $flashBag
    )
    {
    }

    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        if ($authException) {
            $this->flashBag->add('error', 'Tu dois te connecter pour accéder à cette page.');
        }

        return new RedirectResponse($this->urlGenerator->generate('login'));
    }
}
