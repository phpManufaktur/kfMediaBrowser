<?php

/**
 * MediaBrowser
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://kit2.phpmanufaktur.de
 * @copyright 2013 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

if ('á' != "\xc3\xa1") {
    // the language files must be saved as UTF-8 (without BOM)
    throw new \Exception('The language file ' . __FILE__ . ' is damaged, it must be saved UTF-8 encoded!');
}

return array(
    '- please select -'
        => '- bitte auswählen -',

    "Can't change the access rights for the file <b>%file%</b>!"
        => 'Konnte die Zugriffsrechte für die Datei <b>%file%</b> nicht ändern!',
    "Can't create the directory <b>%directory%</b>, message: <em>%message%</em>"
        => 'Konnte das Verzeichnis <b>%directory%</b> nicht anlegen, Meldung: <em>%message%</em>',
    "Can't change the last modification time for the file <b>%file%</b>!"
        => 'Konnte die Zeit der letzten Änderung für die Datei <b>%file%</b> nicht setzen!',
    'Create directory'
        => 'Verzeichnis anlegen',

    'Delete directory: %directory%'
        => 'Verzeichnis löschen: %directory%',
    'Delete file: %file%'
        => 'Datei löschen: %file%',

    'Exit MediaBrowser'
        => 'MediaBrowser schließen',

    'No file selected!'
        => 'Es wurde keine Datei ausgewählt!',

    'one level up'
        => 'eine Verzeichnisebene höher',
    "Ooops, can't validate the upload form, something went wrong ..."
        => 'Oh, das ist etwas schiefgelaufen, kann den Upload Dialog nicht überprüfen ...',

    'Select file: %file%'
        => 'Datei auswählen: %file%',
    'Submit file'
        => 'Datei übermitteln',

    'The directory %directory% was successfull created.'
        => 'Das Verzeichnis %directory% wurde erfolgreich angelegt.',
    'The directory %directory% was successfull deleted.'
        => 'Das Verzeichnis %directory% wurde erfolgreich gelöscht.',
    'The file extension %extension% is not supported!'
        => 'Die Dateiendung %extension% wird nicht unterstützt!',
    'The file %file% was successfull deleted.'
        => 'Die Datei %file% wurde erfolgreich gelöscht.',
    'The file %file% was successfull uploaded.'
        => 'Die Datei %file% wurde erfolgreich übertragen.',
    'This directory does not contain any media files.'
        => 'Dieses Verzeichnis enthält keine Medien Dateien.',

    'Upload file'
        => 'Datei hochladen',

);
