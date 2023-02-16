<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["teooriatulemus"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["teooriatulemus"], $_REQUEST["id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Teooriaeksam</title>
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
<table>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$eesnimi</td>
			  <td>$perekonnanimi</td>
			  <td><form action=''>
			         <input type='hidden' name='id' value='$id' />
					 <input type='text' name='teooriatulemus' />
					 <input type='submit' value='Sisesta tulemus' />
			      </form>
			  </td>
			</tr>
		  ";
    }
    ?>
</table>
Kui teooriaeksami punktid vähem kui 10, siis registreeri uuesti
<br>
<img src="unnamed.jpg" width="150">
</body>
</html>

