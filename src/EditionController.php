<?php
class EditionController {

    public function showAll() {
        echo json_encode(Edition::showAll());
    }

    public function showEdition() {
        echo json_encode(Edition::showEdition($_GET['format']));
    }

    public function addEdition(){
        Edition::addEdition($_POST['format']);
    }

    public function deleteEdition(){
        Edition::deleteEdition($_POST['id']);
    }

}