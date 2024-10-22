<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     static::addGlobalScope('active', function ($builder) {
        if (auth()->check() && auth()->user()->hasRole('viewer')) {
            $builder->where('status', 1); 
        }
     });
   }
}
