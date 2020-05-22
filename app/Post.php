<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Storage;
use App\Category;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id',
    ];
/**
 * Delete post image from storage
 * HHE
 * @return void
 */
    public function deleteImage() {
       Storage::delete($this->image);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tag() {
        return $this->belongsToMany(Tag::class);
    }

    /**
     *
     * @return bool
     */

    public function hasTag($tagId) {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
