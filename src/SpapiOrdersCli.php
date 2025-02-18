<?php

namespace Zerotoprod\SpapiOrdersCli;

use Symfony\Component\Console\Application;
use Zerotoprod\SpapiOrdersCli\GetOrder\GetOrderCommand;
use Zerotoprod\SpapiOrdersCli\GetOrderAddress\GetOrderAddressCommand;
use Zerotoprod\SpapiOrdersCli\GetOrderBuyerInfo\GetOrderBuyerInfoCommand;
use Zerotoprod\SpapiOrdersCli\GetOrderItems\GetOrderItemsCommand;
use Zerotoprod\SpapiOrdersCli\Src\SrcCommand;

/**
 * A CLI for Amazon Selling Partner API (SPAPI) Orders API.
 *
 * @link https://github.com/zero-to-prod/spapi-orders-cli
 */
class SpapiOrdersCli
{
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public static function register(Application $Application): void
    {
        $Application->add(new SrcCommand());
        $Application->add(new GetOrderCommand());
        $Application->add(new GetOrderItemsCommand());
        $Application->add(new GetOrderBuyerInfoCommand());
        $Application->add(new GetOrderAddressCommand());
    }
}