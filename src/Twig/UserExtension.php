<?php

namespace App\Twig;

use App\Repository\UserRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UserExtension extends AbstractExtension
{

    /**
     * @var PropertyRepository
     */
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
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
            new TwigFunction('initiateurOwner', [$this, 'InitiateurOwners']),
            new TwigFunction('ownerBetween', [$this, 'OwnerBetweens']),
            new TwigFunction('reciveOwner', [$this, 'ReciveOwners']),
        ];
    }

    public function InitiateurOwners($id)
    {
        $var =  $this->user->InitiateurOwner($id);
        return $var;
    }

    public function OwnerBetweens($id)
    {
        $var =  $this->user->OwnerBetween($id);
        return $var;
    }

    public function ReciveOwners($id)
    {
        $var =  $this->user->ReciveOwner($id);
        return $var;
    }
}