<?php

namespace App\Models;

use Eloquent;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property string $id
 * @property string|null $checkin_date
 * @property int $status
 * @property string $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Booking newModelQuery()
 * @method static Builder|Booking newQuery()
 * @method static Builder|Booking query()
 * @method static Builder|Booking whereCheckinDate($value)
 * @method static Builder|Booking whereCreatedAt($value)
 * @method static Builder|Booking whereId($value)
 * @method static Builder|Booking whereStatus($value)
 * @method static Builder|Booking whereUpdatedAt($value)
 * @method static Builder|Booking whereUserId($value)
 * @property int $number
 * @property-read User|null $user
 * @method static Builder|Booking whereNumber($value)
 * @method static Builder|Booking filter(array $input = [], $filter = null)
 * @method static Builder|Booking paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Booking simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Booking whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Booking whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Booking whereLike($column, $value, $boolean = 'and')
 * @mixin Eloquent
 */
class Booking extends Model
{
    use HasUuids;
    use Filterable;

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
