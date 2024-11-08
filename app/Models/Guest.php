<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'country'
    ];

    public static function getGuests(int $limit, int $offset): Collection
    {
        return Guest::skip($offset)->take($limit)->get();
    }
}
