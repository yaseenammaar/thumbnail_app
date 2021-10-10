<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {



	public function __construct() { 
         parent::__construct(); 
         $this->load->helper(array('form', 'url'));
         $this->load->library('encrypt');
         $this->load->library('form_validation'); 
         $this->load->library('session'); 
         $this->load->helper('cookie');
         // Please Define SerVer Path
         define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/thumbnail_app/');
 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
       if(!isset($_SESSION['is_login'])){
          return redirect('home/login');
        }else{

        $page_data=$this->db->where(["user_id"=>$_SESSION['user']['id']])->order_by('id', 'desc')->get('upload_image')->result_array();
        $title="Thumbnails - DesignPro ";
      }
        $this->load->view("crazyspects/index",["title"=>$title,"thumbnails"=>$page_data,"page"=>"home.php"]);  
	}

	public function register(){
	  if(isset($_SESSION['is_login'])){
         return redirect('home');
     }
	   $this->load->view("crazyspects/register",["title"=>"Register - DesignPro "]);  
	}

  function login(){
    $this->load->view("crazyspects/login",["title"=>"Login - DesignPro "]); 
  }
	
	public function sign_up(){
	    if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])){
	       $name=$this->input->post('name'); 
	       $phone=$this->input->post('phone'); 
	       $mail=$this->input->post('email'); 
	       $pass=$this->input->post('password'); 
	       $confirm_password=$this->input->post('confirm_password'); 
	       if($confirm_password==$pass){
	          if($this->db->where(["emailId"=>$mail])->get('tblusers')->num_rows()>0){
	            $data=["status"=>0,"err"=>"This Email Id Already Exist!"];  
	          }else{
	              $query=$this->db->insert('tblusers',['Name'=>$name,'emailId'=>$mail,'mobileNumber'=>$phone,'userPassword'=>md5($confirm_password),'regDate'=>date('Y-m-d'),"isActive"=>1]);
	              if($query){
	                $data=["status"=>1,"err"=>"Your Account Registered Successfully!"];     
	              }else{
	               $data=["status"=>0,"err"=>"Sorry! We Can't Available to handle this request try again later!"];   
	              }
	          } 
	       }else{
	           $data=["status"=>0,"err"=>"Please Enter Both Password Same!"];
	       }
	       
	    }else{
	      $data=["status"=>0,"err"=>"Input Data Missing"];   
	    }
	    echo json_encode($data);
	}
    public function profile(){
     if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
     $this->load->view("crazyspects/profile.php",["title"=>"Profile Details - DesignPro ","page"=>"profile.php"]);   
    }
    
    public function sign_in(){
        if(isset($_POST['email']) and isset($_POST['password'])){
         $phone=$this->input->post('email'); 
         $pass=$this->input->post('password');
         $data=$this->db->where(["emailId"=>$phone,"userPassword"=>md5($pass)])->get('tblusers');
         if($data->num_rows()>0){
            $user=$data->result_array();
            if($user[0]['is_bann']==1){
                $data=["status"=>0,"err"=>"Your Account Is Banned Please Contact to Admin"];
                echo json_encode($data);
                exit();
            }
            $_SESSION['user']=$user[0];
            $_SESSION['is_login']=true;
            $data=["status"=>1,"err"=>"Welcome Back ".$_SESSION['user']['Name']."!"];
            $this->db->where('id',$_SESSION['user']['id'])->update('tblusers',["last_login"=>time()]);
         }else{
            $data=["status"=>0,"err"=>"You entered wrong Details"];  
         }
        }else{
          $data=["status"=>0,"err"=>"Input Data Missing"];  
        }
        echo json_encode($data);
    }

    public function update_profile(){
     if(isset($_POST['name'])){
      $update['Name']=$this->input->post('name'); 
      $update['emailId']=$this->input->post('email'); 
      $update['mobileNumber']=$this->input->post('mobile'); 
      $update['lastUpdationDate']=date('Y-m-d');
      $config['file_name'] = time().'-'.$_FILES["image"]['name'];
      $config['upload_path' ]  = 'uploads/profile/'; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ( ! $this->upload->do_upload('image')) {
        $data=["status"=>0,"err"=>$this->upload->display_errors()];
      }else{ 
        $update['profile'] = $this->upload->file_name;
      }
      $this->db->where('id',$_SESSION['user']['id'])->update('tblusers',$update);
      $userdata=$this->db->where('id',$_SESSION['user']['id'])->get('tblusers')->result_array();
      $_SESSION['user']=$userdata[0];
      $data=["status"=>1,"err"=>"Profile Updated!"];
    }else{
      $data=["status"=>0,"err"=>"Required Field Missing!"];
    }
    echo json_encode($data);
    }

    public function logout(){
      $this->session->sess_destroy();
      return redirect('home');
    }
    public function create_thumbnail(){
      if(!isset($_SESSION['is_login'])){
         return redirect('home');
     }
        unset($_SESSION['is_view_temp']);
        $title="Create Thumbnail - DesignPro ";
        $this->load->view("crazyspects/create_thumb",["title"=>$title,"page"=>"thumbnail.php"]); 
    } 

    public function manage_ajax(){
      $data['status']=1;
      if(!isset($_FILES["file"]['name'])){
        $data=["status"=>0,"err"=>"Please Select Thumbnail File"];
        echo json_encode($data);
        die();
      }
      $config['file_name'] = time().'-'.$_FILES["file"]['name'];
      $config['upload_path' ]  = 'uploads/thumbnails/'; 
      $config['allowed_types'] = 'gif|jpg|png'; 
      $this->load->library('upload', $config);
      $this->upload->initialize($config);
      if ( ! $this->upload->do_upload('file')) {
        $data=["status"=>0,"err"=>$this->upload->display_errors()];
      }else{ 
        $res['thumbnail'] = base_url('uploads/thumbnails/'.$this->upload->file_name);
        $insert['thumbnail']=$this->upload->file_name;
        $insert['user_id']=$_SESSION['user']['id'];
        $this->db->insert('upload_image',$insert);
        $data=["status"=>1,"err"=>$res['thumbnail']];
      }
      echo json_encode($data);
     }

     public function upload_image(){
      if(isset($_POST['image'])){
    define('UPLOAD_DIR', 'uploads/thumbnails/');
    $image_parts = explode(";base64,", $_POST['image']);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $filename="Thumbnail". uniqid();
    $file = SERVER_PATH .UPLOAD_DIR. $filename . '.png';
    if(file_put_contents($file, $image_base64)){
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'uploads/thumbnails/'.$filename . '.png';
        $config['quality'] = '40%';
        $config['new_image'] = 'uploads/thumbnails/'.$filename . '.png';
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
     if(isset($_SESSION['last_id']) && $_SESSION['last_id']!=""){
     $id=$_SESSION['last_id'];
     $insert['thumbnail']=$filename.'.png';
     $insert['name']=$filename;
     $this->db->where('id',$id)->update('upload_image',$insert);
     $this->session->unset_userdata('last_id');
     
     $data=["status"=>1,"filename"=>$filename,"loc"=>base_url()];
   }else{
    $data=["status"=>0];
   }
    }else{
      $data=["status"=>0];
    }
      }else{
        $data=["status"=>0];
      }
      echo json_encode($data);
     }

     public function delete_thumbnail($id){
      echo "Please Wait...";
       if($id!=""){
        $thumbnail=$this->db->where('id',$id)->get('upload_image')->result_array();
        if(count($thumbnail)>0){
          unlink(SERVER_PATH.'uploads/thumbnails/'.$thumbnail[0]['thumbnail']);
          $this->db->where('id',$thumbnail[0]['id'])->delete('upload_image');
        }
        return redirect('home');
       }else{
        return redirect('home');
       }
     }
     public function upload_json(){
         $serverpath=SERVER_PATH.'uploads/';
         $json=json_decode($_POST['json']);
        foreach($json->pages as $key=>$page){
           foreach($page->children as $id=>$child){
              if($child->type=='image'){
               $url = $child->src; 
               $newurl='pixabay'.rand(11111,99999).'.png';
               file_put_contents($serverpath.$newurl, file_get_contents($url));
               $child->src=base_url('uploads/'.$newurl);
              }
           } 
        }
        $_POST['json']=json_encode($json);
      if(isset($_POST['json'])){
        $insert['time']=time();
        $insert['user_id']=$_SESSION['user']['id'];
        $insert['json']=$this->input->post('json');
        if(isset($_SESSION['thumbnail_edits'])){
        $this->db->where('id',$_SESSION['thumbnail_edits'])->update('upload_image',$insert);
        $_SESSION['last_id']=$_SESSION['thumbnail_edits'];
        unset($_SESSION['thumbnail_edits']);
        }else{
        $this->db->insert('upload_image',$insert);
        $_SESSION['last_id']=$this->db->insert_id();
        
        }
         echo true;
      }
     }

     public function templates(){
      $page=$_GET['page'];
        $start=0;
        $query="";
        $end=30;
        if($page>1){
          $start=30*$page;
          $end=$start-30;
        }
        if($_SESSION['user']['is_pro']==0){
        $query="and is_paid='0'";
        }
      $templates=$this->db->query("select * from upload_image where  user_id='1' and thumbnail!='' {$query} order by id desc limit {$start},{$end}")->result_array();
      $data['hits']=count($templates);
      if(count($templates)<1){
            // echo '0';
            die();
        }
        
      foreach($templates as $key=>$template){
        if($_SESSION['user']['is_pro']==0 && $template['user_id']!=$_SESSION['user']['id']){
            if($template['is_paid']==1){
              $data['hits']=$data['hits']-1;
              continue;
            }
        }
        if($template['thumbnail']==""){
              continue;
            }
        $da['json']=base_url('home/get_template/'.$template['id']);
        $da['preview']=base_url('uploads/thumbnails/'.$template['thumbnail']);
        $data['items'][]=$da;
      }
      if(isset($data['items'])){
      echo json_encode($data);
      }
     }
     
     public function Your_templates(){
        $page=$_GET['page'];
        $start=0;
        $end=30;
        if($page>1){
          $start=30*$page;
          $end=$start-30;
        }
        $templates=$this->db->query("select * from upload_image where user_id='".$_SESSION['user']['id']."' order by id desc limit {$start},{$end}")->result_array();
        $data['hits']=count($templates);
        if(count($templates)<1){
            // echo '0';
            die();
        }
      foreach($templates as $key=>$template){
        if($_SESSION['user']['is_pro']==0 && $template['user_id']!=$_SESSION['user']['id']){
            if($template['is_paid']==1){
              $data['hits']=$data['hits']-1;
              continue;
            }
            
        }
        if($template['thumbnail']==""){
              continue;
            }
        $da['json']=base_url('home/get_template/'.$template['id']);
        $da['preview']=base_url('uploads/thumbnails/'.$template['thumbnail']);
        $data['items'][]=$da;
      }
      echo json_encode($data);
     }

     public function get_template($id){
      if($id!=""){
       $templates=$this->db->where('id',$id)->get('upload_image')->result_array();
       if($templates[0]['user_id']==$_SESSION['user']['id']){
       $_SESSION['thumbnail_edits']=$id;
       
       }
       echo $templates[0]['json']; 
      }
     }
     
     public function change_template_type($id){
        $template=$this->db->where('id',$id)->get('upload_image')->result_array();
        if(count($template)>0){
         if($template[0]['is_paid']==1){
             $data['is_paid']=0;
         }else{
            $data['is_paid']=1;  
         }
         $this->db->where('id',$id)->update('upload_image',$data);
         
        }
        return redirect('home');
     }
     
     public function manage_users(){
         if($_SESSION['user']['is_admin']==1){
           $this->load->view("crazyspects/users",["title"=>"Manage Users - DesignPro ","page"=>"users.php"]);  
         }else{
             return redirect('home');
         }
     }
     public function change_user_status($uid){
        if($_SESSION['user']['is_admin']==1){
          $user=$this->db->where('id',$uid)->get('tblusers')->result_array();
          if(count($user)>0){
              if($user[0]['is_pro']==1){
                  $data['is_pro']=0;
              }else{
                 $data['is_pro']=1; 
              }
            $this->db->where('id',$uid)->update('tblusers',$data);
            
          }
          return redirect('home/manage_users'); 
        }else{
          return redirect('home');  
        } 
     }
     
     public function change_block_status($uid){
        if($_SESSION['user']['is_admin']==1){
          $user=$this->db->where('id',$uid)->get('tblusers')->result_array();
          if(count($user)>0){
              if($user[0]['is_bann']==1){
                  $data['is_bann']=0;
              }else{
                 $data['is_bann']=1; 
              }
            $this->db->where('id',$uid)->update('tblusers',$data);
            
          }
          return redirect('home/manage_users'); 
        }else{
          return redirect('home');  
        } 
     }
     
     public function upload_pdf(){
      if(isset($_POST['image'])){
    define('UPLOAD_DIR', 'uploads/thumbnails/');
    $image_parts = explode(";base64,", $_POST['image']);
    $image_parts1 = explode(";base64,", $_POST['thumbnail']);
    // $image_type_aux = explode("image/", $image_parts[0]);
    // $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $filename="ebook". uniqid();
    $file = SERVER_PATH .UPLOAD_DIR. $filename . '.pdf';
    if(file_put_contents($file, $image_base64)){
     $image_base64png = base64_decode($image_parts1[1]);
     $filename1="thumbnail". uniqid();
     $file1 = SERVER_PATH .UPLOAD_DIR. $filename1 . '.png';
     file_put_contents($file1, $image_base64png);
     if(isset($_SESSION['last_id']) && $_SESSION['last_id']!=""){
     $id=$_SESSION['last_id'];
     $insert['thumbnail']=$filename1.'.png';
     
     $insert['pdf']=$filename.'.pdf';
     $insert['name']=$filename;
     $this->db->where('id',$id)->update('upload_image',$insert);
     $this->session->unset_userdata('last_id');
     
     $data=["status"=>1,"filename"=>$filename,"loc"=>base_url()];
   }else{
    $data=["status"=>0];
   }
    }else{
      $data=["status"=>0,"err"=>"File can't saved"];
    }
      }else{
        $data=["status"=>0];
      }
      echo json_encode($data);
     }
     
     public function mock_up(){
         if(!isset($_SESSION['is_login'])){
         return redirect('home');
         }
        $title="Mock up - DesignPro ";
        $this->load->view("crazyspects/mock",["title"=>$title,"page"=>"mock.php"]); 
    }
    public function filter(){
       if(!isset($_SESSION['is_login'])){
         return redirect('home');
         }
        $title="Mock up - DesignPro ";
        $this->load->view("crazyspects/filter",["title"=>$title,"page"=>"filter.php"]);  
    }
    
}

      
