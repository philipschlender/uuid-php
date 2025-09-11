<?php

namespace Uuid\Models;

interface UuidInterface
{
    public function toBytes(): string;

    public function toHexadecimal(): string;

    public function toString(): string;
}
