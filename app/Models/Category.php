<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SocialRequest;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug_ru' => [
                'source' => 'title_ru',
            ],
            'slug_uz' => [
                'source' => 'title_uz',
            ]
        ];
    }

    protected $fillable = [
        'title_ru',
        'title_uz',
    ];

    public function getTitle(string $lang): string
    {
        if (in_array($lang, config('app.available_locales'))){
            $title = 'title_'.$lang;
        }else{
            $title = 'title_ru';
        }
        return $this->$title;
    }

    public function getSlug(string $lang): string
    {
        if (in_array($lang, config('app.available_locales'))) {
            $slug = 'slug_'.app()->getLocale();
        }else{
            $slug = 'slug_ru';
        }
        return $this->$slug;
    }

    public function socialRequests()
    {
        return $this->belongsToMany(
            SocialRequest::class,
            'requests__categories',
            'category_id',
            'request_id'
        );
    }

    public static function add($fields)
    {
        $category = new self;

        $category->fill($fields);
        $category->save();

        return $category;
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
}
