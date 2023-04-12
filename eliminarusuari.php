<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_POST['uid']&& $_POST['ou']){
    $uid= $_POST['uid'];
    $ou = $_POST['ou'];
    $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';

    $opcions = [
        'host' => 'zend-posabo.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];

    $ldap = new Ldap($opcions);
    $ldap->bind();
    try{
        $ldap->delete($dn);
        echo "<b>Entrada esborrada</b><br>";
    } catch (Exception $e){
        echo "<b>Aquesta entrada no existeix</b><br>";
    }
}
?>
<html>
<head>
<title>
    ELIMINAR USUARI
</title>
</head>
<body>
    <h2>Formulari de eliminació d'usuari</h2>
    <form action="eliminarusuari.php" method="POST">
        uid: <input type="text" name="uid"><br>
        Unitat Organitzativa (ou): <input type="text" name="ou"><br>
        <input type="submit" value ="Eliminar usuari"/>
        <input type="reset"/><br><br>
    </form>
    <a href="http://zend-posabo.fjeclot.net/autent/menu.php">Tornar al menu</a>
</body>
</html>

