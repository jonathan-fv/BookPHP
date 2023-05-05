<?php

class WhishlistController {
    
    public function showWhislist() {
        echo json_encode(Whishlist::showWhislist($_GET['name']));
    }

}