<?php
// controllers/RankingController.php

require_once __DIR__ . '/../models/Player.php';

class RankingController {
    private $player;
    private $currentYear;
    
    public function __construct() {
        $this->player = new Player();
        session_start();
        $this->currentYear = $_SESSION['current_year'] ?? 2042;
    }
    
    public function getRanking() {
        $ranking = $this->player->getTopRanking($this->currentYear);
        return ['success' => true, 'ranking' => $ranking, 'current_year' => $this->currentYear];
    }
    
    public function getHonorableMention() {
        $hmPlayers = $this->player->getHonorableMention($this->currentYear);
        return ['success' => true, 'hm_players' => $hmPlayers, 'current_year' => $this->currentYear];
    }
    
    public function setCurrentYear($year) {
        $_SESSION['current_year'] = $year;
        $this->currentYear = $year;
        return ['success' => true, 'current_year' => $year];
    }
}
?>