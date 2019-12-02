<?php
namespace App\Models;

use App\Models\Check;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Website extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Create a check against the website.
     *
     * @param int $statusCode
     * @param int $loadTime
     * @return \App\Models\Check
     */
    public function createCheck(int $statusCode, int $loadTime): Check
    {
        $check = $this->checks()->create([
            'status_code' => $statusCode,
            'load_time' => $loadTime,
        ]);

        // Send notifications if required
        $check->notify();

        return $check;
    }

    /**
     * Scope a query to only include active websites.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * Get the owner of the website.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the websites checks.
     */
    public function checks()
    {
        return $this->hasMany('App\Models\Check');
    }

    /**
     * Get the latest website check.
     */
    public function lastCheck()
    {
        return $this->checks()->latest()->first();
    }
}
