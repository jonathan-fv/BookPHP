<?php

class CategoryController{

    public function showAll() {
        echo json_encode(Category::showAll());
    }

    public function showCategory() {
        echo json_encode(Category::showCategory($_GET['name']));
    }

    public function addCategory(){
        Category::addCategory($_POST['name']);
    }

    public function deleteCategory(){
        Category::deleteCategory($_POST['id']);
    }
}