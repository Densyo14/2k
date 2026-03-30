// API Base URL - FIXED for your folder structure
const API_URL = '../api/';  // From views/ to root/api/

// ========== RANKING PAGE FUNCTIONS ==========
function loadRanking() {
    const loading = document.getElementById('loading');
    const table = document.getElementById('ranking-table');
    
    if (loading) loading.style.display = 'block';
    if (table) table.style.display = 'none';
    
    console.log('Fetching from:', API_URL + 'get_ranking.php');
    
    fetch(API_URL + 'get_ranking.php')
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('API Response:', data);
            if (data.success) {
                displayRanking(data.ranking);
                if (loading) loading.style.display = 'none';
                if (table) table.style.display = 'table';
            } else {
                if (loading) loading.innerHTML = 'Error loading ranking: ' + (data.error || 'Unknown error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (loading) loading.innerHTML = 'Error loading ranking. Check console for details.';
        });
}

function displayRanking(ranking) {
    const tbody = document.getElementById('ranking-body');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    if (!ranking || ranking.length === 0) {
        tbody.innerHTML = '<tr><td colspan="12" style="text-align: center;">No players found</td></tr>';
        return;
    }
    
    ranking.forEach(player => {
        const row = tbody.insertRow();
        
        const lcTotal = (player.ppg_lc || 0) + (player.rpg_lc || 0) + (player.apg_lc || 0) + 
                        (player.spg_lc || 0) + (player.bpg_lc || 0);
        
        const score = player.score || calculateScore(player);
        
        row.innerHTML = `
            <td><strong>#${player.rank}</strong></td>
            <td class="${player.status === 'Retired' ? 'retired' : 'active'}"><strong>${escapeHtml(player.name)}</strong></td>
            <td>${player.position}</td>
            <td class="${player.status === 'Retired' ? 'retired' : 'active'}">${player.status}</td>
            <td>${player.rings || 0}</td>
            <td>${player.mvp || 0}</td>
            <td>${player.fmvp || 0}</td>
            <td>${player.all_nba || 0}</td>
            <td>${player.all_def || 0}</td>
            <td>${player.dpoy || 0}</td>
            <td>${lcTotal}</td>
            <td class="score">${score.toFixed(1)}</td>
        `;
    });
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

// ========== ADMIN PAGE FUNCTIONS ==========
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab
    const selectedTab = document.getElementById(`${tabName}-tab`);
    if (selectedTab) selectedTab.classList.add('active');
    
    // Add active class to corresponding button
    document.querySelectorAll('.tab-btn').forEach(btn => {
        if (btn.getAttribute('data-tab') === tabName) {
            btn.classList.add('active');
        }
    });
    
    // Load data if needed
    if (tabName === 'players') {
        loadPlayersList();
    }
}

// Tab event listeners - Add this AFTER the showTab function
document.addEventListener('DOMContentLoaded', function() {
    // Set up tab click handlers
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            if (tabName) {
                showTab(tabName);
            }
        });
    });
});

function loadPlayersList() {
    const loading = document.getElementById('players-loading');
    const table = document.getElementById('players-table');
    
    if (loading) loading.style.display = 'block';
    if (table) table.style.display = 'none';
    
    fetch(API_URL + 'get_players.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPlayersList(data.players);
                if (loading) loading.style.display = 'none';
                if (table) table.style.display = 'table';
            } else {
                if (loading) loading.innerHTML = 'Error loading players.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (loading) loading.innerHTML = 'Error loading players.';
        });
}

function displayPlayersList(players) {
    const tbody = document.getElementById('players-body');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    players.forEach(player => {
        const row = tbody.insertRow();
        const score = calculateScore(player);
        
        row.innerHTML = `
            <td>${player.id}</td>
            <td><strong>${escapeHtml(player.name)}</strong></td>
            <td>${player.position}</td>
            <td class="${player.status === 'Retired' ? 'retired' : 'active'}">${player.status}</td>
            <td class="score">${score.toFixed(1)}</td>
            <td>
                <a href="edit.php?id=${player.id}" class="edit-btn" style="padding: 5px 10px; font-size: 12px;">✏️ Edit</a>
                <button onclick="deletePlayer(${player.id}, '${escapeHtml(player.name)}')" class="delete-btn" style="padding: 5px 10px; font-size: 12px;">🗑️ Delete</button>
            </td>
        `;
    });
}

function deletePlayer(id, name) {
    if (confirm(`Are you sure you want to delete ${name}?`)) {
        fetch(API_URL + 'delete_player.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Player deleted successfully!');
                loadPlayersList();
                // Also refresh the player select dropdown if it exists
                if (document.getElementById('update-player-select')) {
                    loadPlayerSelect();
                }
            } else {
                alert('Error deleting player: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting player');
        });
    }
}

function loadPlayerSelect() {
    const select = document.getElementById('update-player-select');
    if (!select) return;
    
    fetch(API_URL + 'get_players.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                select.innerHTML = '<option value="">-- Select Player --</option>';
                data.players.forEach(player => {
                    select.innerHTML += `<option value="${player.id}">${escapeHtml(player.name)} (${player.status})</option>`;
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function updateAchievement(achievement, value) {
    const select = document.getElementById('update-player-select');
    const playerId = select.value;
    const messageDiv = document.getElementById('update-message');
    
    if (!playerId) {
        messageDiv.innerHTML = '<div style="color: #ff6b6b;">❌ Please select a player first</div>';
        setTimeout(() => { messageDiv.innerHTML = ''; }, 3000);
        return;
    }
    
    // Disable buttons while updating
    const buttons = document.querySelectorAll('.achievement-buttons button');
    buttons.forEach(btn => btn.disabled = true);
    
    fetch(API_URL + 'update_achievement.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            player_id: parseInt(playerId),
            achievement: achievement,
            value: value
        })
    })
    .then(response => response.json())
    .then(data => {
        // Re-enable buttons
        buttons.forEach(btn => btn.disabled = false);
        
        if (data.success) {
            messageDiv.innerHTML = '<div style="color: #9bff9b;">✅ Achievement updated successfully! Ranking will update.</div>';
            
            // Refresh the players list to show updated scores
            loadPlayersList();
            
            // Show option to view ranking
            setTimeout(() => {
                messageDiv.innerHTML = '<div style="color: #ffd93d;">🔄 <a href="index.php" style="color: #ffd93d; text-decoration: underline;">Click here to view updated ranking</a></div>';
            }, 2000);
            
            // Auto redirect to ranking after 3 seconds
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 5000);
        } else {
            messageDiv.innerHTML = '<div style="color: #ff6b6b;">❌ Error: ' + (data.error || 'Unknown error') + '</div>';
            setTimeout(() => { messageDiv.innerHTML = ''; }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        buttons.forEach(btn => btn.disabled = false);
        messageDiv.innerHTML = '<div style="color: #ff6b6b;">❌ Error updating achievement</div>';
        setTimeout(() => { messageDiv.innerHTML = ''; }, 3000);
    });
}

// ========== ADD PLAYER FORM (SINGLE VERSION - FIXED) ==========
document.addEventListener('DOMContentLoaded', function() {
    const addForm = document.getElementById('add-player-form');
    if (addForm) {
        // Prevent duplicate event listeners by removing existing ones
        const newForm = addForm.cloneNode(true);
        addForm.parentNode.replaceChild(newForm, addForm);
        
        newForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get the name value and trim it
            const nameInput = newForm.querySelector('input[name="name"]');
            const playerName = nameInput ? nameInput.value.trim() : '';
            
            // Validate name is not empty
            if (!playerName) {
                alert('Please enter a player name');
                return;
            }
            
            const formData = new FormData(newForm);
            const data = {};
            
            formData.forEach((value, key) => {
                if (value === "") {
                    data[key] = 0;
                } else {
                    if (key === 'name') {
                        data[key] = value.trim();
                    } else if (key === 'position' || key === 'status') {
                        data[key] = value;
                    } else {
                        data[key] = isNaN(value) ? 0 : parseInt(value);
                    }
                }
            });
            
            console.log('Sending data:', data);
            
            // Disable submit button to prevent double submission
            const submitBtn = newForm.querySelector('.submit-btn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Adding...';
            }
            
            fetch(API_URL + 'create_player.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Player "${playerName}" added successfully!`);
                    newForm.reset();
                    // Reset all number inputs to 0
                    newForm.querySelectorAll('input[type="number"]').forEach(input => {
                        input.value = 0;
                    });
                    loadPlayersList();
                    loadPlayerSelect();
                    showTab('players');
                } else {
                    alert('Error adding player: ' + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error adding player: ' + error.message);
            })
            .finally(() => {
                // Re-enable submit button
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = '✅ Add Player';
                }
            });
        });
    }
});

// ========== EDIT PAGE FUNCTIONS ==========
function loadPlayerForEdit(id) {
    const loading = document.getElementById('loading');
    const form = document.getElementById('edit-player-form');
    
    if (loading) loading.style.display = 'block';
    if (form) form.style.display = 'none';
    
    fetch(API_URL + 'get_player.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayPlayerForEdit(data.player);
                if (loading) loading.style.display = 'none';
                if (form) form.style.display = 'block';
            } else {
                if (loading) loading.innerHTML = 'Player not found. <a href="admin.php">Go back</a>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (loading) loading.innerHTML = 'Error loading player. <a href="admin.php">Go back</a>';
        });
}

function displayPlayerForEdit(player) {
    document.getElementById('player-id').value = player.id;
    document.getElementById('player-name').value = player.name;
    document.getElementById('player-position').value = player.position;
    document.getElementById('player-status').value = player.status;
    document.getElementById('player-rings').value = player.rings;
    document.getElementById('player-mvp').value = player.mvp;
    document.getElementById('player-fmvp').value = player.fmvp;
    document.getElementById('player-all-nba').value = player.all_nba;
    document.getElementById('player-all-def').value = player.all_def;
    document.getElementById('player-dpoy').value = player.dpoy;
    document.getElementById('player-roty').value = player.roty;
    document.getElementById('player-mip').value = player.mip;
    document.getElementById('player-sixth-man').value = player.sixth_man;
    document.getElementById('player-ppg-lc').value = player.ppg_lc;
    document.getElementById('player-rpg-lc').value = player.rpg_lc;
    document.getElementById('player-apg-lc').value = player.apg_lc;
    document.getElementById('player-spg-lc').value = player.spg_lc;
    document.getElementById('player-bpg-lc').value = player.bpg_lc;
    
    // Setup form submit
    const form = document.getElementById('edit-player-form');
    // Remove any existing event listener to avoid duplicates
    const newForm = form.cloneNode(true);
    form.parentNode.replaceChild(newForm, form);
    
    newForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(newForm);
        const data = {};
        
        formData.forEach((value, key) => {
            data[key] = isNaN(value) ? value : parseInt(value);
        });
        
        fetch(API_URL + 'update_player.php', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Player updated successfully!');
                window.location.href = 'admin.php';
            } else {
                alert('Error updating player: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating player');
        });
    });
}

// ========== UTILITY FUNCTIONS ==========
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}