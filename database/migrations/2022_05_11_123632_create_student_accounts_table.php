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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            
            $table->unsignedBigInteger('fee_invoice_id')->nullable();
            $table->foreign('fee_invoice_id')->references('id')->on('fee_invoices')->onDelete('cascade');
        
            $table->unsignedBigInteger('receipt_id')->nullable();
            $table->foreign('receipt_id')->references('id')->on('student_receipts')->onDelete('cascade');
        
            $table->unsignedBigInteger('processing_id')->nullable();
            $table->foreign('processing_id')->references('id')->on('fee_processings')->onDelete('cascade');
        
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('student_payments')->onDelete('cascade');
        
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        
            $table->decimal('debt',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
};
