<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MigrateController extends Controller {

    /**
     * @var Collection
     */
    private $users;
    /**
     * @var Collection
     */
    private $categories;

    /**
     * @var Collection
     */
    private $transactions;

    public function __construct() {
        $msDB = DB::connection('mysql');

        $this->users = $msDB->table('users')->get();
        $this->categories = $msDB->table('categories')->get();
        foreach ($this->categories as &$c) {
            $c->category_name = strtolower($c->category_name);
        }

        $this->transactions = $msDB->table('transactions')->get();

    }

    public function mysqlToMongoDbMigrate() {
        $this->migrateUsers();
        $this->migrateCategories();
        $this->migrateTransactions();
    }

    private function stdClassToArray($stdClass, $removeColumns = null) {
        $removeColumns = $removeColumns ?: ['id'];
        $stdClass = json_decode(json_encode($stdClass), JSON_OBJECT_AS_ARRAY);
        foreach ($removeColumns as $removedColumn) {
            unset($stdClass['id']);
        }
        return $stdClass;
    }

    public function migrateUsers() {
        foreach ($this->users as $user) {
            $user = $this->stdClassToArray($user, ['id']);
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }

    public function migrateCategories() {
        $hashed = [];
        $categories = $this->categories;

        foreach ($categories as $category) {
            $hashed[$category->id] = $category;
            $category = $this->stdClassToArray($category, ['id', 'parent_category_id']);
            Category::updateOrCreate(
                ['category_name' => $category['category_name']],
                $category
            );
        }

        foreach ($categories as $category) {
            if (!$category->parent_category_id) continue;
            $parentCategory = $hashed[$category->parent_category_id];

            $c = Category::where('category_name', $category->category_name)->first();
            $p = Category::where('category_name', $parentCategory->category_name)->first();

            $c->parent_category_id = $p->_id;
            $c->update();
        }
    }

    public function migrateTransactions() {
        foreach ($this->transactions as $transaction) {
            $user = User::where('email', $this->users->where('id', $transaction->user_id)->first()->email)->first();
            $category = Category::where('category_name', $this->categories->where('id', $transaction->category_id)->first()->category_name)->first();

            $transaction->user_id = $user->_id;
            $transaction->category_id = $category->_id;
            Transaction::firstOrCreate($this->stdClassToArray($transaction));

        }
    }

}
