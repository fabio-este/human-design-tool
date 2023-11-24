<?php

namespace App\Controller;

/**
 * @copyright 2022 Rheingans GmbH <mail@digitalenabler.de>
 * @license   Proprietary
 *
 * This Project can not be copied and/or distributed without the express
 * permission of Fabio Stegmeyer
 */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
