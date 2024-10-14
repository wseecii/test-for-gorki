<?php

namespace App\Filters;

class BookingFilter extends BaseFilter
{
    /**
     * @inheritDoc
     */
    public function setup(): void
    {
        if (array_key_exists('limit', $this->input)) {
            $this->limit($this->input['limit']);
        }

        if (array_key_exists('offset', $this->input)) {
            $this->start($this->input['offset']);
        }
    }

    /**
     * @param int $value
     * @return void
     */
    public function start(int $value): void
    {
        $this->offset($value);
    }

    /**
     * @param int $value
     * @return void
     */
    public function total(int $value): void
    {
        $this->limit($value);
    }

    /**
     * @param bool $value
     * @return void
     */
    public function status(bool $value): void
    {
        $this->where('status', $value);
    }
}
