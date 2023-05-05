<?php

class Edition {
    private $id;
    private $format;

    public function __construct($format){
        $this->format = $format;
    }

    //Getter
    public function getId(){
        return $this->id;
    }
    public function getFormat(){
        return $this->format;
    }

     //Setter
    public function setFormat($format){
        $this->format = $format	;
    }

    public static function showAll(){
        $selectAll = "SELECT * FROM `edition`";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute();
        $resultAll = $stmtselect->fetchAll();
        return $resultAll;
    }

    public static function showEdition($format){
        $selectEdition = "SELECT format, title 
                                FROM edition
                                INNER JOIN book_edition ON book_edition.edition_id = edition.id
                                INNER JOIN book ON book.id = book_edition.book_id
                                WHERE format = :format";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectEdition);
        $stmtselect->execute([
            ':format' => $format,
        ]);
        $resultEdition = $stmtselect->fetchAll();
        return $resultEdition;
    }

    public static function addEdition($format){
        $addAuthor = "INSERT INTO edition (format)
                        VALUES (?)";
        $stmtAdd = MysqlDatabaseConnectionService::get()->prepare($addAuthor);
        $stmtAdd->execute([
            $format,
        ]);
    }

    public static function deleteEdition($id){
        $deleteEdition = "DELETE FROM edition 
                            WHERE id = ?";
        $stmtdelete = MysqlDatabaseConnectionService::get()->prepare($deleteEdition);
        $stmtdelete->execute([
            $id
        ]);
    }
}