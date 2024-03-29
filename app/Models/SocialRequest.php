<?php

namespace App\Models;

use App\Models\User;
use App\Models\Region;
use App\Models\Category;
use App\Models\RequestStatus;
use App\Models\RequestComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialRequest extends Model
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
        'coordinates',
        'urgency',
        'address',
    ];

    public function comments()
    {
        return $this->hasMany(RequestComment::class, 'request_id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'request_id');
    }

    public function status()
    {
        return $this->belongsTo(RequestStatus::class, 'status_id');
    }

    public function getUrgency(): string
    {
        $urgencyList = [
            0 => '<button class="btn btn-info"><i style="color:rgb(145, 34, 34);" class="fa fa-exclamation-triangle" aria-hidden="true"></i>'.__("Низкий").'</button>',
            1 => '<button class="btn btn-secondary"><i style="color:rgb(145, 34, 34);" class="fa fa-exclamation-triangle" aria-hidden="true"></i>'.__("Средний").'</button>',
            2 => '<button class="btn btn-warning"><i style="color:rgb(145, 34, 34);" class="fa fa-exclamation-triangle" aria-hidden="true"></i>'.__("Высокий").'</button>',
            3 => '<button class="btn btn-danger"><i style="color:rgb(145, 34, 34);" class="fa fa-exclamation-triangle" aria-hidden="true"></i>'.__("Очень высокий").'</button>',
        ];
        return $urgencyList[$this->urgency];
    }

    public function setStatus(int $id)
    {
        if (is_null($id)){
            return;
        }
        $this->status_id = $id;
        $this->save();
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function setManager($id)
    {   
        $this->manager_id = $id;
        $this->save();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function setRegion(int $id)
    {
        if (is_null($id)){
            return;
        }
        $this->region_id = $id;
        $this->save();
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'requests__categories',
            'request_id',
            'category_id'
        );
    }

    public function setCategories($ids)
    {
        if (is_null($ids)){
            return;
        }

        $this->categories()->sync($ids);
    }

    public static function add($fields)
    {
        $socialRequest = new self;

        $socialRequest->fill($fields);
        $socialRequest->author_id = Auth::user()->id;
        $socialRequest->save();

        return $socialRequest;
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
