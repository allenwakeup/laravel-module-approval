<?php

namespace Goodcatch\Modules\Approval\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ApprovalDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        Model::unguard ();
        $this->call(PermissionTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
