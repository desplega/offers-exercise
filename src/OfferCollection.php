<?php

namespace CodeChallenge;

use CodeChallenge\Interfaces\OfferCollectionInterface;
use CodeChallenge\Interfaces\OfferInterface;

class OfferCollection implements OfferCollectionInterface
{
    protected $offers = [];

    public function __construct(array $offers)
    {
        $this->offers = $offers;
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
        $arrayObject = new \ArrayObject($this->offers);

        return $arrayObject->getIterator();
    }
}
