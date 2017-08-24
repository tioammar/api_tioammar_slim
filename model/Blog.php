<?php
require_once 'User.php';
require_once __DIR__."/../config.php";

class Blog {

  public $id;
  public $title;
  public $datetime;
  public $content;
  public $picture;
  public $author;
  public $readcount;
  public $tag;
  public $mysqli;

  static function getSingleBlog($id){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $Q = "SELECT * FROM blog WHERE `id` = $id";
    $rows = $mysqli->query($Q);
    if($r = $rows->fetch_array()){
      $blog = new Blog();
      $blog->id = $r['id'];
      $blog->tille = $r['title'];
      $blog->datetime = $r['datetime'];
      $blog->content = $r['content'];
      $blog->picture = $r['picture'];
      $blog->author = $r['author'];
      $blog->readcount = $r['readcount'];
      $blog->tag = $r['tag'];
      return $blog;
    } else return null;
  }

  static function getMultipleBlog($count){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $blogs = array();
    $Q = "SELECT * FROM blog LIMIT $count";
    $rows = $mysqli->query($Q);
    $i = 0; // for array index;
    while($r = $rows->fetch_array()){
      $blog = new Blog();
      $blog->id = $r['id'];
      $blog->tille = $r['title'];
      $blog->datetime = $r['datetime'];
      $blog->content = $r['content'];
      $blog->picture = $r['picture'];
      $blog->author = $r['author'];
      $blog->readcount = $r['readcount'];
      $blog->tag = $r['tag'];
      $blogs[$i] = $blog;
      $i++;
    }
    if(count($blogs) != 0){
      return $blogs;
    } else return null;
  } 
}
?>