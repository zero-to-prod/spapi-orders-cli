<?php

namespace Zerotoprod\SpapiOrdersCli\GetOrderBuyerInfo;

use Zerotoprod\DataModel\DataModel;

class GetOrderBuyerInfoOptions
{
    use DataModel;

    public const user_agent = 'user_agent';
    public ?string $user_agent = null;

    public const response = 'response';
    public bool $response = false;

    public const expiresIn = 'expiresIn';
    public bool $expiresIn = false;
}
