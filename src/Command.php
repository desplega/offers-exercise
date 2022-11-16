<?php

namespace CodeChallenge;

class Command
{
    protected $offers;

    public function __construct(OfferCollection $offers)
    {
        $this->offers = $offers;
    }

    public function run($params): ?int
    {
        $error = 'Non valid command: ' . $params[1];
        if (count($params) > 1) {
            switch ($params[1]) {
                case 'count_by_price_range':
                    if (count($params) >= 4) {
                        return $this->countByPriceRange((float) $params[2], (float) $params[3]);
                    } else {
                        $error = 'Missing parameters: price_low and price_high are required';
                    }
                    break;
                case 'count_by_vendor':
                    if (count($params) >= 3) {
                        return $this->countByVendor((int) $params[2]);
                    } else {
                        $error = 'Missing parameters: vendor_id is required';
                    }
                    break;
            }
        } else {
            $error = 'Missing command';
        }

        error_log($error);
        throw new \Exception($error);

        return null;
    }

    public function countByPriceRange(float $priceLow, float $priceHigh): int
    {
        $iterator = $this->offers->getIterator();

        $count = 0;
        while ($iterator->valid()) {
            if ($iterator->current()->price >= $priceLow && $iterator->current()->price <= $priceHigh)
                $count++;
            $iterator->next();
        }

        return $count;
    }

    public function countByVendor(int $vendorId): int
    {
        $iterator = $this->offers->getIterator();

        $count = 0;
        while ($iterator->valid()) {
            if ($iterator->current()->vendorId == $vendorId)
                $count++;
            $iterator->next();
        }

        return $count;
    }
}
