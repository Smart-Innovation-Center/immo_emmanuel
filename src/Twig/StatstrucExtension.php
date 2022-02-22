<?php

namespace App\Twig;

use App\Repository\StructuresRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class StatstrucExtension extends AbstractExtension
{

    /**
     * @var StructuresRepository
     */
    private $struc;

    public function __construct(StructuresRepository $struc)
    {
        $this->struc = $struc;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('initiateurStructure', [$this, 'InitiateurStructures']),
            new TwigFunction('reciveStructure', [$this, 'ReciveStructures']),
        ];
    }

    public function InitiateurStructures($id)
    {
        $var =  $this->struc->InitiateurStructure($id);
        return $var;
    }
    public function ReciveStructures($id)
    {
        $var =  $this->struc->ReciveStructure($id);
        return $var;
    }
}