<?php
namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $file = $request->file('files');
        $data['title'] = $request->title;
        $data['name'] = $file->getClientOriginalName();
        $data['path'] = $file->store(session('email'));
        $data['user_id'] = session('id_user');
        $file = File::create($data);
        if($file){
            return redirect()->back()->with('success',"Documento salvo com sucesso.");
        }
        return redirect()->back()->with('error','Falha ao registrar documento.');
    }

    public function download($id){
        return File::download($id);
    }

    //Método que vai atualizar status de PENDENTE para ACEITO ou REJEITADO
    public function updateStatus(int $id, Request $request){
        $file = File::where('id',$id)
        ->update(['status'=>$request->status,'analist_name'=>$request->analist_name]);
        if($file){
            return redirect()->back()->with('success','Atualizado com sucesso.');
        }
        return redirect()->back()->with('error','Falha ao atualizar registro.');
    }

    public function delete($id){
        $file = File::find($id);
        if($file){
            Storage::delete($file->path);
            $file->delete($id);
            return redirect()->back()->with('success','Registro excluido com sucesso.');
        }
        return redirect()->back()->with('error', 'Falha ao remover registro.');
    }
}
