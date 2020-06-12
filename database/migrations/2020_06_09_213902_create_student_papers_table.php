<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\ForeignIdColumnDefinition;
use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\ForeignKeyDefinition;

class CreateStudentPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->unique();
            $table->foreignId('paper_id')->constrained()->unique();
            $table->foreignId('status_id')->constrained();
            $table->integer('score')->default(0);
            $table->decimal('percentage', 5 , 2)->default(0.00);
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
        Schema::dropIfExists('student_papers');
    }
}
