<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $this->assertSame('test', $kernel->getEnvironment());

        $command = $application->find('emcomm:user:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'username' => 'test',
        ]);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('[NOTE] Generated password:', $output);
        $this->assertStringContainsString('[OK] Added new admin user [test]', $output);
    }
}
