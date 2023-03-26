<?php
namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    //Listar todos os documentos
    public function all(){
        $uploads = Upload::where('user_id','!=',session('id_user'))
        ->orderByDesc('status')
        ->orderByDesc('id')
        ->get();
        return view('upload.all', compact('uploads'));
    }

    //Listar somente documentos do usuário logado.
    public function list(){
        $uploads = Upload::where('user_id','=',session('id_user'))
        ->orderByDesc('id')
        ->get();
        return view('upload.list', compact('uploads'));
    }

    //Carregar a view para cadastrar um novo documento.
    public function new(){
        return view('upload.new');
    }

    //Registrar novo documento.
    public function create(UploadRequest $request){
        $file = $request->file('files');
        $data['title'] = $request->title;
        $data['name'] = $file->getClientOriginalName();
        $data['path'] = $file->store(session('email'));
        $data['user_id'] = session('id_user');
        $upload = Upload::create($data);
        if($upload){
            return redirect()->back()->with('success',"Documento salvo com sucesso.");
        }
        return redirect()->back()->with('error','Falha ao registrar documento.');
    }

    //Método que vai atualizar status de PENDENTE para ACEITO ou REJEITADO
    public function updateStatus(int $id, Request $request){
        $upload = Upload::where('id',$id)->update(['status'=>$request->status]);
        if($upload){
            return redirect()->back()->with('success','Atualizado com sucesso.');
        }
        return redirect()->back()->with('error','Falha ao atualizar registro.');
    }

    public function delete($id){
        $upload = Upload::find($id);
        if($upload){
            Storage::delete($upload->path);
            $upload->delete($id);
            return redirect()->back()->with('success','Registro excluido com sucesso.');
        }
        return redirect()->back()->with('error', 'Falha ao remover registro.');
    }
}
