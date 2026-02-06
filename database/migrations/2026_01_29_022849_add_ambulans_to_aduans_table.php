<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->string('ambulans_id')->nullable()->after('darurat');
            $table->string('no_ambulans')->nullable()->after('ambulans_id');
        });
    }

    public function down(): void
    {
        Schema::table('aduans', function (Blueprint $table) {
            $table->dropColumn(['ambulans_id', 'no_ambulans']);
        });
    }
};
