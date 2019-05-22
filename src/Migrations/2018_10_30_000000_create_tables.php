<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wink_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('wink_posts_tags', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('tag_id');

            $table->unique(['post_id', 'tag_id']);
        });

        Schema::create('wink_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->boolean('published')->default(false);
            $table->dateTime('publish_date')->default('2018-10-10 00:00:00');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption');
            $table->uuid('author_id')->index();
            $table->timestamps();
        });

        Schema::create('wink_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->morphs('commentable');
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->unsignedInteger('author_id')->nullable();
            $table->timestamps();
        });

        Schema::create('wink_roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('wink_authors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('bio');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('wink_authors_roles', function (Blueprint $table) {
            $table->uuid('author_id');
            $table->uuid('role_id');

            $table->unique(['author_id', 'role_id']);
        });

        Schema::create('wink_pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body');
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
        Schema::dropIfExists('wink_tags');
        Schema::dropIfExists('wink_posts_tags');
        Schema::dropIfExists('wink_authors');
        Schema::dropIfExists('wink_posts');
        Schema::dropIfExists('wink_pages');
        Schema::dropIfExists('wink_roles');
        Schema::dropIfExists('wink_authors_roles');
        Schema::dropIfExists('wink_comments');
    }
}
