<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Department::class, 5)->create([])->each(function ($department) {
            factory(App\Models\Department::class, \mt_rand(0, 10))->create([ 'superior_id' => $department->id])->each(function ($departmentInner) {
                factory(App\Models\Department::class, \mt_rand(0, 15))->create([ 'parent_id' => $departmentInner->id]);
            });
        });

        factory(App\Models\Department::class, 20)->states('no_embassador')->create();
    }
}
