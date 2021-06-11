<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnusaanwezigheidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnusaanwezigheids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('mail');
            $table->string('token');
            $table->timestamps();
        });
        DB::table('alumnusaanwezigheids')->insert(
            [
                [
                    'voornaam' => 'brecht',
                    'achternaam' => 'noyens',
                    'mail' => 'brecht.noyens@example.com',
                    'token' => "abcbrecht",

                    'created_at' => now(),

               ],
                [
                    'voornaam' => 'jens',
                    'achternaam' => 'hermans',
                    'mail' => 'jens.hermans@example.com',
                    'token' => "abcjens",
                    'created_at' => now(),

                ],
                [
                    'voornaam' => 'brent',
                    'achternaam' => 'vandenheuvel',
                    'mail' => 'brentvandenheuvel@example.com',
                    'token' => "abcbrent",
                    'created_at' => now(),

                ],
                [
                    'voornaam' => 'sander',
                    'achternaam' => 'backx',
                    'mail' => 'sander.backx@example.com',
                    'token' => "abcsander",
                    'created_at' => now(),

                ],
                [
                    'voornaam' => 'Jozef',
                    'achternaam' => 'aerts',
                    'mail' => 'Jozef.aerts@example.com',
                    'token' => "abcjozef",
                    'created_at' => now(),

                ],

            ]
        );
        for ($i = 1; $i <= 10; $i++) {
            DB::table('alumnusaanwezigheids')->insert(
                [
                    'voornaam' => 'Dummy',
                    'achternaam' => "alumni$i",
                    'mail' => "dummyalumni$i@example.com",
                    'token' => "abcdummy$i",
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
        Schema::dropIfExists('alumnusaanwezigheids');
    }
}
