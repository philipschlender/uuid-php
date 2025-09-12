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

        $bytes = hex2bin('6a7cb592f7a44739b1fadc78c09bd76d');

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

        $this->assertEquals(hex2bin('6a7cb592f7a44739b1fadc78c09bd76d'), $bytes);
    }

    public function testToHexadecimal(): void
    {
        $hexadecimal = $this->uuid->toHexadecimal();

        $this->assertEquals('6a7cb592f7a44739b1fadc78c09bd76d', $hexadecimal);
    }

    public function testToString(): void
    {
        $string = $this->uuid->toString();

        $this->assertEquals('6a7cb592-f7a4-4739-b1fa-dc78c09bd76d', $string);
    }
}
