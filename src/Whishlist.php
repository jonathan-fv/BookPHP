<?php

class Whishlist {
    private $id;
    private $user_id;
    private $book_edition_id;

    public function __construct($id, $user_id, $book_edition_id){
        $this->id = $id;
        $this->user_id = $user_id;
        $this->book_edition_id = $book_edition_id;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getBookEditionId(){
        return $this->book_edition_id;
    }

    public static function showWhislist($name){
        $selectAll = "SELECT title, resume, firstname, lastname, format, category.name AS category_name, published_at FROM `whislist`
                        INNER JOIN book_edition ON book_edition.id = whislist.id
                        INNER JOIN user ON user.id = whislist.user_id
                        INNER JOIN book ON book.id = book_edition.book_id
                        INNER JOIN author ON author.id = book.author_id
                        INNER JOIN edition ON edition.id = book_edition.edition_id
                        INNER JOIN category ON category.id = book.category_id
                        WHERE user.name= :name";
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