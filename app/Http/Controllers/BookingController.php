<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\BookingGetAllRequest;
use App\Http\Requests\Booking\BookingNewRequest;
use App\Http\Requests\Booking\BookingUpdateRequest;
use App\Http\Resources\BookingAllResource;
use App\Interfaces\BookingRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function __construct(protected BookingRepositoryInterface $bookingRepository)
    {
        parent::__construct();
    }

    /**
     * @param BookingNewRequest $request
     * @return ResponseFactory|Application|Response
     */
    public function new(BookingNewRequest $request): ResponseFactory|Application|Response
    {
        $booking = $this->bookingRepository->new($request->integer('number'), $request->date('checkInDate'), $this->user->id, $request->boolean('status'));

        return $this->ok(['message' => __('messages.bookings.ok'), 'bookingId' => $booking->id]);
    }

    /**
     * @param BookingUpdateRequest $request
     * @param string $id
     * @return ResponseFactory|Application|Response
     */
    public function update(BookingUpdateRequest $request, string $id): ResponseFactory|Application|Response
    {
        $booking = $this->bookingRepository->show($id);

        if ($booking === null) {
            return $this->fail(['message' => __('messages.bookings.unknown')], 404);
        }

        $result = $this->bookingRepository->update($id, $request->integer('number'), $request->date('checkInDate'), $this->user->id, $request->boolean('status'));

        if (!$result) {
            return $this->fail(['message' => __('messages.bookings.failUpdated'), 'bookingId' => $booking->id]);
        }

        return $this->ok(['message' => __('messages.bookings.updated'), 'bookingId' => $booking->id]);
    }

    /**
     * @param string $id
     * @return ResponseFactory|Application|Response
     */
    public function show(string $id): ResponseFactory|Application|Response
    {
        $booking = $this->bookingRepository->show($id);

        if ($booking === null) {
            return $this->fail(['message' => __('messages.bookings.unknown')], 404);
        }

        return $this->ok(new BookingAllResource($booking));
    }

    /**
     * @param BookingGetAllRequest $request
     * @return ResponseFactory|Application|Response
     */
    public function getAll(BookingGetAllRequest $request): ResponseFactory|Application|Response
    {
        $bookings = $this->bookingRepository->getAll($request->validated());

        return $this->ok(BookingAllResource::collection($bookings));
    }

    /**
     * @param string $id
     * @return ResponseFactory|Application|Response
     */
    public function delete(string $id): ResponseFactory|Application|Response
    {
        $booking = $this->bookingRepository->show($id);

        if ($booking === null) {
            return $this->fail(['message' => __('messages.bookings.unknown')], 404);
        }

        if (!$this->bookingRepository->delete($id)) {
            return $this->fail(['message' => __('messages.bookings.failDeleted')]);
        }

        return $this->ok(['message' => __('messages.bookings.deleted')]);
    }

    /**
     * @param BookingGetAllRequest $request
     * @return ResponseFactory|Application|Response
     */
    public function getByUser(BookingGetAllRequest $request): ResponseFactory|Application|Response
    {
        $bookings = $this->bookingRepository->getByUser($this->user->id, $request->validated());

        return $this->ok(BookingAllResource::collection($bookings));
    }
}
