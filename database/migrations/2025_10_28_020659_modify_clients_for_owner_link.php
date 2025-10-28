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
        Schema::table('clients', function (Blueprint $table) {
            if (Schema::hasColumn('clients', 'contact_person')) {
                $table->dropColumn('contact_person');
            }
            $table->foreignId('contact_user_id')
                ->nullable()
                ->after('name')
                ->constrained('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['contact_user_id']); 
            $table->dropColumn('contact_user_id'); 
            $table->string('contact_person')->nullable()->after('name');
        });
    }
};
