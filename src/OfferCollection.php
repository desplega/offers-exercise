<?php

namespace CodeChallenge;

use CodeChallenge\Interfaces\OfferCollectionInterface;
use CodeChallenge\Interfaces\OfferInterface;

class OfferCollection implements OfferCollectionInterface
{
    private $offers = [];

    public function __construct(array $offers)
    {
        $this->offers = [];

        foreach ($offers as $offer) {
            $this->offers[] = new Offer($offer);
        }
    }

    public function count()
    {
        return count($this->offers);
    }

    public function get(int $index): OfferInterface
    {
        return $this->offers[$index];
    }

    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->offers);
    }
}
