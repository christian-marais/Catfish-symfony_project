<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MyPersonnalFunctionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MyPersonnalFunctionExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('toInt', [$this, 'ceilTwig']),
        ];
    }

    public function ceilTwig(int $number): int
    {
        return ceil($number);
    }
}
