<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Income extends Model
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
        $income = new self;

        $income->fill($fields);
        $income->user_id = Auth::user()->id;
        $income->organization_id = Auth::user()->organization_id;
        $income->save();

        return $income;
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
        $file->storeAs('uploads/incomes/' . $this->id, $filename);
        $this->file = $filename;
        $this->mime = $file->getClientMimeType();
        $this->save();
    }

    public function removeFile()
    {
        if ($this->file !=null) {
			Storage::delete('uploads/incomes/'. $this->id . '/' . $this->file);
		}
    }

    public function getFile()
    {
        if ($this->file == null) {
			return '/img/no-image.png';
		}
		return '/uploads/incomes/' . $this->id . '/' . $this->file;
    }
}
