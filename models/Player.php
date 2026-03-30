<?php
// models/Player.php

require_once __DIR__ . '/../config/database.php';

class Player {
    private $conn;
    private $table = 'players';
    
    public $id;
    public $name;
    public $position;
    public $status;
    public $rings;
    public $mvp;
    public $fmvp;
    public $all_nba;
    public $all_def;
    public $dpoy;
    public $roty;
    public $mip;
    public $sixth_man;
    public $ppg_lc;
    public $rpg_lc;
    public $apg_lc;
    public $spg_lc;
    public $bpg_lc;
    public $retired_order;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    /**
     * Calculate player score based on weighted values
     * 
     * Philosophy:
     * - MVP: Most prestigious individual award (15 pts)
     * - FMVP: Best player on championship team (12 pts)
     * - Rings: Team accomplishment, slightly reduced (8 pts)
     * - DPOY: Great but less than MVP (6 pts)
     * - All-NBA: Top 15 players each season (3 pts)
     * - All-Defense: Best defenders (2 pts)
     * - ROTY: Immediate impact (3 pts)
     * - Scoring Title: Elite scoring (4 pts)
     * - Other stat titles: Position-specific (2 pts)
     * - MIP/6MOY: Nice but not elite (1 pt)
     */
    private function calculatePlayerScore($player) {
        return ($player['rings'] * 8) +           // Rings - team accomplishment
               ($player['mvp'] * 15) +             // MVP - Most prestigious
               ($player['fmvp'] * 12) +            // FMVP - Best on championship team
               ($player['dpoy'] * 6) +             // DPOY - Great but less than MVP
               ($player['all_nba'] * 3) +          // All-NBA - Top 15 player
               ($player['all_def'] * 2) +          // All-Defense - Elite defender
               ($player['roty'] * 3) +             // ROTY - Immediate stardom
               ($player['mip'] * 1) +              // MIP - Nice but not elite
               ($player['sixth_man'] * 1) +        // 6MOY - Valuable role player
               ($player['ppg_lc'] * 4) +           // Scoring Title - Elite scorer
               ($player['rpg_lc'] * 2) +           // Rebound Title - Big man elite
               ($player['apg_lc'] * 2) +           // Assist Title - Playmaker elite
               ($player['spg_lc'] * 2) +           // Steals Title - Defensive elite
               ($player['bpg_lc'] * 2);            // Blocks Title - Rim protector
    }
    
    /**
     * Get Top X players by score based on current year
     * Formula: Top X = Year - 2000
     * Example: 2019 = Top 19, 2042 = Top 42, 2045 = Top 45
     */
    public function getTopRanking($year = null) {
        if ($year === null) {
            $year = date('Y');
        }
        
        // Calculate limit based on year
        $limit = $year - 2000;
        
        // Get ALL players
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculate scores for all players
        foreach ($players as $key => $player) {
            $players[$key]['score'] = $this->calculatePlayerScore($player);
        }
        
        // Sort by score DESCENDING (highest first)
        usort($players, function($a, $b) {
            return $b['score'] - $a['score'];
        });
        
        // Take top X players based on year
        $topPlayers = array_slice($players, 0, $limit);
        
        // Add rank numbers
        foreach ($topPlayers as $index => $player) {
            $topPlayers[$index]['rank'] = $index + 1;
        }
        
        return $topPlayers;
    }
    
    /**
     * Get Honorable Mention players (outside Top X based on year)
     */
    public function getHonorableMention($year = null) {
        if ($year === null) {
            $year = date('Y');
        }
        
        // Calculate limit based on year
        $limit = $year - 2000;
        
        // Get ALL players
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Calculate scores for all players
        foreach ($players as $key => $player) {
            $players[$key]['score'] = $this->calculatePlayerScore($player);
        }
        
        // Sort by score DESCENDING
        usort($players, function($a, $b) {
            return $b['score'] - $a['score'];
        });
        
        // Get players outside top X
        $hmPlayers = array_slice($players, $limit);
        
        // Sort HM alphabetically by name
        usort($hmPlayers, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        
        return $hmPlayers;
    }
    
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->position = $row['position'];
            $this->status = $row['status'];
            $this->rings = $row['rings'];
            $this->mvp = $row['mvp'];
            $this->fmvp = $row['fmvp'];
            $this->all_nba = $row['all_nba'];
            $this->all_def = $row['all_def'];
            $this->dpoy = $row['dpoy'];
            $this->roty = $row['roty'];
            $this->mip = $row['mip'];
            $this->sixth_man = $row['sixth_man'];
            $this->ppg_lc = $row['ppg_lc'];
            $this->rpg_lc = $row['rpg_lc'];
            $this->apg_lc = $row['apg_lc'];
            $this->spg_lc = $row['spg_lc'];
            $this->bpg_lc = $row['bpg_lc'];
            $this->retired_order = $row['retired_order'];
            return true;
        }
        return false;
    }
    
    public function create() {
        $checkQuery = "SELECT id FROM " . $this->table . " WHERE name = :name";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(':name', $this->name);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            return false;
        }
        
        $query = "INSERT INTO " . $this->table . " 
                  (name, position, status, rings, mvp, fmvp, all_nba, all_def, dpoy, 
                   roty, mip, sixth_man, ppg_lc, rpg_lc, apg_lc, spg_lc, bpg_lc) 
                  VALUES 
                  (:name, :position, :status, :rings, :mvp, :fmvp, :all_nba, :all_def, :dpoy, 
                   :roty, :mip, :sixth_man, :ppg_lc, :rpg_lc, :apg_lc, :spg_lc, :bpg_lc)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':rings', $this->rings);
        $stmt->bindParam(':mvp', $this->mvp);
        $stmt->bindParam(':fmvp', $this->fmvp);
        $stmt->bindParam(':all_nba', $this->all_nba);
        $stmt->bindParam(':all_def', $this->all_def);
        $stmt->bindParam(':dpoy', $this->dpoy);
        $stmt->bindParam(':roty', $this->roty);
        $stmt->bindParam(':mip', $this->mip);
        $stmt->bindParam(':sixth_man', $this->sixth_man);
        $stmt->bindParam(':ppg_lc', $this->ppg_lc);
        $stmt->bindParam(':rpg_lc', $this->rpg_lc);
        $stmt->bindParam(':apg_lc', $this->apg_lc);
        $stmt->bindParam(':spg_lc', $this->spg_lc);
        $stmt->bindParam(':bpg_lc', $this->bpg_lc);
        
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    
    public function update() {
        $query = "UPDATE " . $this->table . "
                  SET name = :name,
                      position = :position,
                      status = :status,
                      rings = :rings,
                      mvp = :mvp,
                      fmvp = :fmvp,
                      all_nba = :all_nba,
                      all_def = :all_def,
                      dpoy = :dpoy,
                      roty = :roty,
                      mip = :mip,
                      sixth_man = :sixth_man,
                      ppg_lc = :ppg_lc,
                      rpg_lc = :rpg_lc,
                      apg_lc = :apg_lc,
                      spg_lc = :spg_lc,
                      bpg_lc = :bpg_lc
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':rings', $this->rings);
        $stmt->bindParam(':mvp', $this->mvp);
        $stmt->bindParam(':fmvp', $this->fmvp);
        $stmt->bindParam(':all_nba', $this->all_nba);
        $stmt->bindParam(':all_def', $this->all_def);
        $stmt->bindParam(':dpoy', $this->dpoy);
        $stmt->bindParam(':roty', $this->roty);
        $stmt->bindParam(':mip', $this->mip);
        $stmt->bindParam(':sixth_man', $this->sixth_man);
        $stmt->bindParam(':ppg_lc', $this->ppg_lc);
        $stmt->bindParam(':rpg_lc', $this->rpg_lc);
        $stmt->bindParam(':apg_lc', $this->apg_lc);
        $stmt->bindParam(':spg_lc', $this->spg_lc);
        $stmt->bindParam(':bpg_lc', $this->bpg_lc);
        
        return $stmt->execute();
    }
    
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
    
    public function updateAchievement($achievement, $value) {
        $allowed = ['rings', 'mvp', 'fmvp', 'all_nba', 'all_def', 'dpoy', 
                    'ppg_lc', 'rpg_lc', 'apg_lc', 'spg_lc', 'bpg_lc'];
        
        if (!in_array($achievement, $allowed)) {
            return false;
        }
        
        $query = "UPDATE " . $this->table . " 
                  SET $achievement = $achievement + :value 
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $this->id);
        
        return $stmt->execute();
    }
}
?>