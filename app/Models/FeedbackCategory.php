<?php

namespace App\Models;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title'
    ];

    /**
     * Get all of the feedbacks for the FeedbackCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'feedback_category_id', 'id');
    }
}
