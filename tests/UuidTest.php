<?php

namespace Tests;

use Uuid\Exceptions\UuidException;
use Uuid\Models\Uuid;
use Uuid\Models\UuidInterface;

class UuidTest extends TestCase
{
    protected UuidInterface $uuid;

    /**
     * @throws UuidException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $bytes = hex2bin('00000000000000000000000000000000');

        if (!is_string($bytes)) {
            throw new UuidException('Failed to convert the hexadecimal string to its binary representation.');
        }

        $this->uuid = new Uuid($bytes);
    }

    public function testConstructInvalidBytes(): void
    {
        $this->expectException(UuidException::class);
        $this->expectExceptionMessage('The bytes must have a length of 16.');

        new Uuid($this->fakerService->getStringGenerator()->randomBytes(2));
    }

    public function testToBytes(): void
    {
        $bytes = $this->uuid->toBytes();

        $this->assertEquals(hex2bin('00000000000000000000000000000000'), $bytes);
    }

    public function testToHexadecimal(): void
    {
        $hexadecimal = $this->uuid->toHexadecimal();

        $this->assertEquals('00000000000000000000000000000000', $hexadecimal);
    }

    public function testToString(): void
    {
        $string = $this->uuid->toString();

        $this->assertEquals('00000000-0000-0000-0000-000000000000', $string);
    }
}
