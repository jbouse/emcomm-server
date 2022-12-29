<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class SetupStationCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $this->assertSame('test', $kernel->getEnvironment());

        $command = $application->find('emcomm:station:setup');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'station' => 'N0CALL',
        ]);

        $commandTester->assertCommandIsSuccessful();

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('[OK] Station N0CALL setup', $output);
    }
}
