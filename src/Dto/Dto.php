<?php

namespace Shahinyanm\ElevenlabsApi\Dto;

abstract class Dto
{
    abstract function toArray(): array;

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
