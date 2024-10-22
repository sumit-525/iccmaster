<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = [
        'title',
        'category_id',
        'document',
        'startdate',
        'enddate',
        'documentstatus',
        'documentcount',
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
