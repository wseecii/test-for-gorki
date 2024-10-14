<?php

namespace App\Filters;

use EloquentFilter\ModelFilter;

abstract class BaseFilter extends ModelFilter
{
    public function __construct($query, array $input = [], $relationsEnabled = true)
    {
        parent::__construct($query, $input, $relationsEnabled);

        $this->setup();
    }

    /**
     * @return void
     */
    abstract public function setup(): void;
}
