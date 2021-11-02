
# REST API
Denna webbtjänst är skapad för projektet i kursen DT173G. 
Webbtjänsten används av ett admingränssnitt samt front-end sida för att lagra/hämta data. Syftet med denna webbtjänst är att hantera data för att presentera mitt cv och portfolio som utvecklare. 

#### Beskrivning av API:ets uppbyggnad:
- **api/classes**
  - **[kategori].class.php:** I denna mapp finns tre filer som innehåller tre klasser. Dessa klasser används för hämta,lagra,ändra och radera data till databasen.
- **api/includes**
  - **config.php**: Använder autoload för att snabba upp registering av klasserna
  - **database.php:** Använder en klass för att skapa en anslutning till databas. Använder även PDO.
- **api/**
  -**[kategori].php:** I root mappen finns det tre PHP filer som fungerar som API-endpoint. Dessa används för att konsumera webbtjänsten. Filerna består av en switch för alla request typer.
  
#### Dessa förfrågningar har använts:
* GET hämtar data from databasen i JSON-format.
* POST skickar data i JSON-format till databasen.
* PUT uppdaterar specifikt objekt utifrån angivet id i databasen.
* DELETE tar bort objekt relaterat till ett id i databasen.
