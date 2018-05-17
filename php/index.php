



<?php 
include("coBDD.php");?>
<!--
<form action="page.php" method="GET">
 <p>page : <input type="text" name="id" /></p>
 <p><input type="submit" value="OK"></p>
</form>-->


<?php
/**/

?>





<link rel="stylesheet" type="text/css" href="../css/home.css">
<link rel="stylesheet" type="text/css" href="../css/header.css">
<link rel="stylesheet" type="text/css" href="../css/comments.css">
<html id="global_size">

    <body>
        <p class="home_text_container" >
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aliquam sed laoreet metus. Sed non vulputate eros. Aenean vel nisl nec tellus auctor ornare.
            Nullam pharetra fringilla ornare. Donec tincidunt tempor elit sit amet efficitur. 
            Mauris in condimentum ipsum. Phasellus nunc dolor, rhoncus blandit ex ut, laoreet luctus purus. 
            Fusce convallis, velit mattis finibus convallis, sapien massa faucibus nisl, vel tempor urna sapien et neque. 
            Donec ultricies urna vitae nibh mollis semper. Nam sed eros fringilla, semper augue imperdiet, vehicula velit. 
            Aliquam quis quam sit amet lectus interdum egestas vel id lacus. 
        </p>
        <p class="home_text_container" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Aliquam sed laoreet metus. Sed non vulputate eros. Aenean vel nisl nec tellus auctor ornare.
                Nullam pharetra fringilla ornare. Donec tincidunt tempor elit sit amet efficitur. 
                Mauris in condimentum ipsum. Phasellus nunc dolor, rhoncus blandit ex ut, laoreet luctus purus. 
                Fusce convallis, velit mattis finibus convallis, sapien massa faucibus nisl, vel tempor urna sapien et neque. 
                Donec ultricies urna vitae nibh mollis semper. Nam sed eros fringilla, semper augue imperdiet, vehicula velit. 
                Aliquam quis quam sit amet lectus interdum egestas vel id lacus. 
            </p>
        <div class="all_comments">

<?php
$page=$dbh->prepare('SELECT * from commentaire order by date DESC');
       	 $page->execute();
			$count=1;
		if(connected($dbh))
		{
			$count=-7;
		}	


	foreach($page->fetchAll(PDO::FETCH_ASSOC) as $row) {

		$id=$row["id_question"];
		$titre=$row["contenu"];
	//	var_dump($row);
	$getUsername=$dbh->prepare('SELECT pseudo from users where id='.$row["id_auteur"]);
	$getUsername->execute();
	
	$username=$getUsername->fetchAll()[0]["pseudo"];
	//var_dump($row);

    $getPages=$dbh->prepare("SELECT * from question WHERE id=". $row["id_question"]);
    $getPages->execute();
   // var_dump($getPages->fetchAll());
    $result = $getPages->fetchAll();
    $pagesNames = $result[0]["titre"];
    $pagesId = $result[0]["id"];    
?>

            <div class="comments_display">
                <div class="comments_display_user_and_page">
                    <span class="comment_user"><?php echo($username);?></span>
                    <span class="comment_page">Dans la page:&nbsp;&nbsp;
                        <a class="page_title" href="page.php?id=<?php echo($pagesId);?>"> <?php echo($pagesNames);?>
                        </a>
                    </span>
                </div>
                <span class="comment_date"><?php echo($row["date"]);?></span>
                <span class="separation_user_comments">_______________________________________________________________________</span>
                <p class="comment"><?php echo($row["contenu"]);?></p>

            </div>
<?php
    


	if($count==3)
	{
		break;
	}
	$count++;
    

    }
    
if(!connected($dbh))
{
	?>
    <span class="connection_message">Veuillez vous connecter pour afficher plus de commentaire et en poster !</span>

<?php }
?>
                
        </div>
		<?php


if(isadmin($dbh))

{
?>
<?php
}?>
    </body>
    <footer>
        <br></br>
    <?php 
include("../html/footer.html");?>

    </footer>
</html>