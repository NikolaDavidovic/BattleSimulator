<?php
include 'src/Component/ArmyService.php';

class ArmyController
{
    private $armyService;

    /**
     * ArmyController constructor.
     */
    public function __construct()
    {
        $this->armyService = new ArmyService();
    }

    /**
     * @param Army $army
     * @param int  $health
     */
    public function reduceSoldiersHealth(Army $army, $health)
    {
        /** @var Soldier $soldier */
        foreach ($army->getSoldiers() as $key => $soldier) {
            $soldier->reduceHealth($health);
            if ($soldier->isDead()) {
                $army->reduceTotalDamage($soldier->getDamage());
                $soldier->setIsDead(true);
                $army->killSoldier($key);
            }
        }
    }

    /**
     * Heal soldiers
     * @param Army $army
     */
    public function heal(Army $army)
    {
        if ($numberOfMedics = $this->armyService->getNumberOfMedics($army->getSoldiers())) {
            $this->armyService->increaseSoldiersHealth($numberOfMedics * Soldier::MEDIC_HEAL, $army->getSoldiers());
        }
    }

    /**
     * @param Army $army
     * @param int  $numOfDeadSoldiers
     */
    public function soldiersDiedInDisaster(Army $army, $numOfDeadSoldiers)
    {
        if ($numOfDeadSoldiers > $army->getSoldiersCount()) {
            $this->armyService->killAllSoldiers($army);
            return;
        }

        $army->randomFormation();

        for ($i = 0; $i < $numOfDeadSoldiers; $i++) {
            /** @var Soldier $soldier */
            $soldier = $army->getSoldiers()[$i];
            $army->reduceTotalDamage($soldier->getDamage());
            $soldier->setIsDead(true);
            $army->killSoldier($i);
        }
    }
}