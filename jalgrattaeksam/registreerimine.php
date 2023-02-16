<?php
require_once("konf.php");
global $yhendus;
if (isset($_REQUEST["sisestusnupp"])) {
        $kask = $yhendus->prepare(
            "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
        $kask->execute();
        $yhendus->close();
        header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
        header("Location: teooriaeksam.php");
        exit();
}

?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
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
<h1>Registreerimine</h1>
<?php
if(isSet($_REQUEST["lisatudeesnimi"])){
    echo "Lisati $_REQUEST[lisatudeesnimi]";
}
?>
<form action="?">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" placeholder="eesnimi" pattern="[A-Za-z]+" /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" placeholder="perekonnanimi" pattern="[A-Za-z].{2,}" /></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
    </dl>

    <img src="unnamed.jpg" width="150">

</form>
</body>
</html>

