<?php
include_once "Easy.php";
include_once "user.php";
class Teacher extends User{
    
    private $name;
    private $email;
    private $role;
    private $id;
    private $password;

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