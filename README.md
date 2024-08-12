# Kasch_RegisterInfo module

**Eine einfache Erweiterung, um zu fragen, wie der Kunde von der Website erfahren hat.**

## Voraussetzungen

- PHP 8.1 oder höher
- Magento 2.4.*

## Installation

### 1. Installation über Composer

Um das Modul über Composer zu installieren, gehe wie folgt vor:

1. Öffne ein Terminal und navigiere in das Root-Verzeichnis deiner Magento-Installation.

2. Füge das Modul zu deinem Projekt hinzu, indem du folgenden Befehl ausführst:

    ```bash
    composer require Kasch/RegisterInfo
    ```

3. Nachdem das Modul heruntergeladen wurde, führe die folgenden Magento-Befehle aus, um das Modul zu installieren:

    ```bash
    php bin/magento module:enable Kasch_RegisterInfo
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy -f
    php bin/magento cache:clean
    ```

### 2. Manuelle Installation

Wenn du das Modul manuell installieren möchtest, folge diesen Schritten:

1. Lade das Modul-Archiv (`Kasch_RegisterInfo.zip`) von der Quelle herunter oder klone das Git-Repository.

2. Entpacke das Archiv (falls zutreffend).

3. Kopiere den entpackten Ordner `Kasch/RegisterInfo` in das Verzeichnis `app/code` deiner Magento-Installation:

    ```
    app/code/Kasch/RegisterInfo
    ```

4. Aktiviere das Modul und führe die folgenden Befehle aus:

    ```bash
    php bin/magento module:enable Kasch_RegisterInfo
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy -f
    php bin/magento cache:clean
