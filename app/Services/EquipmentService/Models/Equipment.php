<?php

namespace App\Services\EquipmentService\Models;

use App\Services\EquipmentService\Filters\EquipmentFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Spatie\Tags\HasTags;

class Equipment extends Model
{
    use HasFactory, HasTags;

    public $primaryKey  = 'id';

    protected $table = 'equipment';

    protected $fillable = [
        'name',
        'date',
        'geolocation',
        'category_id',
        'side_country',
        'source_url'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $filter = new EquipmentFilter($request);
        return $filter->filter($query);
    }
}
