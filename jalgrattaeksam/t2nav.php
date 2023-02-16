<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET t2nav=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET t2nav=2 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vigane_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE slaalom=1 AND ringtee=1 AND t2nav=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Tänavasõit</title>
    <link rel="stylesheet" href="style.css">
</head>

<h1>Daniil Jalgrattaeksami leht</h1>

<div class="nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
        <div class="nav-title">




        </div>
    </div>
    <div class="nav-btn">

        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>



    </div>

    <div class='nav-links'>

        <?php

        echo "<a href='registreerimine.php' target='_self' >Registreerimine</a>";
        echo "<a href='teooriaeksam.php' target='_self' >Teooriaeksam</a>";
        echo "<a href='slaalom.php' target='_self' >Slaalom</a>";
        echo "<a href='ringtee.php' target='_self' >Ringtee</a>";
        echo "<a href='t2nav.php' target='_self' >Tanav</a>";
        echo "<a href='lubadeleht.php' target='_self' >lubaleht</a>";



        ?>

    </div>

</div>






<body>
<h1>Tänavasõit</h1>
<table>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td>
			    <a href='?korras_id=$id'>Korras</a>
			    <a href='?vigane_id=$id'>Ebaõnnestunud</a>
			  </td>
			</tr>
		  ";
    }
    ?>
</table>
<img src="unnamed.jpg" width="150">
</body>
</html>

