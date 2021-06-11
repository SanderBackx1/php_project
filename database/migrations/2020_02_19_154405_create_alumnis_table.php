<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('mail')->unique();
            $table->string('afstudeerjaar');

            $table->timestamps();
        });
        for ($i = 10; $i <= 20; $i++) {
            DB::table('alumnis')->insert(
                [
                    'voornaam' => "alumni voornaam $i",
                    'achternaam' => "achternaam $i",
                    'mail' => "alumni_$i@mailinator.com",
                    'afstudeerjaar' => '2016',

                    'created_at' => now()

                ]
            );
        }
        for ($i = 21; $i <= 30; $i++) {
            DB::table('alumnis')->insert(
                [
                    'voornaam' => "alumni voornaam $i",
                    'achternaam' => "achternaam $i",
                    'mail' => "alumni_$i@mailinator.com",
                    'afstudeerjaar' => '2017',

                    'created_at' => now()

                ]
            );
        }
        for ($i = 31; $i <= 40; $i++) {
            DB::table('alumnis')->insert(
                [
                    'voornaam' => "alumni voornaam $i",
                    'achternaam' => "achternaam $i",
                    'mail' => "alumni_$i@mailinator.com",
                    'afstudeerjaar' => '2018',

                    'created_at' => now(),

                ]
            );
        }
        for ($i = 41; $i <= 50; $i++) {
            DB::table('alumnis')->insert(
                [
                    'voornaam' => "alumni voornaam $i",
                    'achternaam' => "achternaam $i",
                    'mail' => "alumni_$i@mailinator.com",
                    'afstudeerjaar' => '2019',

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
        Schema::dropIfExists('alumnis');
    }
}
