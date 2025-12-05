<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class Customer extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $primaryKey = 'cust_id';
    protected $table = 'customers';

    protected $hidden = [
        'cust_password'
    ];

    protected $guarded = [];


    protected function casts(): array
    {
        return [
            'cust_password' => 'hashed',
        ];
    }

    public function createToken(string $name, array $abilities = ['*'], ?DateTimeInterface $expiresAt = null)
    {
        $plainTextToken = $this->generateTokenString();

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $plainTextToken);
    }

    /*
     * Define relationships
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'cust_id', 'cust_id');
    }

    public function eventAccesses()
    {
        return $this->hasMany(EventAccess::class, 'cust_id', 'cust_id');
    }
}
