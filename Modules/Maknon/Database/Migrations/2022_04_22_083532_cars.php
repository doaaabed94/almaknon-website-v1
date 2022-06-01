<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mk_cars', function (Blueprint $table) {

            $table->increments('id');
            $table->string('image', 191)->nullable();
            $table->date('years')->nullable();

            $table->integer('price')->nullable();
            $table->integer('price_after')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('color_id')->nullable();

            $table->integer('marka_id')->nullable();
            $table->integer('offer_id')->nullable();
            $table->integer('condition_id')->nullable();
            $table->integer('fuel_id')->nullable();
            $table->integer('category_id')->nullable();

            $table->string('transmission')->nullable();
            $table->string('colors')->nullable();
            $table->integer('kilometer')->nullable();

            $table->string('factory_country')->nullable();
            $table->string('import_country')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();

            $table->text('order')->nullable();
            $table->enum('show_in_site', ['yes', 'no'])->nullable();
            $table->text('slug')->nullable();

            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mk_car_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['car_id', 'locale'],
                'car_translations_unique'
            );
            $table->foreign('car_id')
                ->references('id')->on('mk_cars')
                ->onDelete('cascade');
        });

        Schema::create('mk_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mk_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['category_id', 'locale'],
                'category_translations_unique'
            );
            $table->foreign('category_id')
                ->references('id')->on('mk_categories')
                ->onDelete('cascade');
        });

        Schema::create('mk_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('mk_offer_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('offer_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['offer_id', 'locale'],
                'offer_translations_unique'
            );
            $table->foreign('offer_id')
                ->references('id')->on('mk_offers')
                ->onDelete('cascade');
        });

        Schema::create('mk_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('mk_condition_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('condition_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['condition_id', 'locale'],
                'condition_translations_unique'
            );
            $table->foreign('condition_id')
                ->references('id')->on('mk_conditions')
                ->onDelete('cascade');
        });

        Schema::create('mk_fuels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('mk_fuel_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fuel_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['fuel_id', 'locale'],
                'fuel_translations_unique'
            );
            $table->foreign('fuel_id')
                ->references('id')->on('mk_fuels')
                ->onDelete('cascade');
        });

        Schema::create('mk_markas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('mk_marka_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marka_id')->unsigned();
            $table->char('locale', 5);
            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->unique(
                ['marka_id', 'locale'],
                'marka_translations_unique'
            );
            $table->foreign('marka_id')
                ->references('id')->on('mk_markas')
                ->onDelete('cascade');
        });

        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->string('code')->nullable();
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('created_by')->unsigned()->nullable();
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
        Schema::dropIfExists('mk_marka_translations');
        Schema::dropIfExists('mk_markas');

        Schema::dropIfExists('mk_fuel_translations');
        Schema::dropIfExists('mk_fuels');

        Schema::dropIfExists('mk_condition_translations');
        Schema::dropIfExists('mk_conditions');

        Schema::dropIfExists('mk_offer_translations');
        Schema::dropIfExists('mk_offers');

        Schema::dropIfExists('mk_car_translations');
        Schema::dropIfExists('mk_cars');

        Schema::dropIfExists('mk_category_translations');
        Schema::dropIfExists('mk_categories');

    }
}
