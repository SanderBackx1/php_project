<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('onderwerp');
            $table->string('bericht');
            $table->dateTime('datum');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('mails')->insert(
            [
                [
                    'user_id' => '1',
                    'onderwerp' => 'welkom',
                    'bericht' => 'welkom op de nieuwe applicatie als er vragen of onduidelijkheden zijn vraag maar gerust!',
                    'datum' => '2020-03-18 18:54:23',
                    'created_at' => now()

                ],
                [
                    'user_id' => '1',
                    'onderwerp' => 'taken',
                    'bericht' => 'zouden jullie aub je voorkeur voor de taken willen ingeven?',
                    'datum' => '2020-03-25 14:22:43',
                    'created_at' => now()

                ],

                [
                    'user_id' => '1',
                    'onderwerp' => 'Inschrijving alumni avond IT Factory',
                    'bericht' => 'Beste alumnis van de IT Factory, vanaf dit jaar kan je jezelf inschrijven met deze link. www.link.com',
                    'datum' => '2020-04-01 09:40:46',
                    'created_at' => now()

                ],
                [
                    'user_id' => '2',
                    'onderwerp' => 'borrelhapjes',
                    'bericht' => 'Zouden we ook geen toastjes als borrelhapjes aanbieden?',
                    'datum' => '2020-04-04 20:27:09',
                    'created_at' => now()

                ],

                [
                    'user_id' => '3',
                    'onderwerp' => 'vergadering',
                    'bericht' => 'Kan er iemand mij het vergaderverslag doormailen?',
                    'datum' => '2020-04-10 12:05:33',
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
        Schema::dropIfExists('mails');
    }
}
