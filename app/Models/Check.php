<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    /**
     * Get the website the check is for.
     */
    public function website()
    {
        return $this->belongsTo('App\Models\Website');
    }
}
