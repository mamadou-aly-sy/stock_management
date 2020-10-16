<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Product extends Model
{
    public $id;
    public $name_p;
    public $categorie_p;
    public $price;
    public $qty;
    public $description;
    public $admin_id;
    public $fournissur_id;
    public $date_ajout;

    public static function all()
    {
        return Database::query(
            "SELECT *
            FROM products INNER JOIN categories INNER JOIN fournisseurs INNER JOIN admins
            WHERE category_id = categories.id AND fournissur_id = fournisseurs.id AND products.admin_id = admins.id"
        );
    }
}
