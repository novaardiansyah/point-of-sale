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

    $result = $this->db->query("SELECT a.uid, a.name, a.parent_id, a.icon, b.name AS parent_name 
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

  public function dropdown_category($param = [])
  {
    if (is_array($param)) $param = (object) $param;

    $searchQuery = isset($param->search) ? "AND (a.name LIKE '%$param->search%')" : '';

    $result = $this->db->query("SELECT a.uid, a.name AS text, a.parent_id, a.icon 
    FROM categories AS a 
      WHERE a.is_deleted != 1 $searchQuery
    ORDER BY a.name ASC LIMIT 10 OFFSET 0")->result();
    lasq($this->db->last_query(), 1);

    return ['status' => true, 'data' => $result];
  }

  public function add_category($param = [])
  {
    if (is_array($param)) $param = (object) $param;
    $now = getTimestamp();

    $result = $this->db->query("SELECT a.uid, a.name, a.icon, b.uid AS parent_uid
    FROM categories AS a 
      LEFT JOIN categories AS b ON a.parent_id = b.id
    WHERE a.is_deleted != 1 AND a.name = ? AND b.uid = ?", [$param->name, $param->parent_uid])->row();
    lasq($this->db->last_query(), 1);

    if ($result) return ['status' => false, 'message' => 'Kategori sudah ada'];

    $category = $this->db->query("SELECT id FROM categories WHERE uid = ?", [$param->parent_uid])->row();
    lasq($this->db->last_query(), 2);

    $this->db->insert('categories', [
      'uid'            => uuid(),
      'name'           => $param->name,
      'parent_id'      => $category->id ?? 0,
      'icon'           => $param->is_icon_change == 1 ? $param->icon : null,
      'is_active'      => 1,
      'is_deleted'     => 0,
      'created_at'     => $now,
      'created_by'     => base64_decode(get_session('login')['id'] ?? false) ?: 0
    ]);
    lasq($this->db->last_query(), 3);

    return ['status' => true, 'message' => 'Kategori berhasil ditambahkan'];
  }

  public function edit_category($param = [])
  {
    if (is_array($param)) $param = (object) $param;
    $now = getTimestamp();
    $uid = $param->uid ?? null;

    if ($uid == null) return ['status' => false, 'message' => 'Kategori tidak ditemukan'];

    $result = $this->db->query("SELECT a.uid, a.name, a.icon, b.uid AS parent_uid, b.name AS parent_name
    FROM categories AS a 
      LEFT JOIN categories AS b ON a.parent_id = b.id
    WHERE a.is_deleted != 1 AND a.uid = ?", [$uid])->row();
    lasq($this->db->last_query(), 1);

    if (!$result) return ['status' => false, 'message' => 'Kategori tidak ditemukan'];

    return ['status' => true, 'message' => 'Kategori Tersedia', 'data' => $result];
  }

  public function update_category($param = [])
  {
    if (is_array($param)) $param = (object) $param;
    
    $now = getTimestamp();
    
    $uid            = $param->uid ?? 0;
    $parent_uid     = $param->parent_uid;
    $name           = $param->name;
    $is_icon_change = $param->is_icon_change;
    $icon           = $param->icon;

    $result = $this->db->query("SELECT a.uid, a.name, a.icon, b.uid AS parent_uid
    FROM categories AS a 
      LEFT JOIN categories AS b ON a.parent_id = b.id
    WHERE a.is_deleted != 1 AND a.uid = ?", [$uid])->row();
    lasq($this->db->last_query(), 1);

    if (empty($result)) return ['status' => false, 'message' => 'Kategori tidak tersedia!'];

    $category = $this->db->query("SELECT id FROM categories WHERE uid = ?", [$parent_uid])->row();
    lasq($this->db->last_query(), 2);

    $this->db->update('categories', [
      'name'       => $name,
      'parent_id'  => $category->id ?? 0,
      'icon'       => $is_icon_change == 1 ? $icon : null,
      'updated_at' => $now,
      'updated_by' => base64_decode(get_session('login')['id'] ?? false) ?: 0
    ], ['uid' => $uid]);
    lasq($this->db->last_query(), 3);

    return ['status' => true, 'message' => 'Kategori berhasil diperbarui!', 'data' => $result];
  }
}