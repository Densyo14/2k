<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - NBA Ranking System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background: #f4f6f9; }
        .container { max-width: 1400px; margin: 0 auto; padding: 2rem; }
        h1 { text-align: center; font-size: 2rem; font-weight: 700; background: linear-gradient(135deg, #1d428a, #c8102e); -webkit-background-clip: text; background-clip: text; color: transparent; margin-bottom: 0.5rem; }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .back-link-top { background: #64748b; color: white; padding: 0.5rem 1rem; border-radius: 30px; text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 0.3rem; transition: all 0.2s; }
        .back-link-top:hover { background: #475569; transform: scale(1.02); }
        .admin-tabs { display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
        .tab-btn { background: white; color: #1d428a; border: 1px solid #e2e8f0; padding: 0.7rem 1.5rem; border-radius: 40px; cursor: pointer; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; }
        .tab-btn:hover { background: #f1f5f9; }
        .tab-btn.active { background: #1d428a; color: white; border-color: #1d428a; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .search-filter-bar { display: flex; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; justify-content: center; }
        .search-box { flex: 1; max-width: 300px; display: flex; align-items: center; background: white; border-radius: 40px; padding: 0.3rem 0.3rem 0.3rem 1.5rem; border: 1px solid #e2e8f0; }
        .search-box input { flex: 1; border: none; padding: 0.7rem 0; font-size: 0.9rem; outline: none; background: transparent; color: #1e293b; }
        .search-box input::placeholder { color: #94a3b8; }
        .search-box button { background: #1d428a; color: white; border: none; padding: 0.5rem 1.2rem; border-radius: 40px; cursor: pointer; font-size: 0.8rem; }
        .search-box button:hover { background: #c8102e; }
        .filter-dropdown { padding: 0.7rem 1rem; border: 1px solid #e2e8f0; border-radius: 40px; background: white; color: #1d428a; font-weight: 500; cursor: pointer; }
        .filter-dropdown:hover { border-color: #1d428a; }
        .reset-btn { background: #64748b; color: white; border: none; padding: 0.5rem 1.2rem; border-radius: 40px; cursor: pointer; font-size: 0.8rem; }
        .reset-btn:hover { background: #475569; }
        .stats-info { text-align: center; margin-bottom: 1rem; color: #475569; font-size: 0.85rem; }
        .players-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .player-card { background: white; border-radius: 20px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .player-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .card-header { background: linear-gradient(135deg, #1d428a, #0f2b5a); padding: 0.8rem 1.2rem; display: flex; justify-content: space-between; align-items: center; }
        .player-name-header { font-weight: 600; color: white; font-size: 1rem; }
        .player-score { background: rgba(255,255,255,0.2); padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.7rem; font-weight: 600; color: white; }
        .card-body { padding: 1.2rem; }
        .player-info { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; }
        .player-position { background: #eef2ff; padding: 0.2rem 0.7rem; border-radius: 30px; font-size: 0.7rem; font-weight: 600; color: #1d428a; }
        .player-status { font-size: 0.7rem; padding: 0.2rem 0.7rem; border-radius: 30px; font-weight: 600; }
        .status-active { background: #c8102e; color: white; }
        .status-retired { background: #64748b; color: white; }
        .quick-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; margin-bottom: 1rem; }
        .quick-stat { text-align: center; background: #f8fafc; padding: 0.5rem; border-radius: 12px; }
        .quick-stat .value { font-size: 1rem; font-weight: 700; color: #1d428a; }
        .quick-stat .label { font-size: 0.6rem; color: #64748b; }
        .card-actions { display: flex; gap: 0.5rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eef2ff; }
        .edit-btn, .delete-btn { flex: 1; text-align: center; padding: 0.5rem; border-radius: 30px; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: all 0.2s; }
        .edit-btn { background: #eef2ff; color: #1d428a; }
        .edit-btn:hover { background: #1d428a; color: white; }
        .delete-btn { background: #fee2e2; color: #c8102e; cursor: pointer; border: none; }
        .delete-btn:hover { background: #c8102e; color: white; }
        .form-section { background: white; padding: 1.5rem; border-radius: 20px; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .form-section h3 { color: #1d428a; margin-bottom: 1rem; font-size: 0.9rem; font-weight: 600; border-left: 3px solid #c8102e; padding-left: 0.8rem; text-align: left; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
        .form-field { display: flex; flex-direction: column; }
        .form-field label { font-size: 0.7rem; font-weight: 600; color: #1d428a; margin-bottom: 0.3rem; }
        .form-field input, .form-field select { padding: 0.7rem; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; color: #1e293b; font-size: 0.85rem; transition: all 0.2s; }
        .form-field input:focus, .form-field select:focus { outline: none; border-color: #1d428a; background: white; }
        .submit-btn { background: #1d428a; color: white; border: none; padding: 0.8rem 2rem; font-size: 0.9rem; font-weight: 600; border-radius: 40px; cursor: pointer; display: block; margin: 0 auto; transition: all 0.2s; }
        .submit-btn:hover { background: #c8102e; transform: scale(1.02); }
        .achievement-buttons { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.8rem; margin: 1.5rem 0; }
        .achievement-buttons button { background: #1d428a; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 40px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
        .achievement-buttons button:hover { background: #c8102e; transform: translateY(-2px); }
        .loading { text-align: center; padding: 2rem; color: #64748b; }
        .error-message { text-align: center; padding: 1rem; color: #c8102e; background: #ffe5e5; border-radius: 12px; margin-bottom: 1rem; }
        .no-results { text-align: center; padding: 2rem; color: #64748b; background: white; border-radius: 20px; }
        @media (max-width: 768px) { .container { padding: 1rem; } .players-grid { grid-template-columns: 1fr; } .form-grid { grid-template-columns: 1fr; } .top-bar { flex-direction: column; text-align: center; } }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Bar with Back Link -->
        <div class="top-bar">
            <div></div>
            <a href="index.php" class="back-link-top">← Back to Ranking</a>
        </div>
        
        <h1>⚙️ Admin Panel</h1>
        
        <div class="admin-tabs">
            <button class="tab-btn active" data-tab="players">📋 All Players</button>
            <button class="tab-btn" data-tab="add">➕ Add Player</button>
            <button class="tab-btn" data-tab="update">📈 Update Achievements</button>
        </div>
        
        <!-- Players List Tab -->
        <div id="players-tab" class="tab-content active">
            <div class="search-filter-bar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="🔍 Search by player name..." onkeyup="filterAdminPlayers()">
                    <button onclick="filterAdminPlayers()">Search</button>
                </div>
                <select id="positionFilter" class="filter-dropdown" onchange="filterAdminPlayers()">
                    <option value="all">All Positions</option>
                    <option value="PG">PG</option><option value="SG">SG</option><option value="SF">SF</option><option value="PF">PF</option><option value="C">C</option>
                </select>
                <select id="statusFilter" class="filter-dropdown" onchange="filterAdminPlayers()">
                    <option value="all">All Status</option>
                    <option value="Active">Active</option><option value="Retired">Retired</option>
                </select>
                <button onclick="resetAdminFilters()" class="reset-btn">Reset</button>
            </div>
            <div class="stats-info" id="adminStatsInfo">Loading players...</div>
            <div id="players-loading" class="loading">Loading players...</div>
            <div id="players-grid" class="players-grid" style="display: none;"></div>
            <div id="noResultsMessage" class="no-results" style="display: none;">No players found</div>
        </div>
        
        <!-- Add Player Tab -->
        <div id="add-tab" class="tab-content">
            <form id="add-player-form">
                <div class="form-section"><h3>📋 Basic Information</h3>
                    <div class="form-grid">
                        <div class="form-field"><label>Full Name</label><input type="text" name="name" placeholder="e.g., Michael Jordan" required></div>
                        <div class="form-field"><label>Position</label><select name="position"><option value="PG">PG</option><option value="SG">SG</option><option value="SF">SF</option><option value="PF">PF</option><option value="C">C</option></select></div>
                        <div class="form-field"><label>Status</label><select name="status"><option value="Active">Active</option><option value="Retired">Retired</option></select></div>
                    </div>
                </div>
                <div class="form-section"><h3>🏆 Championships & Major Awards</h3>
                    <div class="form-grid">
                        <div class="form-field"><label>🏆 Rings</label><input type="number" name="rings" value="0"></div>
                        <div class="form-field"><label>👑 MVP</label><input type="number" name="mvp" value="0"></div>
                        <div class="form-field"><label>⭐ Finals MVP</label><input type="number" name="fmvp" value="0"></div>
                        <div class="form-field"><label>🔒 DPOY</label><input type="number" name="dpoy" value="0"></div>
                        <div class="form-field"><label>👶 ROTY</label><input type="number" name="roty" value="0"></div>
                        <div class="form-field"><label>📈 MIP</label><input type="number" name="mip" value="0"></div>
                        <div class="form-field"><label>🏀 6MOY</label><input type="number" name="sixth_man" value="0"></div>
                    </div>
                </div>
                <div class="form-section"><h3>🌟 All-League Teams</h3>
                    <div class="form-grid">
                        <div class="form-field"><label>All-NBA</label><input type="number" name="all_nba" value="0"></div>
                        <div class="form-field"><label>All-Defensive</label><input type="number" name="all_def" value="0"></div>
                    </div>
                </div>
                <div class="form-section"><h3>📊 League Leader Titles</h3>
                    <div class="form-grid">
                        <div class="form-field"><label>🏀 Scoring (PPG)</label><input type="number" name="ppg_lc" value="0"></div>
                        <div class="form-field"><label>📊 Rebounding (RPG)</label><input type="number" name="rpg_lc" value="0"></div>
                        <div class="form-field"><label>🎯 Assists (APG)</label><input type="number" name="apg_lc" value="0"></div>
                        <div class="form-field"><label>✋ Steals (SPG)</label><input type="number" name="spg_lc" value="0"></div>
                        <div class="form-field"><label>🚫 Blocks (BPG)</label><input type="number" name="bpg_lc" value="0"></div>
                    </div>
                </div>
                <div class="form-actions"><button type="submit" class="submit-btn">✅ Add Player</button></div>
            </form>
        </div>
        
        <!-- Update Achievements Tab -->
        <div id="update-tab" class="tab-content">
            <h3 style="color:#1d428a;text-align:center;">📈 Update Season Achievements</h3>
            <p style="color:#475569;text-align:center;">Search for a player and click the achievement they earned</p>
            <div style="max-width:400px;margin:0 auto 1.5rem auto;">
                <input type="text" id="playerSearchInput" placeholder="🔍 Search player by name..." style="width:100%;padding:0.8rem 1rem;border:2px solid #e2e8f0;border-radius:12px;margin-bottom:0.5rem;" onkeyup="filterPlayerDropdown()">
                <select id="update-player-select" size="5" style="width:100%;padding:0.5rem;border:2px solid #e2e8f0;border-radius:12px;">
                    <option value="">-- Select Player --</option>
                </select>
                <div id="playerDropdownMessage" style="font-size:0.7rem;color:#64748b;text-align:center;margin-top:0.3rem;"></div>
            </div>
            <div class="achievement-buttons">
                <button onclick="updateAchievement('rings',1)">🏆 +1 Ring</button>
                <button onclick="updateAchievement('mvp',1)">👑 +1 MVP</button>
                <button onclick="updateAchievement('fmvp',1)">⭐ +1 FMVP</button>
                <button onclick="updateAchievement('dpoy',1)">🔒 +1 DPOY</button>
                <button onclick="updateAchievement('ppg_lc',1)">📊 +1 Scoring</button>
                <button onclick="updateAchievement('rpg_lc',1)">📊 +1 Rebound</button>
                <button onclick="updateAchievement('apg_lc',1)">📊 +1 Assist</button>
                <button onclick="updateAchievement('spg_lc',1)">📊 +1 Steals</button>
                <button onclick="updateAchievement('bpg_lc',1)">📊 +1 Blocks</button>
                <button onclick="updateAchievement('all_nba',1)">🌟 +1 All-NBA</button>
                <button onclick="updateAchievement('all_def',1)">🛡️ +1 All-Def</button>
            </div>
            <div id="update-message" style="margin-top:1rem;padding:0.8rem;border-radius:12px;text-align:center;"></div>
        </div>
    </div>
    
    <script>
        const API_URL = '../api/';
        let allPlayers = [];
        
        function calculateScore(p) {
            return (p.rings||0)*10 + (p.mvp||0)*15 + (p.fmvp||0)*12 + (p.all_nba||0)*2 + (p.all_def||0)*1.5 + 
                   (p.dpoy||0)*8 + (p.roty||0)*3 + (p.mip||0)*2 + (p.sixth_man||0)*2 + 
                   (p.ppg_lc||0)*3 + (p.rpg_lc||0)*2 + (p.apg_lc||0)*2 + (p.spg_lc||0)*2 + (p.bpg_lc||0)*2;
        }
        
        function displayPlayersList(players) {
            const container = document.getElementById('players-grid');
            if (!container) return;
            container.innerHTML = '';
            if (!players || players.length === 0) {
                document.getElementById('noResultsMessage').style.display = 'block';
                document.getElementById('adminStatsInfo').innerHTML = '0 players found';
                container.style.display = 'none';
                return;
            }
            document.getElementById('noResultsMessage').style.display = 'none';
            document.getElementById('adminStatsInfo').innerHTML = players.length + ' players found';
            container.style.display = 'grid';
            
            players.forEach(p => {
                const score = calculateScore(p);
                const statusClass = p.status === 'Active' ? 'status-active' : 'status-retired';
                const lcTotal = (p.ppg_lc||0)+(p.rpg_lc||0)+(p.apg_lc||0)+(p.spg_lc||0)+(p.bpg_lc||0);
                const card = document.createElement('div');
                card.className = 'player-card';
                card.innerHTML = `
                    <div class="card-header">
                        <span class="player-name-header">${escapeHtml(p.name)}</span>
                        <span class="player-score">${score.toFixed(1)} pts</span>
                    </div>
                    <div class="card-body">
                        <div class="player-info">
                            <span class="player-position">${p.position}</span>
                            <span class="player-status ${statusClass}">${p.status}</span>
                        </div>
                        <div class="quick-stats">
                            <div class="quick-stat"><div class="value">${p.rings||0}</div><div class="label">🏆 Rings</div></div>
                            <div class="quick-stat"><div class="value">${p.mvp||0}</div><div class="label">👑 MVP</div></div>
                            <div class="quick-stat"><div class="value">${p.fmvp||0}</div><div class="label">⭐ FMVP</div></div>
                            <div class="quick-stat"><div class="value">${lcTotal}</div><div class="label">📊 LC</div></div>
                        </div>
                        <div class="quick-stats">
                            <div class="quick-stat"><div class="value">${p.all_nba||0}</div><div class="label">All-NBA</div></div>
                            <div class="quick-stat"><div class="value">${p.all_def||0}</div><div class="label">All-Def</div></div>
                            <div class="quick-stat"><div class="value">${p.dpoy||0}</div><div class="label">DPOY</div></div>
                            <div class="quick-stat"><div class="value">${p.roty||0}</div><div class="label">ROTY</div></div>
                        </div>
                        <div class="card-actions">
                            <a href="edit.php?id=${p.id}" class="edit-btn">✏️ Edit</a>
                            <button onclick="deletePlayer(${p.id}, '${escapeHtml(p.name)}')" class="delete-btn">🗑️ Delete</button>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }
        
        function filterAdminPlayers() {
            const search = document.getElementById('searchInput').value.toLowerCase().trim();
            const pos = document.getElementById('positionFilter').value;
            const stat = document.getElementById('statusFilter').value;
            let filtered = [...allPlayers];
            if (search) filtered = filtered.filter(p => p.name.toLowerCase().includes(search));
            if (pos !== 'all') filtered = filtered.filter(p => p.position === pos);
            if (stat !== 'all') filtered = filtered.filter(p => p.status === stat);
            displayPlayersList(filtered);
        }
        
        function resetAdminFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('positionFilter').value = 'all';
            document.getElementById('statusFilter').value = 'all';
            filterAdminPlayers();
        }
        
        function filterPlayerDropdown() {
            const search = document.getElementById('playerSearchInput').value.toLowerCase().trim();
            const select = document.getElementById('update-player-select');
            const opts = select.querySelectorAll('option');
            let visible = 0;
            opts.forEach(opt => {
                if (opt.value === "") { opt.style.display = ''; return; }
                if (opt.textContent.toLowerCase().includes(search)) {
                    opt.style.display = '';
                    visible++;
                } else {
                    opt.style.display = 'none';
                }
            });
            const msg = document.getElementById('playerDropdownMessage');
            if (visible === 0 && search) msg.textContent = `No players found matching "${search}"`;
            else msg.textContent = `${visible} players found`;
        }
        
        function loadPlayersList() {
            const loading = document.getElementById('players-loading');
            loading.style.display = 'block';
            fetch(API_URL + 'get_players.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        allPlayers = data.players;
                        displayPlayersList(allPlayers);
                    } else {
                        console.error('API error:', data);
                    }
                    loading.style.display = 'none';
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    loading.innerHTML = 'Error loading players. Check console.';
                });
        }
        
        function loadPlayerSelect() {
            const select = document.getElementById('update-player-select');
            if (!select) return;
            fetch(API_URL + 'get_players.php')
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        select.innerHTML = '<option value="">-- Select Player --</option>';
                        data.players.forEach(p => {
                            select.innerHTML += `<option value="${p.id}">${escapeHtml(p.name)} (${p.position} · ${p.status})</option>`;
                        });
                        document.getElementById('playerDropdownMessage').textContent = `${data.players.length} players available`;
                    }
                })
                .catch(err => console.error('Error loading player select:', err));
        }
        
        function deletePlayer(id, name) {
            if (confirm(`Delete ${name}?`)) {
                fetch(API_URL + 'delete_player.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Player deleted!');
                        loadPlayersList();
                        loadPlayerSelect();
                    } else {
                        alert('Error: ' + (data.error || 'Unknown'));
                    }
                })
                .catch(err => alert('Error deleting player'));
            }
        }
        
        // Add Player Form
        const addForm = document.getElementById('add-player-form');
        if (addForm) {
            addForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const data = {};
                formData.forEach((v, k) => {
                    if (v === "") data[k] = 0;
                    else if (k === 'name') data[k] = v.trim();
                    else if (k === 'position' || k === 'status') data[k] = v;
                    else data[k] = isNaN(v) ? 0 : parseInt(v);
                });
                const btn = this.querySelector('.submit-btn');
                btn.textContent = 'Adding...';
                btn.disabled = true;
                fetch(API_URL + 'create_player.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(`Player added successfully!`);
                        this.reset();
                        loadPlayersList();
                        loadPlayerSelect();
                        document.querySelector('.tab-btn[data-tab="players"]').click();
                    } else {
                        alert('Error: ' + (data.error || 'Unknown'));
                    }
                })
                .catch(err => alert('Error adding player'))
                .finally(() => { btn.textContent = '✅ Add Player'; btn.disabled = false; });
            });
        }
        
        function updateAchievement(achievement, value) {
            const select = document.getElementById('update-player-select');
            const playerId = select.value;
            const msgDiv = document.getElementById('update-message');
            if (!playerId) {
                msgDiv.innerHTML = '<div style="color:#c8102e;">❌ Select a player first</div>';
                setTimeout(() => msgDiv.innerHTML = '', 3000);
                return;
            }
            const btns = document.querySelectorAll('.achievement-buttons button');
            btns.forEach(btn => btn.disabled = true);
            fetch(API_URL + 'update_achievement.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ player_id: parseInt(playerId), achievement: achievement, value: value })
            })
            .then(res => res.json())
            .then(data => {
                btns.forEach(btn => btn.disabled = false);
                if (data.success) {
                    msgDiv.innerHTML = '<div style="color:#2a6b4e;">✅ Achievement updated!</div>';
                    setTimeout(() => msgDiv.innerHTML = '', 3000);
                    loadPlayersList();
                } else {
                    msgDiv.innerHTML = '<div style="color:#c8102e;">❌ Error: ' + (data.error || 'Unknown') + '</div>';
                    setTimeout(() => msgDiv.innerHTML = '', 3000);
                }
            })
            .catch(err => {
                btns.forEach(btn => btn.disabled = false);
                msgDiv.innerHTML = '<div style="color:#c8102e;">❌ Error updating</div>';
                setTimeout(() => msgDiv.innerHTML = '', 3000);
            });
        }
        
        // Tab functionality
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tab = this.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.getElementById(`${tab}-tab`).classList.add('active');
                this.classList.add('active');
                if (tab === 'players') loadPlayersList();
                if (tab === 'update') loadPlayerSelect();
            });
        });
        
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            loadPlayersList();
            loadPlayerSelect();
        });
    </script>
</body>
</html>