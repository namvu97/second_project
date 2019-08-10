<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('email', 50);
            $table->string('full_name');
            $table->string('photo', 100)->nullable();
            $table->string('token')->nullable();
            $table->boolean('verified')->default(false);
            $table->timestamp('change_password_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
