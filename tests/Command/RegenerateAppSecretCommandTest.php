<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class RegenerateAppSecretCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $this->assertSame('test', $kernel->getEnvironment());

        $command = $application->find('regenerate-app-secret');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'envfile' => '.env.test',
        ]);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('[OK] New APP_SECRET was generated:', $output);
    }
}