<?php

class UserController{

    public function showUser() {
        echo json_encode(User::showUser($_GET['name']));
    }
}