<?php
require_once("konf.php");

if(isSet($_REQUEST['kustuta'])){
    global $yhendus;
    $kask=$yhendus->prepare('DELETE FROM jalgrattaeksam WHERE id=?');
    $kask->bind_param("s", $_REQUEST['kustuta']);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
}

global $yhendus;
if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}


$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus, 
	     slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus,
    $slaalom, $ringtee, $t2nav, $luba);
$kask->execute();

function asenda($nr){
    if($nr==-1){return ".";} //tegemata
    if($nr== 1){return "korras";}
    if($nr== 2){return "ebaõnnestunud";}
    return "Tundmatu number";
}
?>
<!doctype html>
<html>
<head>
    <title>Lõpetamine</title>
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
<h1>Lõpetamine</h1>
<table>
    <tr>
        <th>Kustuta</th>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Teooriaeksam</th>
        <th>Slaalom</th>
        <th>Ringtee</th>
        <th>Tänavasõit</th>
        <th>Lubade väljastus</th>
    </tr>
    <?php
    while($kask->fetch()){
        $asendatud_slaalom=asenda($slaalom);
        $asendatud_ringtee=asenda($ringtee);
        $asendatud_t2nav=asenda($t2nav);
        $loalahter=".";
        if($luba==1){$loalahter="Väljastatud";}
        if($luba==-1 and $t2nav==1){
            $loalahter="<a href='?vormistamine_id=$id'>Vormista load</a>";
        }
        echo "<tr>";
        ?>
        <td><a href="?kustuta=<?=$id ?>" onclick="return confirm('Kas ikka soovid kusutada?')">Kustuta</a>    </td>

        <?php
			   echo "<td>$eesnimi</td>";
			   echo "<td>$perekonnanimi</td>";
			   echo "<td>$teooriatulemus</td>";
			   echo "<td>$asendatud_slaalom</td>";
			   echo "<td>$asendatud_ringtee</td>";
			   echo "<td>$asendatud_t2nav</td>";
			   echo "<td>$loalahter</td>";
			 echo "</tr>";
    } ?>
</table>
<img src="unnamed.jpg" width="150">
</body>
</html>