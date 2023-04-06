<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userlog extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'created_at',
    ];

    protected $appends = [
        'date',
        'time',
    ];

    /* -------------------------------------------------------------------------------------------- */
    // Accessors (GET) Attribute (APPENDED)
    /* -------------------------------------------------------------------------------------------- */
    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

    public function getTimeAttribute()
    {
        return date('H:i', strtotime($this->attributes['created_at']));
    }

    /* -------------------------------------------------------------------------------------------- */
    // Relationships
    /* -------------------------------------------------------------------------------------------- */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
