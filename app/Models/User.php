<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the average website response time today.
     *
     * @return float
     */
    public function getAverageResponseTimeToday(): float
    {
        return $this->websites->map(function ($website) {
            return $website->checks()
                ->whereDate('created_at', now())
                ->get()
                ->map(function ($check) {
                    return $check->load_time;
                });
        })->flatten()->avg();
    }

    /**
     * Get the number of website checks ran today.
     *
     * @return int
     */
    public function getChecksCountToday(): int
    {
        return $this->websites->reduce(function ($carry, $website) {
            return $carry + $website->checks()->whereDate('created_at', now())->count();
        });
    }

    /**
     * Get the websites the user owns.
     */
    public function websites()
    {
        return $this->hasMany('App\Models\Website');
    }
}
