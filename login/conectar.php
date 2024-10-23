<?php

try {
    $banco = new PDO("sqlite:".__DIR__."/../../banco.sqlite");
} catch (\PDOException $e) {
    echo "Aconteceu um erro! ".$e->getMessage();
}
