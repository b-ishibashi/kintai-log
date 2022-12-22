<?php

declare(strict_types=1);

namespace App\Packages\Uuid;

use App\Exceptions\DomainException;
use Illuminate\Support\Str;

class Uuid
{
    private const UUID_LENGTH = 36;

    private String $value;

    /**
     * @param String|null $value
     *
     * @throws DomainException
     */
    public function __construct(String | null $value = null)
    {
        if ($value === null) {
            $this->value = (string) Str::orderedUuid();
        } else {
            $this->value = $value;
        }

        if (strlen($this->value) !== self::UUID_LENGTH) {
            throw new DomainException('uuid is invalid. value:' . $this->value);
        }
    }

    public function getValue(): String
    {
        return $this->value;
    }

    public function equals(Uuid $uuid): bool
    {
        return $this->value === $uuid->getValue();
    }

    public function __toString(): String
    {
        return $this->value;
    }
}
