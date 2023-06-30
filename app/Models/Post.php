<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected $fillable = [
        'title',
        'text',
    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMAny(
            Comment::class,
            'post_id',
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public static function add($fields)
    {
        $post = new self;

        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->organization_id = Auth::user()->organization_id;
        $post->save();

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->delete();
    }

    public function firstPic()
    {
        $firstPic = $this->gallery()->whereIn('mime',['image/jpg', 'image/png', 'image/jpeg'])->first();      
        if(!is_null($firstPic)){
            return $firstPic->getFile();
        }                 
        return "/images/no-image.png";
    }
}
