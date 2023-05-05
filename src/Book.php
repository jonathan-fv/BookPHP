<?php

class Book {
    protected $id;
    protected $title;
    protected $resume;

    public function __construct($id, $title, $resume){
        $this->id = $id;
        $this->title= $title ;
        $this->resume = $resume;
    }

    //Getter
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getResume(){
        return $this->resume;
    }

    //Setter
    public function setTitle($title){
        $this->title = $title;
    }
    public function setResume($resume){
        $this->resume = $resume;
    }

    public static function showAll(){
        $selectAll = "SELECT title, resume, category.name as category_name, author.firstname, author.lastname, edition.format, book_edition.published_at
                        FROM book 
                        LEFT JOIN book_edition ON book_edition.book_id = book.id
                        JOIN category ON category.id = book.category_id
                        JOIN author ON author.id = book.author_id
                        LEFT JOIN edition ON edition_id = edition.id 
                        ORDER BY book.id DESC";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute();
        $resultAll = $stmtselect->fetchAll();
        return $resultAll;
    }

    public static function showBook($title){
        $selectBook = "SELECT title, resume, category.name as category_name, author.firstname, author.lastname, edition.format, book_edition.published_at
                        FROM book 
                        INNER JOIN category ON category.id = book.category_id
                        INNER JOIN author ON author.id = book.author_id
                        INNER JOIN book_edition ON book_edition.book_id = book.id
                        INNER join edition ON edition_id = edition.id
                        WHERE title = :title ";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectBook);
        $stmtselect->execute([
            ':title' => $title,
        ]);
        $resultBook = $stmtselect->fetch();
        return $resultBook;
    }

    public static function addBook($title, $resume, $category_id, $author_id){
        $addBook = "INSERT INTO book (title, resume, category_id, author_id)
                        VALUES (?, ?, ?, ?)";
        $stmtAdd = MysqlDatabaseConnectionService::get()->prepare($addBook);
        $stmtAdd->execute([
            $title,
            $resume,
            $category_id,
            $author_id
        ]);
    }

    public static function deleteBook($id){
        $deleteAuthor = "DELETE FROM book 
                            WHERE id = ?";
        $stmtdelete = MysqlDatabaseConnectionService::get()->prepare($deleteAuthor);
        $stmtdelete->execute([
            $id
        ]);
    }


}