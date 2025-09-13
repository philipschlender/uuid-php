<?php

namespace Tests;

use Uuid\Factories\UuidFactoryInterface;
use Uuid\Factories\UuidV4Factory;
use Uuid\Models\Uuid;

class UuidV4FactoryTest extends TestCase
{
    protected UuidFactoryInterface $uuidFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uuidFactory = new UuidV4Factory();
    }

    public function testCreateUuid(): void
    {
        $uuid = $this->uuidFactory->createUuid();

        $this->assertInstanceOf(Uuid::class, $uuid);
        $this->assertMatchesRegularExpression('/^[0-9a-f]{32}$/', $uuid->toHexadecimal());
        $this->assertEquals('4', substr($uuid->toHexadecimal(), 12, 1));
    }
}
