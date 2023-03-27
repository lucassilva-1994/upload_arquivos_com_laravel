<?php
namespace App\Http\Controllers;
use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    //Listar todos os documentos
    public function all(){
        $files = File::where('user_id','!=',session('id_user'))
        ->orderByDesc('status')
        ->orderByDesc('id')
        ->get();
        return view('file.all', compact('files'));
    }

    //Listar somente documentos do usuário logado.
    public function list(){
        $files = File::where('user_id','=',session('id_user'))
        ->orderByDesc('id')
        ->get();
        return view('file.list', compact('files'));
    }

    //Carregar a view para cadastrar um novo documento.
    public function new(){
        return view('file.new');
    }

    //Registrar novo documento.
    public function create(FileRequest $request){
        return File::fileCreate($request->except(['_token']), session('id_user'),session('email'));
    }

    public function download($id){
        return File::fileDownload($id);
    }

    //Método que vai atualizar status de PENDENTE para ACEITO ou REJEITADO
    public function updateStatus(int $id, Request $request){
        return File::fileUpdateStatus($id,$request->except(['_token','_method']));
    }

    public function delete($id){
        return File::fileDelete($id);
    }
}
