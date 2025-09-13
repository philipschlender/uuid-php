<?php

namespace Uuid\Factories;

use Uuid\Exceptions\UuidException;
use Uuid\Models\UuidInterface;

interface UuidFactoryInterface
{
    /**
     * @throws UuidException
     */
    public function createUuid(): UuidInterface;

    /**
     * @throws UuidException
     */
    public function createUuidFromBytes(string $bytes): UuidInterface;

    /**
     * @throws UuidException
     */
    public function createUuidFromHexadecimal(string $hexadecimal): UuidInterface;

    /**
     * @throws UuidException
     */
    public function createUuidFromString(string $string): UuidInterface;
}
