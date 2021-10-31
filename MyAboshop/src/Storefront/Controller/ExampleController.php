<?php declare(strict_types=1);

namespace MyAboshop\Storefront\Controller;

use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class ExampleController extends StorefrontController
{
    /**
     * @RouteScope(scopes={"storefront"})
     * @Route("/example", name="frontend.example.example", methods={"GET"})
     */
    public function showExample(): Response
    {
        return $this->renderStorefront('@MyAboshop/storefront/component/address/address-form.html.twig', [
            'example' => 'Hello world'
        ]);
    }
    public $request;

    public function gettingValues(): Response
    {
        $_COOKIE->get('meraemail');
    }
}