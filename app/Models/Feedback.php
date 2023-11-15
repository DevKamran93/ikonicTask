<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'feedback_category_id', 'description', 'user_id', 'vote', 'voted_users', 'comments'];
    /**
     * Get all of the comments for the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbackComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'feedback_id', 'id');
    }

    /**
     * Get the feedbackCategory that owns the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feedbackCategory(): BelongsTo
    {
        return $this->belongsTo(FeedbackCategory::class, 'feedback_category_id', 'id');
    }
    /**
     * Get the user that owns the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the votes for the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upVotes(): HasMany
    {
        return $this->hasMany(Vote::class, 'feedback_id', 'id')->where('vote_action', 'up');
    }

    public function downVotes(): HasMany
    {
        return $this->hasMany(Vote::class, 'feedback_id', 'id')->where('vote_action', 'down');
    }
}
