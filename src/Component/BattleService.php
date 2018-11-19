<?php
include 'src/Entity/NaturalDisasters.php';

class BattleService
{
    private $armyController;

    /**
     * BattleService constructor.
     */
    public function __construct()
    {
        $this->armyController = new ArmyController();
    }

    /**
     * @param Army $army1
     * @param Army $army2
     * @return mixed
     */
    public function naturalDisaster(Army $army1, Army $army2)
    {
        $naturalDisaster = new NaturalDisasters();

        $this->armyController->soldiersDiedInDisaster($army1, $naturalDisaster->getKillsPerArmy());
        $this->armyController->soldiersDiedInDisaster($army2, $naturalDisaster->getKillsPerArmy());

        return $naturalDisaster->getDisasterName();
    }

    /**
     * @param Army $army1
     * @param Army $army2
     */
    public function fight(Army $army1, Army $army2)
    {
        $this->armyController->reduceSoldiersHealth($army1, $this->getHealthPerSoldier($army2, $army1));
        $this->armyController->reduceSoldiersHealth($army2, $this->getHealthPerSoldier($army1, $army2));
    }

    /**
     * @param Army $attacker
     * @param Army $defender
     * @return int
     */
    private function getHealthPerSoldier(Army $attacker, Army $defender)
    {
        // Calculating damage per solider with random factor
        return (int) (($attacker->getTotalDamage() / $defender->getSoldiersCount()) + rand(-5, 5));
    }
}