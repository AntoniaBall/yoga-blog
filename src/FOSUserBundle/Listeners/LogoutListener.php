<?php

namespace App\FOSUserBundle\Listeners;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class LogoutListener implements LogoutHandlerInterface {
    protected $session;
    
    public function __construct(SessionInterface $session){
        $this->session = $session;

    }
    
    public function logout(Request $Request, Response $Response, TokenInterface $Token) {
        $this->session->getFlashBag()->add('Info','Bye bye');
    }
}
