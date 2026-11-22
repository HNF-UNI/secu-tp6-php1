<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exo1 - Etudiants Note</title>
</head>
<body>
<?php
    // tableau associatif nom => moyenne (slide 64)
    $etudiantsNote = array('JOHN'=>9, 'BOB'=>15.5, 'RAYANE'=>7, 'ROSIE'=>13);

    // fonction avec retour, vrai si la note >= 10 (slide 71)
    function estAdmissible($note){
        return $note >= 10;
    }
?>
    <!-- les lignes du tableau sont generees par le php (slide 27) -->
    <table id="table1" border="1">
        <tr>
            <th>Etudiant</th>
            <th>Note</th>
        </tr>
<?php
    // on parcourt les etudiants avec foreach (slide 69)
    foreach($etudiantsNote as $etudiant=>$note){
        // vert si admissible sinon rouge
        if(estAdmissible($note))
            $couleur = "rgb(136,248,136)";
        else
            $couleur = "rgb(251,173,173)";

        echo "<tr class='row' style='background-color:$couleur'>
                <td class='etud'>$etudiant</td>
                <td class='note'>$note</td>
            </tr>";
    }
?>
    </table>
</body>
</html>
