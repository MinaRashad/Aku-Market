<?php
    $dir = 'sqlite:'.$_SERVER['DOCUMENT_ROOT'].'/Aku_database.db';
    try {
        # Connect to the SQLite Database.
        $db = new PDO($dir);
    } catch(Exception $e) {
        echo('connection_unsuccessful: ' . $e->getMessage());
    }
