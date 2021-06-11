<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('actief')->default(true);
            $table->boolean('verantwoordelijke')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            [
                [
                    'name' => 'Christel Maes',
                    'email' => 'Christel.maes@example.com',
                    'admin' => true,
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin1234'),
                    'actief' => true,
                    'verantwoordelijke' => true,
                    'created_at' => now()

                ],
                [
                    'name' => 'Jan Janssen',
                    'email' => 'jan.janssen@example.com',
                    'admin' => false,
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'actief' => true,
                    'verantwoordelijke' => true,
                    'created_at' => now()
                ],
                [
                    'name' => 'Michaël Cloots',
                    'email' => 'Michaël.cloots@example.com',
                    'admin' => false,
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'actief' => true,
                    'verantwoordelijke' => true,
                    'created_at' => now()
                ],
                [
                    'name' => 'Patrick Verhaert',
                    'email' => 'Patrick.Verhaert@example.com',
                    'admin' => false,
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'actief' => true,
                    'verantwoordelijke' => false,
                    'created_at' => now()
                ],
                [
                    'name' => 'Ann Hannes',
                    'email' => 'Ann.hannes@example.com',
                    'admin' => false,
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'actief' => false,
                    'verantwoordelijke' => false,
                    'created_at' => now()
                ]
            ]
        );



    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
