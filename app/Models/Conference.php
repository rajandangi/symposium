<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    /** @use HasFactory<\Database\Factories\ConferenceFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // Add date casting in the Conference model
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'cfp_starts_at' => 'datetime',
        'cfp_ends_at' => 'datetime',
    ];

    /**
     * Get the user that favourited the conference.
     */
    public function usersFavourited(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourites');
    }
}
