<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVraagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vraags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('typevraag_id');
            $table->unsignedBigInteger('evenement_id');
            $table->string('inhoud');
            $table->boolean('verplicht');
            $table->timestamps();

            $table->foreign('typevraag_id')->references('id')->on('typevraags')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('vraags')->insert(
            [
                [
                    'typevraag_id' => '2',
                    'evenement_id' => '1',
                    'inhoud' => 'Voorkeur eten?',
                    'verplicht' => true,

                    'created_at' => now()

                ],
                [
                    'typevraag_id' => '1',
                    'evenement_id' => '2',
                    'inhoud' => 'Waar werk je nu?',
                    'verplicht' => true,
                    'created_at' => now()

                ],
                [
                    'typevraag_id' => '2',
                    'evenement_id' => '3',
                    'inhoud' => 'Hoe kom je naar hier?',
                    'verplicht' => true,
                    'created_at' => now()

                ],
                [
                    'typevraag_id' => '1',
                    'evenement_id' => '4',
                    'inhoud' => 'Bijkomende informatie?',
                    'verplicht' => true,
                    'created_at' => now()

                ],
                [
                    'typevraag_id' => '1',
                    'evenement_id' => '4',
                    'inhoud' => 'Heb je na je diploma nog verder gestudeerd?',
                    'verplicht' => true,
                    'created_at' => now()

                ],
                [
                    'typevraag_id' => '2',
                    'evenement_id' => '6',
                    'inhoud' => 'Voorkeur broodje?',
                    'verplicht' => true,

                    'created_at' => now()

                ]

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vraags');
    }
}
