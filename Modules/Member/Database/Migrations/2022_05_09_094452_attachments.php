<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 20)->nullable();
            $table->string('filename')->nullable();
            $table->string('uid')->nullable();
            $table->integer('size')->nullable();
            $table->string('mime', 100)->nullable();
            $table->string('input_name', 20)->nullable();
            $table->nullableMorphs('attachable');
            $table->unsignedInteger('uploaded_by')->nullable();
            $table->timestamps();

            $table->foreign('uploaded_by')
            ->references('id')->on('users')
            ->onDelete(\DB::raw('SET NULL'));
        });

        Schema::create('external_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->morphs('attachable');
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_attachments');
        Schema::dropIfExists('attachments');
    }
}
