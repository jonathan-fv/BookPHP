<?php
class AuthorController {

    public function showAll() {
        echo json_encode(Author::showAll());
    }

    public function showAuthor() {
        echo json_encode(Author::showAuthor($_GET['firstname']));
    }

    public function addAuthor(){
        Author::addAuthor($_POST['firstname'], $_POST['lastname']);
    }

    public function deleteAuthor(){
        Author::deleteAuthor($_POST['id']);
    }

    public function updateAuthor(){
        if(empty($_POST) || !isset($_GET['id'])) {
            throw new MyException('Accèss forbidden, empty $_POST or ID', 403);
            }
            return Author::updateAuthor($_GET['id'], $_POST['firstname'], $_POST['lastname']);
    }
}