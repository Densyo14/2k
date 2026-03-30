<?php
// views/index.php

require_once __DIR__ . '/../controllers/RankingController.php';

$controller = new RankingController();
$rankingData = $controller->getRanking();
$ranking = $rankingData['ranking'];
$currentYear = $rankingData['current_year'];
$hmData = $controller->getHonorableMention();
$hmPlayers = $hmData['hm_players'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA 2K19 All-Time Greats</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: #f4f6f9;
            color: #1e293b;
            line-height: 1.5;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1d428a, #c8102e);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .admin-link {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .admin-link a {
            color: #1d428a;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            background: white;
            border-radius: 30px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .admin-link a:hover {
            background: #1d428a;
            color: white;
        }

        /* Year Selector */
        .year-selector {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            background: white;
            padding: 0.8rem 1.5rem;
            border-radius: 40px;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        
        .year-selector label {
            font-weight: 600;
            color: #1d428a;
        }
        
        .year-selector input {
            padding: 0.4rem 0.8rem;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 0.9rem;
            width: 100px;
            text-align: center;
        }
        
        .year-selector button {
            background: #1d428a;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            cursor: pointer;
        }

        /* Scoring System - Top Bar */
        .scoring-system {
            background: white;
            border-radius: 20px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        
        .scoring-system h4 {
            font-size: 0.8rem;
            font-weight: 600;
            color: #1d428a;
            margin-bottom: 0.8rem;
            text-align: center;
        }
        
        .scoring-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }
        
        .scoring-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.7rem;
            color: #64748b;
            background: #f8fafc;
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
        }
        
        .scoring-item span:first-child {
            font-weight: 600;
        }
        
        .scoring-item span:last-child {
            font-weight: 700;
            color: #c8102e;
        }

        /* Search Bar */
        .search-container {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 40px;
            padding: 0.3rem 0.3rem 0.3rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            width: 100%;
            max-width: 400px;
        }
        
        .search-box input {
            flex: 1;
            border: none;
            padding: 0.7rem 0;
            font-size: 0.9rem;
            outline: none;
            background: transparent;
        }
        
        .search-box button {
            background: #1d428a;
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.8rem;
        }
        
        .search-box button:hover {
            background: #c8102e;
        }
        
        .search-reset {
            background: #64748b;
            margin-left: 0.5rem;
        }
        
        .search-reset:hover {
            background: #475569;
        }
        
        .no-results {
            text-align: center;
            padding: 2rem;
            color: #64748b;
            background: white;
            border-radius: 20px;
        }

        .stats-summary {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            padding: 0.8rem 1.5rem;
            border-radius: 40px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .stat-card span {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1d428a;
        }

        .stat-card label {
            font-size: 0.75rem;
            color: #64748b;
            margin-left: 0.5rem;
        }

        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .player-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            cursor: pointer;
            position: relative;
        }

        .player-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #1d428a 0%, #0f2b5a 100%);
            padding: 0.8rem 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rank-badge {
            background: rgba(255,255,255,0.2);
            padding: 0.2rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }

        .rank-1 { background: #ffd700; color: #1d428a; }
        .rank-2 { background: #c0c0c0; color: #1d428a; }
        .rank-3 { background: #cd7f32; color: #1d428a; }

        .status-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.7rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .status-active {
            background: #c8102e;
            color: white;
        }

        .status-retired {
            background: #64748b;
            color: white;
        }

        .card-body {
            padding: 1.2rem;
        }

        .player-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0f2b5a;
            margin-bottom: 0.25rem;
        }

        .player-position {
            display: inline-block;
            background: #eef2ff;
            padding: 0.2rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #1d428a;
            margin-bottom: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.6rem;
            margin-bottom: 0.8rem;
        }

        .stat-item {
            text-align: center;
            background: #f8fafc;
            padding: 0.5rem;
            border-radius: 12px;
        }

        .stat-item .value {
            font-size: 1rem;
            font-weight: 700;
            color: #1d428a;
        }

        .stat-item .label {
            font-size: 0.6rem;
            color: #64748b;
        }

        .stats-grid-secondary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.6rem;
            margin-bottom: 0.8rem;
        }

        .stat-item-secondary {
            text-align: center;
            background: #f8fafc;
            padding: 0.5rem;
            border-radius: 12px;
        }

        .stat-item-secondary .value {
            font-size: 1rem;
            font-weight: 700;
            color: #1d428a;
        }

        .stat-item-secondary .label {
            font-size: 0.6rem;
            color: #64748b;
        }

        .league-leader-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0.4rem;
            margin-bottom: 0.8rem;
        }

        .leader-item {
            text-align: center;
            background: #eef2ff;
            padding: 0.3rem;
            border-radius: 8px;
        }

        .leader-item .value {
            font-size: 0.8rem;
            font-weight: 700;
            color: #1d428a;
        }

        .leader-item .label {
            font-size: 0.55rem;
            color: #64748b;
        }

        .award-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid #eef2ff;
        }

        .award-pill {
            background: #fef3e8;
            padding: 0.2rem 0.6rem;
            border-radius: 30px;
            font-size: 0.65rem;
            font-weight: 500;
            color: #c2410c;
        }

        .card-footer {
            background: #f8fafc;
            padding: 0.8rem 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eef2ff;
        }

        .score-label {
            font-size: 0.7rem;
            color: #64748b;
        }

        .score-value {
            font-size: 1.3rem;
            font-weight: 800;
            color: #c8102e;
        }

        /* HM Section */
        .hm-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e2e8f0;
        }
        
        .hm-title {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .hm-title h2 {
            color: #64748b;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .hm-title p {
            color: #94a3b8;
            font-size: 0.8rem;
        }
        
        .hm-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }
        
        .hm-card {
            background: white;
            border-radius: 16px;
            padding: 0.8rem 1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            border: 1px solid #eef2ff;
        }
        
        .hm-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            border-color: #1d428a;
        }
        
        .hm-card-name {
            font-weight: 700;
            color: #1d428a;
            font-size: 1rem;
        }
        
        .hm-card-position {
            font-size: 0.7rem;
            color: #64748b;
            margin-left: 0.5rem;
        }
        
        .hm-card-status {
            font-size: 0.65rem;
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            margin-left: 0.5rem;
        }
        
        .hm-card-status.active {
            background: #c8102e;
            color: white;
        }
        
        .hm-card-status.retired {
            background: #64748b;
            color: white;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 28px;
            max-width: 600px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1.2rem;
            font-size: 1.8rem;
            cursor: pointer;
            color: #64748b;
            transition: all 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f1f5f9;
        }

        .modal-close:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        .modal-header {
            background: linear-gradient(135deg, #1d428a, #0f2b5a);
            color: white;
            padding: 1.5rem;
            border-radius: 28px 28px 0 0;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .modal-header .modal-position {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.2rem 0.7rem;
            border-radius: 30px;
            font-size: 0.7rem;
            margin-top: 0.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .achievement-section {
            margin-bottom: 1.5rem;
        }

        .achievement-section h3 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1d428a;
            margin-bottom: 0.8rem;
            border-left: 3px solid #c8102e;
            padding-left: 0.8rem;
        }

        .achievement-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 0.8rem;
        }

        .achievement-item {
            background: #f8fafc;
            padding: 0.6rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .achievement-item .icon {
            font-size: 1.2rem;
        }

        .achievement-item .info {
            display: flex;
            flex-direction: column;
        }

        .achievement-item .value {
            font-size: 1rem;
            font-weight: 700;
            color: #1d428a;
        }

        .achievement-item .label {
            font-size: 0.7rem;
            color: #64748b;
        }

        .total-score {
            background: linear-gradient(135deg, #fef3e8, #ffe4cc);
            padding: 1rem;
            border-radius: 16px;
            text-align: center;
            margin-top: 1rem;
        }

        .total-score span {
            font-size: 2rem;
            font-weight: 800;
            color: #c8102e;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            .players-grid {
                grid-template-columns: 1fr;
            }
            .league-leader-grid {
                grid-template-columns: repeat(5, 1fr);
            }
            .leader-item .label {
                font-size: 0.5rem;
            }
            .scoring-grid {
                gap: 0.5rem;
            }
            .scoring-item {
                font-size: 0.6rem;
                padding: 0.2rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-link">
            <a href="admin.php">
                <span>⚙️</span> Admin Panel
            </a>
        </div>

        <!-- Year Selector -->
        <div class="year-selector">
            <label>📅 Current Season:</label>
            <input type="number" id="currentYear" value="<?= $currentYear ?>" min="2019" max="2100">
            <button onclick="updateYear()">Update</button>
            <span style="font-size: 0.7rem; color: #64748b;">Top 42 players based on achievements through this season</span>
        </div>

       <div class="header">
    <h1>🏀 NBA 2K19 All-Time Greats</h1>
    <p>21st Century Players · Top <?= $currentYear - 2000 ?> Ranking through <?= $currentYear ?> Season</p>
</div>

        <!-- Scoring System - MOVED TO TOP -->
       <div class="scoring-system">
    <h4>📊 Scoring System</h4>
    <div class="scoring-grid">
        <div class="scoring-item"><span>👑 MVP</span><span>15 pts</span></div>
        <div class="scoring-item"><span>⭐ FMVP</span><span>12 pts</span></div>
        <div class="scoring-item"><span>🏆 Ring</span><span>8 pts</span></div>
        <div class="scoring-item"><span>🔒 DPOY</span><span>6 pts</span></div>
        <div class="scoring-item"><span>🏀 Scoring Title (PPG)</span><span>4 pts</span></div>
        <div class="scoring-item"><span>🌟 All-NBA</span><span>3 pts</span></div>
        <div class="scoring-item"><span>👶 ROTY</span><span>3 pts</span></div>
        <div class="scoring-item"><span>📊 RPG/APG/SPG/BPG</span><span>2 pts</span></div>
        <div class="scoring-item"><span>🛡️ All-Def</span><span>2 pts</span></div>
        <div class="scoring-item"><span>📈 MIP/6MOY</span><span>1 pt</span></div>
    </div>
</div>

        <!-- Search Bar -->
        <div class="search-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Search player by name..." onkeyup="filterPlayers()">
                <button onclick="filterPlayers()">Search</button>
                <button onclick="resetSearch()" class="search-reset">Reset</button>
            </div>
        </div>

        <div class="stats-summary">
            <div class="stat-card">
                <span id="playerCount"><?= count($ranking) ?></span>
                <label>Top Players</label>
            </div>
            <div class="stat-card">
                <span><?= number_format($ranking[0]['score'] ?? 0, 1) ?></span>
                <label>Top Score</label>
            </div>
            <div class="stat-card">
                <span><?= $ranking[0]['name'] ?? 'N/A' ?></span>
                <label>#1 Player</label>
            </div>
        </div>

        <div class="players-grid" id="playersGrid">
            <?php foreach ($ranking as $index => $player): 
                $rank = $index + 1;
                $rankClass = '';
                if ($rank == 1) $rankClass = 'rank-1';
                elseif ($rank == 2) $rankClass = 'rank-2';
                elseif ($rank == 3) $rankClass = 'rank-3';
                
                $statusClass = $player['status'] == 'Active' ? 'status-active' : 'status-retired';
                
                $awards = [];
                if ($player['roty'] > 0) $awards[] = "ROTY";
                if ($player['mip'] > 0) $awards[] = "MIP";
                if ($player['sixth_man'] > 0) $awards[] = "6MOY";
            ?>
                <div class="player-card" data-name="<?= strtolower(htmlspecialchars($player['name'])) ?>" onclick="showPlayerModal(<?= htmlspecialchars(json_encode($player)) ?>)">
                    <div class="card-header">
                        <span class="rank-badge <?= $rankClass ?>">#<?= $rank ?></span>
                        <span class="status-badge <?= $statusClass ?>"><?= $player['status'] ?></span>
                    </div>
                    <div class="card-body">
                        <div class="player-name"><?= htmlspecialchars($player['name']) ?></div>
                        <span class="player-position"><?= htmlspecialchars($player['position']) ?></span>
                        
                        <div class="stats-grid">
                            <div class="stat-item"><div class="value"><?= $player['rings'] ?? 0 ?></div><div class="label">🏆 Rings</div></div>
                            <div class="stat-item"><div class="value"><?= $player['mvp'] ?? 0 ?></div><div class="label">👑 MVP</div></div>
                            <div class="stat-item"><div class="value"><?= $player['fmvp'] ?? 0 ?></div><div class="label">⭐ FMVP</div></div>
                            <div class="stat-item"><div class="value"><?= $player['dpoy'] ?? 0 ?></div><div class="label">🔒 DPOY</div></div>
                        </div>
                        
                        <div class="stats-grid-secondary">
                            <div class="stat-item-secondary"><div class="value"><?= $player['all_nba'] ?? 0 ?></div><div class="label">🌟 All-NBA</div></div>
                            <div class="stat-item-secondary"><div class="value"><?= $player['all_def'] ?? 0 ?></div><div class="label">🛡️ All-Defensive</div></div>
                        </div>
                        
                        <div class="league-leader-grid">
                            <div class="leader-item"><div class="value"><?= $player['ppg_lc'] ?? 0 ?></div><div class="label">🏀 PPG</div></div>
                            <div class="leader-item"><div class="value"><?= $player['rpg_lc'] ?? 0 ?></div><div class="label">📊 RPG</div></div>
                            <div class="leader-item"><div class="value"><?= $player['apg_lc'] ?? 0 ?></div><div class="label">🎯 APG</div></div>
                            <div class="leader-item"><div class="value"><?= $player['spg_lc'] ?? 0 ?></div><div class="label">✋ SPG</div></div>
                            <div class="leader-item"><div class="value"><?= $player['bpg_lc'] ?? 0 ?></div><div class="label">🚫 BPG</div></div>
                        </div>
                        
                        <?php if (!empty($awards)): ?>
                        <div class="award-pills">
                            <?php foreach ($awards as $award): ?>
                                <span class="award-pill">🏅 <?= $award ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <span class="score-label">Total Score</span>
                        <span class="score-value"><?= number_format($player['score'], 1) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Honorable Mention Section -->
        <?php if (!empty($hmPlayers)): ?>
        <div class="hm-section">
            <div class="hm-title">
                <h2>🏅 Honorable Mention</h2>
                <p>Players who didn't make the Top 42 but are still greats (click to view achievements)</p>
            </div>
            <div class="hm-grid" id="hmGrid">
                <?php foreach ($hmPlayers as $player): 
                    $statusClass = $player['status'] == 'Active' ? 'active' : 'retired';
                ?>
                    <div class="hm-card" data-name="<?= strtolower(htmlspecialchars($player['name'])) ?>" onclick="showPlayerModal(<?= htmlspecialchars(json_encode($player)) ?>)">
                        <span class="hm-card-name"><?= htmlspecialchars($player['name']) ?></span>
                        <span class="hm-card-position"><?= $player['position'] ?></span>
                        <span class="hm-card-status <?= $statusClass ?>"><?= $player['status'] ?></span>
                        <div style="font-size: 0.7rem; color: #64748b; margin-top: 0.3rem;">
                            Score: <?= number_format($player['score'], 1) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div id="playerModal" class="modal" onclick="closeModalOnOutside(event)">
        <div class="modal-content">
            <div class="modal-close" onclick="closeModal()">×</div>
            <div id="modalContent"></div>
        </div>
    </div>

    <script>
        let currentModalPlayer = null;

        function updateYear() {
            const year = document.getElementById('currentYear').value;
            fetch('../api/set_year.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ year: parseInt(year) })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Error updating year');
                }
            });
        }

        function filterPlayers() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const playerCards = document.querySelectorAll('.player-card');
            const hmCards = document.querySelectorAll('.hm-card');
            let visibleCount = 0;
            
            playerCards.forEach(card => {
                const playerName = card.getAttribute('data-name');
                if (playerName && playerName.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            hmCards.forEach(card => {
                const playerName = card.getAttribute('data-name');
                if (playerName && playerName.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update player count display
            const playerCountSpan = document.getElementById('playerCount');
            if (playerCountSpan) {
                playerCountSpan.textContent = visibleCount;
            }
            
            // Show no results message
            const grid = document.getElementById('playersGrid');
            const existingNoResults = document.querySelector('.no-results');
            
            if (visibleCount === 0 && searchTerm !== '') {
                if (!existingNoResults) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.id = 'noResultsMessage';
                    noResultsDiv.innerHTML = `🔍 No players found matching "${searchTerm}"`;
                    grid.parentNode.insertBefore(noResultsDiv, grid.nextSibling);
                } else {
                    existingNoResults.style.display = 'block';
                    existingNoResults.innerHTML = `🔍 No players found matching "${searchTerm}"`;
                }
            } else if (existingNoResults) {
                existingNoResults.style.display = 'none';
            }
        }
        
        function resetSearch() {
            document.getElementById('searchInput').value = '';
            const playerCards = document.querySelectorAll('.player-card');
            const hmCards = document.querySelectorAll('.hm-card');
            
            playerCards.forEach(card => {
                card.style.display = '';
            });
            
            hmCards.forEach(card => {
                card.style.display = '';
            });
            
            const playerCountSpan = document.getElementById('playerCount');
            if (playerCountSpan) {
                playerCountSpan.textContent = '<?= count($ranking) ?>';
            }
            
            const noResults = document.querySelector('.no-results');
            if (noResults) {
                noResults.style.display = 'none';
            }
        }

        function showPlayerModal(player) {
            currentModalPlayer = player;
            const modalContent = document.getElementById('modalContent');
            
            modalContent.innerHTML = `
                <div class="modal-header">
                    <h2>${escapeHtml(player.name)}</h2>
                    <span class="modal-position">${player.position} · ${player.status}</span>
                </div>
                <div class="modal-body">
                    <div class="achievement-section">
                        <h3>🏆 Championships & Major Awards</h3>
                        <div class="achievement-grid">
                            <div class="achievement-item"><div class="icon">🏆</div><div class="info"><div class="value">${player.rings || 0}</div><div class="label">Rings</div></div></div>
                            <div class="achievement-item"><div class="icon">👑</div><div class="info"><div class="value">${player.mvp || 0}</div><div class="label">MVP</div></div></div>
                            <div class="achievement-item"><div class="icon">⭐</div><div class="info"><div class="value">${player.fmvp || 0}</div><div class="label">Finals MVP</div></div></div>
                            <div class="achievement-item"><div class="icon">🔒</div><div class="info"><div class="value">${player.dpoy || 0}</div><div class="label">DPOY</div></div></div>
                            <div class="achievement-item"><div class="icon">👶</div><div class="info"><div class="value">${player.roty || 0}</div><div class="label">ROTY</div></div></div>
                            <div class="achievement-item"><div class="icon">📈</div><div class="info"><div class="value">${player.mip || 0}</div><div class="label">MIP</div></div></div>
                            <div class="achievement-item"><div class="icon">🏀</div><div class="info"><div class="value">${player.sixth_man || 0}</div><div class="label">6MOY</div></div></div>
                        </div>
                    </div>
                    
                    <div class="achievement-section">
                        <h3>🌟 All-League Teams</h3>
                        <div class="achievement-grid">
                            <div class="achievement-item"><div class="icon">🌟</div><div class="info"><div class="value">${player.all_nba || 0}</div><div class="label">All-NBA Selections</div></div></div>
                            <div class="achievement-item"><div class="icon">🛡️</div><div class="info"><div class="value">${player.all_def || 0}</div><div class="label">All-Defensive Selections</div></div></div>
                        </div>
                    </div>
                    
                    <div class="achievement-section">
                        <h3>📊 League Leader Titles</h3>
                        <div class="achievement-grid">
                            <div class="achievement-item"><div class="icon">🏀</div><div class="info"><div class="value">${player.ppg_lc || 0}</div><div class="label">Scoring Titles (PPG)</div></div></div>
                            <div class="achievement-item"><div class="icon">📊</div><div class="info"><div class="value">${player.rpg_lc || 0}</div><div class="label">Rebounding Titles (RPG)</div></div></div>
                            <div class="achievement-item"><div class="icon">🎯</div><div class="info"><div class="value">${player.apg_lc || 0}</div><div class="label">Assist Titles (APG)</div></div></div>
                            <div class="achievement-item"><div class="icon">✋</div><div class="info"><div class="value">${player.spg_lc || 0}</div><div class="label">Steals Titles (SPG)</div></div></div>
                            <div class="achievement-item"><div class="icon">🚫</div><div class="info"><div class="value">${player.bpg_lc || 0}</div><div class="label">Blocks Titles (BPG)</div></div></div>
                        </div>
                    </div>
                    
                    <div class="total-score">
                        <div>🏆 TOTAL CAREER SCORE</div>
                        <span>${(player.score || calculateScore(player)).toFixed(1)}</span>
                    </div>
                </div>
            `;
            
            document.getElementById('playerModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('playerModal').classList.remove('active');
        }

        function closeModalOnOutside(event) {
            if (event.target === document.getElementById('playerModal')) {
                closeModal();
            }
        }

        function calculateScore(player) {
            return ((player.rings || 0) * 10) +
                   ((player.mvp || 0) * 15) +
                   ((player.fmvp || 0) * 12) +
                   ((player.all_nba || 0) * 2) +
                   ((player.all_def || 0) * 1.5) +
                   ((player.dpoy || 0) * 8) +
                   ((player.roty || 0) * 3) +
                   ((player.mip || 0) * 2) +
                   ((player.sixth_man || 0) * 2) +
                   ((player.ppg_lc || 0) * 3) +
                   ((player.rpg_lc || 0) * 2) +
                   ((player.apg_lc || 0) * 2) +
                   ((player.spg_lc || 0) * 2) +
                   ((player.bpg_lc || 0) * 2);
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
</body>
</html>