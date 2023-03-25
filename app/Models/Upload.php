<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        "title",
        "name",
        "path",
        "user_id"
    ];

    protected $table="uploads";

    public function getCreatedAtAttribute() {
        return Date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return Date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }
}
