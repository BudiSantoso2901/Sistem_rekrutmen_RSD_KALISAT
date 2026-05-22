<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'pelamars',
            function (Blueprint $table) {

                $table->string('tempat_lahir')->nullable()->after('kota_domisili');
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
                $table->integer('usia')->nullable()->after('tanggal_lahir');
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'pelamars',
            function (Blueprint $table) {

                $table->dropColumn([
                    'tempat_lahir',
                    'tanggal_lahir',
                    'usia',
                ]);
            }
        );
    }
};
