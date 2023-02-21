<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MyPersonnalExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyPersonnalExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('defaultImage', [$this,'myFunctionFilter']),
        ];
    }
    public function myFunctionFilter(string $path):string
    {
        if(strlen(trim($path))==0){
            return 'as.jpg';
        }
        return $path;
    }

}
