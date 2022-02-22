<?php

namespace App\Twig;

use App\Repository\TransferRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TransferExtension extends AbstractExtension
{

    /**
     * @var TransferRepository
     */
    private $trans;

    public function __construct(TransferRepository $trans)
    {
        $this->trans = $trans;
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
            new TwigFunction('countTransferByType', [$this, 'CountTransfersByType']),
            new TwigFunction('transferType', [$this, 'TransferTypes'])
        ];
    }

    public function CountTransfersByType($id)
    {
        $var =  $this->trans->CountTransferByType($id);
        return $var;
    }

    public function TransferTypes($id)
    {
        $var =  $this->trans->TransferType($id);
        return $var;
    }
}