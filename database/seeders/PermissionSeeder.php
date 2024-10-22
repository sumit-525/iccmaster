<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permission = [
            'employee-view',
            'employee-add',
            'employee-edit',
            'employee-delete',
            'documentcategory-view',
            'documentcategory-add',
            'documentcategory-edit',
            'documentcategory-delete',
            'document-view',
            'document-add',
            'document-edit',
            'document-delete',
            'newscategory-view',
            'newscategory-add',
            'newscategory-edit',
            'newscategory-delete',

            'tendercategory-view',
            'tendercategory-add',
            'tendercategory-edit',
            'tendercategory-delete',
            'tender-view',
            'tender-add',
            'tender-edit',
            'tender-delete',
            'tender-view',
            'portwise-view',
            'portwise-add',
            'portwise-edit',
            'portwise-delete',
            'setting-view',
            'setting-add',
            'setting-edit',
            'setting-delete',
        ];

        foreach ($permission as $value) {
            Permission::updateOrCreate(['name' => $value], ['name' => $value]);
        }
    }
}
