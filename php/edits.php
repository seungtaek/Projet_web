<link rel="stylesheet" type="text/css" href="../css/page.css">
<?php 

include("coBDD.php");
if(isadmin($dbh))
{
if(isset($_POST["changeTitle"]))
{
   // var_dump($_POST["modifTitre"]);
    $reqdelete='UPDATE question set titre="'.$_POST["modifTitre"].'" where id = '.$_GET["id"];
    $delete=$dbh->prepare($reqdelete);
    $delete->execute();
    header('Location: edit.php');

}
elseif(isset($_POST["changeContenu"]))
{
    //var_dump($_POST["modifContenu"]);
    $reqdelete='UPDATE question set contenu="'.$_POST["modifContenu"].'" where id = '.$_GET["id"];
    $delete=$dbh->prepare($reqdelete);
    $delete->execute();
    header('Location: edit.php');

}
elseif(isset($_POST["changeComm"]))
{
    //var_dump($_POST["modifContenu"]);
    var_dump($_POST["modifComm"]);
    var_dump($_GET["id"]);
    $reqdelete='UPDATE commentaire set contenu="'.$_POST["modifComm"].'" where id = '.$_GET["id"];
    $delete=$dbh->prepare($reqdelete);
    $delete->execute();
    header('Location: edit.php');

}





/*****************************************************************************************************/
 if($_GET["action"]=="suppress")
 {
    
    if($_GET["modif"]=="page")
     {$reqdelete='DELETE from question where id ='.$_GET["id"];
     $delete=$dbh->prepare($reqdelete);
     $delete->execute();
 
     header('Location: edit.php');}

     elseif($_GET["modif"]=="user"){
        $reqdelete='DELETE from users where id ='.$_GET["id"];
        $delete=$dbh->prepare($reqdelete);
        $delete->execute();
        header('Location: edit.php');        
     }
     elseif($_GET["modif"]=="comm"){
        $reqdelete='DELETE from commentaire where id ='.$_GET["id"];
        $delete=$dbh->prepare($reqdelete);
        $delete->execute();
        header('Location: edit.php');        
     }


     
 }
 //////////////////////////////////////////////////////////
 elseif ($_GET["action"]=="edit") {
     
    if($_GET["modif"]=="pageTitre")
    {
        //var_dump($_GET["id"]);
        $request='SELECT titre from question where id = '.$_GET["id"];
        $selecttitre=$dbh->prepare($request);
        $selecttitre->execute();
        $getTitre=$selecttitre->fetch();
        //var_dump($getTitre["titre"]);
    ?>

<form action="#" method="POST">
 <textarea name="modifTitre" ><?php echo($getTitre["titre"]);?> </textarea>
 <input name="changeTitle" value="OK" type="submit"/>
</form>

<?php
    }

    elseif($_GET["modif"]=="pageContenu")
    {
        //var_dump($_GET["id"]);
        $request='SELECT contenu from question where id = '.$_GET["id"];
        $selecttitre=$dbh->prepare($request);
        $selecttitre->execute();
        $getTitre=$selecttitre->fetch();
        //var_dump($getTitre["contenu"]);
    ?>

<form action="#" method="POST">
 <textarea name="modifContenu" ><?php echo($getTitre["contenu"]);?></textarea>
 <input name="changeContenu" value="OK" type="submit"/>
</form>

<?php
    }

    elseif($_GET["modif"]=="comm")
    {
        //var_dump($_GET["id"]);
        $request='SELECT contenu from commentaire where id = '.$_GET["id"];
        $selecttitre=$dbh->prepare($request);
        $selecttitre->execute();
        $getTitre=$selecttitre->fetch();
        //var_dump($getTitre["contenu"]);
    ?>

<form action="#" method="POST">
 <textarea name="modifComm" ><?php echo($getTitre["contenu"]);?></textarea>
 <input name="changeComm" value="OK" type="submit"/>
</form>

<?php
    }




 

 }
 elseif ($_GET["action"]=="addPage") {
    


?>
<div class="add_page_container">
    <form class="input_container_edit" action="#" method="POST">
            <input class="page_title_edit" name='titre' type="text" placeholder='Titre de la page'>
            <textarea class="page_content_edit" name="contenu" type="text" placeholder="Contenu de la page" ></textarea>
            <input class="add_page" name="addPage" value="Creer la page !" type="submit"/>
    </form>
 </div>


<?php
    }
    if(isset($_POST["addPage"]))
    {
        $reqAddPage="INSERT INTO question(titre,contenu,date) values('".$_POST["titre"]."','".$_POST["contenu"]."',now())";

        $addPage = $dbh->prepare($reqAddPage);
        $addPage->execute();
        //var_dump($reqAddPage);
        header("Location:edit.php");
    }

if(isset($_GET["modif"])) {
    if($_GET["modif"]=="ips")
    {
        if($_GET["action"]=="ban")
        {
            $requestBanIp="insert into ips values('".$_GET["id"]."',1)";
            $BanIp=$dbh->prepare($requestBanIp);
            $BanIp->execute();
            //ne sert que si l'IP a déjà été bannie une fois mais débannie. (constraint unique sur la colonne ip)
            $requestBanIp="update ips set status=1 where ip = '".$_GET["id"]."'";
            $BanIp=$dbh->prepare($requestBanIp);
            $BanIp->execute();
            header("Location:edit.php");

        }

        if($_GET["action"]=="deban")
        {
            $requestDebanIp="update ips set status=0 where ip = '".$_GET["id"]."'";
            $deBanIp=$dbh->prepare($requestDebanIp);
            $deBanIp->execute();
            header("Location:edit.php");



        }


    }

}

}
?>


