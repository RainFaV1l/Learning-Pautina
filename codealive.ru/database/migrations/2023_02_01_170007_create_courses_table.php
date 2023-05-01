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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', '1000')->nullable();
            $table->unsignedFloat('price')->nullable();
            $table->foreignId('author')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_category_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('course_level_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('course_icon_path')->nullable();
            $table->boolean('isFree')->nullable();
            //            $table->string('course_banner_path')->nullable();
            $table->timestamps();
            //            $table->softDeletes();

            // Указываем на связь таблицы courses с таблицой course_categories
            //            $table->index('course_category_id', 'course_category_idx');
            //            $table->foreign('course_category_id', 'course_category_fk')
            //                ->on('course_categories')
            //                ->references('id')
            //                ->cascadeOnDelete()
            //                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
