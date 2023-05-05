<?php

class CommentController {

    public function showAll() {
        echo json_encode(Comment::showAll());
    }

    public function showComment() {
        echo json_encode(Comment::showComment($_GET['title']));
    }

    public function avgRate() {
        echo json_encode(Comment::avgRate($_GET['title']));
    }

    public function addRate() {
        echo json_encode(Comment::addRate($_POST['content'], $_GET['user'], $_GET['book'], $_POST['rate']));
    }
}