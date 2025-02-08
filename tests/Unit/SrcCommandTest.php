<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Tests\TestCase;
use Zerotoprod\:namespace\Src\SrcCommand;

class SrcCommandTest extends TestCase
{
    #[Test] public function command(): void
    {
        $Application = new Application();
        $Application->add(new SrcCommand());
        $Command = $Application->find(SrcCommand::signature);
        $CommandTester = new CommandTester($Command);

        $CommandTester->execute([]);

        $CommandTester->assertCommandIsSuccessful();
    }
}