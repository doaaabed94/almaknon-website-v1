<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentPagesCrud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();

            $table->string('image', 191)->nullable();
            $table->string('status', 20)->default('ACTIVE');

            $table->text('slug')->nullable();
            $table->text('views')->nullable();
            $table->text('order')->nullable();
            $table->enum('show_in_site' ,['yes','no'])->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();

            $table->string('link')->nullable();
            $table->string('page_name')->nullable();


            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cms_content_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->unsigned();
            $table->char('locale', 5);

            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();

            $table->unique(
                ['content_id', 'locale'],
                'blog_translations_unique'
            );
            $table->foreign('content_id')
            ->references('id')->on('cms_contents')
            ->onDelete('cascade');
        });


           Schema::create('cms_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('code')->nullable();
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cms_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->char('locale', 5);

            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();

            $table->unique(
                ['category_id', 'locale'],
                'blog_translations_unique'
            );
            $table->foreign('category_id')
            ->references('id')->on('cms_categories')
            ->onDelete('cascade');
        });


           Schema::create('cms_sub_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned();
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('category_id')
            ->references('id')->on('cms_categories')
            ->onDelete('cascade');
        });

        Schema::create('cms_sub_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_category_id')->unsigned();
            $table->char('locale', 5);

            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();

            $table->unique(
                ['sub_category_id', 'locale'],
                'blog_translations_unique'
            );
            $table->foreign('sub_category_id')
            ->references('id')->on('cms_sub_categories')
            ->onDelete('cascade');
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
