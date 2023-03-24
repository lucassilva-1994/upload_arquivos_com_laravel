<?php
namespace App\Http\Controllers;

class UploadsController extends Controller
{
    public function list(){
        return view('upload.list');
    }

    public function new(){
        return view('upload.new');
    }

    public function create(){

    }

    public function delete($id){

    }
}
