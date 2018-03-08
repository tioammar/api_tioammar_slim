<?php
require_once __DIR__.'/../model/Blog.php';
require_once __DIR__.'/../model/User.php';

class BlogController {

  private $blog;

  const ALL = "all";
  const SINGLE = "single";

  function userData($user){
     return $user_data = array(
      "id" => $user->id,
      "firstName" => $user->firstName,
      "lastName" => $user->lastName,
      "avatar" => $user->avatar
    );
  }

  function blogData($blog, $user_data){
    return $blog_data = array(
      "id" => $blog->id,
      "title" => $blog->title,
      "datetime" => $blog->datetime,
      "content" => $blog->content,
      "picture" => $blog->picture,
      "author" => $user_data,
      "readcount" => $blog->readcount,
      "tag" => $blog->tag
    );
  }

  function all($count){
    $blogs = Blog::getAll($count);
    $blogs_data = array();
    $user_data = $this->userData(User::get($blogs[0]->author));
    $i = 0;
    foreach($blogs as $blog){
      $blog_data = $this->blogData($blog, $user_data);
      $blogs_data[$i] = $blog_data;
      $i++;
    }
    $data = array("blog" => $blogs_data);
    return json_encode($data);
  }

  function single($id){
    $blog = Blog::get($id);
    $user_data = $this->user(User::get($blog->author));
    $blog_data = $this->blogData($blog, $user_data);
    $data = array("user" => $user_data, "blog" => $blog_data);
    return json_encode($data);
  }

  // if multiple use BlogController::ALL, $count
  // if single use BlogController::SINGLE, $count (in this case == null), and blog's id
  function get($type, $count, $id = null){
    if($type == self::ALL){
      return $this->all($count);
    } else if ($type == self::SINGLE){
      return $this->single($id);
    } else return json_encode("null");
  }
}
?>