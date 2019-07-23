<?php
    session_start();
    if ((! (isset($_SESSION["loggedin"]))) || (! $_SESSION["loggedin"]))
        header("location: login.php");
?>

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
        }

        /* Fixed sidenav, full height */
        .sidenav {
            height: 100%;
            width: 300px;
            position: fixed;
            z-index: 1;
            top: 0px;
            left: 0;
            background-color: steelblue;
            overflow-x: hidden;
            padding-top: 20px;
        }

        .sidenavbut {
            height: 43px;
            width: 300px;
            position: fixed;
            z-index: 1;
            bottom: 0px;
            left: 0;
            background-color: rgb(102, 152, 192);
            overflow-x: hidden;
            padding-top: 15px;
            padding-bottom: 0px;
            text-decoration: none;
            font-size: 15px;
            color: white;
            text-align: center;
        }

        /* Style the sidenav links and the dropdown button */
        .sidenav a,
        .dropdown-btn {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 20px;
            color: white;
            display: block;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }

        .sidenavbut a {
            text-decoration: none;
            font-size: 13px;
            color: white;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            outline: none;
        }

        /* On mouse-over */
        .sidenav a:hover,
        .dropdown-btn:hover {
            color: #f1f1f1;
        }

        /* Main content */
        .main {
            margin-left: 300px;
            /* Same as the width of the sidenav */
            font-size: 20px;
            /* Increased text to enable scrolling */
            padding: 0px 10px;
            height: 100%;
            width: 100%;
        }

        .iframe-container {
            overflow: hidden;
            /*Calculated from the aspect ration of the content (in case of 16:9 it is 9/16= 0.5625)*/
            padding-top: 56.25%;
            position: relative;
        }

        .iframe-container iframe {
            margin-left: 300px;
            border: 0;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* Add an active class to the active dropdown button */
        .active {
            background-color: steelblue;
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
            padding-right: 8px;
        }

        .fa-caret-down {
            float: right;
            padding-right: 8px;
        }

        /* Some media queries for responsiveness */
        /* Desktop */
        /* @media screen and (max-height: 450px) { */
        @media screen and (min-width: 401px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        /* Mobile */
        @media screen and (max-width: 400px) {
            .sidenav {
                height: 100%;
                width: 300px;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: blue;
                overflow-x: hidden;
                padding-top: 20px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="sidenav">
        <img src="./solorob_logo.png" width="200px" hspace="50px">
        <br><br><br>
        <a href="../solorob/Startseite.html" target="mainframe" onclick=fnselect()>Startseite</a>
        <a href="./Neubeschaffung.php" target="mainframe">Neubeschaffung</a>
        <button class="dropdown-btn">Stammdatenverwaltung
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="./Lieferanten.php" target="mainframe">• Lieferanten</a>
            <a href="./Raeume.php" target="mainframe">• Räume</a>
            <a href="./Benutzer.php" target="mainframe">• Benutzer</a>
            <a href="./Komponentenarten.html" target="mainframe">• Komponentenarten</a>
            <a href="./Komponentenattribute.html" target="mainframe">• Komponentenattribute</a>
        </div>
        <a href="./Ausmusterung.php" target="mainframe">Ausmusterung</a>
        <a href="./Wartung.php" target="mainframe">Wartung</a>
        <a href="./Reporting.html" target="mainframe">Reporting</a>
    </div>

    <div class="sidenavbut">
        © 2019 - solorob - IT-Verwaltung <br>
        <a href="./Hilfe.html" target="mainframe">Hilfe • </a>
        <a href="./Sitemap.html" target="mainframe">Sitemap • </a>
        <a href="./Impressum.html" target="mainframe">Impressum</a>
    </div>

    <div class="iframe-container">
        <iframe src="./Startseite.html" name="mainframe"></iframe>
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
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>

</body>

</html>