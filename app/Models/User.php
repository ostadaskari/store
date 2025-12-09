<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'family',
        'mobile',
        'email',
        'password',
        'verification_code',
        'code_expires_at',
        'is_mobile_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code', // Hide the code
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

    static public function getSingle($id){
        return self::find($id);
    }
    static public function getAdmin(){
        return User::select('users.*')
            ->where('is_admin', 1)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();
    }
    /**
     * Query Scope to fetch customer records with filtering logic.
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeGetCustomer(Builder $query, array $filters = [])
    {
        $query->select('users.*')
            ->where('is_admin', 0)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc');

        // Apply dynamic filters
        if (!empty($filters['name'])) {
            $query->where(function ($q) use ($filters) {
                // Assuming 'name' field contains both first and last name, or we search across both
                $q->where('name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('family', 'like', '%' . $filters['name'] . '%');
            });
        }

        if (!empty($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (!empty($filters['mobile'])) {
            $query->where('mobile', 'like', '%' . $filters['mobile'] . '%');
        }

        // Status Filter
        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', (int)$filters['status']);
        }

        // 1. From Date: Start of the day (00:00:00)
        if (!empty($filters['from_date'])) {
            // Converts 'YYYY-MM-DD' string to a Carbon object at the start of that day.
            $fromDate = Carbon::parse($filters['from_date'])->startOfDay();
            $query->where('created_at', '>=', $fromDate);
        }

        // 2. To Date: End of the day (23:59:59)
        if (!empty($filters['to_date'])) {
            // Converts 'YYYY-MM-DD' string to a Carbon object at the end of that day.
            $toDate = Carbon::parse($filters['to_date'])->endOfDay();
            $query->where('created_at', '<=', $toDate);
        }

        return $query;
    }

    /**
     * A user can have multiple addresses.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
}

