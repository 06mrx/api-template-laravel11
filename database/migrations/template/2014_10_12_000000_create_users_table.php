<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('reference_work_unit_id');
            $table->foreign('reference_work_unit_id')->references('id')->on('reference_work_units');
            $table->uuid('personal_data_id');
            $table->foreign('personal_data_id')->references('id')->on('personal_datas');
            $table->string('registration_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->uuid('role_id');
            $table->string('created_by')->nullable();
            $table->string('modified_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
