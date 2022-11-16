<?php
namespace CodeChallenge\Interfaces;

/**
 * The interface provides the contract for different readers
 * E.g. It can be XML/JSON Remote Endpoint, or CSV/JSON/XML local files
 */
interface ReaderInterface {
    /**
     * Read an incoming data and parse the objects
     */
    public function read(string $input): OfferCollectionInterface;
}