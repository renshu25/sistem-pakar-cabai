<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('basis_pengetahuan', function (Blueprint $table) {
            $table->string('kode_rule')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('basis_pengetahuan', function (Blueprint $table) {
            $table->string('kode_rule')->nullable(false)->change();
        });
    }
};