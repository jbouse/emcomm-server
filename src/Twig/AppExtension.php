<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('phone', [$this, 'formatPhone']),
        ];
    }

    public function formatPhone(string $phone): string
    {
        $format = '(%s) %s-%s';

        return ($phone) ? sprintf($format, substr($phone, 0, 3), substr($phone, 3, 3), substr($phone, 6,4)) : '';
    }
}