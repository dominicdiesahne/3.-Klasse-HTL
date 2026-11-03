**SYTB – Systemtechnik Betriebssysteme**

| **Woche** | **Datum**  |
|-----------|------------|
| Woche 2   | 18.09.2026 |

**1 · Aufgabenstellung**

*Am Anfang wurde die Theorie wiederholt danach konnten wir testen Dateien zu erstellen, bearbeiten, kopieren,...*

*Danach haben wir selbstständig in Gameshell gearbeitet*

*Am Ende haben wir noch einen Snapshot erstellt.*

**2 · Durchgeführte Schritte & Befehle**

| **Befehl**      | **Ausgabe / Ergebnis**                                    | **Kommentar**                        |
|-----------------|-----------------------------------------------------------|--------------------------------------|
| pwd             | Zeigt den aktuellen Pfad an                               |                                      |
| Ls -la          | Zeigt alle Datein und Ordner inklusive versteckter Datein |                                      |
| mkdir           | Erstellt einen neuen Ordner                               |                                      |
| touch           | Erstellt eine neue leere Datei                            |                                      |
| echo            | Gibt Text im Terminal aus                                 |                                      |
| cp              | Kopiert Datein oder Ordner                                |                                      |
| mv              | Verschiebt oder benennt Datein/ Ordner um                 |                                      |
| nano            | Öffnet einen Texteditor                                   |                                      |
| Sudo apt update | Aktualisiert die paketlisten                              |                                      |
| reset           | Setzt das Terminal zurück                                 | Falls ein Darstellungsfehler auftrit |
| cat             | Zeigt den Inhalt einer Datei an                           |                                      |

**3 · Ergebnisse**

**Aufgabe 1:**

Touch notiz.txt

Echo “Mein erste Eintrag“ \> notiz.txt

Cat notiz.txt

Cp notiz.txt kopie.txt

Ls

Mv kopie.txt archiv.txt

Ls -al

**Aufgabe 2:**

Selbständiges arbeiten in der Gameshell.

**Aufgabe 3:**

Rm -rf ~/woche2/

Nach dem wiederherstellen des Sicherungspunkts ist die Directory wieder da.

**4 · Kontrollfragen & Antworten**

| **Frage**                                                                                                                              | **Antwort**                                                                                                                                                                       |
|----------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Was bedeutet der Punkt vor einem Datei- oder Ordnernamen unter Linux, und mit welcher Option von ls machst du solche Dateien sichtbar? | Ein Punkt vor dem Namen bedeutet, dass die Datei oder der Ordner versteckt ist. Mit ls -a werden sie angezeigt.                                                                   |
| Was genau verwirft „Snapshot wiederherstellen"?                                                                                        | “Snapshot wiederherstellen” setzt die Virtuelle Maschine auf den zuletzt gespeicherten sicherungspunkt alles was dazwischen gemacht worden ist geht verloren.                     |
| Warum reicht ein einziger Snapshot vom Jahresanfang nicht als Rettungsleine für das ganze Jahr?                                        | Weil alle Änderungen seit dem Jahresanfang verloren gehen würden. Deshalb braucht man regelmäßig neue Snapshots.                                                                  |
| Ist ein Snapshot dasselbe wie ein Backup? Begründe kurz.                                                                               | Nein. Ein Snapshot speichert einen Zustand zu einem bestimmten Zeitpunkt, ein Backup ist eine separate Sicherung, die auch bei einem Systemausfall wiederhergestellt werden kann. |

**5 · Reflexion**

*Was war heute am schwierigsten zu verstehen, und warum?*

Es war nichts Schwieriges dabei, weil es gut erklärt wurde.

*Was hast du heute neu gelernt, das dir vorher nicht klar war?*

Ich habe alle Befehle davor schon gekannt aber jetzt auch richtig verstanden und gemerkt.

*Wobei hättest du dir mehr Zeit oder Hilfe gewünscht?*

Nirgendwo.
