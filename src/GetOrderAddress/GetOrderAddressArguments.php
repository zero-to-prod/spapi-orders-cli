<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderAddress;

use Zerotoprod\DataModel\DataModel;

class GetOrderAddressArguments
{
    use DataModel;

    public const refresh_token = 'refresh_token';
    public string $refresh_token;

    public const client_id = 'client_id';
    public string $client_id;

    public const client_secret = 'client_secret';
    public string $client_secret;

    public const targetApplication = 'targetApplication';
    public string $targetApplication;

    public const order_id = 'order_id';
    public string $order_id;
}