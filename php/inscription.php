<?php
include("coBDD.php");
function inscription()
{
    $mail=$_POST["inscription_mail"];
    $pseudo=$_POST["inscription_pseudo"];
    $pass=$_POST["inscription_password"];


    echo("it works");
    echo($_POST["inscription_mail"]);
    $pseudorequete='SELECT pseudo from users where pseudo="'.$pseudo.'"';
    $requetepseudo=$dbh->prepare($pseudorequete);
    $requetepseudo->execute();

    $mailrequete='SELECT pseudo from users where mail="'.$mail.'"';
    $requetemail=$dbh->prepare($mailrequete);
    $requetemail->execute();

    var_dump($requetepseudo->rowCount());

    if($requetepseudo->rowCount()==0 && $requetemail->rowCount()==0)
    {

        echo("inscription acceptée");
        $insertrequete="insert into users(mail,pseudo,password) values('".$mail."','".$pseudo."','".$pass."')";
       // echo($insertrequete);
        $requeteinsert=$dbh->prepare($insertrequete);
        $requeteinsert->execute();
        echo("inscription réussie");
    }

    else {

        if($requetepseudo->rowCount()==1)
            echo("pseudo déjà utilisé");

        else
            echo("mail déjà utilisé");

        
    }

   // if($requetepseudo->fetchColumn())
    //var_dump($_POST['submit']);

    unset($_POST['submit']);


}


if(isset($_POST['submit']))
{
   inscription();
} 


if(!connected($dbh))
{

?>

<form action="inscription.php" method="POST">
<input name="inscription_mail" type="email" placeholder="mail"/>
<input name="inscription_pseudo" type="text" placeholder="Pseudo"/>
<input name="inscription_password" type="password" placeholder="password"/>
<input type="submit" value="click" name="submit">

</form>

<?php
}



?>