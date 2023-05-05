<?php

class User{
    private $id;
    private $name;

    public function __construct($id, $name){
        $this->id = $id;
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

    public static function showUser($name){
        $selectAll = "SELECT title, progression, added_at, format FROM `user_book`
                            INNER JOIN user ON user.id = user_book.user_id
                            INNER JOIN book_edition ON book_edition.id = user_book.book_edition_id
                            INNER JOIN book ON book.id = book_edition.id
                            INNER JOIN edition ON edition.id = book_edition.id
                            WHERE name= :name";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute([
            ':name' => $name,
        ]);
        $resultAll = $stmtselect->fetchAll();
        $result = new stdClass();
        $result->name = $name;
        $result->bookList = $resultAll;
        return $result;
    }
}