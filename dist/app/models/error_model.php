<?php

class Error_Model extends Model
{

  public function __construct()
  {
    parent::__construct();
  }

  function connection()
  {
    // QUERY
    //sql, data (array to bind), association
    // $sql = 'SELECT * FROM testTemp WHERE id = :bump';
    // $data = array(':bump' => 3);
    // return $this->db->select($sql, $data);

    //INSERT
    //table, data (array to bind)
    // $table = 'testTemp';
    // $data = array(
    //           'desc' => 'This is an inserted description',
    //           'name' => 'This is a name'
    //         );
    //
    // return $this->db->insert($table, $data);

    //UPDATE
    // table, data (array), where
    // $table = 'testTemp';
    // $data = array(
    //           'desc' => 'BOOM UPDATE',
    //           'name' => 'DOUBLE BOOM'
    //         );
    // $fakeId = 2;
    // $where = 'id = ' . $fakeId;
    // return $this->db->update($table, $data, $where);

  }
}
