<?php

namespace App\Models;

use App\Scopes\checkTrash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Policy extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
        'title',
        'date_uploaded',
        'acknowledgement_required',
        'file',
        'file_type',
        'is_trashed',
    ];


    protected static function booted()
    {
        static::addGlobalScope(new checkTrash());
    }
}
