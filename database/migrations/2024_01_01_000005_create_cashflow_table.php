<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashflow', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['entrada', 'saida']);
            $table->decimal('amount', 10, 2);
            $table->string('description');
            $table->date('transaction_date');
            $table->enum('category', ['servico', 'produto', 'despesa', 'outro'])->default('outro');
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashflow');
    }
};



