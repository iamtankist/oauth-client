<?php

namespace StarkIndustries\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use OAuth2;


class AuthController extends Controller
{
    /**
     * @Route("/authorize", name="auth")
     * @Template()
     */
    public function authAction(Request $request)
    {
        $authorizeClient = $this->container->get('stark_industries_client.authorize_client');

        if (!$request->query->get('code')) {
            return new RedirectResponse($authorizeClient->getAuthenticationUrl());
        }

        $authorizeClient->getAccessToken($request->query->get('code'));
        var_dump($authorizeClient->fetch('http://oauth-server.local/api/articles'));exit;

        return new JsonResponse();
    }
}
