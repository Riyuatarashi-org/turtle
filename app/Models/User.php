<?php

declare( strict_types=1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int                                                                $id
 * @property string                                                             $name
 * @property string                                                             $email
 * @property \Illuminate\Support\Carbon|null                                    $email_verified_at
 * @property string                                                             $password
 * @property string|null                                                        $profile_photo_path
 * @property string|null                                                        $current_team_id
 * @property string|null                                                        $profile_photo_url
 * @property string|null                                                        $remember_token
 * @property string|null                                                        $two_factor_secret
 * @property string|null                                                        $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null                                    $created_at
 * @property \Illuminate\Support\Carbon|null                                    $updated_at
 * @property \Illuminate\Support\Carbon|null                                    $deleted_at
 * ----
 * Relations:
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Message> $messagesSend
 * @property-read \Illuminate\Database\Eloquent\Collection<\App\Models\Message> $messagesReceived
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // --------------------------------------------------
    // ---- Relationships

    public function messagesSend(): HasMany
    {
        return $this->hasMany(Message::class, 'author_id');
    }

    public function messagesReceived(): HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
}
