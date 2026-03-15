<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'phone',
        'image',
        'address',
        'website',
        'description',
        'username',
        'github',
        'facebook',
        'youtube',
        'twitter',
        'facebook_link',
        'linkedin_link',
        'twitter_link',
        'instagram_link',
        'vimo_link',
        'balance',
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


    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function businessUser()
    {
        return $this->hasOne(Business::class, 'user_id');
    }

    public function serviceCategory()
    {
        return $this->hasMany(ServiceCategory::class, 'created_by');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'created_by');
    }

    public function teamMember()
    {
        return $this->hasMany(TeamMember::class, 'created_by');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'created_by');
    }
    public function shopMemberships()
    {
        return $this->hasMany(Membership::class, 'created_by');
    }

    public function paid_plans()
    {
        return $this->hasMany(PaidPlan::class, 'client_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class, 'created_by');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'created_by');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'store_id');
    }

    public function averageRating()
    {
        return $this->feedback()->avg('rating') / 6 * 100;
    }
}
