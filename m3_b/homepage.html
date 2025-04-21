<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NBA Stats</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .card {
      position: fixed;
      top: 20%;
      left: 50%;
      transform: translate(-50%, -20%);
      background: #fff;
      border: 2px solid #333;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.3);
      max-width: 400px;
      width: 90%;
      z-index: 1000;
    }
    .card.hidden { display: none; }
    #close-card {
      float: right;
      background: var(--primary-red);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      font-weight: bold;
      cursor: pointer;
    }
    #card-content::after {
      content: "";
      display: block;
      clear: both;
    }
    .admin-section, .search-container, .table-container {
      background: #fff;
      border-radius: 10px;
      padding: 2rem;
      margin: 2rem 0;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .search-container input,
    .admin-section input[type="text"],
    .admin-section input[type="password"] {
      width: 100%;
      padding: 0.5rem;
      margin: 0.5rem 0;
      border: 1px solid var(--border-color);
      border-radius: 4px;
    }
    .admin-section input[type="submit"] {
      background: var(--primary-blue);
      color: #fff;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      cursor: pointer;
    }
    .admin-section input[type="submit"]:hover {
      background: #15316D;
    }
    #search {
      width: 100%;
      padding: 0.5rem;
      margin: 0.5rem 0;
      border: 1px solid var(--border-color);
      border-radius: 4px;
    }
  </style>
  <script>const isAdmin = false;</script>
</head>
<body>
  <nav class="nav-container">
    <ul class="nav-menu">
      <li><a href="#" class="active">Home</a></li>
    </ul>
  </nav>

  <section class="hero-section">
    <div class="hero-content">
      <h1>NBA Stats</h1>
      <p>Receive real time NBA updates!</p>
    </div>
  </section>

  <div class="search-container">
    <h2 class="section-header">Search</h2>
    <form action="/search" method="GET">
      <label for="search">Search for Team/player:</label>
      <input type="text" id="search" name="q" placeholder="Type here...">
    </form>
    <div id="results"></div>
  </div>

  <div class="admin-section">
    <h2 class="section-header">Admin Login</h2>
    <form action="loginLogic.php" method="POST">
      <input type="hidden" name="formType" value="login">
      <label>Username:</label>
      <input type="text" name="loginUsername" required>
      <label>Password:</label>
      <input type="password" name="loginPassword" required>
      <input type="submit" value="Login">
    </form>

    <h2 class="section-header">Admin Sign-Up</h2>
    <form action="loginLogic.php" method="POST">
      <input type="hidden" name="formType" value="signup">
      <label>Username:</label>
      <input type="text" name="signinUsername" required>
      <label>Password:</label>
      <input type="password" name="signinPassword" required>
      <input type="submit" value="Sign Up">
    </form>
  </div>

  <div id="info-card" class="card hidden">
    <button id="close-card" type="button">X</button>
    <div id="card-content"></div>
  </div>

  <div class="table-container">
    <h2 class="section-header">Top Teams</h2>
    <?php
      $_GET['formType'] = 'topTeamsTable';
      include 'tableLogic.php';
    ?>
  </div>

  <div class="table-container">
    <h2 class="section-header">Top Players</h2>
    <?php
      $_GET['formType'] = 'topPlayersTable';
      include 'tableLogic.php';
    ?>
  </div>

  <div class="table-container">
    <h2 class="section-header">Player Advanced Stats</h2>
    <?php
      $_GET['formType'] = 'advancedStatsTable';
      include 'tableLogic.php';
    ?>
  </div>

  <div class="table-container">
    <h2 class="section-header">Team Stats</h2>
    <?php
      $_GET['formType'] = 'teamStatsTable';
      include 'tableLogic.php';
    ?>
  </div>

  <script src="search.js"></script>
</body>
</html>
