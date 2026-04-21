# Exoplanets

**Browser-based game created to promote a physical board game.** Players register a planet tied to their BoardGameGeek account, customize it, earn tokens and badges, and compete in a global ranking.

---

## About

Exoplanets is a web companion app for the [Exoplanets board game](https://boardgamegeek.com/boardgame/163976/exoplanets). It adds a digital gamification layer — players create an account using their BGG username, receive a customizable planet, collect tokens and badges, and track their progress on a live leaderboard.

Registration is semi-manual: after submitting the form, accounts are activated within a few hours by the administrator.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (vanilla, no framework) |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS (`css/style.css`) |
| JS Libraries | jQuery 1.8.2, jQuery UI 1.8.23, SlimScroll |
| Analytics | Google Analytics (via `analyticstracking.php`) |

---

## File Structure

```
exoplanets/
├── index.php                 # Home page
├── register.php              # New planet registration form
├── ranking.php               # Global planet ranking
├── events.php                # Events listing
├── tips.php                  # Game tips
├── about.php                 # About the project / board game
├── contact.php               # Contact form
├── analyticstracking.php     # Google Analytics include
├── css/
│   └── style.css             # Main stylesheet
├── js/
│   └── slimScroll.min.js     # Scroll UI plugin
├── images/                   # UI graphics, badges, tokens, logo, icons
└── planets/                  # Per-user planet images
```

---

## Database Schema

Based on queries in the source code, the project uses a single `users` table:

| Column | Type | Description |
|---|---|---|
| `user_id` | INT | Primary key, auto-increment |
| `user_login` | VARCHAR | BGG username |
| `user_password` | VARCHAR | Plain-text password ⚠️ |
| `user_email` | VARCHAR | User email |
| `planet` | VARCHAR | Planet image filename |
| `token1`–`token6` | VARCHAR | Token image filenames |
| `badge1`–`badge6` | VARCHAR | Badge image filenames |
| `life` | VARCHAR | Life status image |
| `life_cost` | VARCHAR | Life cost variant image |
| `rank` | VARCHAR | Player rank label |
| `points` | VARCHAR | Player points |

> ⚠️ **Security note:** Passwords are stored in plain text. Do not use real passwords when testing this project.

---

## Requirements

- PHP >= 5.6 (uses `mysqli` OOP style)
- MySQL / MariaDB
- HTTP server: Apache or Nginx
- jQuery and jQuery UI (loaded from Google CDN)
- jQuery SlimScroll (`js/slimScroll.min.js`)

---

## Installation

1. **Clone the repository:**

```bash
git clone https://github.com/pswierczynski/exoplanets.git
cd exoplanets
```

2. **Create the database:**

```sql
CREATE DATABASE exoplanets CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. **Create the `users` table:**

```sql
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  user_login VARCHAR(100),
  user_password VARCHAR(255),
  user_email VARCHAR(255),
  planet VARCHAR(100),
  token1 VARCHAR(100), token2 VARCHAR(100), token3 VARCHAR(100),
  token4 VARCHAR(100), token5 VARCHAR(100), token6 VARCHAR(100),
  badge1 VARCHAR(100), badge2 VARCHAR(100), badge3 VARCHAR(100),
  badge4 VARCHAR(100), badge5 VARCHAR(100), badge6 VARCHAR(100),
  life VARCHAR(100),
  life_cost VARCHAR(100),
  rank VARCHAR(100),
  points VARCHAR(100)
);
```

4. **Update database credentials** in each PHP file that contains:

```php
$conn = new mysqli("localhost", "username", "password", "exoplanets");
```

5. **Deploy files to your server** and ensure the `planets/` and `images/` directories are writable if dynamic file handling is needed.

6. **Open in browser:** `http://localhost/exoplanets/`

---

## Features

- Planet registration linked to a BoardGameGeek account
- Global ranking with planet image, badges, tokens, and points per player
- Events page for board game events
- Game tips section
- Contact form
- Google Analytics integration
- BoardGameGeek profile link in the header

---

## Related

- [Exoplanets on BoardGameGeek](https://boardgamegeek.com/boardgame/163976/exoplanets)

---

## Author

**Przemek Świerczyński**
[github.com/pswierczynski](https://github.com/pswierczynski)
[przemek.swierczynski@gmail.com](mailto:przemek.swierczynski@gmail.com)

---

## License

No license is explicitly defined in this repository. All rights reserved by the author.
