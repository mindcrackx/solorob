<?php
    session_start();
    if ((! (isset($_SESSION["loggedin"]))) || (! $_SESSION["loggedin"]))
        header("location: login.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../static/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <title>solorob - IT-Verwaltung</title>
    <style>
        /* Kompletter HTML-Body (Schriftart) */
        body {
            font-family: "Lato", sans-serif;
        }

        /* Navigation Seitenleiste */
        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0px;
            left: 0;
            background-color: steelblue;
            overflow-x: hidden;
            padding-top: 20px;
            -webkit-box-shadow: 2.5px 0px 2.5px 0px rgba(0,0,0,0.25); 
            -moz-box-shadow: 2.5px 0px 2.5px 0px rgba(0,0,0,0.25);
            box-shadow: 2.5px 0px 2.5px 0px rgba(0,0,0,0.25);
        }

        /* Navigation Seitenleiste - Footer */
        .sidenavbut {
            height: 90px;
            width: 250px;
            position: fixed;
            z-index: 1;
            bottom: 0px;
            left: 0;
            background-color: rgb(102, 152, 192);
            overflow-x: hidden;
            padding-top: 15px;
            padding-bottom: 0px;
            text-decoration: none;
            font-size: 12px;
            color: white;
            text-align: center;
        }

        /* Navigation Seitenleiste - Style Schrift & Buttons */
        .sidenav a,
        .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }

        /* Navigation Seitenleiste - Footer Style Schrift */
        .sidenavbut a {
            text-decoration: none;
            font-size: 14px;
            color: white;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            outline: none;
        }

        /* Navigation Seitenleiste - Schrift & Button Hover */
        .sidenav a:hover,
        .dropdown-btn:hover {
            color: #f1f1f1;
        }

        /* Hauptseite - iFrame */
        .iframe-container {
            overflow: hidden;
            height: 100%;
            width: 100%;
            left: 250px;
            margin-right: 600px;
            /*Calculated from the aspect ration of the content (in case of 16:9 it is 9/16= 0.5625)*/
            /*padding-top: 56.25%;
            position: relative;*/
        }
        .iframe-container iframe {
            border: 0;
            left: 258px;
            margin-right: 600px;
            width: -webkit-calc(100% - 266px);
            width:    -moz-calc(100% - 266px);
            width:         calc(100% - 266px);
            position: absolute;
            top: 0;
            height: 100%;
        }

        /* Aktiver Button */
        .active {
            background-color: rgb(102, 152, 192);
            color: white;
        }

        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        .dropdown-container {
            display: none;
            background-color: rgb(102, 152, 192);
            padding-left: 12px;
        }

        /* Optional: Style the caret down icon */
        .fa-caret-left {
            float: right;
            padding-right: 4px;
        }

        .fa-caret-down {
            float: right;
            padding-right: 4px;
        }

        /* Some media queries for responsiveness */
        /* Desktop */
        /* @media screen and (max-height: 450px) { */
        @media screen and (min-width: 401px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 16px;
            }
        }

        /* Mobile */
        @media screen and (max-width: 400px) {
            .sidenav {
                height: 100%;
                width: 250px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: blue;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <img src="../static/solorob_logo.png" width="200px" hspace="20px">
        <br><br><br>
        <a href="./main.php" target="mainframe">Startseite</a>

        <?php
        $dropdown = false;
        foreach ($_SESSION["funktionen"] as $funktion)
        {
            if ($funktion === "Neubeschaffung")
                echo('<a href="./Neubeschaffung.php" target="mainframe">Neubeschaffung</a>');
            elseif ($funktion === "Stammdatenverwaltung")
            {
                echo('<button class="dropdown-btn">Stammdatenverwaltung');
                echo('<img class="fa-caret-down" src="../static/carrotdown.png" width="13" vspace="4">');
                echo('</button>');
                echo('<div class="dropdown-container">');
                echo('<a href="./Lieferanten.php" target="mainframe">• Lieferanten</a>');
                echo('<a href="./Raeume.php" target="mainframe">• Räume</a>');
                echo('<a href="./Benutzer.php" target="mainframe">• Benutzer</a>');
                echo('<a href="./Komponentenarten.php" target="mainframe">• Komponentenarten</a>');
                echo('<a href="./Komponentenattribute.php" target="mainframe">• Komponentenattribute</a>');
                echo('</div>');
            }
            elseif ($funktion === "Ausmusterung")
                echo('<a href="./Ausmusterung.php" target="mainframe">Ausmusterung</a>');
            elseif ($funktion === "Wartung")
                echo('<a href="./Wartung.php" target="mainframe">Wartung</a>');
            elseif ($funktion === "Reporting")
                echo('<a href="./Reporting.php" target="mainframe">Reporting</a>');
        }
        ?>
    </div>

    <div class="sidenavbut">
        <a href="./logout.php"><button>Ausloggen</button></a><br><br>
        <a href="./help/Hilfeindex.php" target="mainframe">Hilfe • </a>
        <a href="../static/Impressum.html" target="mainframe">Impressum</a><br><br>
        © 2019 - solorob - IT-Verwaltung
    </div>

    <div class="iframe-container">
        <iframe src="./main.php" name="mainframe"></iframe>
    </div>

    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                    $dropdown = true;
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>