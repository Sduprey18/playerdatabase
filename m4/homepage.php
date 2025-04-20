<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        .layout {
        display: flex;
        align-items: flex-start;
        gap: 40px;
        padding: 20px;
        }

        .sidebar {
            width: 250px;
        }

        .main-content {
            flex-grow: 1;
        }
                .card {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -20%);
            background-color: #fff;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
            z-index: 1000;
        }

        .card.hidden {
            display: none;
        }

        #close-card {
            float: right;
            background: crimson;
            color: white;
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
    </style>

</head>

<body>
    <div class="layout">
        <div class="sidebar">
            <h1>Search</h1>
            <form action="/search" method="GET">
                <label for="query">Search for Team/player:</label>
                <input type="text" id="search" name="q" placeholder="Type here...">
                <div id="results" ></div>
                <div id="info-card" class="card hidden">
                    <button id="close-card" type ="button">X</button>
                    <div id="card-content"></div>
               </div>
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
    <script src="search.js"></script>
</body>


<!--
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
--> 


</html>