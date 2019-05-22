<?php
namespace Wink;

use Exception;
use Wink\WinkAuthor;
use Illuminate\Database\Eloquent\Model;
use Wink\Traits\HasComments;

class WinkComment extends Model
{
    use HasComments;

    protected $fillable = [
        'comment',
        'user_id',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function scopeApproved($query) {
        return $query->where('is_approved', true);
    }

    public function commentable() {
        return $this->morphTo();
    }

    public function commentator() {
        return $this->belongsTo(WinkAuthor::class, 'author_id');
    }

    public function approve() {
        $this->update([
            'is_approved' => true,
        ]);

        return $this;
    }
  
    public function disapprove() {
        $this->update([
            'is_approved' => false,
        ]);

        return $this;
    }
}