<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Category extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function list_category($param = [])
  {
    if (empty($param)) return ['status' => false, 'recordsTotal' => 0, 'recordsFiltered' => 0, 'data' => []];
    if (is_array($param)) $param = (object) $param;

    $result = $this->db->query("SELECT a.id, a.uid, a.name, a.parent_id, a.icon, b.name AS parent_name 
    FROM categories AS a 
      LEFT JOIN categories AS b ON a.parent_id = b.id
      WHERE a.is_deleted != 1 $param->searchQuery
    $param->sort_by LIMIT $param->length OFFSET $param->start")->result();
    lasq($this->db->last_query(), 1);

    $count = $this->db->query("SELECT COUNT(*) AS total FROM categories AS a 
      LEFT JOIN categories AS b ON a.parent_id = b.id
    WHERE a.is_deleted != 1")->row();
    lasq($this->db->last_query(), 2);

    return dataTableResponse(['total' => $count->total, 'data' => $result, 'request' => $param]);
  }
}