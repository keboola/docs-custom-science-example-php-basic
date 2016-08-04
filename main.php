<?php

require "vendor/autoload.php";

// read the configuration file
$configFile = getenv('KBC_DATADIR') . DIRECTORY_SEPARATOR . 'config.json';
$config = json_decode(file_get_contents($configFile), true);

$length = $config['parameters']['length'];
$count = $config['parameters']['count'];

// create output file and write header
$csv = new \Keboola\Csv\CsvFile(
    getenv('KBC_DATADIR') . DIRECTORY_SEPARATOR . 'out' . DIRECTORY_SEPARATOR . 'tables' . DIRECTORY_SEPARATOR . 'result.csv'
);
$csv->writeRow(['id', 'string']);

// generate some roandom rows
for ($i = 0; $i < $count; $i++) {
    $csv->writeRow([
        $i,
        substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length),
    ]);
}
