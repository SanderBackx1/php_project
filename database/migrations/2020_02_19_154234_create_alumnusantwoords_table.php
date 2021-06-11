<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnusantwoordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnusantwoords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('alumnusaanwezigheid_id');
            $table->unsignedBigInteger('antwoord_id');
            $table->timestamps();

            $table->foreign('alumnusaanwezigheid_id')->references('id')->on('alumnusaanwezigheids')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('antwoord_id')->references('id')->on('antwoords')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('alumnusantwoords')->insert(
            [
                [
                    'alumnusaanwezigheid_id' => '1',
                    'antwoord_id' => '2',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '2',
                    'antwoord_id' => '4',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '3',
                    'antwoord_id' => '5',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '4',
                    'antwoord_id' => '8',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '4',
                    'antwoord_id' => '9',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '5',
                    'antwoord_id' => '10',

                    'created_at' => now(),

                ],
                [
                    'alumnusaanwezigheid_id' => '5',
                    'antwoord_id' => '11',

                    'created_at' => now(),

                ]

            ]
        );
        for ($i = 6; $i <= 15; $i++) {
            $random = rand(12,14);
            DB::table('alumnusantwoords')->insert(
                [
                    'alumnusaanwezigheid_id' => "$i",
                    'antwoord_id' => "$random",

                    'created_at' => now(),

                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnusantwoords');
    }
}
