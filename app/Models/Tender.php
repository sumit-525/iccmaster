<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $table = 'tenders';
    protected $fillable = [
        'title',
        'tendercategory_id',
        'document',
        'startdate',
        'enddate',
        'country',
        'state',
        'city',
        'description',
        'link',
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
    public function tendercategory()
    {
        return $this->belongsTo(TenderCategory::class, 'tendercategory_id');
    }
    
    protected static function boot()
    {
     parent::boot();
     static::addGlobalScope('active', function ($builder) {
        if (auth()->check() && auth()->user()->hasRole('viewer')) {
            $builder->where('status', true); 
        }
     });
   }

}
