<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'data_of_birth',
        'avatar_img',
        'mobile_number',
        'national_id',
        'last_login_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'avatar_img'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	protected $appends = ['avatar'];

	public function getAvatarAttribute()
	{
		$path = $this->avatar_img;

		if (Storage::exists($path))
			return 'data:' . Storage::mimeType($path) . ';base64,' . base64_encode(Storage::get($path));

		return null;
	}
}
