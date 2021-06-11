<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('opleiding_id');
            $table->string('evenementnaam');
            $table->string('beschrijving')->nullable();
            $table->date('datum');
            $table->string('tijdstip');
            $table->boolean('formulier')->default(false);

            $table->timestamps();

            $table->foreign('opleiding_id')->references('id')->on('opleidings')->onDelete('restrict')->onUpdate('restrict');
        });
        DB::table('evenements')->insert(
            [
                [
                    'opleiding_id' => '1',
                    'evenementnaam' => 'ITfactory avond',
                    'beschrijving' => 'De avond van de ITFactory!',
                    'datum' => '2020-04-20',
                    'tijdstip' => '20:00',
                    'formulier' => true,


                    'created_at' => now()

                ],
                [
                    'opleiding_id' => '2',
                    'evenementnaam' => 'Elektromechanica avond',
                    'beschrijving' => 'De avond van de elektromechanica!',
                    'datum' => '2020-04-20 ',
                    'tijdstip' => '20:00',
                    'formulier' => true,
                    'created_at' => now()

                ],
                [
                    'opleiding_id' => '3',
                    'evenementnaam' => 'Bouw avond',
                    'beschrijving' => 'De avond van de bouw!',
                    'datum' => '2020-04-20 ',
                    'tijdstip' => '20:00',
                    'formulier' => true,
                    'created_at' => now()

                ],
                [
                    'opleiding_id' => '4',
                    'evenementnaam' => 'Chemie avond',
                    'beschrijving' => 'De avond van de Chemie!',
                    'datum' => '2020-04-20 ',
                    'tijdstip' => '20:00',
                    'formulier' => true,
                    'created_at' => now()

                ],
                [
                    'opleiding_id' => '5',
                    'evenementnaam' => 'accountancy avond',
                    'beschrijving' =>'',

                    'datum' => '2020-04-20',
                    'tijdstip' => '20:00',
                    'formulier' => false,
                    'created_at' => now()

                ],
                [
                    'opleiding_id' => '6',
                    'evenementnaam' => 'Landbouw avond',
                    'beschrijving' =>'voorbeeld van een avond met veel records',

                    'datum' => '2020-04-20',
                    'tijdstip' => '20:00',
                    'formulier' => true,
                    'created_at' => now()

                ],

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
        Schema::dropIfExists('evenements');
    }
}
