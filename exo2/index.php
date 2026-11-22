<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exo2 - Monitoring de serveurs</title>
</head>
<body>
<?php
    // tableau associatif, la valeur c'est un autre tableau (slide 64)
    $serveurs = array(
        'api-01'   => array('cpu'=>45, 'ram'=>60, 'status'=>"1"),
        'api-02'   => array('cpu'=>92, 'ram'=>78, 'status'=>"1"),
        'db-prod'  => array('cpu'=>70, 'ram'=>95, 'status'=>"1"),
        'web-01'   => array('cpu'=>30, 'ram'=>40, 'status'=>"1"),
        'web-02'   => array('cpu'=>55, 'ram'=>65, 'status'=>"0"),
        'cache-01' => array('cpu'=>88, 'ram'=>92, 'status'=>"1")
    );

    // pour le resume
    $totalOnline = 0;
    $sommeScores = 0;
    $meilleurServ = "";
    $meilleurScore = -1;
?>
    <!-- meme principe que l'exo1, les lignes sont generees en php (slide 27) -->
    <table id="table1" border="1">
        <tr>
            <th>Serveur</th>
            <th>CPU%</th>
            <th>RAM%</th>
            <th>Status</th>
            <th>Score</th>
            <th>État</th>
        </tr>
<?php
    // on parcourt les serveurs avec foreach (slide 69)
    foreach($serveurs as $nom=>$infos){
        $cpu = $infos['cpu'];
        $ram = $infos['ram'];
        $score = 100 - ($cpu+$ram)/2;

        // critique si cpu>85 ou ram>90
        if($cpu>85 || $ram>90)
            $etat = "CRITIQUE";
        elseif($score>=50)
            $etat = "OK";
        else
            $etat = "ATTENTION";

        // couleur de la ligne, offline en premier
        if($infos['status']=="0")
            $couleur = "rgb(200,200,200)";
        elseif($etat=="CRITIQUE")
            $couleur = "rgb(255,180,180)";
        elseif($score>=50)
            $couleur = "rgb(180,255,180)";
        else
            $couleur = "rgb(255,220,150)";

        if($infos['status']=="1"){
            $status = "online";
            $totalOnline++;
        }
        else
            $status = "offline";

        $sommeScores = $sommeScores + $score;

        // on garde le meilleur score
        if($score>$meilleurScore){
            $meilleurScore = $score;
            $meilleurServ = $nom;
        }

        echo "<tr class='row' style='background-color:$couleur'>
                <td class='serveur'>$nom</td>
                <td class='cpu'>$cpu</td>
                <td class='ram'>$ram</td>
                <td class='status'>$status</td>
                <td class='score'>$score</td>
                <td class='etat'>$etat</td>
            </tr>";
    }

    // count donne le nombre de serveurs (slide 65)
    $moyScores = $sommeScores / count($serveurs);
?>
    </table>

    <h3>Résumé</h3>
    <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
    <p>Score moyen: <span id="moy_scores"><?php echo $moyScores; ?></span></p>
    <p>Meilleur serveur: <span id="best_serv"><?php echo "$meilleurServ ($meilleurScore)"; ?></span></p>
</body>
</html>
