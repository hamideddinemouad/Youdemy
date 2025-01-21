<?php 
trait Easy{
    public static function secureQuery($db, $stmnt, $params = false)
    {
        // echo $stmnt;
        // var_dump($params);
        if (!($db || $stmnt))
        {
            echo "secureQuery Error";
            return false;
        }
        if (!$params)
        {
            $preparation = $db->prepare($stmnt);
            $preparation->execute();
            return $preparation->fetchall(PDO::FETCH_ASSOC);
        }
        // echo "$stmnt";
        $preparation = $db->prepare($stmnt);
        $preparation->execute($params);
        return $preparation->fetchall(PDO::FETCH_ASSOC);
    }
    public function redirect($path){
        header("location: $path");
        exit();
    }
}