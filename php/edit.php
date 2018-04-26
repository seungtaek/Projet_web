<?php 
include("coBDD.php");
if(isadmin($dbh))
{
?>
<link rel="stylesheet" type="text/css" href="../css/edit.css">
<h1>Pages</h1>
<table style="width:80%">
  <tr>
    <th>Titre page</th>
    <th>Contenu page</th>
    <th>Suppression</th>
  </tr>

<?php

    //echo("true");
    $tabrequete='SELECT id,titre,contenu from question';
    $requeteAdmin=$dbh->prepare($tabrequete);
    $requeteAdmin->execute();
    $result=$requeteAdmin->fetchAll();
//    echo(implode('/',$result[0]));
    //var_dump($result);
    foreach($result as $value) {
?>
  <tr>
    <td><a href="edits.php?modif=pageTitre&id=<?php echo($value["id"])?>&action=edit"><?php echo $value["titre"]?></a></td>
    <td><a href="edits.php?modif=pageContenu&id=<?php echo($value["id"])?>&action=edit"><?php echo $value["contenu"]?></a</td>
    <td><a href="edits.php?modif=page&id=<?php echo($value["id"])?>&action=suppress"><img src="./../res/close.png" alt="x" height="42" width="42"></a></td>
  </tr>


<?php
    }




    ?>
<tr>
    <td>Ajouter une page: </td>
    <td></td>
    <td ><a href="edits.php?action=addPage" style = "color:green;"><img src="./../res/open.png" alt="x" height="42" width="42"></a></td>
</tr>


<!-- ------------------------------------------------------------------------------------------- -->

</table>

<h1>Commentaires</h1>
<table style="width:80%">
  <tr>
    <th>Contenu</th>
    <th>Page</th>
    <th>Supprimer</th>
    <th>Modifier </th>
    <th>Date</th>
  </tr>




<?php

//echo("true");
$requetecomm='SELECT id,contenu,id_auteur,date,id_question from commentaire';
$CommentaireRequete=$dbh->prepare($requetecomm);
$CommentaireRequete->execute();
$result=$CommentaireRequete->fetchAll();
//var_dump($result);
foreach($result as $value) {
  //var_dump($value);
  $strReqPageComm = 'SELECT titre from question where id ='.$value["id_question"];
  //var_dump($strReqPageComm); 
  $RequestPageComm=$dbh->prepare($strReqPageComm);
  $RequestPageComm->execute();
  $result=$RequestPageComm->fetch();
  //var_dump($result);


?>
<tr>
<td><?php echo $value["contenu"]?></td>
<td><?php echo $result["titre"]?></td>
<td><a href="edits.php?modif=comm&id=<?php echo($value["id"])?>&action=suppress"><img src="./../res/close.png" alt="x" height="42" width="42"></a></td>
<td><a href="edits.php?modif=comm&id=<?php echo($value["id"])?>&action=edit"><img src="./../res/modifier.png" alt="x" height="42" width="42"></a></td>
<td><?php echo($value["date"])?></td>
</tr>


<?php
}

?>
</table>
<h1>Users:</h1>
<table style="width:80%">
  <tr>
    <th>pseudo</th>
    <th>email</th>
    <th>Supprimer</th>
    <th>ip</th>
  </tr>
<?php

$strRequeteUser='SELECT id,mail,pseudo,last_ip from users where admin!=1';
$requeteUser=$dbh->prepare($strRequeteUser);
$requeteUser->execute();
$result=$requeteUser->fetchAll();
//var_dump($result);
foreach ($result as $value) {
  

  ?>
<tr>
<td><?php echo $value["pseudo"]?></td>
<td><?php echo $value["mail"]?></td>
<td><a href="edits.php?modif=user&id=<?php echo($value["id"])?>&action=suppress"><img src="./../res/close.png" alt="x" height="42" width="42"></a></td>
<td><a href="edits.php?modif=ips&id=<?php echo $value["last_ip"] ?>&action=ban"> <?php echo $value["last_ip"] ?></td>
</tr>


<?php
}
?>
</table>

<h1>Banned Ips</h1>
<table>
<?php 

$strrequeteBannedIp='SELECT ip from ips where status=1';
$requeteBannedIp=$dbh->prepare($strrequeteBannedIp);
$requeteBannedIp->execute();
if($requeteBannedIp->rowCount()==0)
  echo("il n'y a pas d'IP bannie");
$resultBannedIp=$requeteBannedIp->fetchAll();

foreach ($resultBannedIp as $ip) {

?>
<tr>
<td><?php echo($ip["ip"]); ?>
<td><a href="edits.php?modif=ips&id=<?php echo($ip["ip"]);?>&action=deban">deban</a>
</tr>


<?php

  
}


  }

  
else
{
  echo("erreur 404");
  header('Location: index.php');
  exit();
}

?>
