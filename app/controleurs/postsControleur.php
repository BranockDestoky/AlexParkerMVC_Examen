<?php
/*
  ../app/controleurs/postsControleur
*/

namespace App\Controleurs\PostsControleur;
use \App\Modeles\PostsModele;
/**
 * [IndexAction description]
 * @param PDO $connexion [description]
 */
// INDEX ACTION
function IndexAction(\PDO $connexion){
  //Je met dans $posts  la liste des 10 derniers postsque je demande au modèles */
  include_once '../app/modeles/postsModele.php';
  $posts = PostsModele\findAll($connexion);

  /*On charge la vue posts/index dans $content*/
  GLOBAL $content,$title;
  $title = "BLOG";
  ob_start();
    include '../app/vues/posts/index.php';
  $content = ob_get_clean();
}


// SHOW ACTION
function showAction(\PDO $connexion, int $id) {
  // je met dans $post les infos du post que je demande au modèle
include_once '../app/modeles/postsModele.php';
$post = PostsModele\findOneById($connexion, $id);

// je charge la vue show dans $content
GLOBAL $content,$title;
$title = $post['title'];
ob_start();
  include '../app/vues/posts/show.php';
$content = ob_get_clean();
}


// Affiche le formulaire d'ajout d'un post
function addFormAction(\PDO $connexion) {
  include_once '../app/modeles/categoriesModele.php';
  $categories = \App\Modeles\CategoriesModele\findAll($connexion);

  GLOBAL $content;
  ob_start();
    include '../app/vues/posts/addForm.php';
  $content = ob_get_clean();
}

//ajoute un post suite au formulaire
function addAction(\PDO $connexion) {


  //je demande au modèle d'ajouter le poste
  include_once '../app/modeles/postsModele.php';
  $id = \App\Modeles\PostsModele\insert($connexion);
  //je redirige vers la liste des posts
  header('location:'. BASE_URL);
}
