<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->unique();
            $table->string('slug',200)->unique();
            $table->string('image');
            $table->string('caption', 100);
            $table->longText('content',2000);
            $table->text('description',200);
            $table->text('keywords');
            $table->integer('total_views')->default(0); 
            $table->string('published_by')->nullable();
            $table->date('published_at')->nullable()->index();
            $table->boolean('is_published')->default(false);
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
}
