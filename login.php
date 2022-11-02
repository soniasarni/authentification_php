<?php
include("connexion.php");
session_start();
@$login=htmlspecialchars(trim(strtolower($_POST['login'])));
@$pass=md5($_POST['pass']);
@$valide=$_POST['valider'];  
$message="";
if(isset($valide)){
    
    
    $req=$con->prepare("select * from users where email=? & password=? limit 1");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute(array($login,md5($pass)));
    $rst=$req->fetchAll(); 
    if(count($rst)==0)
        $message="<li>Mauvais login ou mot de passe!</li>";
    else{
        $_SESSION["autoriser"]="oui";
        $_SESSION["nomPrenom"]=strtoupper($rst[cu]["nom"]." ". $rst[0]["prenom"]);
        header("location:session.php");





    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body onLoad="document.fo.login.focus()">
		<header>
			Authentification
			<a href="inscription.php">S'inscrire</a>
		</header>
		<form name="fo" method="POST" action="">
			<div class="label">Login</div>
			<input type="text" name="login" value="<?php echo $login?>"required />
			<div class="label">Mot de passe</div>
			<input type="password" name="pass"value="<?php echo $pass?>" required />
			<input type="submit" name="valider" value="S'authentifier" />
		</form>
		<?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
		<?php } ?>
    
</body>
</html>