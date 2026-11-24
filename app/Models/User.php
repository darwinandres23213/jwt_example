<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];


    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @return array<string, string>
     */
    // 0,1 == True false
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function getRoleName(): ?string
    {
        return $this->role?->name;
    }

    /**
     * Permisos del único rol del usuario (config/roles.php).
     *
     * @return list<string>
     */
    public function getPermissions(): array
    {
        return $this->role?->permissions() ?? [];
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->getPermissions(), true);
    }

    public function hasRole(string $role): bool
    {
        return $this->getRoleName() === $role;
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

  
    public function getJWTCustomClaims(): array
    {
        return [
            'role' => $this->getRoleName(),
        ];
    }
}
