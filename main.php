<?php

$date = date("Y-m-d");
$version = 'v1';
$baseList = file_get_contents("https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies.json");
$baseList = json_decode($baseList, true);

$matchFound = false;
while ($matchFound == false) {
    $selectedCurrency = strtolower(readline("Enter currency to exchange: "));
    if (array_key_exists($selectedCurrency, $baseList)) {
        $matchFound = true;
    } else {
        echo "$selectedCurrency is not a valid currency code." . PHP_EOL;
        echo 'Please enter a valid currency to exchange ' . PHP_EOL;
    }
}

$matchFound = false;
while ($matchFound == false) {
    $amount = (float)readline("Enter amount to exchange: ");
    if (!is_numeric($amount) || $amount < 0) {
        echo "$amount is not a valid amount." . PHP_EOL;
    } else {
        $matchFound = true;
        break;
    }
}

$matchFound = false;
while ($matchFound == false) {
    $exchangeTo = strtolower(readline("Enter currency to exchange: "));
    if (array_key_exists($exchangeTo, $baseList)) {
        $matchFound = true;
    } else {
        echo "$exchangeTo is not a valid currency code." . PHP_EOL;
        echo 'Please enter a valid currency to exchange.' . PHP_EOL;
    }
}

$api = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@$date/v1/currencies/$selectedCurrency.json";
$data = file_get_contents($api);
$array = json_decode($data);

$result = number_format($array->$selectedCurrency->$exchangeTo * $amount, 2);
echo "$amount $selectedCurrency to $exchangeTo is $result \n";