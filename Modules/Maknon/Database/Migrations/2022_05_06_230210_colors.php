<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Colors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('mk_colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mk_color_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('color_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['color_id', 'locale'],
                'color_translations_unique'
            );
            $table->foreign('color_id')
            ->references('id')->on('mk_colors')
            ->onDelete('cascade');
        });


             Schema::create('mk_currencies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code')->nullable();
            $table->string('symbol')->nullable();

            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mk_currency_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['color_id', 'locale'],
                'color_translations_unique'
            );
            $table->foreign('currency_id')
            ->references('id')->on('mk_currencies')
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
