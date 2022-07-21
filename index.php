<?php
    //var_dump($_POST);
    $errorNom = null;
    $errorPrenom = null;
    $errorAge = null;
    $errorEmail = null;
    $errorPassword = null;
    $errorCodePostal = null;
    $errorTelephone = null;
    
    if(isset($_POST['send'])){
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);


        //taille du nom est entre 2 et 15
        if(empty($nom)){
            $errorNom.= "<p>le champ nom ne doit pas etre vide";
        }elseif((strlen($nom) <2) || (strlen($nom) > 15)){
            $errorNom.= "<p>le nom doit etre compris entre 2 et 15</p>";
            
        }

        //taille du prenom est entre 2 et 15
        if(empty($prenom)){
            $errorPrenom.= "<p>le champ prenom ne doit pas etre vide";
        }elseif((strlen($nom) <2) || (strlen($nom) > 15)){
            $errorPrenom.= "<p>le prenom doit etre compris entre 2 et 15</p>";
        }

        //l'email doit etre valide (exemple@exemple.com)
        if(empty($email)){
            $errorEmail.= "<p>le champ email ne doit pas etre vide";
        }elseif(!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $email)){ //elseif(!preg_match($email, FILTER_VALIDATE_EMAIL))
            $errorEmail.= "<p>le format email n'est pas valide</p>";
        }

        if(empty($password)){
            $errorPassword.= "<p>le champ password ne doit pas etre vide </p>";
        }

        if(empty($_POST['telephone'])){
            $errorTelephone.= "<p>le champ tel ne doit pas etre vide </p>";
        }elseif(!preg_match('#^0[1-9]{1}\d{8}$#', $_POST['telephone'])){
            $errorTelephone.= "<p>le format telephone n'est pas valide</p>";
        }

        if(empty($_POST['age'])){
            $errorAge.= "<p>le champ age ne doit pas etre vide </p>";
        }elseif(!is_numeric($_POST['age']) || $_POST['age'] <10){
            $errorAge.= "<p>se n'est pas un nombre et supérieur a 10ans </p>";
        }

        if(empty($_POST['codePostal'])){
            $errorCodePostal.= "<p>le champ code postal ne doit pas etre vide </p>";
        }elseif(!preg_match("/^[0-9]{5,5}$/ ", $_POST['codePostal'])){
            $errorCodePostal.= "<p>le format code postal n'est pas valide</p>";
        }
    }

function erreur($error){
            if(!empty($error)){
                ?>
                <div class="alert alert-dismissible alert-warning mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <h4 class="alert-heading">Warning!</h4>
                    <?php echo $error ?>
                </div>
            <?php
            }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/pulse/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Document</title>
</head>
<body>
    
        <!-- partie header -->
        <?php include "./assets/php/header.php"?>
    <div class="formulaireSide">

        <h1>formulaire</h1>
        <!-- partie formulaire -->
        <form action="" method="POST">
            <!-- nom -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="nom" name="nom" value="<?php echo @$_POST['nom'] ?>">
                <label for="floatingInput">Nom</label>
                <?php erreur($errorNom) ?>
            </div>
            <!-- prenom -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Prenom" name="prenom" value="<?php echo @$_POST['prenom'] ?>">
                <label for="floatingInput">Prenom</label>
                <?php erreur($errorPrenom) ?>
            </div>
            <!-- age -->
            <div class="form-floating mb-3">
                <input type="number" class="form-control" placeholder="age" name="age" value="<?php echo @$_POST['age'] ?>">
                <label for="floatingInput">Age</label>
                <?php erreur($errorAge) ?>
            </div>
            <!-- mail -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" placeholder="name@example.com" name="email" value="<?php echo @$_POST['email'] ?>">
                <label for="floatingInput">Email address</label>
                <?php erreur($errorEmail) ?>
            </div>
            <!-- password -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
                <?php erreur($errorPassword) ?>
            </div>
            <!-- code postal -->
            <div class="form-floating mb-3">
                <input type="number" class="form-control" placeholder="inputDefault" name="codePostal" value="<?php echo @$_POST['codePostal'] ?>">
                <label for="floatingInput">Code Postal</label>
                <?php erreur($errorCodePostal) ?>
            </div>
            <!-- telephone -->
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" placeholder="telephone" name="telephone" value="<?php echo @$_POST['telephone'] ?>">
                <label for="floatingInput">Telephone</label>
                <?php erreur($errorTelephone) ?>
            </div>
            <!-- envoyer -->
            <button type="submit" class="btn btn-primary" name="send" >Submit</button>
        </form>

        <br><br><br>
    
        <!-- partie footer -->
    </div>    
        <?php include "./assets/php/footer.php"?>
    
</body>
</html>