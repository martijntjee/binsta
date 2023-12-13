# Mijn Fullstack Framework

## Installatie
Voor dit project hebt je php nodig, doe dit via [XAMPP]('https://www.apachefriends.org/download.html'). Als dit klaar is hoor je in de terminal de command `php -v` uitvoeren. Daarnaast is [Composer]('https://getcomposer.org/doc/00-intro.md#installation-windows') ook nodig, is dit klaar voer dan het command `composer -v` uit om te kijken of composer succesvol is geïnstalleerd.
Voor de tailwindcss heb je javascript nodig, mocht je dit niet hebben, kan je het [hier]('https://nodejs.org/en/download') vinden, controller of dit gelukt is met `node -v`.

## Setup
Voer de volgende commands uit in volgorde:
- `composer i`
- `npm i`
- `npm run watch`

## Database
Ook is er een database server nodig, waarop je een database aanmaakt genaamd: 'binsta', zodra dit klaar is kan je bij index.php en seeder.php bij de `R::setup()` de gegevens aanpassen volgens jouw setup:
- host: De naam van de server waarop je de database host
- dbname: De naam van de Database, oftewel binsta
- username: De gebruikersnaam van het account wat je wilt gebruiken om een connectie te maken met je server
- password: Het wachtwoord die bij de gebruiker hoort

Is dit gelukt, voer het volgende command uit om de database te vullen met data:
- `php database/seeder.php`

+------------------------+       +------------------------+       +------------------------+
|          User          |       |          Post          |       |          Like          |
+------------------------+       +------------------------+       +------------------------+
| PK: UserID             |       | PK: PostID             |       | PK: LikeID             |
| Username               |-------| FK: UserID             |-------| FK: UserID             |
| Password               |       | Caption                |       | FK: PostID             |
| Email                  |       | ImageURL               |       +------------------------+
| Bio                    |       | CreationDate           |
| ProfilePicture         |       +------------------------+
+------------------------+

+------------------------+       +------------------------+       +------------------------+
|        Comment         |       |      CodeSnippet       |       |         Fork           |
+------------------------+       +------------------------+       +------------------------+
| PK: CommentID          |       | PK: SnippetID          |       | PK: ForkID             |
| FK: UserID             |-------| FK: UserID             |-------| FK: OriginalSnippetID  |
| FK: PostID             |       | Text                   |       | FK: ForkedSnippetID    |
| Text                   |       | Language               |       +------------------------+
| CommentDate            |       | SyntaxHighlighting     |
+------------------------+       +------------------------+

+------------------------+       +------------------------+       +------------------------+
|          Feed          |       |     ColorScheme        |       |         Feed           |
+------------------------+       +------------------------+       +------------------------+
| PK: FeedID             |       | PK: SchemeID           |       | PK: FeedID             |
| FK: UserID             |-------| Name                   |-------| FK: UserID             |
| FK: PostID             |       | BackgroundColor        |       | FK: PostID             |
| Timestamp              |       | ForegroundColor        |       +------------------------+
+------------------------+       | AccentColor            |
                                 +------------------------+
