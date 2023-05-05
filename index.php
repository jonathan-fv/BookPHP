<?php
include_once 'bootstrap.php';


$routes = [
    //Route pour afficher tous les livres de la BDD
    new Route('/books/all', 'BookController', 'showAll'),
    //Route pour afficher un livre par rapport à son titre
    new Route('/books/search', 'BookController', 'showBook'),
    //Route pour ajouter un livre
    new Route('/books/add', 'BookController', 'addBook'),
    //Route pour supprimer un livre
    new Route('/books/delete', 'BookController', 'deleteBook'),


    //Route pour afficher tous les auteurs de la BDD
    new Route('/author/all', 'AuthorController', 'showAll'),
    //Route pour afficher un auteur par rapport a son nom, prénom
    new Route("/author/search", 'AuthorController', 'showAuthor'),
    //Route pour ajouter un auteur
    new Route('/author/add', 'AuthorController' , 'addAuthor'),
    //Route pour supprimer un auteur
    new Route('/author/delete', 'AuthorController' , 'deleteAuthor'),
     //Route pour update un auteur
    new Route('/author/update', 'AuthorController' , 'updateAuthor'),

    //Route pour afficher tous les commentaires de la BDD
    new Route('/comment/all', 'CommentController', 'showAll'),
    //Route pour afficher tous les commentaires d'un livre
    new Route('/comment/search', 'CommentController', 'showComment'),
    //Route pour afficher la moyenne d'un livre
    new Route('/rate/search', 'CommentController', 'avgRate'),
    //Route pour ajouter un commentaire et une note à une livre par rapport à un user
    new Route('/comment/add', 'CommentController', 'addRate'),


    //Route pour afficher toutes les catégories de la BDD
    new Route('/category/all', 'CategoryController', 'showAll'),
    //Route pour afficher une catégorie par rapport à son nom
    new Route('/category/search', 'CategoryController', 'showCategory'),
    //Route pour ajouter une categorie
    new Route('/category/add', 'CategoryController', 'addCategory'),
    //Route pour supprimer une category
    new Route('/category/delete', 'CategoryController', 'deleteCategory'),


    //Route pour afficher toutes les éditions de la BDD
    new Route('/edition/all', 'EditionController', 'showAll'),
    //Route pour afficher d'une édition par rapport à son nom
    new Route("/edition/search", 'EditionController', 'showEdition'),
    //Route pour ajouter une édition
    new Route("/edition/add", 'EditionController', 'addEdition'),
    //Route pour supprimer une édition
    new Route('/edition/delete', 'EditionController', 'deleteEdition'),


    //Route pour afficher la whishlist d'un utilisateur
    new Route('/whishlist', 'WhishlistController', 'showWhislist'),
    
    
    //Route pour l'utilisateur
    new Route('/user', 'UserController', 'showUser'),
];

$url = parse_url($_SERVER['REQUEST_URI'])['path'];


try{
    foreach($routes as $route){
        if($route->match($url)){
            $route->run();
            break;
        }
    }
}
catch(MyException $e){
    echo json_encode([
        'Error: ' => $e->getMessage(),
        'Code' => $e->getCode(),
        'More Infos' => [
            'File' => $e->getFile(),
            'Line' => $e->getLine(),
        ]
    ]);
}



