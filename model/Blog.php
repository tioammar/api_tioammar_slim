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

  private static function fetch($rows){
    $blogs = array();
    $i = 0; // for array index;
    while($r = $rows->fetch_array()){
      $blog = new Blog();
      $blog->id = $r['id'];
      $blog->title = $r['title'];
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

  static function get($id){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $Q = "SELECT * FROM blog WHERE `id` = $id";
    $blogs = self::fetch($mysqli->query($Q));
    return $blogs[0];
  }

  static function getAll($count){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $Q = "SELECT * FROM blog LIMIT $count";
    return self::fetch($mysqli->query($Q));
  }
}
?>