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

  public function create()
  {
    $data['title'] = 'Tambah Kategori';
    $data['content'] = 'masterData/category/create';

    $this->load->view('layouts/master', $data);
  }

  public function store()
  {
    $this->form_validation->set_rules('name', 'Nama Kategori', 'required|is_unique[categories.name]');

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Tambah Kategori';
      $data['content'] = 'masterData/category/create';

      $this->load->view('layouts/master', $data);
    } else {
      $this->category_model->store();
      redirect('master-data/kategori');
    }
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