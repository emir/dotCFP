<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Talk extends Model
{
    use SoftDeletes, ValidatingTrait, Sluggable, SluggableScopeHelpers;

    /**
     * @var string
     */
    protected $slugKeyName = 'slug';

    /**
     * Whether the model should throw a ValidationException if it
     * fails validation. If not set, it will default to false.
     *
     * @var boolean
     */
    protected $throwValidationExceptions = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'additional_information',
        'duration',
        'slide',
        'is_favorite',
        'average_vote',
        'status'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * @var array
     */
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:140',
        'additional_information' => 'nullable|string',
        'duration' => 'required|numeric',
        'slide' => 'nullable|url',
        'is_favorite' => 'boolean',
        'average_vote' => 'nullable|min:1|max:5'
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
                'source' => 'title'
            ]
        ];
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getSlugKeyName();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSpeaker($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeMostVoted($query)
    {
        return $query->orderBy('average_vote', 'DESC');
    }

    /**
     * @param  string $value
     * @return void
     */
    public function setAverageVoteAttribute($value)
    {
        $this->attributes['average_vote'] = round($value);
    }
}
