<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;
use App\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'kasir'],
        ]);
        
        $permission_ids = []; // an empty array of stored permission IDs
        // iterate though all routes
        foreach (Route::getRoutes()->getRoutes() as $key => $route)
        {
            // get route action
            $action = $route->getActionname();
            // separating controller and method
            $_action = explode('@',$action);
            
            $controller = $_action[0];
            $method = end($_action);
            
            // check if this permission is already exists
            $permission_check = Permission::where(
                    ["controller"=>$controller,"method"=>$method]
                )->first();
            if(!$permission_check){
                $permission = new Permission;
                $permission->controller = $controller;
                $permission->method = $method;
                $permission->save();
                // add stored permission id in array
                $permission_ids[] = $permission->id;    
            }
        }
        // find admin role.
        $admin_role = Role::where("name","admin")->first();
        // atache all permissions to admin role
        $admin_role->permissions()->attach($permission_ids);
        // \App\Models\User::factory(10)->create();

        DB::table('buku')->insert([
            'judul'=>'Sang Penandai',
            'noisbn'=>'hF5oE',
            'penulis'=>'Darwis',
            'penerbit'=>'Darwis ',
            'tahun'=>'2010',
            'hargaPokok'=>'10000',
            'hargaJual'=>'20000',
            'ppn'=>'10',
            'stock'=>'10',
            'disc'=>'10',
        ]);
        DB::table('buku')->insert([
            'judul'=>'Bidadari',
            'noisbn'=>'hadoE',
            'penulis'=>'Darwis',
            'penerbit'=>'Darwis ',
            'tahun'=>'2001',
            'hargaPokok'=>'15000',
            'hargaJual'=>'17000',
            'ppn'=>'0',
            'stock'=>'0',
            'disc'=>'0',
        ]);
        DB::table('distributor')->insert([
            'namaDist'=>'Herman',
            'alamat'=>'Jakarta',
            'telepon'=>'085726262373',
        ]);
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'role_id'=>'1',
            'password'=>bcrypt('admin@gmail.com'),
        ]);
        DB::table('users')->insert([
            'name'=>'Kasir',
            'role_id'=>'2',
            'email'=>'kasir@gmail.com',
            'password'=>bcrypt('kasir@gmail.com'),
        ]);
    }
}
