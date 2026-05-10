<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('status_pelamar');
            $table->string('nik')->nullable()->after('username');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('nik');
            $table->string('no_str')->nullable()->after('jenis_kelamin');
            $table->enum('jenis_pelamar', ['nakes', 'non_nakes'])->after('no_str');
        });
    }

    public function down(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropColumn('catatan');
            $table->dropColumn('nik');
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('no_str');
            $table->dropColumn('jenis_pelamar');
        });
    }
};
