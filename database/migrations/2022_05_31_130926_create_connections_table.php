<?php

use App\Models\Connection;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_from_id');
            $table->foreign('user_from_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_to_id');
            $table->foreign('user_to_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('status')->default(Connection::STATUS_PENDING);
            $table->unique(['user_from_id', 'user_to_id']);
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
        Schema::dropIfExists('connections');
    }
};
