<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player - NBA Ranking System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: #f4f6f9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #1d428a, #c8102e);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
        }

        .form-section {
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .form-section h3 {
            color: #1d428a;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-left: 3px solid #c8102e;
            padding-left: 0.8rem;
            text-align: left;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
        }

        .form-field {
            display: flex;
            flex-direction: column;
        }

        .form-field label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #1d428a;
            margin-bottom: 0.3rem;
        }

        .form-field input,
        .form-field select {
            padding: 0.7rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            color: #1e293b;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .form-field input:focus,
        .form-field select:focus {
            outline: none;
            border-color: #1d428a;
            background: white;
        }

        .form-actions {
            text-align: center;
            margin-top: 1.5rem;
        }

        .save-btn {
            background: #1d428a;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .save-btn:hover {
            background: #c8102e;
            transform: scale(1.02);
        }

        .cancel-btn {
            background: #64748b;
            color: white;
            padding: 0.8rem 2rem;
            text-decoration: none;
            border-radius: 40px;
            display: inline-block;
            margin-left: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .cancel-btn:hover {
            background: #475569;
            transform: scale(1.02);
        }

        .loading {
            text-align: center;
            padding: 2rem;
            color: #64748b;
            background: white;
            border-radius: 20px;
        }

        .error-message {
            text-align: center;
            padding: 2rem;
            color: #c8102e;
            background: #ffe5e5;
            border-radius: 20px;
            margin: 1rem 0;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>✏️ Edit Player</h1>
        
        <div id="loading" class="loading">Loading player data...</div>
        <div id="error-message" class="error-message" style="display: none;"></div>
        
        <form id="edit-player-form" style="display: none;">
            <input type="hidden" name="id" id="player-id">
            
            <div class="form-section">
                <h3>📋 Basic Information</h3>
                <div class="form-grid">
                    <div class="form-field">
                        <label>Full Name</label>
                        <input type="text" name="name" id="player-name" required>
                    </div>
                    <div class="form-field">
                        <label>Position</label>
                        <select name="position" id="player-position" required>
                            <option value="PG">PG - Point Guard</option>
                            <option value="SG">SG - Shooting Guard</option>
                            <option value="SF">SF - Small Forward</option>
                            <option value="PF">PF - Power Forward</option>
                            <option value="C">C - Center</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Status</label>
                        <select name="status" id="player-status">
                            <option value="Active">Active</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h3>🏆 Championships & Major Awards</h3>
                <div class="form-grid">
                    <div class="form-field"><label>🏆 Rings</label><input type="number" name="rings" id="player-rings" value="0"></div>
                    <div class="form-field"><label>👑 MVP</label><input type="number" name="mvp" id="player-mvp" value="0"></div>
                    <div class="form-field"><label>⭐ Finals MVP</label><input type="number" name="fmvp" id="player-fmvp" value="0"></div>
                    <div class="form-field"><label>🔒 DPOY</label><input type="number" name="dpoy" id="player-dpoy" value="0"></div>
                    <div class="form-field"><label>👶 ROTY</label><input type="number" name="roty" id="player-roty" value="0"></div>
                    <div class="form-field"><label>📈 MIP</label><input type="number" name="mip" id="player-mip" value="0"></div>
                    <div class="form-field"><label>🏀 6MOY</label><input type="number" name="sixth_man" id="player-sixth-man" value="0"></div>
                </div>
            </div>
            
            <div class="form-section">
                <h3>🌟 All-League Teams</h3>
                <div class="form-grid">
                    <div class="form-field"><label>All-NBA Selections</label><input type="number" name="all_nba" id="player-all-nba" value="0"></div>
                    <div class="form-field"><label>All-Defensive Selections</label><input type="number" name="all_def" id="player-all-def" value="0"></div>
                </div>
            </div>
            
            <div class="form-section">
                <h3>📊 League Leader Titles</h3>
                <div class="form-grid">
                    <div class="form-field"><label>🏀 Scoring Titles (PPG)</label><input type="number" name="ppg_lc" id="player-ppg-lc" value="0"></div>
                    <div class="form-field"><label>📊 Rebounding Titles (RPG)</label><input type="number" name="rpg_lc" id="player-rpg-lc" value="0"></div>
                    <div class="form-field"><label>🎯 Assist Titles (APG)</label><input type="number" name="apg_lc" id="player-apg-lc" value="0"></div>
                    <div class="form-field"><label>✋ Steals Titles (SPG)</label><input type="number" name="spg_lc" id="player-spg-lc" value="0"></div>
                    <div class="form-field"><label>🚫 Blocks Titles (BPG)</label><input type="number" name="bpg_lc" id="player-bpg-lc" value="0"></div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="save-btn">💾 Save Changes</button>
                <a href="admin.php" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
    
    <script>
        const API_URL = '../api/';
        
        async function loadPlayerForEdit(id) {
            const loading = document.getElementById('loading');
            const form = document.getElementById('edit-player-form');
            const errorDiv = document.getElementById('error-message');
            
            loading.style.display = 'block';
            form.style.display = 'none';
            errorDiv.style.display = 'none';
            
            try {
                console.log('Fetching player ID:', id);
                console.log('API URL:', API_URL + 'get_player.php?id=' + id);
                
                const response = await fetch(API_URL + 'get_player.php?id=' + id);
                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error('HTTP error ' + response.status);
                }
                
                const data = await response.json();
                console.log('API Response:', data);
                
                if (data.success && data.player) {
                    displayPlayerForEdit(data.player);
                    loading.style.display = 'none';
                    form.style.display = 'block';
                } else {
                    errorDiv.innerHTML = 'Player not found. <a href="admin.php">Go back to admin panel</a>';
                    errorDiv.style.display = 'block';
                    loading.style.display = 'none';
                }
            } catch (error) {
                console.error('Error loading player:', error);
                errorDiv.innerHTML = 'Error loading player data: ' + error.message + '<br><a href="admin.php">Go back</a>';
                errorDiv.style.display = 'block';
                loading.style.display = 'none';
            }
        }
        
        function displayPlayerForEdit(player) {
            console.log('Displaying player:', player);
            
            document.getElementById('player-id').value = player.id;
            document.getElementById('player-name').value = player.name;
            document.getElementById('player-position').value = player.position;
            document.getElementById('player-status').value = player.status;
            document.getElementById('player-rings').value = player.rings || 0;
            document.getElementById('player-mvp').value = player.mvp || 0;
            document.getElementById('player-fmvp').value = player.fmvp || 0;
            document.getElementById('player-all-nba').value = player.all_nba || 0;
            document.getElementById('player-all-def').value = player.all_def || 0;
            document.getElementById('player-dpoy').value = player.dpoy || 0;
            document.getElementById('player-roty').value = player.roty || 0;
            document.getElementById('player-mip').value = player.mip || 0;
            document.getElementById('player-sixth-man').value = player.sixth_man || 0;
            document.getElementById('player-ppg-lc').value = player.ppg_lc || 0;
            document.getElementById('player-rpg-lc').value = player.rpg_lc || 0;
            document.getElementById('player-apg-lc').value = player.apg_lc || 0;
            document.getElementById('player-spg-lc').value = player.spg_lc || 0;
            document.getElementById('player-bpg-lc').value = player.bpg_lc || 0;
            
            // Setup form submit
            const form = document.getElementById('edit-player-form');
            // Remove existing listener to avoid duplicates
            const newForm = form.cloneNode(true);
            form.parentNode.replaceChild(newForm, form);
            
            newForm.onsubmit = async function(e) {
                e.preventDefault();
                
                const formData = new FormData(newForm);
                const data = {};
                
                formData.forEach((value, key) => {
                    data[key] = isNaN(value) ? value : parseInt(value);
                });
                
                console.log('Saving data:', data);
                
                const saveBtn = newForm.querySelector('.save-btn');
                saveBtn.textContent = 'Saving...';
                saveBtn.disabled = true;
                
                try {
                    const response = await fetch(API_URL + 'update_player.php', {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });
                    const result = await response.json();
                    console.log('Update response:', result);
                    
                    if (result.success) {
                        alert('Player updated successfully!');
                        window.location.href = 'admin.php';
                    } else {
                        alert('Error updating player: ' + (result.error || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error updating player: ' + error.message);
                } finally {
                    saveBtn.textContent = '💾 Save Changes';
                    saveBtn.disabled = false;
                }
            };
        }
        
        const urlParams = new URLSearchParams(window.location.search);
        const playerId = urlParams.get('id');
        
        if (playerId) {
            document.addEventListener('DOMContentLoaded', function() {
                loadPlayerForEdit(playerId);
            });
        } else {
            window.location.href = 'admin.php';
        }
    </script>
</body>
</html>