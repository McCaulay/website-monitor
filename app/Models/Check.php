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
     * Get the website the check is for.
     */
    public function website()
    {
        return $this->belongsTo('App\Models\Website');
    }
}
