<?php

namespace Zerotoprod\SpapiOrdersCli;

use Symfony\Component\Console\Application;
use Zerotoprod\SpapiOrdersCli\GetOrder\GetOrderCommand;
use Zerotoprod\SpapiOrdersCli\Src\SrcCommand;

class SpapiOrdersCli
{
    public static function register(Application $Application): void
    {
        $Application->add(new SrcCommand());
        $Application->add(new GetOrderCommand());
    }
}