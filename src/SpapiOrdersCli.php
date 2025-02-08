<?php

namespace Zerotoprod\SpapiOrdersCli;

use Symfony\Component\Console\Application;
use Zerotoprod\SpapiOrdersCli\GetOrder\GetOrderCommand;
use Zerotoprod\SpapiOrdersCli\GetOrderBuyerInfo\GetOrderBuyerInfoCommand;
use Zerotoprod\SpapiOrdersCli\GetOrderItems\GetOrderItemsCommand;
use Zerotoprod\SpapiOrdersCli\Src\SrcCommand;

class SpapiOrdersCli
{
    public static function register(Application $Application): void
    {
        $Application->add(new SrcCommand());
        $Application->add(new GetOrderCommand());
        $Application->add(new GetOrderItemsCommand());
        $Application->add(new GetOrderBuyerInfoCommand());
    }
}