<?php

require 'vendor/autoload.php';

ini_set('log_errors', 1); // Just in case it is not set in php.ini
ini_set('error_log', 'error.log');

use CodeChallenge\JSONReader;
use CodeChallenge\Command;

// Get JSON data from HTTP endpoint
$data = '[
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

// Get offers collection
$reader = new JSONReader();
$offers = $reader->read($data);

$command = new Command($offers);

try {
    echo $command->run($argv);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

