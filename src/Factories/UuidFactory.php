<?php

namespace Uuid\Factories;

use Uuid\Exceptions\UuidException;
use Uuid\Models\Uuid;
use Uuid\Models\UuidInterface;

abstract class UuidFactory implements UuidFactoryInterface
{
    /**
     * @throws UuidException
     */
    abstract public function createUuid(): UuidInterface;

    /**
     * @throws UuidException
     */
    public function createUuidFromBytes(string $bytes): UuidInterface
    {
        if (16 !== strlen($bytes)) {
            throw new UuidException('The bytes must have a length of 16.');
        }

        return new Uuid($bytes);
    }

    /**
     * @throws UuidException
     */
    public function createUuidFromHexadecimal(string $hexadecimal): UuidInterface
    {
        if (1 !== preg_match('/^[0-9a-f]{32}$/', $hexadecimal)) {
            throw new UuidException('The hexadecimal must be a hexadecimal string and must have a length of 32.');
        }

        $bytes = @hex2bin($hexadecimal);

        if (!is_string($bytes)) {
            throw new UuidException('Failed to convert the hexadecimal string to its binary representation.');
        }

        return $this->createUuidFromBytes($bytes);
    }

    /**
     * @throws UuidException
     */
    public function createUuidFromString(string $string): UuidInterface
    {
        if (1 !== preg_match('/^[0-9a-f]{8}\-[0-9a-f]{4}\-[0-9a-f]{4}\-[0-9a-f]{4}\-[0-9a-f]{12}$/', $string)) {
            throw new UuidException('The string must be a uuid.');
        }

        return $this->createUuidFromHexadecimal(str_replace('-', '', $string));
    }
}
