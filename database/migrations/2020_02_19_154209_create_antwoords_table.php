<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntwoordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antwoords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vraag_id');
            $table->string('inhoud');
            $table->timestamps();

            $table->foreign('vraag_id')->references('id')->on('vraags')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('antwoords')->insert(
            [
                [
                    'vraag_id' => '1',
                    'inhoud' => 'vlees',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '1',
                    'inhoud' => 'vis',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '1',
                    'inhoud' => 'vegetarisch',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '2',
                    'inhoud' => 'credon',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '3',
                    'inhoud' => 'auto',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '3',
                    'inhoud' => 'fiets',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '3',
                    'inhoud' => 'trein',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '4',
                    'inhoud' => 'Neen.',

                    'created_at' => now()

                ],


                [
                    'vraag_id' => '5',
                    'inhoud' => 'Ook niet',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '4',
                    'inhoud' => 'ik eet graag kip',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '5',
                    'inhoud' => 'Ja een master chemie in leuven',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '6',
                    'inhoud' => 'Smos kaas',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '6',
                    'inhoud' => 'Smos hesp',

                    'created_at' => now()

                ],
                [
                    'vraag_id' => '6',
                    'inhoud' => 'Smos kaas&hesp',

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
        Schema::dropIfExists('antwoords');
    }
}
