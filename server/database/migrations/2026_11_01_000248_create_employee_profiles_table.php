<?php

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
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
        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Department::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Position::class)->nullable()->constrained()->nullOnDelete();
            $table->string('employee_id')->unique();
            $table->string('status')->default('active');
            $table->date('date_hired')->nullable();
            $table->date('date_terminated')->nullable();
            $table->date('date_resigned')->nullable();
            $table->date('date_regularized')->nullable();
            $table->string('employment_type')->default('full-time');
            $table->string('employment_status')->default('probationary');
            $table->string('previous_salary')->nullable();
            $table->string('current_salary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};
