<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_POST['uid']&& $_POST['ou'] && $_POST['uidNumber'] && $_POST['gidNumber'] && $_POST['directoriPersonal'] && $_POST['shell'] && $_POST['cn'] && $_POST['sn'] && $_POST['givenName'] && $_POST['mobile'] && $_POST['postalAddress'] && $_POST['telephoneNumber'] && $_POST['title'] && $_POST['description']){
    $uid= $_POST['uid'];
    $ou = $_POST['ou'];
    $uidNumber = $_POST['uidNumber'];
    $gidNumber = $_POST['gidNumber'];
    $homeDirectory = $_POST['directoriPersonal'];
    $loginShell = $_POST['shell'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $givenName = $_POST['givenName'];
    $mobile = $_POST['mobile'];
    $postalAddress = $_POST['postalAddress'];
    $telephoneNumber = $_POST['telephoneNumber'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');

    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-posabo.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'ou', $ou);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $uidNumber);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $gidNumber);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $homeDirectory);
    Attribute::setAttribute($nova_entrada, 'loginShell', $loginShell);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $givenName);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobile);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $postalAddress);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telephoneNumber);
    Attribute::setAttribute($nova_entrada, 'title', $title);
    Attribute::setAttribute($nova_entrada, 'description', $description);
    
    $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
}
?>
<html>
<head>
<title>
	CREACIÓ USUARI
</title>
</head>
<body>
	<h2>Formulari de creació d'usuari</h2>
	<form action="crearusuari.php" method="POST">
		uid: <input type="text" name="uid"><br>
		Unitat Organitzativa (ou): <input type="text" name="ou"><br>
		uidNumber: <input type="text" name="uidNumber"><br>
		GID Number: <input type="text" name="gidNumber"><br>
		homeDirectory: <input type="text" name="directoriPersonal"><br>
		loginShell: <input type="text" name="shell"><br>
		cn: <input type="text" name="cn"><br>
		sn: <input type="text" name="sn"><br>
		givenName: <input type="text" name="givenName"><br>
		mobile: <input type="text" name="mobile"><br>
		postalAddress: <input type="text" name="postalAddress"><br>
		telephoneNumber: <input type="text" name="telephoneNumber"><br>
		description: <input type="text" name="description"><br>
		title: <input type="text" name="title"><br>
		<input type="submit" value="Crear Usuari"/>
		<input type="reset"/><br><br>
	</form>
	<a href="http://zend-posabo.fjeclot.net/autent/menu.php">Tornar a al menú</a>
</body>
</html>