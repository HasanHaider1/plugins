<?php declare(strict_types=1);

namespace MyAboshop\Storefront\Controller;

use Shopware\Storefront\Framework\Cache\Annotation\HttpCache;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Routing\Annotation\LoginRequired;
use Shopware\Storefront\Page\Account\Overview\AccountOverviewPageLoader;
use Shopware\Core\Checkout\Customer\CustomerEntity;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;



function debug($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
/**
 * @RouteScope(scopes={"storefront"})
 */
Class CheckoutController extends StorefrontController{

    private  $userFirstName = "Hasan";
    private $users="mai";
    private $userNotifications = ['done', 'not done'];


    /**
     * @HttpCache
     * @Route ("/address" , name="frontend.address.address" ,defaults={"csrf_protected"=false},methods={"GET","POST"})
     */

    public function index(Request $request): Response{

        $value=$request->get('user');
        debug($value);
        return $this->renderStorefront("@MyAboshop/storefront/component/address/address-form.html.twig");
    }
}