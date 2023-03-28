<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public string $_table = "files";
    public function up(): void
    {
        Schema::create($this->_table, function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('title',30)->nullable();
            $table->string('name',100);
            $table->string('path',100);
            $table->string('analist_name',100)->nullable();
            $table->enum('status',['APROVADO','REJEITADO','PENDENTE'])->default('PENDENTE');
            $table->integer('qtd_download')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists($this->_table);
    }
};
