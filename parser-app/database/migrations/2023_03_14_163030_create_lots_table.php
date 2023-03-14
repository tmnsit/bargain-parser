<?php

use App\Models\Bargain;
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
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('hashName');
            $table->text('familiarization')->nullable();
            $table->text('classification')->nullable();
            $table->string('startPrice')->nullable();
            $table->text('deposit')->nullable();
            $table->text('increaseAmount')->nullable();
            $table->string('status')->nullable();
            $table->json('files');

            $table->foreignIdFor(Bargain::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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
        Schema::dropIfExists('lots');
    }
};
