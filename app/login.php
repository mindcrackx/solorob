<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>solorob - IT-Verwaltung</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
            background-color: steelblue;
        }

        /* Main content */
        .main {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            /* Same as the width of the sidenav */
            font-size: 16px;
            /* Increased text to enable scrolling */
            padding: 25px 5px 25px 5px;
            color: rgb(0, 0, 48);
            background-color: white;
            height: 250px;
            width: 350px;
            border-radius: 16px;
            background-color: white;
            border: 5px rgb(102, 152, 192);
            -moz-border-radius: 16px;

        }

        td,
        th {
            border-left: solid black 0px;
            border-top: solid black 0px;
            padding-left: 20px;
            padding-right: 20px;
        }

        th {
            background-color: blue;
            border-top: none;
        }

        .main input {
            width: 300px;
        }
    </style>
</head>

<body>
    <?php
        session_start();
        require_once("../mysqldb.php");

        if (! (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === TRUE))
        {
            if (isset($_POST["anmelden"]))
            {
                $nickname = $_POST["nickname"];
                $password = $_POST["password"];
                if (sql_benutzer_check_hash($mysqli, $nickname, $password))
                {
                    $_SESSION["nickname"] = $nickname;
                    $_SESSION["loggedin"] = TRUE;
                    $funktionen = sql_benutzer_get_rechte_funktionen($mysqli, $nickname);
                    $_SESSION["funktionen"] = $funktionen;
                    header("location: menu.php");
                }
            }
        }
        else
            header("location: menu.php");
    ?>


<form method="POST" action="">
<div class="main">
        <table halign="center">
            <tr>
                <td>
                    <img src="./solorob_logo_2.png" width="250px" hspace="20">
                </td>
            </tr>
            <tr>
                <td>
                    Nickname:
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="nickname" placeholder="" size="41">
                </td>
            </tr>
            <tr>
                <td>
                    Passwort:
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="password" placeholder="" size="41">
                </td>
            </tr>
            <tr>
                    <td>
                        <input type="submit" name="anmelden" value="Anmelden">
                    </td>
                </tr>
                <tr><td></td></tr>
        </table>
    </div>
</form>
</body>

</html>