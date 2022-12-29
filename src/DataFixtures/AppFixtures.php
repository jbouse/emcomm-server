<?php

namespace App\DataFixtures;

use App\Entity\MobileProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadMobileProviders($manager);
    }

    private function loadMobileProviders(ObjectManager $manager): void
    {
        foreach ($this->getMobileProvider() as [$name, $emailSuffix])
        {
            $mobile = new MobileProvider();
            $mobile->setName($name);
            $mobile->setEmailSuffix($emailSuffix);

            $manager->persist($mobile);
        }

        $manager->flush();
    }

    private function getMobileProvider(): array
    {
        return [
            // $mobile = [$name, $emailSuffix];
            ['AT&T', '@txt.att.net'],
            ['Bell Mobility', '@txt.bellmobility.com'],
            ['Boost Mobile', '@sms.myboostmobile.com'],
            ['Google Fi', '@msg.fi.google.com'],
            ['Metro PCS', '@mymetropcs.com'],
            ['Rogers', '@pcs.rogers.com'],
            ['Sprint', '@messaging.sprintpcs.com'],
            ['Telus', '@msg.telus.com'],
            ['T-Mobile', '@tmomail.net'],
            ['U.S. Cellular', '@email.uscc.net'],
            ['Verizon', '@vtext.com'],
            ['Virgin Mobile', '@vmobl.com'],
        ];
    }
}
