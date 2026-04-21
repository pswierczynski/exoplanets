# 🪐 Exoplanets — Web Game

> A browser-based game built to promote the **Exoplanets** board game. Players register their own planet, participate in community events, collect resource tokens, earn special badges, and compete on a global ranking — all tied to the physical board game experience on [BoardGameGeek](https://boardgamegeek.com/boardgame/163976/exoplanets).

---

## About the Project

Exoplanets (the web game) is a companion experience for the **Exoplanets board game**. It extends gameplay beyond the tabletop by letting players create and customize their own planet online, track their resources and progress, and engage with a community of space builders.

Each registered player gets a personal dashboard showing their planet, life form, resource tokens, special badges, current rank, and total points. Events posted on BoardGameGeek feed directly into the game — completing them rewards players with in-game items.

---

## Features

- **Planet dashboard** — personalized view with planet image, life form overlay, resource tokens, and special badges
- **User registration & login** — BGG (BoardGameGeek) username used as the login identifier
- **Gamification layer** — points, ranks, resource tokens, and collectible badges earned through events
- **Event feed** — rotating in-game events connected to BGG discussion threads
- **Global ranking** — leaderboard of all registered players
- **BGG integration** — direct links to the board game profile and event threads on BoardGameGeek
- **Google Analytics tracking** — via `analyticstracking.php`

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (MySQLi + prepared statements) |
| Database | MySQL |
| Frontend | HTML, CSS, JavaScript |
| JS Libraries | jQuery 1.10.1, easySlider 1.7 |
| Session handling | PHP native sessions |
| Analytics | Google Analytics |

---

## Project Structure

```
exoplanets/
├── index.php              # Main game dashboard (login + planet view + events)
├── register.php           # New player registration
├── ranking.php            # Global leaderboard
├── events.php             # Event listing page
├── about.php              # About the board game
├── contact.php            # Contact page
├── tips.php               # Registration tips / help
├── analyticstracking.php  # Google Analytics include
```

---

## Database Schema

The application uses a MySQL database. The main `users` table stores:

| Column | Description |
|---|---|
| `user_id` | Primary key |
| `user_login` | BGG username |
| `user_password` | Player password |
| `planet` | Filename of the assigned planet image |
| `life` | Filename of the life form image overlay |
| `life_cost` | Resource cost image |
| `token1`–`token6` | Resource token image filenames |
| `badge1`–`badge6` | Special badge image filenames |
| `rank` | Current rank label |
| `points` | Total score |

---

## Setup & Deployment

### Requirements

- PHP 7.4+ (MySQLi extension enabled)
- MySQL 5.7+ / MariaDB 10+
- Web server: Apache or Nginx

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/pswierczynski/exoplanets.git
   ```

2. Import the database schema into your MySQL server and create a user with appropriate privileges.

3. Update the database credentials in `index.php` (and other pages that connect to the DB):
   ```php
   $dbHost = 'localhost';
   $dbUser = 'your_db_user';
   $dbPass = 'your_db_password';
   $dbName = 'your_db_name';
   ```

4. Upload files to your web server's public directory.

5. Ensure the `planets/` and `images/` directories are accessible and contain the required image assets.

> ⚠️ **Security note:** Database credentials are currently hardcoded in PHP files. For production use, move them to a separate configuration file outside the webroot and add it to `.gitignore`.

---

## Board Game

**Exoplanets** is a space-themed board game where players terraform planets, manage resources, and navigate cosmic events. The web game serves as an online companion — extending the experience between tabletop sessions and building a community of players.

- 🎲 [Exoplanets on BoardGameGeek](https://boardgamegeek.com/boardgame/163976/exoplanets)

---

## Author

**Przemysław Świerczyński**  
[przemyslaw.swierczynski@o2.pl](mailto:przemyslaw.swierczynski@o2.pl)

---

## License

This project is not currently under an open-source license. All rights reserved by the author.
