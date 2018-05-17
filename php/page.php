
<link rel="stylesheet" type="text/css" href="../css/page.css">

<?php
    include("coBDD.php");

    	$page=$dbh->prepare('SELECT * from question where id = '.$_GET["id"]);
        $page->execute();
$count = $page->rowCount();

    if($count==0)

    {
        echo("erreur 404");
        header('Location: index.php');
        exit();
    }
      
      
        
    else {
        foreach($page->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo('<div class="down">Titre:'.$row["titre"].'</div>');
            echo('<div class="down">Contenu:'.$row["contenu"].'</div>');
        }

        echo "<div class='liste'>Liste des commentaires </div>";
        $commentaires=$dbh->prepare('SELECT * from commentaire where id_question = '.$_GET["id"].' ORDER BY date');
        $commentaires->execute();

        if($commentaires->rowCount()>0)
{
        foreach($commentaires->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $requete = "SELECT pseudo FROM users WHERE id=".$row["id_auteur"];
            $pseudo = $dbh->query($requete);
            $pseudo2 = $pseudo->fetch();
           echo('<p class="time">'.$pseudo2["pseudo"]." a écrit le : ");
            echo($row["date"]."</p>");
            /*echo $row["contenu"];*/
            echo '<div class="comment">' . $row["contenu"] . '</div>';
            echo "<br>";

        }
    }
    else
        echo("Aucun commentaire");


}
          //  echo $page;

/*if(connected($dbh))
{

?>
    <form action="#" method="POST">
    <textarea name="modifTitre" ><?php echo($getTitre["titre"]);?> </textarea>
    <input name="changeTitle" value="OK" type="submit"/>
   </form>

<?php
}
?>

<?php
*/
if(connected($dbh))
{
?>
<p class="ajouter">Ajouter un commentaire sur cette page</p>
<div class="box">
    <form action="#" method="POST">
    <textarea name="textComm" ></textarea>
 <input name="addComment" value="OK" type="submit"/>
</form>
    </div>


<?php
}

if(isset($_POST["addComment"]) && isset($_POST["textComm"]))
{
    if($_POST["textComm"]!='')
    {
      //  var_dump('SELECT id from users where mail="'.$_COOKIE["mail"].'"');
        
        $id_auteur=get_user($dbh);
        //var_dump($id_auteur);

        $strrequestInsertComm='INSERT INTO commentaire(id_auteur,contenu,id_question,date) values("'.$id_auteur.'", "'.$_POST["textComm"].'", "'.$_GET["id"].'",NOW())';
        var_dump($strrequestInsertComm);
        $requInsertComm=$dbh->prepare($strrequestInsertComm);
        $requInsertComm->execute();
        
    
    
    
        var_dump($strrequestInsertComm);
    
        echo("je suis passé par là");
        header("Refresh:0");
    }
    else
    {
        echo("Comm vide!");
    }


}
elseif(isset($_POST["textComm"])&&is_null($_POST["textComm"]))
{
    echo("Comm vide!");
}

?>




