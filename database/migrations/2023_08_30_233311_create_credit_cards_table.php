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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('bank', 50);
            $table->integer('credit_limit');
            $table->float('credit_available');
            $table->float('credit_used');
            $table->float('minimum_payment');
            $table->float('full_payment');
            $table->float('annual_payment');
            $table->date('next_annual_payment_date');
            $table->integer('cutoff_date');
            $table->integer('payment_date');
            $table->date('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};

$creditCard = App\Models\CreditCard::create([
    "name" => 'test',
    "bank" => 'test',
    "credit_limit" => 5000,
    "credit_available" => 5000,
    "credit_used" => 0,
    "minimum_payment" => 0,
    "full_payment" => 0,
    "annual_payment" => 0,
    "next_annual_payment_date" => "2022-01-01",
    "cutoff_date" => 1,
    "payment_date" => 1,
    "expires_at" => "2022-01-01"
]);