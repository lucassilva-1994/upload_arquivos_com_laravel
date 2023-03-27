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

    protected $table = "files";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute()
    {
        return Date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return Date('d/m/Y H:i:s', strtotime($this->attributes['updated_at']));
    }

    public static function fileCreate(array $data, int $user_id, string $localStorage ){
        $file = $data['files'];
        $data['title'] = $data['title'];
        $data['name'] = $file->getClientOriginalName();
        $data['path'] = $file->store($localStorage);
        $data['user_id'] = $user_id;
        $file = File::create($data);
        if($file){
            return redirect()->back()->with('success','Documento salvo com sucesso.');
        }
        return redirect()->back()->with('error','Falha ao registrar documento.');
    }

    public static function fileDownload(int $id)
    {
        $file = File::find($id);
        if ($file) {
            return Storage::download($file->path, $file->name, []);
        }
    }

    public static function fileDelete(int $id)
    {
        $file = File::find($id);
        if ($file) {
            Storage::delete($file->path);
            $file->delete($id);
            return redirect()->back()->with('success', 'Registro excluido com sucesso.');
        }
        return redirect()->back()->with('error', 'Falha ao remover registro.');
    }

    public static function fileUpdateStatus(int $id, array $data){
        $file = File::where('id',$id)
        ->update([ 'status'=>$data['status'],'analist_name'=>$data['analist_name'] ]);
        if($file){
            return redirect()->back()->with('success','Atualizado com sucesso.');
        }
        return redirect()->back()->with('error','Falha ao atualizar registro.');
    }
}
