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
        Schema::create('resource', function (Blueprint $table) {
            $table->id()->autoIncrement()->unique()->comment('Уникальный идентификатор');
            $table->string('name')->comment('Наименование');
            $table->integer('denomination')->comment('Номинал/количество');
            $table->string('resource_type')->comment('Тип ресурса');
            $table->jsonb('additional_data')->comment('Дополнительные параметры для ресурса');
            $table->string('resource_storage_name')->comment('Наименование хранения ресурса');
            $table->string('resource_storage_address')->comment('Адрес хранения ресурса');
            $table->date('created_at')->comment('Дата создания');
            $table->date('updated_at')->comment('Дата изменения');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource');
    }
};
