<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use App\Repository\PropertyRepository;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AreaExtension extends AbstractExtension
{

    /**
     * @var PropertyRepository
     */
    private $bien;

    public function __construct(PropertyRepository $bien)
    {
        $this->bien = $bien;
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
            new TwigFunction('minArea', [$this, 'minAreas']),
            new TwigFunction('maxArea', [$this, 'maxAreas']),
            new TwigFunction('showProperty', [$this, 'showPropertys']),
        ];
    }

    public function minAreas()
    {
        $var = $this->bien->MinArea();
        return $var;
    }

    public function maxAreas()
    {
        $var = $this->bien->MaxArea();
        return $var;
    }

    public function showPropertys($id)
    {
        $var = $this->bien->ShowProperty($id);
        return (array) $var;
    }
}