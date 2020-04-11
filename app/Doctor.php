<?php

namespace App;

use App\Notifications\Doctor\Auth\ResetPassword;
use App\Notifications\Doctor\Auth\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Authenticatable implements MustVerifyEmail
{
	use Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'avatar_image',
        'is_baned',
        'pharmacy_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */


    public function getCompleteDoctorAttribute()
    {
        $doctor['id']=$this->id;
        $doctor['name']=$this->name;
        $doctor['email']=$this->email;
        $doctor['password']=$this->password;
        $doctor['national_id']=$this->national_id;
        $doctor['avatar_image']=$this->avatar_image;
        $doctor['is_baned']=$this->is_baned;
        $doctor['pharmacy_id']=$this->pharmacy->name;
        $doctor['created_at']=$this->created_at;
        $doctor['updated_at']=$this->updated_at;
        $doctor['email_verified_at']=$this->email_verified_at;
        $doctor['remember_token']=$this->remember_token;

        // if(Auth::guard('admin')->check())

        return $doctor;
    }


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

     //function pharmacy represent one to many relation between pharmacy and doctors
     public function pharmacy()
     {
         return $this->belongsTo('App\Pharmacy');
     }

     public function setAvatarAttribute($image){
        if($image){
            if(isset($this->attributes['avatar_image']))
                Storage::delete($this->avatar_image);

            $path=$image->store('public/images/avatars');
            $this->attributes['avatar_image']=$path;
        }

        else
            $this->attributes['avatar_image']='public/images/avatars/default.jpeg';
    }

    public function getAvatarImageAttribute(){
        if(isset($this->attributes['avatar_image'])){   
            return Storage::url($this->attributes['avatar_image']); 
        }   
        return "";
    }
}
