<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailontvangersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailontvangers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('alumni_id')->nullable();
            $table->unsignedBigInteger('mail_id');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
            $table->foreign('alumni_id')->references('id')->on('alumnis')->onDelete('set null')->onUpdate('set null');
            $table->foreign('mail_id')->references('id')->on('mails')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('mailontvangers')->insert(
            [
                [
                    'user_id' => '2',
                    'alumni_id' => null,
                    'mail_id'=>'1',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '3',
                    'alumni_id' => null,
                    'mail_id'=>'1',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '4',
                    'alumni_id' => null,
                    'mail_id'=>'1',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '5',
                    'alumni_id' => null,
                    'mail_id'=>'1',
                    'created_at' => now(),

                ],

                [
                    'user_id' => '2',
                    'alumni_id' => null,
                    'mail_id'=>'2',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '3',
                    'alumni_id' => null,
                    'mail_id'=>'2',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '4',
                    'alumni_id' => null,
                    'mail_id'=>'2',
                    'created_at' => now()

                ],
                [
                    'user_id' => '5',
                    'alumni_id' => null,
                    'mail_id'=>'2',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '1',
                    'alumni_id' => null,
                    'mail_id'=>'4',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '3',
                    'alumni_id' => null,
                    'mail_id'=>'4',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '4',
                    'alumni_id' => null,
                    'mail_id'=>'4',
                    'created_at' => now()

                ],
                [
                    'user_id' => '5',
                    'alumni_id' => null,
                    'mail_id'=>'4',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '1',
                    'alumni_id' => null,
                    'mail_id'=>'5',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '2',
                    'alumni_id' => null,
                    'mail_id'=>'5',
                    'created_at' => now(),

                ],
                [
                    'user_id' => '4',
                    'alumni_id' => null,
                    'mail_id'=>'5',
                    'created_at' => now()

                ],
                [
                    'user_id' => '5',
                    'alumni_id' => null,
                    'mail_id'=>'5',
                    'created_at' => now(),

                ]






            ]
        );
        for ($i = 10; $i <= 30; $i++) {
            DB::table('mailontvangers')->insert(
                [
                    'user_id' => null,
                    'alumni_id' => "$i",
                    'mail_id'=>'3',
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
        Schema::dropIfExists('mailontvangers');
    }
}
