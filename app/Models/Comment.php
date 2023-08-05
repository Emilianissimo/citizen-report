<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add($fields, $postId)
    {
        $comment = new self;

        $comment->fill($fields);
        $comment->post_id = $postId;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return $comment;
    }

    public function remove()
    {
        $this->delete();
    }
}
