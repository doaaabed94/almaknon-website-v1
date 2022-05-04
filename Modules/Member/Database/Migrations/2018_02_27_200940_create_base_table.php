<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('iso_2', 2)->nullable();
            $table->char('iso_3', 3)->nullable();
            $table->string('dial_code', 10)->nullable();
            $table->string('lat', 100)->nullable();
            $table->string('lng', 100)->nullable();
            $table->char('base_locale', 5)->nullable();
            $table->enum('deleteable', ['Y', 'N'])->default('Y');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->unique(
                ['country_id', 'locale'],
                'country_translations_unique'
            );
            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onDelete('cascade');
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('native_name', 191)->nullable();
            $table->string('zip_code', 191)->nullable();
            $table->string('lat', 100)->nullable();
            $table->string('lng', 100)->nullable();
            $table->char('base_locale', 5)->nullable();
            $table->enum('deleteable', ['Y', 'N'])->default('Y');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onDelete('cascade');
        });

        Schema::create('city_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->unique(
                ['city_id', 'locale'],
                'city_translations_unique'
            );
            $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('cascade');
        });

        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->string('native_name', 191)->nullable();
            $table->string('zip_code', 191)->nullable();
            $table->string('lat', 100)->nullable();
            $table->string('lng', 100)->nullable();
            $table->char('base_locale', 5)->nullable();
            $table->enum('deleteable', ['Y', 'N'])->default('Y');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->foreign('city_id')
            ->references('id')->on('cities')
            ->onDelete('cascade');
        });

        Schema::create('state_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->unique(
                ['state_id', 'locale'],
                'state_translations_unique'
            );
            $table->foreign('state_id')
            ->references('id')->on('states')
            ->onDelete('cascade');
        });

        Schema::create('timezones', function (Blueprint $table) {
            $table->increments('id');
            $table->char('country_code', 2)->nullable();
            $table->string('code', 100)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timezones');

        Schema::dropIfExists('city_translations');
        Schema::dropIfExists('cities');

        Schema::dropIfExists('state_translations');
        Schema::dropIfExists('states');

        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}
