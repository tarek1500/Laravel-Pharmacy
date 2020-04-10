<?php

namespace App;

use App\Notifications\Pharmacy\Auth\ResetPassword;
use App\Notifications\Pharmacy\Auth\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Pharmacy extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, SoftDeletes, Billable;

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
        'priority',
        'area_id',
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


    public function area()
    {
         return $this->belongsTo('App\Area');
    } 

      
    // The medicines that belong to the pharmacy.
    
    public function medicines()
    {  //many to many relation
        return $this->belongsToMany(Medicine::class,'medicine_pharmacies')->withTimestamps();
    }

    public function doctors(){
        return $this->hasMany('App\Doctor');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($pharmacy) { // before delete() method call this
            
            Doctor::where('pharmacy_id',$pharmacy->id)->delete();
            MedicinePharmacy::where('pharmacy_id',$pharmacy->id)->delete();
        
        });
}

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
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function setPasswordAttribute($password)
{
    $this->attributes['password'] = \Hash::make($password);
}

    public function orders()
    {
        return $this->hasMany('App\Order','pharamcy_id');
    }

    
    public function setAvatarAttribute($image){
        if($image){
            if(isset($this->attributes['avatar_image']))
                Storage::delete($this->avatar_image);

            $path=$image->store('public/images/avatars');
            $this->attributes['avatar_image']=$path;
        }

        else
            $this->attributes['avatar_image']='public/avatars/default.jpeg';
    }

    public function getAvatarImageAttribute(){
        if(isset($this->attributes['avatar_image'])){   
            return Storage::url($this->attributes['avatar_image']); 
        }   
        return "";
    }
}
