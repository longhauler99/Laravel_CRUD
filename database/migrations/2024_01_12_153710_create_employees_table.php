<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $primaryKey = 'PayrollNum';
    public bool $incrementing = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';

    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('PayrollNum');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('DoB');
            $table->string('Gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
