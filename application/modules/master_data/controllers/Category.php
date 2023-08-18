<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Category', 'Category');
  }

  public function index()
  {
    secure_access();

    $data = [
      'breadcrumb' => [
        'title' => 'List Kategori',
        'content' => [
          ['title' => 'Master Data', 'url' => base_url('master-data/kategori')],
          ['title' => 'Kategori', 'is_active' => true]
        ]
      ],
    ];

    view('master_data.category.list', $data);
  }

  public function list_category()
  {
    $result = $this->Category->list_category(dataTable());
    json($result);
  }

  public function dropdown_category()
  {
    $result = $this->Category->dropdown_category($_GET);
    json($result);
  }

  public function add_category()
  {
    $rules = [
      ['field' => 'name', 'label' => 'nama kategori', 'rules' => 'trim|required']
    ];
    $validate = form_validate($rules);
    if ($validate['status'] == false) return json($validate);

    $image_path     = 'master_data/category';
    $icon_name      = $_FILES['icon']['name'] ?? '';
    $is_icon_change = 0;

    if ($icon_name != '') {
      $upload = upload_image('icon', $image_path);
      if ($upload['status'] == false) return json($upload);
      else {
        $icon_name      = $upload['file_name'];
        $is_icon_change = 1;
      }
    }

    $send = [
      'name'           => post('name'),
      'parent_uid'     => post('parent_uid'),
      'icon'           => $icon_name,
      'is_icon_change' => $is_icon_change
    ];
    $result = $this->Category->add_category($send);

    if ($result['status'] == false) {
      remove_image($icon_name, $image_path);
      return json($result);
    }
    
    return json($result);
  }

  public function edit_category()
  {
    $result = $this->Category->edit_category(['uid' => post('uid')]);
    json($result);
  }

  public function update_category()
  {
    $rules = [
      ['field' => 'name', 'label' => 'nama kategori', 'rules' => 'trim|required']
    ];
    $validate = form_validate($rules);
    if ($validate['status'] == false) return json($validate);

    $image_path     = 'master_data/category';
    $icon_name      = $_FILES['icon']['name'] ?? '';
    $is_icon_change = 0;

    if ($icon_name != '') {
      $upload = upload_image('icon', $image_path);
      if ($upload['status'] == false) return json($upload);
      else {
        $icon_name      = $upload['file_name'];
        $is_icon_change = 1;
      }
    }

    $send = [
      'uid'            => post('uid'),
      'name'           => post('name'),
      'parent_uid'     => post('parent_uid'),
      'icon'           => $icon_name,
      'is_icon_change' => $is_icon_change
    ];
    
    $result = $this->Category->update_category($send);

    if ($result['status'] == false) {
      remove_image($icon_name, $image_path);
      return json($result);
    }

    if ($is_icon_change == 1) {
      $old_icon = $result['data']->icon;
      remove_image($old_icon, $image_path);
    }
    
    return json($result);
  }
}