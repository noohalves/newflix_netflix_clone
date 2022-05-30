<?php

include("class/conexao.php");
require_once 'class/users.php';
session_start();
$u = new Users;
$pdo = $u->conectar($bd,$hostname,$user,$passwordBD);


$sql2 = $pdo->prepare("SELECT * FROM sessions WHERE session_user_id = :x");
$sql2->bindValue(":x", $_SESSION['id_user']);
$sql2->execute();

if($sql2->rowCount() > 0){
    $sql = $pdo->prepare("UPDATE sessions SET session_serial= :y WHERE session_user_id= :x AND session_status= :s");
    $sql->bindValue(":y", "");
    $sql->bindValue(":x", $_SESSION['id_user']);
    $sql->bindValue(":s", $_COOKIE['session_status']);
    $sql->execute();
}

setcookie (session_id(), "", time() - 3600);
session_destroy();
session_write_close();
unset($_SESSION['id_user']);

/**
 * Unset cookies
 *
 * @param string $key    Nome do cookie
 * @param string $path   (Opcional) Se definido irá remover o cookie de caminhos especificos
 * @param string $domain (Opcional) Se definido irá remover o cookie de (sub)dominios especificos
 * @param bool $secure   (Opcional) Se definido irá remover o cookie em conexão segura (isto varia conforme o navegador)
 * @return bool
 */
function unsetcookie($key, $path = '', $domain = '', $secure = false)
{
    if (array_key_exists($key, $_COOKIE)) {
        if (false === setcookie($key, null, -1, $path, $domain, $secure)) {
            return false;
        }

        unset($_COOKIE[$key]);
    }

    return true;
}

//Elimina o cookie pro path atual
unsetcookie('session_serial');
unsetcookie('session_status');
unsetcookie('PHPSESSID');


header("location: index.php");

?>