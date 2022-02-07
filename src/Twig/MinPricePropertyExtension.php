<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use App\Repository\PropertyRepository;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MinPricePropertyExtension extends AbstractExtension
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
            new TwigFunction('minPrice', [$this, 'MinPrices']),
            new TwigFunction('maxPrice', [$this, 'MaxPrices']),
            new TwigFunction('countPropertyByType', [$this, 'CountPropertiesByType'])
        ];
    }

    public function MinPrices()
    {
        $var =  $this->bien->MinPrice();
        return $var;
    }

    public function MaxPrices()
    {
        $var =  $this->bien->MaxPrice();
        return $var;
    }

    public function CountPropertiesByType($id)
    {
        $var =  $this->bien->CountPropertyByType($id);
        return $var;
    }
}