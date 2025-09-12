<?php

namespace Tests;

use Uuid\Exceptions\UuidException;
use Uuid\Factories\UuidFactory;
use Uuid\Factories\UuidFactoryInterface;
use Uuid\Models\Uuid;

class UuidFactoryTest extends TestCase
{
    protected UuidFactoryInterface $uuidFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uuidFactory = new UuidFactory();
    }

    public function testCreateUuidV4(): void
    {
        $uuid = $this->uuidFactory->createUuidV4();

        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertMatchesRegularExpression('/^[0-9a-f]{32}$/', $uuid->toHexadecimal());
        $this->assertEquals('4', substr($uuid->toHexadecimal(), 12, 1));
    }

    public function testCreateUuidFromBytes(): void
    {
        $expectedUuid = $this->uuidFactory->createUuidV4();

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
        $expectedUuid = $this->uuidFactory->createUuidV4();

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
        $expectedUuid = $this->uuidFactory->createUuidV4();

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
