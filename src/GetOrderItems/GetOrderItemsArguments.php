<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderItems;

use Zerotoprod\DataModel\DataModel;

/**
 * @link https://github.com/zero-to-prod/spapi-orders-cli
 */
class GetOrderItemsArguments
{
    use DataModel;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const refresh_token = 'refresh_token';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public string $refresh_token;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const client_id = 'client_id';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public string $client_id;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const client_secret = 'client_secret';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public string $client_secret;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const targetApplication = 'targetApplication';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public string $targetApplication;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const order_id = 'order_id';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public string $order_id;
}