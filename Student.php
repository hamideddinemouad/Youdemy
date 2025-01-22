<?php
include_once "Easy.php";
include_once "user.php";
class Student extends User{

    private $name;
    private $email;
    private $role;
    private $id;
    private $password;

  public function __construct($db, $name = '', $email = '', $role = '', $id = '', $password = '')
    {
        parent::__construct($db);

        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->id = $id;
        $this->password = $password;
        $this->login();
    }
    public function getname() {
        return $this->name;
    }
    public function login(){
        
    }
    // public function signUp(){

    //     // var_dump($_POST);
    //     //if student register direct
    //     //if student already registered return an error in front end
    //     //if teacher register need admin approval enter in teaachers_validation table
    //     //if teacher already registered return an error in front end
    //     // if teacher already sent request return an error in front end
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST')
    //     {
    //         $name = $_POST['name'];
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
    //         $stmnt = "insert into users (username, email, password, role) values (?, ?, ?, ?);";
    //         $params = [$name, $email, $password, 'student'];
    //         try {
    //             $result = $this->secureQuery($this->db, $stmnt, $params);
    //             }
    //         catch (Exception $e) {
    //             echo "bitch aint got";
    //             return 'false';
    //         }
    //         $this->login($this->db, $email, $password);
    //         return 'true';
    //     }
        
    // }
    public function encode()
    {
        return json_encode([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            // 'isguest' => $this->isguest,
            'id' => $this->id,
            'password' => $this->password ]);
    }
}
?>