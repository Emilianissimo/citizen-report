<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Consumption;
use App\Models\Income;

class Organization extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'main_card_number',
        'info',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function regions()
    {
        return $this->belongsToMany(
            Region::class,
            'regions__organizations',
            'organization_id',
            'region_id'
        );
    }

    public function consumptions()
    {
        return $this->hasMany(Consumption::class, 'organization_id');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class, 'organization_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'organization_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'organization_id');
    }

    public function setRegions($ids)
    {
        if (is_null($ids)){
            return;
        }

        $this->regions()->sync($ids);
    }

    public function getRegionIds(): array
    {
        return $this->regions()->get()->pluck('id')->toArray();
    }

    public static function add(array $fields): self
    {
        $user = new self;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit(array $fields): void
    {
        $this->fill($fields);

        $this->save();
    }

    public function remove(): void
    {
        $this->removeFile();
        $this->delete();
    }

    public function uploadFile($file)
    {
        if (is_null($file)){
            return;
        } 

        $this->removeFile();
        $filename = Str::random(10).'.'.$file->extension();
        $file->storeAs('uploads/organizations/' . $this->id, $filename);
        $this->picture = $filename;
        $this->save();
    }

    public function removeFile()
    {
        if ($this->picture !=null) {
			Storage::delete('uploads/organizations/'. $this->id . '/' . $this->picture);
		}
    }

    public function getFile()
    {
        if ($this->picture == null) {
			return '/img/no-image.png';
		}
		return '/uploads/organizations/' . $this->id . '/' . $this->picture;
    }

    public function setAdmin(int $userId, bool $isAdmin = false): void 
    {
        $user = $this->users()->find($userId);
        $user->pivot->is_org_admin = $isAdmin;
        $user->pivor->save();
    }
}
