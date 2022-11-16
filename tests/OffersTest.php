<?php

namespace CodeChallenge\Test;

use PHPUnit\Framework\TestCase;
use CodeChallenge\JSONReader;
use CodeChallenge\Offer;
use CodeChallenge\OfferCollection;
use CodeChallenge\Command;

class OffersTest extends TestCase
{
    public function endPointData()
    {
        return '[
            {
                "offerId": 123,
                "productTitle": "Coffee Machine",
                "vendorId": 35,
                "price": 390.4
            },
            {
                "offerId": 124,
                "productTitle": "Napkins",
                "vendorId": 35,
                "price": 15.5
            },
            {
                "offerId": 125,
                "productTitle": "Chair",
                "vendorId": 84,
                "price": 230.0
            }
        ]';
    }

    public function testOfferInstancesAreCorrect(): void
    {
        // Get JSON data from HTTP endpoint
        $data = $this->endPointData();

        // Get offers collection
        $reader = new JSONReader();
        $offers = $reader->read($data);

        $this->assertInstanceOf(OfferCollection::class, $offers);

        for ($i = 0; $i < $offers->count(); $i++)
            $this->assertInstanceOf(Offer::class, $offers->get($i));
    }

    public function testCommands(): void
    {
        // Get JSON data from HTTP endpoint
        $data = $this->endPointData();

        // Get offers collection
        $reader = new JSONReader();
        $offers = $reader->read($data);

        // Run command
        $command = new Command($offers);

        $this->assertEquals(1, $command->countByPriceRange(12.00, 145.80));
        $this->assertEquals(2, $command->countByVendor(35));
        $this->assertEquals(1, $command->countByVendor(84));
    }

    public function testRunCommand(): void
    {
        // Get JSON data from HTTP endpoint
        $data = $this->endPointData();

        // Get offers collection
        $reader = new JSONReader();
        $offers = $reader->read($data);

        $command = new Command($offers);
        $count = $command->run(['run.php', 'count_by_price_range', '12.00', '145.80']);
        $this->assertEquals(1, $count);
        $count = $command->run(['run.php', 'count_by_vendor', '35']);
        $this->assertEquals(2, $count);
        $count = $command->run(['run.php', 'count_by_vendor', '84']);
        $this->assertEquals(1, $count);
    }
}
