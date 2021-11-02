Administrationsgränssnitt
- 
I denna del behandlas admingränssnittet i projektet av kursen DT173G.<br>
Nedan följer filstrukturen samt hur detta användargränssnitt är tänkt att fungera.

admin/includes
-
I denna mapp finns tre filer. Dessa filer är **header.php, config.php** samt **mainmenu.php**
Header-filen innehåller head delen av dokument tillsammans med länk till JavaScript och CSS.
Config.php behandlar databasanslutning.
Slutligen används filen mainmenu.php för huvudmenyn på sidan. Denna inkluderas även i header-filen.

admin/classes/Users.php
-
I denna del fill klassen Users tillsammans med alla funktioner för att lagra och hämta data relaterat till användare.

admin/css/stilmall
-
I mappen css finns en stilmall som används för hela gränssnittet. Denna CSS är dock indelad i olika sektioner för enklare hantering.

admin/js/main.js
-
Denna fil innehåller funktioner som alla använder fetch för att hantera data från och till API. Samtliga funktioner är kopplade till tre API:er<br>
Nedanstående beskrivs alla funktioner:

```
function getData()
```
Denna funktion används av alla API:er för att hämta data från databas och skriva ut det till administratör.

```
function getSpecificData()
```
Denna funktion används för att hämta data för just ett specifikt ID. Denna funktion används vid redigering då data måste läsas in för ett specifkt id.

```
function addData()
```
Denna funktion används för att lagra data i databas.

```
function updateData()
```
Denna funktion används för att skicka den uppdaterade datan till databas. Funktionen läser in data från formulär och skickar det för lagring.

Administrationsgränssnitt
- 
I denna del behandlas admingränssnittet i projektet av kursen DT173G.<br>
Nedan följer filstrukturen samt hur detta användargränssnitt är tänkt att fungera.
**URLE, URLP, URLW** är i detta fall länkad till det lokala Apiét

admin/includes
-
I denna mapp finns tre filer. Dessa filer är **header.php, config.php** samt **mainmenu.php**
Header-filen innehåller head delen av dokument tillsammans med länk till JavaScript och CSS.
Config.php behandlar databasanslutning.
Slutligen används filen mainmenu.php för huvudmenyn på sidan. Denna inkluderas även i header-filen.

admin/classes/Users.php
-
I denna del fill klassen Users tillsammans med alla funktioner för att lagra och hämta data relaterat till användare.

admin/css/stilmall
-
I mappen css finns en stilmall som används för hela gränssnittet. Denna CSS är dock indelad i olika sektioner för enklare hantering.

admin/js/main.js
-
Denna fil innehåller funktioner som alla använder fetch för att hantera data från och till API. Samtliga funktioner är kopplade till tre API:er<br>
Nedanstående beskrivs alla funktioner:

```
function getData()
```
Denna funktion används av alla API:er för att hämta data från databas och skriva ut det till administratör.

```
function getSpecificData()
```
Denna funktion används för att hämta data för just ett specifikt ID. Denna funktion används vid redigering då data måste läsas in för ett specifkt id.

```
function addData()
```
Denna funktion används för att lagra data i databas.

```
function deleteData(specificId)
```
Denna funktion används vid radering av data. Funktionen tar in argument i form av ett id som sedan används vid delete fetch-andropet.

Resterande PHP-filer
-
I root mappen finns det flertal php-filer som har olika funktioner. Dessa filer används vid inloggning och utloggning av användare. Alla filer som startar med "admin" används för att visa data i form av tabell och filer som startar med "add" används för att producera ett formulär och läsa in data från admin för att sedan skicka det vidare till funktion.
