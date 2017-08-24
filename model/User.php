<?php
class User {

  public $id;
  public $firstName;
  public $lastName;
  public $email;
  public $password;
  public $avatar;

  static function getUser($id){
    $mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
    $Q = "SELECT * FROM user WHERE `id` = $id";
    $rows = $mysqli->query($Q);
    if($r = $rows->fetch_array()){
      $user = new User;
      $user->id = $r['id'];
      $user->firstName = $r['first_name'];
      $user->lastName = $r['last_name'];
      $user->email = $r['email'];
      $user->avatar = $r['avatar'];
      return $user;
    } else return null;
  }
}
?>