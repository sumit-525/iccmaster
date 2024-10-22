<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $admin = Role::where('name', 'admin')->first();
        $editor = Role::where('name', 'editor')->first();
        $viewer = Role::where('name', 'viewer')->first();
        $editor_permission = [
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
            'news-view',
            'news-add',
            'news-edit',
            'news-delete',
            'news-view',
            'tendercategory-view',
            'tendercategory-add',
            'tendercategory-edit',
            'tendercategory-delete',
            'tender-view',
            'tender-add',
            'tender-edit',
            'tender-delete',
            'portwise-view',
            'portwise-add',
            'portwise-edit',
            'portwise-delete',
        ];
        $viewer_permission = [
            'documentcategory-view',
            'document-view',
            'newscategory-view',
            'news-view',
            'tendercategory-view',
            'tender-view',
            'portwise-view',
        ];
        $permissions = Permission::select('id')->get()->pluck('id')->toArray();
        $admin->syncPermissions($permissions);
        $editor->syncPermissions($editor_permission);
        $viewer->syncPermissions($viewer_permission);
    }
}
