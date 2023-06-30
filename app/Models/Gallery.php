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

    private $videoMimes = [
        'video/mp4'
    ];

    private $pictureMimes = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];

    public function socialRequests()
    {
        return $this->belongsTo(SocialRequest::class, 'request_id');
    }

    public static function addRequest($file, $requestId)
    {   
        $gallery = new self;

        $gallery->request_id = $requestId;
        $gallery->mime = $file->getClientMimeType();
        $gallery->save();
        $gallery->uploadFile($file);

        return $gallery;
    }
    
    public static function addPost($file, $postId)
    {
        $gallery = new self;
        $gallery->post_id = $postId;
        $gallery->mime = $file->getClientMimeType();
        $gallery->save();
        $gallery->uploadFile($file);

        return $gallery;
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
        $file->storeAs('uploads/files/' . $this->id, $filename);
        $this->file = $filename;
        $this->save();
    }

    public function removeFile()
    {
        if ($this->file !=null) {
			Storage::delete('uploads/files/'. $this->id . '/' . $this->file);
		}
    }

    public function getFile()
    {
        if ($this->file == null) {
			return '/img/no-image.png';
		}
		return '/uploads/files/' . $this->id . '/' . $this->file;
    }

    public function getHtmlBlock()
    {
        if (in_array($this->mime, $this->videoMimes)){
            $result = "<video class='w-100' src='{$this->getFile()}'></video>";
        }elseif (in_array($this->mime, $this->pictureMimes)){
            $result = "<img class='w-100' src='{$this->getFile()}'>";
        }else{
            $result = '<p>File is not file nor video!</p>';
        }
        return $result;
    }
}
