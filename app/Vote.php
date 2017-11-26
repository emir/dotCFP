<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Vote extends Model
{
    use SoftDeletes, ValidatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'talk_id',
        'vote'
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
        'user_id' => 'required|exists:users,id',
        'talk_id' => 'required|exists:talks,id',
        'vote' => 'required|min:1|max:5',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function talk(): BelongsTo
    {
        return $this->belongsTo(Talk::class);
    }
}
