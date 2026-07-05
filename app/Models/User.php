<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

// class User extends Authenticatable implements FilamentUser
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'city_id',
        'state_id',
        'type'
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

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function isAdmin()
    {
        return $this->type === "admin";
    }
    public function isManager()
    {
        return $this->type === "manager";
    }
    public function isUser()
    {
        return $this->type === "user";
    }

    // public function canAccessPanel(Panel $panel): bool
    // {
    //     return match ($panel->getId()) {
    //         'admin' => $this->isAdmin(),
    //         'manager' => $this->isManager(),
    //         'user' => $this->isUser(),
    //         default => false,
    //     };
    // }
}
