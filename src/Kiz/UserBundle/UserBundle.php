<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 2018-02-25
 * Time: 13:55
 */
namespace Kiz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle {
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}