<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocenttaaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docenttaaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('taak_id');
            $table->boolean('voorkeur')->default(false);
            $table->boolean('aangewezen')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('taak_id')->references('id')->on('taaks')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('docenttaaks')->insert(
            [
                [
                    'user_id' => '1',
                    'taak_id' => '1',
                    'voorkeur' => true,
                    'aangewezen' => true,
                    'created_at' => now()
                ],
                [
                    'user_id' => '2',
                    'taak_id' => '2',
                    'voorkeur' => true,
                    'aangewezen' => false,
                    'created_at' => now()
                ],
                [
                    'user_id' => '3',
                    'taak_id' => '3',
                    'voorkeur' => true,
                    'aangewezen' => true,
                    'created_at' => now()

                ],
                [
                    'user_id' => '3',
                    'taak_id' => '4',
                    'voorkeur' => true,
                    'aangewezen' => false,
                    'created_at' => now()

                ],
                [
                    'user_id' => '4',
                    'taak_id' => '1',
                    'voorkeur' => false,
                    'aangewezen' => true,
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
        Schema::dropIfExists('docenttaaks');
    }
}
