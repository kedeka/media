<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->string('ulid', 26)->nullable()->index();
            $table->string('path')->nullable();
            $table->string('name')->nullable();
            $table->string('disk', 20)->nullable();
            $table->string('mime', 50)->nullable();
            $table->unsignedInteger('size')->nullable();
            $table->string('url')->index()->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('media_attachments', function (Blueprint $table) {
            $table->string('id', 26)->primary();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->string('attachable_type')->nullable();
            $table->unsignedBigInteger('attachable_id')->nullable();
            $table->integer('order_column')->default(0);
            $table->string('tag', 50)->nullable();

            $table->index(['file_id', 'attachable_type', 'attachable_id']);
            $table->index(['tag', 'attachable_type', 'attachable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_files');
        Schema::dropIfExists('media_attachments');
    }
};
