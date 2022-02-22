<?php

namespace App\Twig;

use App\Repository\AgencesRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AgenceExtension extends AbstractExtension
{

    /**
     * @var AgencesRepository
     */
    private $agency;

    public function __construct(AgencesRepository $agency)
    {
        $this->agency = $agency;
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
            new TwigFunction('initiateurAgence', [$this, 'InitiateurAgences']),
            new TwigFunction('agencyBetween', [$this, 'AgenciesBetween']),
            new TwigFunction('reciveAgence', [$this, 'ReciveAgences']),
        ];
    }

    public function InitiateurAgences($id)
    {
        $var =  $this->agency->InitiateurAgence($id);
        return $var;
    }

    public function AgenciesBetween($id)
    {
        $var =  $this->agency->AgencyBetween($id);
        return $var;
    }

    public function ReciveAgences($id)
    {
        $var =  $this->agency->ReciveAgence($id);
        return $var;
    }
}