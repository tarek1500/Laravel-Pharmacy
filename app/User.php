<?php

namespace App;

use App\Notifications\User\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
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
        'date_of_birth',
        'avatar_img',
        'mobile_number',
        'national_id',
        'last_login_date'
    ];

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function orders()
    {
        return $this->hasMany('App\Order','order_user_id');
    }

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

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerifyEmail);
	}

	public function getAvatarAttribute()
	{
		$path = $this->avatar_img;

		if (Storage::exists($path))
			return 'data:' . Storage::mimeType($path) . ';base64,' . base64_encode(Storage::get($path));

		return null;
    }
    
    public function setAvatarAttribute($image){
        
        if(isset($this->attributes['avatar_img']))
            Storage::delete($this->avatar_img);

        $path=$image->store('images/avatars');
        $this->attributes['avatar_img']=$path;
    }

    public function setLastLoginDateAttribute($value)
    {
       $this->attributes['last_login_date']= Carbon::parse($value)->format('y-m-d 00:00:00');
    }
}
