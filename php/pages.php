
<link rel="stylesheet" type="text/css" href="../css/pages.css">
<?php
include("coBDD.php");
$strRequest="select * from question";
$requestPage= $dbh->prepare($strRequest);
$requestPage->execute();
$PageContent=$requestPage->fetchAll();

foreach($PageContent as $row)
{

    $date = date_create($row["date"]);
    echo '<div class="titre">' .$row["titre"] . '</div>';
    echo '<div class="date">' . date_format($date,"d/m/Y H:i") . '</div>';
    echo("</br>");
    echo("<hr/>");

/*    echo '<div class="comment">' . $row["contenu"] . '</div>';*/

}

?>

