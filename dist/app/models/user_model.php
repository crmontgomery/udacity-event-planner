<?php

class User_Model extends Model {

    function __construct()
    {
        parent::__construct();
    }

    // Create
    function createUser()
    {
        try{
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $table = 'user';
            $data = array(
                    'username'   => $_POST['name'],
                    'firstName'  => '',
                    'lastName'   => '',
                    'email'      => $_POST['email'],
                    'phone'      => '555.555.5555',
                    'password'   => $password,
                    'active'     => 1,
                    'userRoleId' => 2, //read and write (not implemented yet)
                    'employer'   => $_POST['employer'],
                    'jobTitle'   => $_POST['jobTitle']
                    );

            $this->db->insert($table, $data);
            $userId = $this->db->lastInsertId();

            echo $userId;
        } catch(Exception $e){
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('There was a problem with adding the user.' => 'ERROR', 'code' => 0117)));
        }
    }

    // Read
    function getUser($id = NULL)
    {
        $userId = ($id != null ? $id : Session::get('userId'));

        $sql = 'SELECT a.id, a.username, a.firstName, a.lastName, a.phone, a.email,
                            b.id as roleId, b.name as role, b.description as roleDesc
                FROM user a
                RIGHT JOIN userRole b
                ON a.userRoleId = b.id
                WHERE a.id = :id';
        $data = array(
                    'id' => $userId
                );

        return $this->db->select($sql, $data);
    }

    function getAllUsers()
    {
        $sql = 'SELECT * FROM user';

        return $this->db->select($sql);
    }

    function getUserRoles()
    {
        $sql = 'SELECT * FROM userRole';

        return $this->db->select($sql);
    }

    function userExists($email)
    {
        try {
            $userEmail = $email;

            $sql = 'SELECT id, email FROM user WHERE email = :email';
            $data = array(
                    'email' => $userEmail
                    );

            $results = $this->db->select($sql, $data);
            
            if(!empty($results)){
                header('HTTP/1.1 500 Internal Server Error: Email');
                header('Content-Type: application/json; charset=UTF-8');
                die(json_encode(array('Sorry, please choose another email.' => 'ERROR', 'code' => 0117)));
            }
            
        } catch(Exception $e){
            echo $e;
        }

    }

    // Update
    function updateUser($id = null)
    {
        $userId = ($id != null ? $id : Session::get('userId'));
        try {
            $table = 'user';
            $data = array(
                    'id' => $userId,
                    'username'   => $_POST['username'],
                    'firstName'  => $_POST['firstName'],
                    'lastName'   => $_POST['lastName'],
                    'email'      => $_POST['email'],
                    'phone'      => $_POST['phone'],
                    'active'     => $_POST['active'],
                    'userRoleId' => $_POST['role']
                    );
            $where = 'id = :id ';

            $this->db->update($table, $data, $where);
        } catch(Exception $e){
            echo $e;
        }
    }

    function updatePassword($id = null)
    {
        $userId = ($id != null ? $id : Session::get('userId'));
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        try {
            $table = 'user';
            $data = array(
                    'id'       => $userId,
                    'password' => $password,
                    );
            $where = 'id = :id';

            $this->db->update($table, $data, $where);
        } catch(Exception $e){
            echo $e;
        }
    }

    // Delete
    function deleteUser()
    {
        // TODO: Add functionality for admin
    }
}
