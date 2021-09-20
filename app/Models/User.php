<?php

namespace App\Models;

use App\Notifications\Users\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,
        Notifiable,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Notifications
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this));
    }

    /**
     * Scopes
     */
    public function findForPassport($identifier) {
        return $this->orWhere('email', $identifier)->where('active', true)->first();
    }

    public function scopeIsRoot($query, $user) {
        if(!$user->hasRole('root')):
            return $this->whereHas('roles', function($q) {
                $q->where('name', '<>', 'root');
            });
        endif;
    }

    /**
     * Mutators
     */
    public function setEmailAttribute($input)
    {
        if ($input)
            $this->attributes['email'] = mb_strtolower($input, 'UTF-8');
    }

    public function setPhoneAttribute($input)
    {
        if ($input)
            $this->attributes['phone'] = trim(preg_replace('#[^0-9]#', '', $input));
    }
}
