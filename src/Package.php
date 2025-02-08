<?php

namespace Zerotoprod\:namespace;

use Symfony\Component\Console\Application;
use Zerotoprod\:namespace\Src\SrcCommand;

class :namespace
{
    public static function register(Application $Application): void
    {
        $Application->add(new SrcCommand());
    }
}