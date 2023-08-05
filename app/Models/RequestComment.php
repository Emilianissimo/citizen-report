<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RequestComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
    ];

    public function socialRequest()
    {
        return $this->belongsTo(SocialRequest::class, 'request_id');
    }

    public function setSocialRequest(int $id)
    {
        if (is_null($id)){
            return;
        }
        $this->request_id = $id;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function add($fields, $requestId)
    {
        $comment = new self;

        $comment->fill($fields);
        $comment->request_id = $requestId;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return $comment;
    }

    public function remove()
    {
        $this->delete();
    }
}
