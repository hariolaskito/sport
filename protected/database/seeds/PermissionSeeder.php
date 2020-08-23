<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('permission')->delete();

    	$admin = Role::where('name','admin')->first();
    	$operator = Role::where('name','operator')->first();

        $user_create = new Permission();
		$user_create->name = 'user-create';
		$user_create->display_name = 'Tambah User';
		$user_create->save();
		$admin->attachPermission($user_create);

		$user_edit = new Permission();
		$user_edit->name = 'user-edit';
		$user_edit->display_name = 'Edit User';
		$user_edit->save();
		$admin->attachPermission($user_edit);

		$user_delete = new Permission();
		$user_delete->name = 'user-delete';
		$user_delete->display_name = 'Hapus User';
		$user_delete->save();
		$admin->attachPermission($user_delete);

		$category_create = new Permission();
		$category_create->name = 'category-create';
		$category_create->display_name = 'Tambah Kategori Artikel';
		$category_create->save();
		$admin->attachPermission($category_create);
		$operator->attachPermission($category_create);

		$category_edit = new Permission();
		$category_edit->name = 'category-edit';
		$category_edit->display_name = 'Edit Kategori Artikel';
		$category_edit->save();
		$admin->attachPermission($category_edit);
		$operator->attachPermission($category_edit);

		$category_delete = new Permission();
		$category_delete->name = 'category-delete';
		$category_delete->display_name = 'Hapus Kategori Artikel';
		$category_delete->save();
		$admin->attachPermission($category_delete);
		$operator->attachPermission($category_delete);

		$article_create = new Permission();
		$article_create->name = 'article-create';
		$article_create->display_name = 'Tambah Artikel';
		$article_create->save();
		$admin->attachPermission($article_create);
		$operator->attachPermission($article_create);

		$article_edit = new Permission();
		$article_edit->name = 'article-edit';
		$article_edit->display_name = 'Edit Artikel';
		$article_edit->save();
		$admin->attachPermission($article_edit);
		$operator->attachPermission($article_edit);

		$article_delete = new Permission();
		$article_delete->name = 'article-delete';
		$article_delete->display_name = 'Hapus Artikel';
		$article_delete->save();
		$admin->attachPermission($article_delete);
		$operator->attachPermission($article_delete);

		$setting_edit = new Permission();
		$setting_edit->name = 'setting-edit';
		$setting_edit->display_name = 'Edit Setting';
		$setting_edit->save();
		$admin->attachPermission($setting_edit);
		$operator->attachPermission($setting_edit);
    }
}
