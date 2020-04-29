<?php

use Illuminate\Database\Seeder;
use App\TipoUser;
class TipoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        TipoUser::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        TipoUser::create([            
            'nombre'=>'Administrador',            
        ]);
        TipoUser::create([            
            'nombre'=>'Usuario',            
        ]);
    }
}
