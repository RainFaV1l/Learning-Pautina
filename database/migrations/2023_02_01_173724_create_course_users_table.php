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
        Schema::create('course_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('groups', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_users_status_id')->default(2)->constrained('course_users_statuses', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            //            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_users');
    }
};
