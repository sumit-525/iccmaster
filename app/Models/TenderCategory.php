<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenderCategory extends Model
{
    use HasFactory;
    protected $table = 'tendercategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
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
