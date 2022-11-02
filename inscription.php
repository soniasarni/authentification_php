
    <?php
      @$nom=$_POST['nom'];
      @$prenom=$_POST['prenom'];
      @$email=$_POST['login'];
      @$password=$_POST['pass'];
      @$repass=$_POST['repass'];
      @$valider=$_POST['valider'];
      $message="";
      $msg="";
      if(isset($valider)){
        if(empty($nom))
        $message.="<li>Nom invalide!</li>";
        if(empty($prenom)) $message.="<li>Prénom invalide!</li>";
        if(empty($email)) $message.="<li>Login invalide!</li>";
        if(empty($password)) $message.="<li>Mot de passe invalide!</li>";
	 	if($password!=$repass) $message.="<li>Mots de passe non identiques!</li>";
        if(empty($message))	{
            include("connexion.php");
            $req = $con ->prepare("select id from users where email= ? limit 1");
            $req->setFetchMode(PDO::FETCH_ASSOC);
            $req->execute(array($email));
            $tab=$req->fetchObject();
			if(count($tab)>0)
			$message="<li>Login existe déjà!</li>";
			else{                                                                                 //marqueurs indexés
                			$ins=$con ->prepare("insert into users(date,nom,prenom,email,password) values(now(),?,?,?,?)");
                			$emt=$ins->execute(array($nom,$prenom,$email,md5($password)));
                            if($emt) $msg="bravo vous êtes bien enregistré!";
                		//header("location:login.php");
                                                                                          // marqueurs nommés
                        // $req=$con->prepare("insert into users(date,nom,prenom,email,password)values(:d,:n,:p,:e,:pwd)");
                        // $elmt=$req->execute(array(":d"=>"now()",":n"=>"$nom",":p"=>"$prenom",":e"=>"$email",":pwd"=>"md5($password)"));
                	}
                 	}
             }
            ?> 
	
<!DOCYTPE html>
<html>
	<head>
    <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
        
		<header>
			Inscription
			<a href="login.php">Déja inscrit</a>
		</header>
		<form name="fo" method="post" action=""enctype="multipart/form-data">
			<div class="label">Nom</div>
			<input type="text" name="nom" value="<?php echo $nom?>" />
			<div class="label">Prénom</div>
			<input type="text" name="prenom" value="<?php echo $prenom?>" />
			<div class="label">Login</div>
			<input type="text" name="login" value="<?php echo $email?>" />
			<div class="label">Mot de passe</div>
			<input type="password" name="pass" />
			<div class="label">Confirmation du mot de passe</div>
			<input type="password" name="repass" />
			<input type="submit" name="valider" value="S'inscrire" />
		</form>
		<?php if(!empty($message)){ ?>
		<div id="message"><?php echo $message ?></div>
        
		<?php } else {
             if(!empty($msg)){ ?>
            <div id="msg"><?php echo $msg ?></div>
	
       
            <?php }}?>
  
    
    
    
    
    
    
    
    
    
    
    
    
    </body>






</html>
