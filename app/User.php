<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Watson\Validating\ValidatingTrait;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, ValidatingTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'github_id',
        'avatar',
        'bio',
        'airport_code',
        'twitter_handle',
        'url',
        'desire_transportation',
        'desire_accommodation',
        'role',
        'is_sponsor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'github_token', 'github_token', 'remember_token'
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
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'username' => 'required|string|max:255|unique:users,username',
        'github_id' => 'required|numeric|unique:users,github_id',
        'avatar' => 'nullable|string',
        'bio' => 'nullable|string',
        'airport_code' => 'nullable|size:3',
        'twitter_handle' => 'nullable|min:1|max:15',
        'url' => 'nullable|url',
        'desire_transportation' => 'nullable|boolean',
        'desire_accommodation' => 'nullable|boolean',
        'is_sponsor' => 'nullable|boolean',
    ];

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
    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCommittee($query)
    {
        return $query->whereIn('role', ['admin', 'reviewer'])->orderBy('name', 'ASC');
    }

    /**
     * @return bool
     */
    public function inCommittee(): bool
    {
        return in_array($this->role, ['admin', 'reviewer']);
    }

    /**
     * @param $value
     */
    public function setAirportCodeAttribute($value)
    {
        $this->attributes['airport_code'] = strtoupper($value);
    }
}
