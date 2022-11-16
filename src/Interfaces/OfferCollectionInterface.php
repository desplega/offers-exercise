<?php

namespace CodeChallenge\Interfaces;

/**
 * Interface for the Collection class that contains offers
 */
interface OfferCollectionInterface
{
    public function count();

    public function get(int $index): OfferInterface;

    public function getIterator(): \Iterator;
}
