<?php

namespace CodeChallenge;

use CodeChallenge\Interfaces\ReaderInterface;
use CodeChallenge\Interfaces\OfferCollectionInterface;

class JSONReader implements ReaderInterface
{
    public function read(string $input): OfferCollectionInterface
    {
        // Convert from JSON to Array of stdClass objects
        $offers = json_decode($input);
        $offersArray = [];

        foreach ($offers as $offer) {
            $offersArray[] = new Offer($offer);
        }

        return new OfferCollection($offersArray);
    }
}
