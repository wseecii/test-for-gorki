<?php

namespace App\Interfaces;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{
    /**
     * @param int $number
     * @param Carbon $checkInDate
     * @param string $userId
     * @param bool $confirm
     * @return Booking
     */
    public function new(int $number, Carbon $checkInDate, string $userId, bool $confirm = false): Booking;

    /**
     * @param string $id
     * @param int $number
     * @param Carbon $checkInDate
     * @param string $userId
     * @param bool $confirm
     * @return Booking|null
     */
    public function update(string $id, int $number, Carbon $checkInDate, string $userId, bool $confirm = false): ?Booking;

    /**
     * @param array $filters
     * @return Collection
     */
    public function getAll(array $filters = []): Collection;

    /**
     * @param string $userId
     * @param array $filters
     * @return Collection
     */
    public function getByUser(string $userId, array $filters = []): Collection;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * @param string $id
     * @return Booking|null
     */
    public function show(string $id): ?Booking;
}
