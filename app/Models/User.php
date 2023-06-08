<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function add(array $fields): self
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit(array $fields): void
    {
        $this->fill($fields);

        $this->save();
    }

    public function remove(): void
    {
        $this->delete();
    }

    public function generatePassword(string $password): void
    {
        if ($password != null){
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function setAdmin(bool $is_admin = False): void 
    {
        if(!$this->id == 1){
            $this->is_admin = $is_admin;
            $this->save();
        }
    }

    public function setStaff(bool $is_staff = False): void 
    {
        if(!$this->id == 1){
            $this->is_staff = $is_staff;
            $this->save();
        }
    }
}
