<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderItems;

use Zerotoprod\DataModel\DataModel;

/**
 * @link https://github.com/zero-to-prod/spapi-orders-cli
 */
class GetOrderItemsOptions
{
    use DataModel;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const user_agent = 'user_agent';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public ?string $user_agent = null;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const response = 'response';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public bool $response = false;

    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public const expiresIn = 'expiresIn';
    /**
     * @link https://github.com/zero-to-prod/spapi-orders-cli
     */
    public bool $expiresIn = false;
}
