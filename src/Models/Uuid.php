<?php

namespace Uuid\Models;

use Uuid\Exceptions\UuidException;

class Uuid implements UuidInterface
{
    protected string $bytes;

    /**
     * @throws UuidException
     */
    public function __construct(
        string $bytes,
    ) {
        if (16 !== strlen($bytes)) {
            throw new UuidException('The bytes must have a length of 16.');
        }

        $this->bytes = $bytes;
    }

    public function toBytes(): string
    {
        return $this->bytes;
    }

    public function toHexadecimal(): string
    {
        return bin2hex($this->bytes);
    }

    public function toString(): string
    {
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($this->toHexadecimal(), 4));
    }
}
