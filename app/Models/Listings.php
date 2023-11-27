<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'email',
        'tags',
        'description',
        'company',
        'location',
        'website',
        'logo',
        'user_id'
    ];
    public function scopefilter($query,array $filters){
        if($filters['tag'] ?? false){
            $query->where('tags','like','%'. request('tag') . '%');
            // dd($query->where('tags', 'like', '%', request('tag'), '%'));
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                    ->orwhere('description', 'like', '%' . request('search') . '%')
                    ->orwhere('tags', 'like', '%' . request('search') . '%');
        }

    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
