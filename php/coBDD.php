

<?php 
$user="root";
$pass="root";


$dbh = new PDO('mysql:host=localhost;dbname=web', $user, $pass);
connected($dbh);
function isadmin($dbh)
{
if(!connected($dbh))
    return false;


    $Coadmin='SELECT admin from users where mail="'.$_COOKIE["mail"].'" and password="'.$_COOKIE["password"].'"';
    $requeteAdmin=$dbh->prepare($Coadmin);
    $requeteAdmin->execute();
    $result=$requeteAdmin->fetch();
   // var_dump($result);
if($result["admin"]==1)
    return true;
else
    return false;

}
function get_user($dbh)
{
    $requestIdAuteur=$dbh->prepare('SELECT id from users where mail="'.$_COOKIE["mail"].'"');
    $requestIdAuteur->execute();
    return $requestIdAuteur->fetch()["id"];

}





function connected($dbh){
   // echo("je suis dans la fonction");
    $strrequeteTestBan="SELECT status from ips where ip='".$_SERVER["REMOTE_ADDR"]."' and status=1";
    
    $requeteTestBan=$dbh->prepare($strrequeteTestBan);
    $requeteTestBan->execute();
    $resultban=$requeteTestBan->fetchAll();
   // var_dump($strrequeteTestBan);
   // var_dump($resultban);

    if(!empty($resultban))
       { echo("Votre IP a été bannie, vous n'avez pas le droit d'accéder au site");
        exit();
        return false;}
    



    if(isset($_COOKIE["mail"]) && isset($_COOKIE["password"]))
    {
        if(!is_null($_COOKIE["mail"])&&!is_null($_COOKIE["password"]))
            {
                $Comail='SELECT pseudo from users where mail="'.$_COOKIE["mail"].'" and password="'.$_COOKIE["password"].'"';
                //var_dump($Comail);
                $requeteComail=$dbh->prepare($Comail);
                $requeteComail->execute();

                //var_dump($requeteComail->rowCount());

                if($requeteComail->rowCount()==1)
                    return true;
                else
                    return false;
}
else
{
    return false;
}
            }
//echo("je suis là!!!");
return false;
}



function checkAccount($dbh)
{
    
    $requeteCo = 'SELECT pseudo,password from users where mail="'.$_POST["connection_mail"].'"';
    $pseudo=$dbh->prepare($requeteCo);
    $pseudo->execute();

   // echo("je check ton compte");
    $row = $pseudo->fetch();
  //  var_dump($row);
    
    if($row["password"]==$_POST["connection_password"])
    {
        echo("tu es mnt connecté\n");
        setcookie("mail",$_POST["connection_mail"]);
        setcookie("password",$row["password"]);

        $updaterequest="update users set last_ip ='".$_SERVER["REMOTE_ADDR"]."' where mail= '".$_POST["connection_mail"]."'";

        $update=$dbh->prepare($updaterequest);
        $update->execute();
       // var_dump($updaterequest);

        //var_dump($updaterequest);
        //var_dump($_SERVER["REMOTE_ADDR"]);
        
        header("Refresh:0");

        //header('Location: #');
    }
    else{
        echo("wrong password\n");
    }
}

?>

<link rel="stylesheet" type="text/css" href="../css/header.css">

<header id="header_containt">
        <div class="home_button">
                <a href="../php/index.php" class="home_img">
                    <img src="../res/home.svg" />
                </a> 
            </div>
            <div id="display_header_links">
                <a href="pages.php" id="community">Communaute</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="dropdown_pages">
                    <a href="../html/pages.html" id="pages">Pages</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="dropdown_pages_content">

<?php
	$getPages=$dbh->prepare("SELECT * from question order by date LIMIT 3");
    $getPages->execute();
    $pagesNames=$getPages->fetchAll();

    

    foreach ($pagesNames as $varPage) {
       // var_dump($varPage);
        ?>

<a href="page.php?id=<?php echo($varPage["id"]); ?>"><?php echo($varPage["titre"]); ?></a>  

<?php
    }
?>



                         <!-- a mettre les titres des dernières pages -->
                    </div>
                </div>
                <?php if(connected($dbh)) { ?>
                <a href="account.php" id="account">Compte</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php } ?>
                <a href="..html/about.html" id="about">&Agrave; propos</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(isadmin($dbh)) { ?>
                <a href="edit.php" id="admin_space">Administration</a>
                <?php  } ?>
            </div>
            <div class="display_header_connection_fields">
            <?php if(!connected($dbh)) { ?>

            <form action="#" method="POST">
                    <input name="connection_mail" type="email" placeholder="email"/>
                    <input name="connection_password" type="password" placeholder="mot de passe"/>
                    <input type="submit" value="Connexion" name="submitConnect" class="connection_button"></form>
            
            

                <div class="help_account">
                <?php


if(!connected($dbh))
{
?>
<a href="../php/inscription.php" class="account_creation">Pas encore inscrit ?</a>&nbsp;&nbsp;&nbsp;&nbsp;

<?php
}
?>
                    <a href="#" class="password_forgotten">Mot de passe oubli&eacute; ?</a>
                </div>


                <?php 
if(isset($_POST['submitConnect']))
{
   checkAccount($dbh);
}

                } 
                
                else{

                    $tmp='SELECT pseudo,password from users where mail="'.$_COOKIE["mail"].'"';
                    $pseudo=$dbh->prepare($tmp);
                    $pseudo->execute();
                    //var_dump($pseudo);
                    $pseudo2=$pseudo->fetch();
                
                  //  var_dump($pseudo2);
                  //  echo("Bienvenue ".$pseudo2["pseudo"]);
                
                
                if(connected($dbh))
                {
                ?>
<p> Bienvenue 
    <span class="username_display">
        <?php echo $pseudo2["pseudo"] ?>
    </span>
</p>
<p><a href="action.php?action=deco" class="disconnect_link">Déconnection</a></p>
                <?php

                }
            }
                
                ?>
                
            </div>
            
</header>




