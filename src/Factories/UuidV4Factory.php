<?php

namespace Uuid\Factories;

use Uuid\Exceptions\UuidException;
use Uuid\Models\UuidInterface;

class UuidV4Factory extends UuidFactory
{
    /**
     * @throws UuidException
     */
    public function createUuid(): UuidInterface
    {
        $bytes = random_bytes(16);

        $data = unpack('n*', $bytes);

        if (!is_array($data)) {
            throw new UuidException('Failed to unpack the data from the binary string.');
        }

        $data[4] = $data[4] & 0x0FFF | 0x4000;
        $data[5] = $data[5] & 0x3FFF | 0x8000;

        $bytes = pack('n*', ...$data);

        return $this->createUuidFromBytes($bytes);
    }
}
