<?php

namespace Modules\Policy\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Policy\Scopes\checkTrash;
use Modules\Policy\Traits\SaveFile;

/**
 * @method static create(array $validate)
 */
class Policy extends Model
{
    use HasFactory , SaveFile;

    public $timestamps = false;
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new checkTrash());
    }

    public function moveToTrash()
    {
        $this->update([
            'is_trashed' => true
        ]);
    }
}
