<?php

use App\Models\Debtor;
use App\Models\Manager;
use App\Models\Organizer;
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
        Schema::table('bargains', function (Blueprint $table) {

            $table->foreignIdFor(Organizer::class)->constrained();
            $table->foreignIdFor(Debtor::class)->constrained();
            $table->foreignIdFor(Manager::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
