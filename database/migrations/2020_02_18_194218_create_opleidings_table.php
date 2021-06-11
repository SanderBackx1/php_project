<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpleidingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opleidings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('opleidingnaam');
            $table->boolean('actief')->default(true);
            $table->timestamps();
        });
        DB::table('opleidings')->insert(
            [
                [
                    'opleidingnaam' => 'ITfactory',
                    'actief' => true,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Elektromechanica',
                    'actief' => true,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Bouw',
                    'actief' => true,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Chemie',
                    'actief' => true,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Accountancy',
                    'actief' => true,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Landbouw',
                    'actief' => false,
                    'created_at' => now()

                ],
                [
                    'opleidingnaam' => 'Energietechnologie',
                    'actief' => true,
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
        Schema::dropIfExists('opleidings');
    }
}
