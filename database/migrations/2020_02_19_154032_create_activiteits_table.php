<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiviteitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activiteits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evenement_id');
            $table->string('activiteitnaam');
            $table->string('lokaal');
            $table->double('startuur');
            $table->double('einduur');
            $table->timestamps();

            $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('activiteits')->insert(

            [

                [
                    'evenement_id' => '1',
                    'activiteitnaam' => 'samenkomen',
                    'lokaal' => 'agora',
                    'startuur' => '19.30',
                    'einduur' => '20',
                    'created_at' => now(),

                ],
                [
                    'evenement_id' => '1',
                    'activiteitnaam' => 'netwerken',
                    'lokaal' => 'agora',
                    'startuur' => '20',
                    'einduur' => '21',
                    'created_at' => now(),

                ],
                [
                    'evenement_id' => '2',
                    'activiteitnaam' => 'samenkomen',
                    'lokaal' => 'agora',
                    'startuur' => '19.30',
                    'einduur' => '20.00',
                    'created_at' => now(),

                ],
                [
                    'evenement_id' => '3',
                    'activiteitnaam' => 'samenkomen',
                    'lokaal' => 'B203',
                    'startuur' => '19.30',
                    'einduur' => '20.00',
                    'created_at' => now(),

                ],
                [
                    'evenement_id' => '4',
                    'activiteitnaam' => 'samenkomen',
                    'lokaal' => 'F003',
                    'startuur' => '19.30',
                    'einduur' => '20.00',
                    'created_at' => now(),

                ],



            ]
        );
        for ($i = 1; $i <= 10; $i++) {
            DB::table('activiteits')->insert(
                [
                    'evenement_id' => '6',
                    'activiteitnaam' => "dummyactiviteit $i",
                    'lokaal' => 'dummylokaal',
                    'startuur' => '19.30',
                    'einduur' => '20.00',
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
        Schema::dropIfExists('activiteits');
    }
}
