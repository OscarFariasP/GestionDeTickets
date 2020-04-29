<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Ticket;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        User::truncate();
        Ticket::truncate();                       
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        User::create([
            'id_tipouser'=>1,
            'nombre'=>'Oscar',
            'email' =>'admin@example.com',
            'pass' => bcrypt('123456'),
        ]);
        User::create([
            'id_tipouser'=>2,
            'nombre'=>'Jesus',
            'email' =>'user@example.com',
            'pass' => bcrypt('123456'),
        ]);
        User::create([
            'id_tipouser'=>2,
            'nombre'=>'Maria',
            'email' =>'user2@example.com',
            'pass' => bcrypt('123456'),
        ]);
        User::create([
            'id_tipouser'=>2,
            'nombre'=>'Miguel',
            'email' =>'user3@example.com',
            'pass' => bcrypt('123456'),
        ]);
        
        User::create([
            'id_tipouser'=>2,
            'nombre'=>'Francys',
            'email' =>'user4@example.com',
            'pass' => bcrypt('123456'),
        ]);

        Ticket::create([
            'id_user'  => null,
            'ticket_pedido' => 'test pedido'
        ]);
        Ticket::create([
            'id_user'  => null,
            'ticket_pedido' => 'Test 2...'
        ]);
        Ticket::create([
            'id_user'  => 1,
            'ticket_pedido' => 'another test'
        ]);
        Ticket::create([
            'id_user'  => null,
            'ticket_pedido' => 'Test 3...'
        ]);
        

    }
}
