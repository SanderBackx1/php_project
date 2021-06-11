<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evenement_id');
            $table->string('naam');
            $table->string('beschrijving')->nullable();
            $table->unsignedInteger('aantal')->nullable();
            $table->timestamps();

            $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('taaks')->insert(
            [
                [
                    'evenement_id' => '1',
                    'naam' => 'tafels klaarzetten',
                    'beschrijving' => 'Hoge tafels klaarzetten aan het podium.',
                    'aantal' => '2',
                    'created_at' => now()

                ],

                [
                    'evenement_id' => '1',
                    'naam' => 'water uitdelen',
                    'beschrijving' => '',
                    'aantal' => '1',
                    'created_at' => now()

                ],
                [
                    'evenement_id' => '2',
                    'naam' => 'affiches uitdelen',
                    'beschrijving' => '',
                    'aantal' => '1',
                    'created_at' => now()

                ],
                [
                    'evenement_id' => '3',
                    'naam' => 'borrelhapjes bestellen',
                    'beschrijving' => 'kaas, salami en olijven bestellen bij de keuken',
                    'aantal' => null,
                    'created_at' => now()

                ],
                [
                    'evenement_id' => '4',
                    'naam' => 'naamkaartjes printen',
                    'beschrijving' => '',
                    'aantal' => '1',
                    'created_at' => now()

                ],
                [
                    'evenement_id' => '3',
                    'naam' => 'Bespreking houden',
                    'beschrijving' => 'Korte intro houden',
                    'aantal' => '2',
                    'created_at' => now()
                ]

            ]
        );
        for ($i = 1; $i <= 10; $i++) {
            $random = rand(0,5);
            DB::table('taaks')->insert(
                [
                    'evenement_id' => '6',
                    'naam' => "Dummy taak $i",
                    'beschrijving' => "Dummy beschrijving $i",
                    'aantal' => "$random",
                    'created_at' => now()

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
        Schema::dropIfExists('taaks');
    }
}
