<html>
	<head>
		<title>Hilfe Lieferanten</title>
		<meta charset = "UTF-8"/>
		<style>
			body{
				font-family: "Lato", sans-serif;
				width: 100%
			}
        h1 {
            color: steelblue;
        }
        table {
            border-collapse: collapse;
            border-style: hidden;
            border: 0;
			width: 100%;

        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            border: none;
		}
		tr:nth-child(even) {background-color: #f2f2f2;}
		</style>
	<head>
	<body>
		<a href = "./Hilfeindex.php"><button>Zurück</button> </a>
		<h1>Lieferanten</h1>
		<!--Bild einfügen-->
		<table style = "width: 100%; border-collapse: collapse;"><tr><td colspan = "3">
			<img src = "../../static/help/02_Stammdaten_Lieferung.png" width="100%">
		<!--Erklärung-->
		<tr>
				<td><strong>Indexnummer</strong></td>
				<td><strong>Name</strong></td>
				<td><strong>Erklärung</strong></td>
			</tr>
			<tr>
				<td align = "center">1</td><td>Pfeile</td><td>Zum Anzeigen der vorherigen/nächsten Seite</td>
			</tr>
			<tr>
				<td align = "center">2</td><td>Duplizieren</td><td>Fügt die Inhalte der ausgewählte Spalte ins Formular ein</td>
			</tr>
			<tr>
				<td align = "center">3</td><td>Bearbeiten</td><td>Bearbeitet die Inhalte der ausgewählten Spalte</td>
			</tr>
			<tr>
				<td align = "center">4</td><td>Löschen</td><td>Löscht die ausgewählte Spalte</td>
			</tr>
			<tr>
				<td align = "center">5</td><td>Formular</td><td>Formular um folgende Daten einzutragen: Name, Straße, PLZ, Ort, Telefon, Mobil, Fax, E-Mail</td>
			</tr>
			<tr>
				<td align = "center">6</td><td>Anlegen</td><td>Speicher die im Formular eingegebenen Daten in der Datenbank</td>
			</tr>
		</table>
		
	</body>
</html>