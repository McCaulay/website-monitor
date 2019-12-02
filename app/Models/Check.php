<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_code', 'load_time'];

    /**
     * Get the speed percentage.
     *
     * @return double
     */
    public function getPercentageAttribute()
    {
        // <= 200ms = 100%
        // <= 500ms = 70%

        $time = $this->load_time - 200; // Remove 200ms

        // If it's faster than 200ms, 100% percentage
        if ($time <= 0) {
            return 100;
        }

        // If it's slower than 1000ms, 0% percentage
        if ($time >= 1000) {
            return 0;
        }

        // Calculate percentage
        $time = 1000 - $time;
        return ($time / 1000) * 100;
    }

    /**
     * Notify the owner if certain conditions are met.
     *
     * @return void
     */
    public function notify(): void
    {
        //
    }

    /**
     * Get the website the check is for.
     */
    public function website()
    {
        return $this->belongsTo('App\Models\Website');
    }
}
