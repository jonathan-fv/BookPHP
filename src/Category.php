<?php

class Category{
    private $id;
    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    //Getter
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }

     //Setter
    public function setName($name){
        $this->name = $name;
    }

    public static function showAll(){
        $selectAll = "SELECT * FROM `category`";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute();
        $resultAll = $stmtselect->fetchAll();
        return $resultAll;
    }

    public static function showCategory($name){
        $selectEdition = "SELECT name as category_name, title 
                            FROM category
                            INNER JOIN book ON book.category_id = category.id
                            WHERE name = :name";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectEdition);
        $stmtselect->execute([
            ':name' => $name,
        ]);
        $resultCategory = $stmtselect->fetchAll();
        return $resultCategory;
    }

    public static function addCategory($name){
        $addAuthor = "INSERT INTO category (name)
                        VALUES (?)";
        $stmtAdd = MysqlDatabaseConnectionService::get()->prepare($addAuthor);
        $stmtAdd->execute([
            $name
        ]);
    }

    public static function deleteCategory($id){
        $deleteCategory = "DELETE FROM category 
                            WHERE id = ?";
        $stmtdelete = MysqlDatabaseConnectionService::get()->prepare($deleteCategory);
        $stmtdelete->execute([
            $id
        ]);
    }
}