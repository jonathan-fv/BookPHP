<?php

class Author {
    private $id;
    private $firstname;
    private $lastname;

    public function __construct($id, $firstname	, $lastname){
        $this->id = $id;
        $this->firstname = $firstname	 ;
        $this->lastname = $lastname;
    }

    //Getter
    public function getId(){
        return $this->id;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }

    //Setter
    public function setFirstName($firstname){
        $this->firstname = $firstname	;
    }
    public function setLastName($lastname){
        $this->lastname = $lastname;
    }

    public static function showAll(){
        $selectAll = "SELECT firstname, lastname FROM `Author`";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAll);
        $stmtselect->execute();
        $resultAll = $stmtselect->fetchAll();
        return $resultAll;
    }

    public static function showAuthor($firstname){
        $selectAuthor = "SELECT lastname, title, resume FROM `Author`
                            INNER JOIN book ON author.id = book.author_id
                            WHERE firstname= :firstname";
        $stmtselect = MysqlDatabaseConnectionService::get()->prepare($selectAuthor);
        $stmtselect->execute([
            ':firstname' => $firstname,
        ]);
        $resultAll = $stmtselect->fetchAll();
        if(count($resultAll) == 0){
            echo " L'auteur n'est pas référencé";
            die();
        }
        else{
            $result = new stdClass();
            $result->author = $firstname . " " . $resultAll[0]["lastname"];
            $result->bookList = $resultAll;
            return $result;
        }
    }

    public static function addAuthor($firstname, $lastname){
        $addAuthor = "INSERT INTO author (firstname, lastname)
                        VALUES (?, ?)";
        $stmtAdd = MysqlDatabaseConnectionService::get()->prepare($addAuthor);
        $stmtAdd->execute([
            $firstname,
            $lastname
        ]);
    }

    public static function deleteAuthor($id){
        $deleteAuthor = "DELETE FROM author 
                            WHERE id = ?";
        $stmtdelete = MysqlDatabaseConnectionService::get()->prepare($deleteAuthor);
        $stmtdelete->execute([
            $id
        ]);
    }

    public static function updateAuthor($id, $firstname, $lastname){
        $updateAuthor = "UPDATE author
                            SET firstname = :firstname, 
                                lastname = :lastname
                            WHERE id = :id";
        $stmtupadte = MysqlDatabaseConnectionService::get()->prepare($updateAuthor);
        $stmtupadte ->execute([
            ":firstname" => $firstname,
            ":lastname" => $lastname,
            ":id" => $id
        ]);
    }
}