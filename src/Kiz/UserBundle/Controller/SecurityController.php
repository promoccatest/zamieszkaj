<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-25
 * Time: 13:59
 */

namespace Kiz\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as FOSController;

/**
 * {@inheritDoc}
 */
class SecurityController extends FOSController
{
    /**
     * Wybierz odpowiedni formularz logowania (user/admin).
     *
     * {@inheritDoc}
     */
    public function renderLogin(array $data)
    {
        $requestAttributes = $this->container->get('request_stack')->getCurrentRequest();

        if ('admin_login' === $requestAttributes->get('_route')) {
            $template = sprintf('UserBundle:Security:login.html.twig');
        } else {
            $template = sprintf('FOSUserBundle:Security:login.html.twig');
        }

        return $this->container->get('templating')->renderResponse($template, $data);
    }
}