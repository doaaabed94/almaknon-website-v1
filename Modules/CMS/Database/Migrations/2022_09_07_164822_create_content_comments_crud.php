<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentCommentsCrud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('cms_contents_comment', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('content_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned()->nullable();
            $table->integer('comment_id')->unsigned()->nullable();

            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('visitor_name')->nullable();
            $table->string('member_ip')->nullable();

            $table->string('status', 20)->default('ACTIVE');

            $table->text('order')->nullable();
            $table->enum('show_in_site' ,['yes','no'])->nullable();

            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
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
        //
    }
}
