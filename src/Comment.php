<?php

class Comment {
    public $id;
    public $content;
    public $rate;

    public function __construct($id, $content, $rate){
        $this->id = $id;
        $this->content = $content;
        $this->rate = $rate;
    }

    //Getter
    public function getId(){
        return $this->id;
    }

    public function getContent(){
        return $this->content;
    }

    public function getRate(){
        return $this->rate;
    }

    //Setter
    public function setContent($content){
        $this->content = $content;
    }

    public function setRate($rate){
        $this->rate = $rate;
    }

    public static function showAll(){
        $selectAll = "SELECT content, title, name, rate FROM `comment` 
                        INNER JOIN book ON comment.book_id = book.id
                        INNER JOIN user ON comment.user_id = user.id;";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute();
        $resultAll = $stmtselect->fetchAll();
        return $resultAll;
    }

    public static function showComment($title){
        $selectAll = "SELECT content, title, name, rate FROM `comment` 
                        INNER JOIN book ON comment.book_id = book.id
                        INNER JOIN user ON comment.user_id = user.id
                        WHERE title = :title"; 
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute([
            ':title' => $title,
        ]);
        $resultAll = $stmtselect->fetchAll();
        $result = new stdClass();
        $result->book = $title;
        $result->bookList = $resultAll;
        return $result;
    }

    public static function avgRate($title){
        $select = "SELECT title, ROUND(AVG(rate),2) as average from comment
                    INNER JOIN book ON comment.book_id = book.id
                    WHERE title = :title";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($select);
        
        $stmtselect->execute([
            ':title' => $title,
        ]);
        $result = $stmtselect->fetch();
        return $result;
    }

    public static function topXBookByNote($take = 3){
        $select = "SELECT title, ROUND(AVG(rate),2) as average from comment
                    INNER JOIN book ON comment.book_id = book.id
                    WHERE rate > 0
                    GROUP BY book.id
                    ORDER BY average DESC
                    LIMIT :take";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($select);
        
        $stmtselect->execute([
            ':take' => $take,
        ]);
        $result = $stmtselect->fetch();
        return $result;
    }

    public static function addRate($content, $user, $book, $rate){
        $addRate = "INSERT INTO comment (content, user_id, book_id, rate)
                VALUES (?, ?, ?, ?)";
        $stmtAdd = MysqlDatabaseConnectionService::get()->prepare($addRate);
        $stmtAdd->execute([
            $content,
            $user,
            $book,
            $rate
        ]);
    }
}