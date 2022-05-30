<?php
Class Users{

    public $msgErro = "";

    public function conectar ($name, $host, $user, $password){
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$name.";host=".$host,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            $msgErro = $e->getMessage();
        }
        
    }
    public function cadastrar ($user,$password){
        global $pdo;
    }
    public function logar($user,$password){
        global $pdo;
        //Cria Keys para Serial e Token
        //SERIAL
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
        $randomSerial = '';
        for($i = 0; $i < 20; $i = $i+1){
            $randomSerial .= $chars[mt_rand(0,60)];
        }
        //TOKEN
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
        $randomToken = '';
        for($i = 0; $i < 23; $i = $i+1){
            $randomToken .= $chars[mt_rand(0,60)];
        }
        //Verificar se o login e senha estao corretas
        $sql = $pdo->prepare("SELECT id FROM users WHERE user = :u AND password = :p");
        $sql->bindValue(":u", $user);
        $sql->bindValue(":p", $password);
        $sql->execute();
        $dado = $sql->fetch();
        
        if($sql->rowCount() > 0){
            $sql2 = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :u");
            $sql2->bindValue(":u", $dado['id']);
            $sql2->execute();

            if($sql2->fetch() < 0){
                $sql2 = $pdo->prepare("INSERT INTO sessions (session_user_id, session_token, session_serial, session_status) VALUES (:s,:t,:se,:st) ");
                $sql2->bindValue(":s", $dado['id']);
                $sql2->bindValue(":t", $randomToken);
                $sql2->bindValue(":se", $randomSerial);
                $sql2->bindValue(":st", 1);
                $sql2->execute();

                setcookie('session_serial', $randomSerial);
                setcookie('session_status', 1);
                setcookie('session_token', $randomToken, time() + ( 365 * 24 * 60 * 60));
                
                
                $_SESSION['id_user'] = $dado['id'];
                return true;

            }else if(!isset($_COOKIE['session_token'])){

                $sql4 = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :xx AND session_status = :d");
                $sql4->bindValue(":xx", $dado['id']);
                $sql4->bindValue(":d", 1);
                $sql4->execute();
                $dadoso = $sql4->fetch();
    
                setcookie('session_serial', $randomSerial);
                setcookie('session_status', $dadoso['session_status']);
                setcookie('session_token', $dadoso['session_token'], time() + ( 365 * 24 * 60 * 60));

                
                $_SESSION['id_user'] = $dado['id'];
                return true;

            }else{
                $sql3 = $pdo->prepare("SELECT * FROM sessions WHERE session_token = :tk");
                $sql3->bindValue(":tk",$_COOKIE['session_token']);
                $sql3->execute();
                $dado3 = $sql3->fetch();

                $sql4 = $pdo->prepare("UPDATE sessions SET session_serial = :se WHERE session_user_id= :xx AND session_status = :st");
                $sql4->bindValue(":se", $randomSerial);
                $sql4->bindValue(":xx", $dado['id']);
                $sql4->bindValue(":st", $dado3['session_status']);
                $sql4->execute();
    
                setcookie('session_serial', $randomSerial);
                setcookie('session_status', $dado3['session_status']);
                
                
                $_SESSION['id_user'] = $dado['id'];
                return true;

            }

        }else{
            return false;
        }
    }

    public function userLogado($number){
        include("conexao.php");
        $pdo = $this->conectar($bd,$hostname,$user,$passwordBD);
        
        $sql = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :x");
        $sql->bindValue(":x", $_SESSION['id_user']);
        $sql->execute();
        $dado2 = $sql->fetchAll();
        $sql2 = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :x");
        $sql2->bindValue(":x", $_SESSION['id_user']);
        $sql2->execute();

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz0123456789";
        $randomSerial = '';
        for($i = 0; $i < 20; $i = $i+1){
            $randomSerial .= $chars[mt_rand(0,60)];
        }
        $randomToken = '';
        for($i = 0; $i < 20; $i = $i+1){
            $randomToken .= $chars[mt_rand(0,60)];
        }
        $pos = $number - 1 ;
        $cont = 1;

        while ($dado4 = $sql2->fetch()){
            $cont++;
        }

        if($cont == $number){
            
            $sql4 = $pdo->prepare("INSERT INTO sessions (session_user_id, session_serial, session_token, session_status) VALUES (:xx,:se,:t,:st)");
            $sql4->bindValue(":xx", $_SESSION['id_user']);
            $sql4->bindValue(":se", $randomSerial);
            $sql4->bindValue(":t", $randomToken);
            $sql4->bindValue(":st", $number);
            $sql4->execute();

            setcookie('session_serial', $randomSerial);
            setcookie('session_status', $number);
            setcookie('session_token', $randomToken, time() + ( 365 * 24 * 60 * 60));
            header("Location: /AreaPrivada.php");
        }else{
            $sql3 = $pdo->prepare("UPDATE sessions SET session_serial = :se, session_status = :st WHERE session_status= :xx AND session_user_id= :d");
            $sql3->bindValue(":se", $randomSerial);
            $sql3->bindValue(":st", $number);
            $sql3->bindValue(":xx", $number);
            $sql3->bindValue(":d", $_SESSION['id_user']);
            $sql3->execute();

            setcookie('session_serial', $randomSerial);
            setcookie('session_status', $number);
            setcookie('session_token', $dado2[$pos]['session_token'], time() + ( 365 * 24 * 60 * 60));
            header("Location: /AreaPrivada.php");
        }
    }

}
?>