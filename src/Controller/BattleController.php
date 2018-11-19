<?php
include 'src/Component/BattleReport.php';
include 'src/Controller/ArmyController.php';
include 'src/Component/BattleService.php';

class BattleController
{
    private $army1;
    private $army2;
    private $armyController;
    private $battleReport;
    private $battleService;

    /**
     * BattleController constructor.
     * @param Army $army1
     * @param Army $army2
     */
    public function __construct(Army $army1, Army $army2)
    {
        $this->army1 = $army1;
        $this->army2 = $army2;
        $this->armyController = new ArmyController();
        $this->battleReport = new BattleReport();
        $this->battleService = new BattleService();
    }

    /**
     * @return array
     */
    public function battle()
    {
        $this->battleReport->log($this->army1, $this->army2, 0);
        $day = 1;
        do {
            // Chance for natural disaster is 1/7
            if (7 === rand(1, 7)) {
                $this->endOfTheDay($day, $this->battleService->naturalDisaster($this->army1, $this->army2));
                $day++;

                continue;
            }

            $this->battleService->fight($this->army1, $this->army2);

            $this->endOfTheDay($day);
            $day++;
        } while ($this->army1->areSoldiersAlive() && $this->army2->areSoldiersAlive());

        $this->battleReport->announceWinner($this->army1, $this->army2);

        return $this->battleReport->getReport();
    }

    /**
     * @param int         $day
     * @param string|null $disasterName
     */
    private function endOfTheDay($day, $disasterName = null)
    {
        $this->armyController->heal($this->army1);
        $this->army1->randomFormation();

        $this->armyController->heal($this->army2);
        $this->army2->randomFormation();

        $this->battleReport->log($this->army1, $this->army2, $day, $disasterName);
    }
}