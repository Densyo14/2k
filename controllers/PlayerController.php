<?php
// controllers/PlayerController.php

require_once __DIR__ . '/../models/Player.php';

class PlayerController {
    private $player;
    
    public function __construct() {
        $this->player = new Player();
    }
    
    public function getAll() {
        try {
            $players = $this->player->getAll();
            return ['success' => true, 'players' => $players];
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    public function getById($id) {
        if ($this->player->getById($id)) {
            return ['success' => true, 'player' => [
                'id' => $this->player->id,
                'name' => $this->player->name,
                'position' => $this->player->position,
                'status' => $this->player->status,
                'rings' => $this->player->rings,
                'mvp' => $this->player->mvp,
                'fmvp' => $this->player->fmvp,
                'all_nba' => $this->player->all_nba,
                'all_def' => $this->player->all_def,
                'dpoy' => $this->player->dpoy,
                'roty' => $this->player->roty,
                'mip' => $this->player->mip,
                'sixth_man' => $this->player->sixth_man,
                'ppg_lc' => $this->player->ppg_lc,
                'rpg_lc' => $this->player->rpg_lc,
                'apg_lc' => $this->player->apg_lc,
                'spg_lc' => $this->player->spg_lc,
                'bpg_lc' => $this->player->bpg_lc
            ]];
        }
        return ['success' => false, 'error' => 'Player not found'];
    }
    
    public function create($data) {
        // Validate name
        if (empty($data['name']) || trim($data['name']) === '') {
            return ['success' => false, 'error' => 'Player name is required'];
        }
        
        $this->player->name = trim($data['name']);
        $this->player->position = $data['position'];
        $this->player->status = $data['status'];
        $this->player->rings = isset($data['rings']) ? (int)$data['rings'] : 0;
        $this->player->mvp = isset($data['mvp']) ? (int)$data['mvp'] : 0;
        $this->player->fmvp = isset($data['fmvp']) ? (int)$data['fmvp'] : 0;
        $this->player->all_nba = isset($data['all_nba']) ? (int)$data['all_nba'] : 0;
        $this->player->all_def = isset($data['all_def']) ? (int)$data['all_def'] : 0;
        $this->player->dpoy = isset($data['dpoy']) ? (int)$data['dpoy'] : 0;
        $this->player->roty = isset($data['roty']) ? (int)$data['roty'] : 0;
        $this->player->mip = isset($data['mip']) ? (int)$data['mip'] : 0;
        $this->player->sixth_man = isset($data['sixth_man']) ? (int)$data['sixth_man'] : 0;
        $this->player->ppg_lc = isset($data['ppg_lc']) ? (int)$data['ppg_lc'] : 0;
        $this->player->rpg_lc = isset($data['rpg_lc']) ? (int)$data['rpg_lc'] : 0;
        $this->player->apg_lc = isset($data['apg_lc']) ? (int)$data['apg_lc'] : 0;
        $this->player->spg_lc = isset($data['spg_lc']) ? (int)$data['spg_lc'] : 0;
        $this->player->bpg_lc = isset($data['bpg_lc']) ? (int)$data['bpg_lc'] : 0;
        
        if ($this->player->create()) {
            return ['success' => true, 'id' => $this->player->id, 'name' => $this->player->name];
        }
        
        return ['success' => false, 'error' => 'Failed to create player. Name might already exist.'];
    }
    
    public function update($id, $data) {
        if (!$this->player->getById($id)) {
            return ['success' => false, 'error' => 'Player not found'];
        }
        
        $this->player->name = $data['name'];
        $this->player->position = $data['position'];
        $this->player->status = $data['status'];
        $this->player->rings = isset($data['rings']) ? (int)$data['rings'] : 0;
        $this->player->mvp = isset($data['mvp']) ? (int)$data['mvp'] : 0;
        $this->player->fmvp = isset($data['fmvp']) ? (int)$data['fmvp'] : 0;
        $this->player->all_nba = isset($data['all_nba']) ? (int)$data['all_nba'] : 0;
        $this->player->all_def = isset($data['all_def']) ? (int)$data['all_def'] : 0;
        $this->player->dpoy = isset($data['dpoy']) ? (int)$data['dpoy'] : 0;
        $this->player->roty = isset($data['roty']) ? (int)$data['roty'] : 0;
        $this->player->mip = isset($data['mip']) ? (int)$data['mip'] : 0;
        $this->player->sixth_man = isset($data['sixth_man']) ? (int)$data['sixth_man'] : 0;
        $this->player->ppg_lc = isset($data['ppg_lc']) ? (int)$data['ppg_lc'] : 0;
        $this->player->rpg_lc = isset($data['rpg_lc']) ? (int)$data['rpg_lc'] : 0;
        $this->player->apg_lc = isset($data['apg_lc']) ? (int)$data['apg_lc'] : 0;
        $this->player->spg_lc = isset($data['spg_lc']) ? (int)$data['spg_lc'] : 0;
        $this->player->bpg_lc = isset($data['bpg_lc']) ? (int)$data['bpg_lc'] : 0;
        
        if ($this->player->update()) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Failed to update player'];
    }
    
    public function delete($id) {
        if (!$this->player->getById($id)) {
            return ['success' => false, 'error' => 'Player not found'];
        }
        
        if ($this->player->delete()) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Failed to delete player'];
    }
    
    public function updateAchievement($id, $achievement, $value) {
        if (!$this->player->getById($id)) {
            return ['success' => false, 'error' => 'Player not found'];
        }
        
        if ($this->player->updateAchievement($achievement, $value)) {
            return ['success' => true];
        }
        return ['success' => false, 'error' => 'Failed to update achievement'];
    }
}
?>