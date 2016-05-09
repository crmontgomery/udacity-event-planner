<?php

class Login_Model extends Model {

  function __construct()
  {
    parent::__construct();
  }

  public function run()
  {
    try {
      //$username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $query = $this->db->prepare("SELECT id, username, firstName, lastName, email, password, userRoleId FROM user WHERE email = :email");
      $query->bindParam(':email', $email);
      $query->execute();
      $data = $query->fetch();

      // Validates user password
      if (password_verify($password, $data['password'])) {
        Session::init();
        Session::set('role', $data['userRoleId']);
        Session::set('loggedIn', true);
        Session::set('userId', $data['id']);
        Session::set('username', $data['username']);
        Session::set('firstName', $data['firstName']);
        Session::set('lastName', $data['lastName']);
        Session::set('email', $data['email']);

        $insert = $this->db->prepare('INSERT INTO userLog (loginDateTime, user_id) VALUES (:loginDateTime, :id)');
        $insert->bindParam(':loginDateTime', date('Y-m-d H:i:s'));
        $insert->bindParam(':id', $data['id']);
        $insert->execute();
        
        // returns the url for the jquery to redirect the user to the desired page
        echo URL;
        
      } else {
        header('HTTP/1.1 500 Internal Server Error: Login ');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('There was an error logging you in.' => 'ERROR', 'code' => 1337)));
      }
    } catch(Exception $e) {
      //echo 'Sorry, an error has occured with your login. Please try again.' . $e;
      return $e;
    }
  }

  public function getUserRoleList()
  {
    $query = $this->db->prepare('SELECT * FROM userRole');
    $query->execute();

    return $query->fetchAll();
  }

}
