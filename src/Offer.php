<?php
namespace CodeChallenge;

use CodeChallenge\Interfaces\OfferInterface;

class Offer implements OfferInterface {
    public $offerId;
    public $productTitle;
    public $vendorId;
    public $price;

    public function __construct(\stdClass $offer) {
        $this->offerId = $offer->offerId;
        $this->productTitle = $offer->productTitle;
        $this->vendorId = $offer->vendorId;
        $this->price = $offer->price;
    }

    public function __toString()
    {
        return $this->offerId . ': ' . $this->productTitle . PHP_EOL; 
    }
}