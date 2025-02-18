<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('neasted_comments', function (Blueprint $table) {
            $table->id();
           // $table->id();
            $table->unsignedBigInteger('user_id'); // Comment Author
            $table->unsignedBigInteger('post_id'); // Related Post
            $table->unsignedBigInteger('parent_id')->nullable(); // Parent Comment for nesting
            $table->text('body'); // Comment Text
           // $table->timestamps();
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neasted_comments');
    }
};
