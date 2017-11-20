<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Watson\Validating\ValidatingTrait;

class Comment extends Model
{
    use SoftDeletes, ValidatingTrait;

    /**
     * @var array
     */
    protected $with = ['user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'talk_id',
        'comment'
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
        'user_id' => 'required|numeric|exists:users,id',
        'talk_id' => 'required|numeric|exists:talks,id',
        'comment' => 'required|string|min:140',
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
