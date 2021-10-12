<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
    ];
}
