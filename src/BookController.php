<?php
class BookController {

    public function showAll() {
        echo json_encode(Book::showAll());
    }

    public function showBook() {
        echo json_encode(Book::showBook($_GET['title']));
    }

    public function addBook(){
        Book::addBook($_POST['title'], $_POST['resume'], $_POST['category_id'], $_POST['author_id']);
    }

    public function deleteBook(){
        Book::deleteBook($_POST['id']);
    }
}