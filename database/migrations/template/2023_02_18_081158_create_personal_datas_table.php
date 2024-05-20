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
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('personal_datas', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->string('registration_number');
        $table->string('id_number');
        $table->string('educator_number')->nullable();
        $table->string('birth_place');
        $table->date('birth_date');
        $table->string('gender');
        $table->integer('reference_marital_status_id');
        $table->foreign('reference_marital_status_id')->references('id')->on('reference_marital_status');
        $table->integer('reference_religion_id');
        $table->foreign('reference_religion_id')->references('id')->on('reference_religions');
        $table->integer('reference_rank_id')->nullable();
        $table->foreign('reference_rank_id')->references('id')->on('reference_ranks');
        $table->integer('reference_work_unit_id');
        $table->foreign('reference_work_unit_id')->references('id')->on('reference_work_units');
        $table->integer('reference_position_id');
        $table->foreign('reference_position_id')->references('id')->on('reference_positions');
        $table->integer('reference_status_id');
        $table->foreign('reference_status_id')->references('id')->on('reference_status');
        $table->integer('reference_education_id');
        $table->foreign('reference_education_id')->references('id')->on('reference_educations');
        $table->date('cs_year')->nullable();
        $table->date('cs_candidate_year')->nullable();
        $table->string('tax_number')->nullable();
        $table->string('teacher_type')->nullable();
        $table->string('address');
        $table->string('province');
        $table->string('city');
        $table->string('district');
        $table->string('village');
        $table->string('zip_code');
        $table->string('created_by')->nullable();
        $table->string('modified_by')->nullable();
        $table->softDeletes();
        $table->timestamps();
      });
      DB::statement('ALTER TABLE personal_datas ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_datas');
    }
};
