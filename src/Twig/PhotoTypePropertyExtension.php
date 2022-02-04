<?php

namespace App\Twig;

use App\Repository\PhotoRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PhotoTypePropertyExtension extends AbstractExtension
{

    /**
     * @var PhotoRepository
     */
    private $photo;

    public function __construct(PhotoRepository $photo)
    {
        $this->photo = $photo;
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
            new TwigFunction('photo', [$this, 'Photos']),
        ];
    }

    public function Photos($id)
    {
        $var =  $this->photo->Photo($id);
        return $var;
    }
}