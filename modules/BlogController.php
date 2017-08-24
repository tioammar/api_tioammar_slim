<?php
require_once __DIR__.'/../model/Blog.php';
require_once __DIR__.'/../model/User.php';

class BlogController {

  const MULTIPLE = "multiple";
  const SINGLE = "single";

  /* 
    This is example function for building response json data
  */
  function multipleExample(){
    // return json_encode('null'); // test response
    $blogs = array();
    for($i = 0; $i <= 10; $i++){
      $blog = array(
        "id" => $i,
        "title" => "Blog $i Title",
        "content" => "Blog $i Content",
        "author" => "Tioammar" 
      );
      $blogs[$i] = $blog;
    }
    $data = array("data" => $blogs);
    return json_encode($data);
  }

  function multiple($count){
    // $data = array("type" => "multiple");
    // return json_encode($data); // test response
    $blogs = Blog::getMultipleBlog($count);
    $blogs_data = array();
    $i = 0;
    foreach($blogs as $blog){
      $user = User::getUser($blog->author);
      $user_data = array(
        "id" => $user->id,
        "firstName" => $user->firstName,
        "lastName" => $user->lastName,
        "avatar" => $user->avatar
      );
      $blog_data = array(
        "id" => $blog->id,
        "title" => $blog->title,
        "datetime" => $blog->datetime,
        "content" => $blog->content,
        "picture" => $blog->picture,
        "author" => $user_data,
        "readcount" => $blog->readcount,
        "tag" => $blog->tag
      );
      $blogs_data[$i] = $blog_data;
      $i++;
    }
    $data = array("data" => $count, "blog" => $blogs_data);
    return json_encode($data);
  }

  function single($id){
    $blog = Blog::getSingleBlog($id);
    $user = User::getUser($blog->author);
    $user_data = array(
      "id" => $user->id,
      "firstName" => $user->firstName,
      "lastName" => $user->lastName,
      "email" => $user->email,
      "avatar" => $user->avatar
    );
    $blog_data = array(
      "id" => $blog->id,
      "title" => $blog->title,
      "datetime" => $blog->datetime,
      "content" => $blog->content,
      "picture" => $blog->picture,
      "author" => $user_data,
      "readcount" => $blog->readcount,
      "tag" => $blog->tag
    );
    $data = array("blog" => $blog_data);
    return json_encode($data);
  }

  // if multiple use BlogController::MULTIPLE, $count
  // if single use BlogController::SINGLE, $count (in this case == null), and blog's id
  function get($type, $count, $id = null){
    if($type == self::MULTIPLE){
      return $this->multiple($count);
    } else if ($type == self::SINGLE){
      return $this->single($id);
    } else return json_encode("null");
  }
}
?>