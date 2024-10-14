<?php

namespace App\Repositories;

use App\Filters\BookingFilter;
use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function new(int $number, Carbon $checkInDate, string $userId, bool $confirm = false): Booking
    {
        $model = new Booking();
        $model->number = $number;
        $model->checkin_date = $checkInDate;
        $model->user_id = $userId;
        $model->status = $confirm;
        $model->save();

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, int $number, Carbon $checkInDate, string $userId, bool $confirm = false): ?Booking
    {
        $booking = $this->show($id);
        if ($booking === null) {
            return null;
        }

        $booking->number = $number;
        $booking->checkin_date = $checkInDate;
        $booking->user_id = $userId;
        $booking->status = $confirm;
        $booking->save();

        return $booking;
    }

    /**
     * @inheritDoc
     */
    public function getAll(array $filters = []): Collection
    {
        return Booking::filter($filters, BookingFilter::class)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getByUser(string $userId, array $filters = []): Collection
    {
        return Booking::filter($filters, BookingFilter::class)
            ->where("user_id", $userId)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id): bool
    {
        return Booking::where("id", $id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function show(string $id): ?Booking
    {
        return Booking::where('id', $id)->first();
    }

}
