<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Имя сотрудника
            $table->foreignId('company_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate(); // ID компании, привязка
            $table->string('email')->unique(); // Эл. почта сотрудника
            $table->string('phone_number'); // Номер телефона сотрудника
            $table->text('image')->nullable(); // Изображение сотрудника
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
        Schema::dropIfExists('workers');
    }
}
