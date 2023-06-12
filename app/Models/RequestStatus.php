<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SocialRequest;

class RequestStatus extends Model
{
    use HasFactory;
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug_ru' => [
                'source' => 'title_ru',
            ],
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

    public function socialRequests()
    {
        return $this->hasMany(SocialRequest::class, 'status_id');
    }

    public static function add($fields)
    {
        $status = new self;

        $status->fill($fields);
        $status->save();

        return $status;
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
