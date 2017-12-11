<?php

namespace A2\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class A2UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}