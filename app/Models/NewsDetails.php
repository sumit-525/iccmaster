<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class NewsDetails extends Model
{
    use HasFactory;
    protected $table = 'newsdetails';
    protected $fillable = [
        'title',
        'newscategory_id',
        'image',
        'link',
        'startdate',
        'enddate',
        'description',
        'position_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];
    public function newscategory()
    {
        return $this->belongsTo(NewsCategory::class, 'newscategory_id');
    }
    protected static function boot()
    {
        parent::boot();

        // Add global scope for 'viewer' role users
        static::addGlobalScope('activeStatusScope', function (Builder $builder) {
            if (Auth::check() && Auth::user()->hasRole('viewer')) {
                // Apply status = 1 filter for viewer role
                $builder->where('status', 1);
            }
        });
    }
}
