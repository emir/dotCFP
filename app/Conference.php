<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Conference extends Model
{
    use SoftDeletes, ValidatingTrait, Sluggable, SluggableScopeHelpers;

    /**
     * @var bool
     */
    protected $throwValidationExceptions = true;

    /**
     * @var string
     */
    protected $slugKeyName = 'slug';

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getSlugKeyName();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'name',
        'description',
        'website',
        'email',
        'timezone',
        'start_date',
        'end_date',
        'open_date',
        'close_date',
        'airport',
        'lat',
        'lng',
        'speaker_packages',
        'previous_years'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @var array
     */
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'slug' => 'nullable|unique:conferences,slug',
        'description' => 'required|string',
        'www' => 'nullable|www',
        'timezone' => 'nullable|string|min:1|max:3',
        'start_date' => 'required|date_format:Y-m-d',
        'end_date' => 'required|date_format:Y-m-d',
        'open_date' => 'required|date_format:Y-m-d',
        'close_date' => 'required|date_format:Y-m-d',
        'airport' => 'nullable|alpha|size:3',
        'lat' => 'nullable|regex:/^-?\d{1,2}\.\d{6,}$/',
        'lng' => 'nullable|regex:/^-?\d{1,2}\.\d{6,}$/',
        'speaker_packages' => 'nullable|string',
        'previous_years' => 'nullable|string',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     * @return string
     */
    public function getStartDateAttribute($value)
    {
        return new Carbon($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getEndDateAttribute($value)
    {
        return new Carbon($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getOpenDateAttribute($value)
    {
        return new Carbon($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getCloseDateAttribute($value)
    {
        return new Carbon($value);
    }
}
