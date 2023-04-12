<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);

	if ($_POST['uid'] && $_POST['ou'] && isset($_POST['atribut']) && $_POST['nouAtribut']){

		$uid= $_POST['uid'];
		$ou = $_POST['ou'];
		$atribut = $_POST['atribut'];
		$nou_contingut = $_POST['nouAtribut'];
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
		$entrada = $ldap->getEntry($dn);
		if ($entrada){
			Attribute::setAttribute($entrada,$atribut,$nou_contingut);
			$ldap->update($dn, $entrada);
			echo "Atribut modificat"; 
		} else echo "<b>Aquesta entrada no existeix</b><br><br>";	
	}

?>
<html>
<head>
<title>
	FORMULARI DE MODIFICACIÓ D'ATRIBUTS
</title>
</head>
<body>
	<h2>Formulari de modificació d'atributs </h2>
	<form action="modificarusuari.php" method="POST">
		uid: <input type="text" name="uid"><br>
		Unitat Organitzativa (ou): <input type="text" name="ou"><br><br>
		<b><label for="atributs">Selecciona l'atribut que vols modificar: </label></b><br>
		<input type="radio" name="atribut" id="atributs" value="uidNumber" />
		<label for="atributs">uidNumber</label><br>
		<input type="radio" name="atribut" id="atributs" value="gidNumber" />
		<label for="atributs">gidNumber</label><br>
		<input type="radio" name="atribut" id="atributs" value="homeDirectory" />
		<label for="atributs">Directori Personal</label><br>
		<input type="radio" name="atribut" id="atributs" value="shell" />
		<label for="atributs">LoginShell</label><br>
		<input type="radio" name="atribut" id="atributs" value="cn" />
		<label for="atributs">cn</label><br>
		<input type="radio" name="atribut" id="atributs" value="sn" />
		<label for="atributs">sn</label><br>
		<input type="radio" name="atribut" id="atributs" value="givenName" />
		<label for="atributs">givenName</label><br>
		<input type="radio" name="atribut" id="atributs" value="postalAddress" />
		<label for="atributs">postalAddress</label><br>
		<input type="radio" name="atribut" id="atributs" value="mobile" />
		<label for="atributs">mobile</label><br>
		<input type="radio" name="atribut" id="atributs" value="telephoneNumber" />
		<label for="atributs">telephoneNumber</label><br>
		<input type="radio" name="atribut" id="atributs" value="title" />
		<label for="atributs">title</label><br>
		<input type="radio" name="atribut" id="atributs" value="description" />
		<label for="atributs">description</label>
		<br><br>
		<label>Introdueix el nou contingut: </label><br><br>
		<input type="text" name="nouAtribut" />
		<input type="submit" value="Modificar atribut"/>
		<input type="reset"/><br><br>
	</form>
	<a href="http://zend-posabo.fjeclot.net/autent/menu.php">Tornar al menu</a>
</body>
</html>
