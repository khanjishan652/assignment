<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Traits\DatetimeTraits;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, DatetimeTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'invited_by',
        'status',
        'invitation_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }
    public function services()
    {
        return $this->hasMany(Service::class,'provider_id','id');
    }

    // Accessor for dynamic attribute
    public function getRoleAttribute($role)
    {
        switch ($role) {
            case 1:
              return 'super-admin';
              break;
            case 2:
              return 'admin';
              break;
            default:
              return 'member';
          }
    }
}
