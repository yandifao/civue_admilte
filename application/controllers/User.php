<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    
    function __construct(){
        parent::__construct();
         $this->load->model('user_model','user');
       
	}
	
    public function index(){
        $this->load->view('template/header2');
        $this->load->view('template/sidebar');
        $this->load->view('users/index');
        $this->load->view('template/footer2');
	}
	
     function showAll(){
       $query=  $this->user->showAll();
             if($query){
                   $result['users']  = $this->user->showAll();
             }
        echo json_encode($result);
	}
	
     function addUser(){
		$config = array(
        array('field' => 'firstname',
              'label' => 'Firstname',
              'rules' => 'trim|required'
             ),
             array('field' => 'lastname',
              'label' => 'Lastname',
              'rules' => 'trim|required'
             ),
             array('field' => 'gender',
              'label' => 'Gender',
              'rules' => 'required'
             ),
             array('field' => 'birthday',
              'label' => 'Birthday',
              'rules' => 'trim|required'
             ),
             array('field' => 'email',
              'label' => 'Email',
              'rules' => 'trim|required'
             ),
               array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'trim|required'
               ),
        array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'trim|required'
        )
	);
	$this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'firstname'=>form_error('firstname'),
                'lastname'=>form_error('lastname'),
                'gender'=>form_error('gender'),
                'birthday'=>form_error('birthday'),
                'email'=>form_error('email'),
                'contact'=>form_error('contact'),
                'address'=>form_error('address')
            );
            
        }else{
				$images =  date("Y-m-d-His").$_FILES['file']['name'];
				if (move_uploaded_file($_FILES["file"]["tmp_name"], "assets/img/upload/".$images)) {
					$this->image = $images;
				}else {
					$this->image = 'default.jpg';
				}
                $data = array(
                'firstname'=> $this->input->post('firstname'),
                'lastname'=> $this->input->post('lastname'),
                'gender'=> $this->input->post('gender'),
                'birthday'=> $this->input->post('birthday'),
                'email'=> $this->input->post('email'),
                'contact'=> $this->input->post('contact'),
                'address'=> $this->input->post('address'),
                'image'=> $this->image
                
            );
            if($this->user->addUser($data)){
               $result['error'] = false;
                $result['msg'] ='User added successfully';
            }
            
        }
        echo json_encode($result);
    }

     function updateUser(){		
         $config = array(
        	array('field' => 'firstname',
              'label' => 'Firstname',
              'rules' => 'trim|required'
             ),
             array('field' => 'lastname',
              'label' => 'Lastname',
              'rules' => 'trim|required'
             ),
             array('field' => 'gender',
              'label' => 'Gender',
              'rules' => 'required'
             ),
             array('field' => 'birthday',
              'label' => 'Birthday',
              'rules' => 'trim|required'
             ),
             array('field' => 'email',
              'label' => 'Email',
              'rules' => 'trim|required'
             ),
			array(
				'field' => 'contact',
				'label' => 'Contact',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required'
			)
	);
	$this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                 'firstname'=>form_error('firstname'),
                'lastname'=>form_error('lastname'),
                'gender'=>form_error('gender'),
                'birthday'=>form_error('birthday'),
                'email'=>form_error('email'),
                'contact'=>form_error('contact'),
                'address'=>form_error('address')
            );
            
        }else{
		  $id = $this->input->post('id');
		  $images =  date("Y-m-d-His").$_FILES['file']['name'];
		  if (move_uploaded_file($_FILES["file"]["tmp_name"], "assets/img/upload/".$images)) {
			$this->image = $images;
		  }else {
			$this->image = $this->input->post('image');
		  }
          $data = array(
                   'firstname'=> $this->input->post('firstname'),
                'lastname'=> $this->input->post('lastname'),
                'gender'=> $this->input->post('gender'),
                'birthday'=> $this->input->post('birthday'),
                'email'=> $this->input->post('email'),
                'contact'=> $this->input->post('contact'),
                'address'=> $this->input->post('address'),
                'image'=> $this->image
            );
                if($this->user->updateUser($id,$data)){
                    $result['error'] = false;
                    $result['success'] = 'User updated successfully';
                }
       
    }
          echo json_encode($result);
	 }
	 
    function deleteUser(){
         $id = $this->input->post('id');
		 $this->_deleteImage($id);
        if($this->user->deleteUser($id)){
             $msg['error'] = false;
            $msg['success'] = 'User deleted successfully';
        }else{
             $msg['error'] = true;
        }
        echo json_encode($msg);
         
	}
	
    function searchUser(){
         $value = $this->input->post('text');
          $query =  $this->user->searchUser($value);
           if($query){
               $result['users']= $query;
           }
           
        echo json_encode($result);
         
	}
	
	private function _deleteImage($id)
	{
		$data = $this->user->getById($id);
		if ($data->image != "default.jpg") {
			$filename = explode(".", $data->image)[0];
			return array_map('unlink', glob(FCPATH."assets/img/upload/$filename.*"));
		}
	}
}
    
