<?php

class BattleReport
{
    private $report = [];

    /**
     * @return array
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param Army        $army1
     * @param Army        $army2
     * @param int         $day
     * @param string|null $disaster
     */
    public function log(Army $army1, Army $army2, $day, $disaster = null)
    {
        if ($disaster) {
            $this->report[$day]['disaster'] = $disaster;
        }
        $this->report[$day]['army1_damage'] = $army1->getTotalDamage();
        $this->report[$day]['army1_soldiers'] = $army1->getSoldiersCount();

        $this->report[$day]['army2_damage'] = $army2->getTotalDamage();
        $this->report[$day]['army2_soldiers'] = $army2->getSoldiersCount();
    }

    /**
     * @param Army $army1
     * @param Army $army2
     */
    public function announceWinner(Army $army1, Army $army2)
    {
        if (!$army1->areSoldiersAlive() && !$army2->areSoldiersAlive()) {
            $this->report['winner'] = 'No winner. Both armies are destroyed';
            return;
        }

        $this->report['winner'] = $army1->areSoldiersAlive() ? 'Army 1' : 'Army 2';
    }
}
