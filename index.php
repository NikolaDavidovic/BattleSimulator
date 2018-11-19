<?php
include 'src/Entity/Army.php';
include 'src/Controller/BattleController.php';

$army1Soldiers = (int) $_GET['army1'];
$army2Soldiers = (int) $_GET['army2'];

$army1 = new Army($army1Soldiers);
$army2 = new Army($army2Soldiers);

$battle = new BattleController($army1, $army2);
$reports = $battle->battle();

foreach ($reports as $key => $report) {
    if (!isset($report['army1_damage'])) {
        break;
    }

    if (0 !== $key) {
        echo $key . ". Day: <br/><br/>";
    } else {
        echo "Pre-Battle Stats: <br/><br/>";
    }

    if (isset($report['disaster'])) {
        echo "Both armies took damage due to the " . $report['disaster'] . "<br/><br/>";
    }

    echo "Army 1 damage: " . $report['army1_damage'] . "<br/>";
    echo "Army 1 soldiers: " . $report['army1_soldiers'] . "<br/> <br/>";

    echo "Army 2 damage: " . $report['army2_damage'] . "<br/>";
    echo "Army 2 soldiers: " . $report['army2_soldiers'] . "<br/> <br/>";

    echo "============================================================================= <br/>";
}

echo "Winner: " . $reports['winner'];