<p align="center">
  <img src="./icon.svg" alt="Pizza-Form Logo" width="120" height="120">
</p>

# Pizza-Form

Ein Bestellformular für den [HardChor](https://hardchor-passau.de) zum Sammeln von Pizzawünschen für ein All-you-can-eat Pizza-Buffet.

**Hinweis:** Dieses Tool ist ausschließlich auf Deutsch verfügbar.

## Funktionen

- **Bestellungen sammeln:** Jeder Teilnehmer kann seine Pizzawünsche eintragen.
- **Aggregierte Übersicht:** Der Admin kann Bestellungen nach Tag und Typ (vegan, vegetarisch, alles) zusammenfassen und die Pizze entsprechend auswählen.
- **Zahlungsstatus:** Nachverfolgung, wer bereits bezahlt hat und wer nicht.

## Voraussetzungen

- PHP 8.5 oder höher
- Composer
- SQLite3

## Installation

1. Repository klonen:

   ```bash
   git clone https://github.com/leonickl/pizza-form
   cd pizza-form
   ```

2. Abhängigkeiten installieren:

   ```bash
   composer install
   ```

3. Datenbank-Migrationen durchführen:

   ```bash
   ./run migrate
   ```

4. Server starten:

   ```bash
   ./run server
   ```

## Aktualisieren

Um die Anwendung zu aktualisieren, genügt ein Pull gefolgt von einer Migration:

```bash
git pull && composer install && ./run migrate
```
