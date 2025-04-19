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
                <input type="text" id="search" name="q" placeholder="Type here...">
                <div id="results"></div>
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
                    $_GET['formType'] = 'topTeamsTable';                 
                    include 'tableLogic.php';
                ?>
            </div>

            <h1 class="center">Top Performers</h1>
            <div>
                    <?php                   
                    $_GET['formType'] = 'topPlayersTable';          
                    include 'tableLogic.php';
                    ?>
                             
                </table>
            </div>
        </div>
    </div>
</body>

<script>
document.getElementById("search").addEventListener("input", function() {
    const query = this.value;

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById("results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});
</script>

</html>