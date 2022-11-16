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
        if (count($params) == 4) {
            switch ($params[1]) {
                case 'count_by_price_range':
                    return $this->countByPriceRange((float) $params[2], (float) $params[3]);
            }
        }

        if (count($params) == 3) {
            switch ($params[1]) {
                case 'count_by_vendor':
                    return $this->countByVendor((int) $params[2]);
            }
        }

        throw new \Exception('Non valid command');

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
