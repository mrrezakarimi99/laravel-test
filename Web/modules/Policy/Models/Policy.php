<?php

namespace Modules\Policy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static available()
 */
class Policy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'date_uploaded',
        'acknowledgement_required',
        'file',
        'file_type',
        'is_trashed',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('is_trashed', '=', false);
    }


    public function moveToTrash()
    {
        $this->update([
            'is_trashed' => true
        ]);
    }
}
