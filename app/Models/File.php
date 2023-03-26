<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        "title",
        "name",
        "path",
        "user_id"
    ];

    protected $table="files";

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute(){
        return Date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return Date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }

    public static function download(int $id){
        $file = File::find($id);
        if($file){
           return Storage::download($file->path, $file->name,[]);
        }
    }
}
