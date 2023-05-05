<?php
session_start();

function custom_autoloader($className){
    //va automatiquement charger toutes les classes dans le dossier lib
    // Si les fichiers ont le même nom que la classe
    include 'src/' .$className . '.php';
}
spl_autoload_register('custom_autoloader');