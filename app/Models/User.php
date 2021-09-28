<?php

namespace App\Models;

use App\Notifications\Users\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Auth;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasFactory,
        Notifiable,
        HasRoles,
        SoftDeletes,
        InteractsWithMedia;

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
        'active',
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
        'active'            => 'boolean',
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

    /**
     * Accessors
     */
    public function getActive()
    {
        $color = $this->active ? 'success' : 'danger';
        $text  = $this->active ? 'Sim' : 'Não';

        return "<span class=\"badge badge-pill badge-soft-{$color} font-size-11\">{$text}</span>";
    }

    public function getAvatar()
    {
        $image = $this->getFirstMedia('avatar');
        // return isset($image) ? $image->getUrl() : null;

        return isset($image) ? $image->getFullUrl() : asset('/admin/images/users/avatar-1.jpg');
    }
}
