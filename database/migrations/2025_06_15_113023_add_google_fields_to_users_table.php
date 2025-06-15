<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('email');
            $table->string('provider')->nullable()->after('google_id');
            $table->timestamp('email_verified_at')->nullable()->change();
            
            // Index untuk pencarian yang lebih cepat
            $table->index('google_id');
            $table->index('provider');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['google_id']);
            $table->dropIndex(['provider']);
            $table->dropColumn(['google_id', 'provider']);
        });
    }
};
