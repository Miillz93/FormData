<?php


Class Model{
    private $host = 'localhost';
    private $user = '****';
    private $pass = '****';
    private $dbname = 'newsletters';

    private $dbh;
    private $stmt;
    private $error;



    public function __construct(){
        // Set DSN
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
      $options = [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
      ];

      try{
        $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        //$this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      } catch(PDOException $e){
        $this->error = $e->getMessage();
        echo $this->error;
      }

    }

    /*
    public function query($sql){
       return $this->dbh->query($sql);
    }*/

    //Prepare statement
    public function query($sql){
        return $this->dbh->prepare($sql);
    }

    //Execute query
     public function execute(){
      return $this->stmt->execute();
    }

    // Get result set as array of objects
    /*public function resultSet(){
      $this->execute();
      return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }*/

    // Get single record
    public function single(){
      $this->execute();
      return $this->stmt->fetch();
    }

    public function rowCount(){
      return $this->stmt->rowCount();
    }



        /*
        *Insert Data into Mysql DB
        *Bind values
        *execute statement
        **/
        public function insertData($data){
        $this->stmt = $this->query("INSERT INTO users(name, email, date,gender,request) VALUES (:name, :email, :birthday, :gender, :requestDate)");
        $this->stmt->bindValue(':name', $data['name']);
        $this->stmt->bindValue(':email', $data['email']);
        $this->stmt->bindValue(':birthday', $data['birthday']);
        $this->stmt->bindValue(':gender', $data['gender']);
        $this->stmt->bindValue(':requestDate', $data['requestDate']);
        $insert = $this->execute();


        //print('Data Insert');
        //return $this->stmt->fetchAll();
        return $insert;
    }

        /*
        *Check for Email into User
        *Bind value
        *Execute statement
        *Fetch One single row
        **/
    public function checkEmail($data){
        $this->stmt = $this->query('SELECT * FROM users WHERE email = :email');
        $this->stmt->bindValue(':email', $data['email']);
        $row = $this->single();
        // Check row
        if($this->stmt->rowCount() > 0){
          return true;
        } else {
          return false;
        }

    }

}
