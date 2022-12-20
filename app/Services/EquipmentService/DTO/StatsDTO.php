<?php

namespace App\Services\EquipmentService\DTO;

class StatsDTO
{
    public function __construct(private readonly int $total,
                                private readonly int $destroyed,
                                private readonly int $damaged,
                                private readonly int $captured,
                                private readonly int $abandoned)
    {
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getDestroyed(): int
    {
        return $this->destroyed;
    }

    public function getDamaged(): int
    {
        return $this->damaged;
    }

    public function getCaptured(): int
    {
        return $this->captured;
    }

    public function getAbandoned(): int
    {
        return $this->abandoned;
    }
}
