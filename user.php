<?php
include_once "easy.php";
class User {
    use Easy;
    // private $name;
    // private $email;
    // private $isguest;
    // private $id;
    // private $password;
    private $db;
    private $role = 'Visitor';

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('location: index.php');
        exit();
    }
    public function login()
    {
        if (isset($_POST))
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            return $this->fork($email, $password);
        }
        return 0;
    }
    
    public function signUp(){

        // var_dump($_POST);
        //if student register direct
        //if student already registered return an error in front end
        //if teacher register need admin approval enter in teaachers_validation table
        //if teacher already registered return an error in front end
        // if teacher already sent request return an error in front end
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['role'] === 'teacher')
        {
            return $this->teacherRequest();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            // echo "from signup user.php method is indeed post";
            $name = $_POST['name'];
            $email = $_POST['email'];
            echo "password from signup in user.php" . $_POST['password'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmnt = "insert into users (username, email, password, role) values (?, ?, ?, ?);";
            $params = [$name, $email, $password, 'student'];
            
            try {
                $result = $this->secureQuery($this->db, $stmnt, $params);
                }
            catch (Exception $e) {
                echo "bitch aint got";
                return 'false';
            }
            return $this->fork($email, $password);
        }
        return 'false';
    }
    public function teacherRequest()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmnt = "select * from users where email = ?";
        $params = [$email];
        $isalreadyregistred = $this->secureQuery($this->db, $stmnt, $params);

        $stmnt = "select * from teachers_demands where email = ?";
        $demandalreadyin = $this->secureQuery($this->db, $stmnt, $params);
        if (count($isalreadyregistred) !== 0 || count($demandalreadyin) !== 0)
        {
            $_SESSION['teacher already registred'];
            return "false";
        }
        $params = [$name, $email, $password];
        $stmnt = "insert into teachers_demands (username, email, password) values (?, ?, ?)";
        $this->secureQuery($this->db, $stmnt, $params);
        $_SESSION['teacher demand submitted'] = 1;
        return ["role" => "teacherrequest"];
    }
    public function fork($email, $password)
    {
        $stmnt = "select * from users where email = ?";
        $params = [$email];
        $result = $this->secureQuery($this->db, $stmnt, $params);
        // echo $email;
        // echo $password;
        echo "i am comparing password from fork funcpassword is " . $password;
        echo "result of password_verify" . password_verify($password, $result[0]['password']);
        if (count($result) === 0 || password_verify($password, $result[0]['password']) === 0) {
            $count = count($result);
            if (!password_verify($password, $result[0]['password'])) {
                echo "passwords don't match";
            }
            echo "count is $count  from fork func";
            echo "Result from database query: fork func";
            print_r($result);
            return 0;
        }
        return ([
            'name' => $result[0]['username'],
            'email' => $result[0]['email'],
            'role' => $result[0]['role'],
            'id' => $result[0]['id'],
            'password' => $result[0]['password']
        ]);
    }
    public function getRole() {
        return $this->role;
    }
}

    // public function __construct($db, $name = '', $email = '', $role = '', $isguest = 'true', $id = '', $password = '')
    // {

    //     $this->name = $name;
    //     $this->email = $email;
    //     $this->role = $role;
    //     $this->isguest = $isguest;
    //     $this->id = $id;
    //     $this->password = $password;
    //     $this->db = $db;
    // }
    // public function signupStudent(){

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
    // public function getisguest() {
    //     return $this->isguest;
    // }
    // public function setName($name) {
    //     $this->name = $name;
    // }

    // public function setEmail($email) {
    //     $this->email = $email;
    // }

    // public function setRole($role) {
    //     $this->role = $role;
    // }

    // Getters
    // public function getName() {
    //     return $this->name;
    // }

    // public function getEmail() {
    //     return $this->email;
    // }
    // public function encode()
    // {
    //     return json_encode([
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'role' => $this->role,
    //         // 'isguest' => $this->isguest,
    //         'id' => $this->id,
    //         'password' => $this->password ]);
    // }


    // public function login($db, $email, $password)
    // {
    //     $stmnt = "select * from users where email = ? and password = ?;";
    //     // echo $email;
    //     // echo $password;
    //     $params = [$email, $password];
    //     $result = $this->secureQuery($db, $stmnt, $params);
    //     if (count($result) === 0)
    //     {
    //         // var_dump($result);
    //         return 0;
    //     }
    //     // var_dump($result);
    //     $this->isguest = 'false';
    //     $this->name = $result[0]['username'];
    //     $this->email = $result[0]['email'];
    //     $this->password = $result[0]['password'];
    //     $this->role = $result[0]['role'];
    //     $this->id = $result[0]['id'];
    //     return 0;
    // }

?>