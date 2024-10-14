<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 * 
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $first_name
 * @property string $surname
 * @property string|null $last_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User whereLogin($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereSurname($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @property-read Collection<int, Client> $clients
 * @property-read int|null $clients_count
 * @property-read Collection<int, Token> $tokens
 * @property-read int|null $tokens_count
 * @property-read Booking|null $bookings
 * @property string|null $remember_token
 * @method static Builder|User whereRememberToken($value)
 * @mixin Eloquent
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use HasUuids;
    use HasApiTokens;

    /**
     * @return BelongsTo
     */
    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
