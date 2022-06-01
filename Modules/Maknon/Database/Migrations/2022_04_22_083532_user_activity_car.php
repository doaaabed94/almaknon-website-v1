<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserActivityCar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mk_fav_car', function (Blueprint $table) {
            $table->increments('id');
         $table->integer('car_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned()->nullable();
            $table->string('member_ip')->nullable();
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

         Schema::create('mk_evaluation_car', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned()->nullable();
            $table->string('member_ip')->nullable();
            $table->string('text')->nullable();
            $table->string('name')->nullable();
            $table->string('status', 20)->default('ACTIVE');
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

         Schema::create('mk_member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->string('phone_number', 50)->unique()->nullable();
            $table->string('password')->nullable();
            $table->char('locale', 4)->default('ar');
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('status', 20)->default('ACTIVE');
            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('deletion_reason', 255)->nullable();
            $table->char('is_verified', 1)->default('Y');
            $table->char('is_new_account', 1)->default('N');
            $table->char('needs_approval', 1)->default('N');

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('disabled_at')->nullable();

            $table->string('avatar', 500)->nullable();
            $table->string('bio', 500)->nullable();
            
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
        Schema::dropIfExists('mk_evaluation_car');
        Schema::dropIfExists('mk_fav_car');
        Schema::dropIfExists('mk_member');

    }
}
