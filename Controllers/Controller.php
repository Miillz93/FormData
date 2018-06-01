<?php
require_once './Model/Model.php';

class Controller{
    
    private $db;
    
    public function __construct(){
        // Instatiate model
        $this->db = new Model();
        
    }
    
    //Load view
    public function view($view, $data = []){
        //check for view file
        if(file_exists('./views/'.$view.'.php')):
            require_once './views/'.$view.'.php';
            else:
            //View doesnt exist
            die('View don\'t exist');
        endif;
    }
    
    /*
    *Load Model
    *Check Data
    *Load View
    **/
    public function index(){
        
        //Check witch Method is request
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            
            //sanitize Post Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            //Init Data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'birthday' => $_POST['birthday'],
                'gender' => $_POST['gender'],
                'requestDate' => $_SERVER['REQUEST_TIME'],
                'email_err' => '',
                'error' => ''
            ];
            
            
            
            
            //Format Date
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
            //$data['requestDate'] = date('Y-m-d', strtotime($data['requestDate']));;
            $data['requestDate'] = gmdate("Y-m-d", $data['requestDate']);
            
            //Check empty fields
            if(empty($data['name']) || empty($data['email']) || empty($data['birthday'])){
                $data['error'] = 'Please Fill All This Field';
                $this->view('acceuil',$data);
            };
            
            //
            if(isset($data['name']) && isset($data['email']) && isset($data['birthday'])){
    
                //Validate Email
                if($this->db->checkEmail($data)){
                    $data['email_err'] = 'Your email is already used!';
                    $this->view('acceuil', $data);
                }else{
                    //Insert Data
                    $this->db->insertData($data);
                    $this->view('subscribe', $data);
                }
                
            };
            
            
            
         
            
            else:
            //require_once './views/acceuil.php';
            //Init Data
            $data = [
                'name' => '',
                'email' => '',
                'birthday' => '',
                'gender' => '',
                'name_err' => '',
                'error' => '',
                'email_err' => ''
            ];
            
            $this->view('acceuil', $data);
            
        endif;
        
        
    }
}