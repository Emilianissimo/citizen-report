<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Consumption extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'text',
    ];

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
        $consumption = new self;

        $consumption->fill($fields);
        $consumption->user_id = Auth::user()->id;
        $consumption->organization_id = Auth::user()->organization_id;
        $consumption->save();

        return $consumption;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
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
        $file->storeAs('uploads/consumptions/' . $this->id, $filename);
        $this->picture = $filename;
        $this->save();
    }

    public function removeFile()
    {
        if ($this->picture !=null) {
			Storage::delete('uploads/consumptions/'. $this->id . '/' . $this->picture);
		}
    }

    public function getFile()
    {
        if ($this->picture == null) {
			return '/img/no-image.png';
		}
		return '/uploads/consumptions/' . $this->id . '/' . $this->picture;
    }
}
