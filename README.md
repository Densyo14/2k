# NBA 2K19 All-Time Greats Ranking System

A comprehensive ranking system for NBA 2K19 that tracks player achievements across seasons (2019-2042+).

## Features

- 🏀 **Dynamic Ranking** - Top X players based on current year (Year - 2000 = Top X)
- 📊 **Scoring System** - Custom point system for MVP, Rings, All-NBA, League Leaders, etc.
- 🔍 **Search & Filter** - Search players by name, position, or status
- 📈 **Achievement Tracking** - Update player achievements for each season
- 🎨 **Modern UI** - Clean NBA-themed design with card layout
- 📱 **Responsive** - Works on desktop and mobile

## Scoring System

| Award | Points |
|-------|--------|
| MVP | 15 pts |
| Finals MVP | 12 pts |
| Championship Ring | 10 pts |
| DPOY | 8 pts |
| Scoring Title (PPG) | 3 pts |
| All-NBA Selection | 2 pts |
| RPG/APG/SPG/BPG Title | 2 pts |
| All-Defensive | 1.5 pts |
| ROTY | 3 pts |
| MIP / 6MOY | 2 pts |

## Tech Stack

- PHP 8.2+
- MySQL/MariaDB
- HTML5/CSS3
- JavaScript (Vanilla)

## Installation

1. Clone the repository
2. Import `database.sql` to phpMyAdmin
3. Update `config/database.php` with your credentials
4. Access `http://localhost/2k/views/index.php`

## Author

[Your Name]

## License

MIT
