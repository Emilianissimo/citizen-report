<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\SocialRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    public function socialRequests()
    {
        return $this->belongsTo(SocialRequest::class, 'request_id');
    }
    
    public static function add(int $requestId)
    {
        $gallery = new self;

        $gallery->request_id = $requestId;
        $gallery->save();

        return $$gallery;
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
        $file->storeAs('uploads/files/' . $this->request_id, $filename);
        $this->file = $filename;
        $this->save();
    }

    public function removeFile()
    {
        if ($this->file !=null) {
			Storage::delete('uploads/files/'. $this->request_id . '/' . $this->file);
		}
    }

    public function getFile()
    {
        if ($this->file == null) {
			return '/img/no-image.png';
		}
		return '/uploads/files/' . $this->request_id . '/' . $this->file;
    }
}
