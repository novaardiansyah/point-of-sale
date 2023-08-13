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

  public function edit($id)
  {
    $data['title'] = 'Edit Kategori';
    $data['content'] = 'masterData/category/edit';
    $data['category'] = $this->category_model->get_by_id($id);

    $this->load->view('layouts/master', $data);
  }

  public function update($id)
  {
    $this->form_validation->set_rules('name', 'Nama Kategori', 'required|is_unique[categories.name]');

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Edit Kategori';
      $data['content'] = 'masterData/category/edit';
      $data['category'] = $this->category_model->get_by_id($id);

      $this->load->view('layouts/master', $data);
    } else {
      $this->category_model->update($id);
      redirect('master-data/kategori');
    }
  }

  public function delete($id)
  {
    $this->category_model->delete($id);
    redirect('master-data/kategori');
  }

}