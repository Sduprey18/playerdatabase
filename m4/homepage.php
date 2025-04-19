<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="homestyles.css">
</head>

<body>
    <div class="layout">
        <div class="sidebar">
            <h1>Search</h1>
            <form action="/search" method="GET">
                <label for="query">Search for Team/player:</label>
                <input type="text" id="query" name="q" placeholder="Type here...">
                <input type="submit" value="Search">
            </form>

            <h3>Admin Login</h3>
            <form action="loginLogic.php" method="POST">
                <input type="hidden" name="formType" value="login">
                <label for="username">Username:</label>
                <input type="text" id="username" name="loginUsername" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="loginPassword" required><br><br>

                <input type="submit" value="Login">
            </form>
            <h3>Admin Sign-Up</h3>
            <form action="loginLogic.php" method="POST">
                <input type="hidden" name="formType" value="signup">
                <label for="username">Username:</label>
                <input type="text" id="username" name="signinUsername" required><br><br>
            
                <label for="password">Password:</label>
                <input type="password" id="password" name="signinPassword" required><br><br>
            
                <input type="submit" value="Login">
            </form>
        </div>

        <div class="main-content">
            <h1>NBA Stats</h1>
            <p>Stats for players and teams.</p>

            <h1 class="center">Top Teams</h1>
            <div>
                <?php
                    // Set the form type directly in PHP
                    $_GET['formType'] = 'topTeamsTable';
                
                    // Include the table generation logic
                    include 'tableLogic.php';
                ?>
            </div>

            <h1 class="center">Top Performers</h1>
            <div>
                <table class="center" border="10">
                    <tr>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Rebounds</th>
                        <th>Assists</th>
                        <th>Minutes</th>
                    </tr>
                    <tr>
                        <td>Jokic, Nikola</td>
                        <td>28</td>
                        <td>13</td>
                        <td>8</td>
                        <td>34</td>
                    </tr>
                    <tr>
                        <td>James, Lebron</td>
                        <td>34</td>
                        <td>6</td>
                        <td>8</td>
                        <td>29</td>
                    </tr>
                    <tr>
                        <td>Curry, Steph</td>
                        <td>17</td>
                        <td>2</td>
                        <td>11</td>
                        <td>35</td>
                    </tr>
                    <tr>
                        <td>Williams, Jaylin</td>
                        <td>20</td>
                        <td>13</td>
                        <td>11</td>
                        <td>30</td>
                    </tr>
                    <tr>
                        <td>Young, Trae</td>
                        <td>44</td>
                        <td>0</td>
                        <td>17</td>
                        <td>52</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>