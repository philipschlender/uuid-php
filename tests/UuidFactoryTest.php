<?php

namespace Tests;

use Uuid\Exceptions\UuidException;
use Uuid\Factories\UuidFactory;
use Uuid\Factories\UuidFactoryInterface;
use Uuid\Models\Uuid;
use Uuid\Models\UuidInterface;

class UuidFactoryTest extends TestCase
{
    protected UuidFactoryInterface $uuidFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uuidFactory = new class extends UuidFactory {
            /**
             * @throws UuidException
             */
            public function createUuid(): UuidInterface
            {
                $bytes = hex2bin('6a7cb592f7a44739b1fadc78c09bd76d');

                if (!is_string($bytes)) {
                    throw new UuidException('Failed to convert the hexadecimal string to its binary representation.');
                }

                return new Uuid($bytes);
            }
        };
    }

    public function testCreateUuidFromBytes(): void
    {
        $expectedUuid = $this->uuidFactory->createUuid();

        $uuid = $this->uuidFactory->createUuidFromBytes($expectedUuid->toBytes());

        $this->assertEquals($expectedUuid, $uuid);
    }

    public function testCreateUuidFromBytesInvalidBytes(): void
    {
        $this->expectException(UuidException::class);
        $this->expectExceptionMessage('The bytes must have a length of 16.');

        $this->uuidFactory->createUuidFromBytes($this->fakerService->getStringGenerator()->randomBytes(2));
    }

    public function testCreateUuidFromHexadecimal(): void
    {
        $expectedUuid = $this->uuidFactory->createUuid();

        $uuid = $this->uuidFactory->createUuidFromHexadecimal($expectedUuid->toHexadecimal());

        $this->assertEquals($expectedUuid, $uuid);
    }

    public function testCreateUuidFromHexadecimalInvalidHexadecimal(): void
    {
        $this->expectException(UuidException::class);
        $this->expectExceptionMessage('The hexadecimal must be a hexadecimal string and must have a length of 32.');

        $this->uuidFactory->createUuidFromHexadecimal($this->fakerService->getStringGenerator()->randomHexadecimal(2));
    }

    public function testCreateUuidFromString(): void
    {
        $expectedUuid = $this->uuidFactory->createUuid();

        $uuid = $this->uuidFactory->createUuidFromString($expectedUuid->toString());

        $this->assertEquals($expectedUuid, $uuid);
    }

    public function testCreateUuidFromStringInvalidString(): void
    {
        $this->expectException(UuidException::class);
        $this->expectExceptionMessage('The string must be a uuid.');

        $this->uuidFactory->createUuidFromString($this->fakerService->getDataTypeGenerator()->randomString(2));
    }
}
