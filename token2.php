<?php

$balances = [];

function createAccount($username) {
    global $balances;
    if (!isset($balances[$username])) {
        $balances[$username] = 100;
    }
}

function getBalance($username) {
    global $balances;
    return isset($balances[$username]) ? $balances[$username] : 0;
}

function transfer($from, $to, $amount) {
    global $balances;
    if (getBalance($from) >= $amount) {
        $balances[$from] -= $amount;
        $balances[$to] += $amount;
        echo "Transfer successful: $amount tokens transferred from $from to $to.\n";
    } else {
        echo "Transfer failed: Insufficient balance.\n";
    }
}

createAccount("Alice");
createAccount("Bob");

echo "Alice's balance: " . getBalance("Alice") . " tokens\n";
echo "Bob's balance: " . getBalance("Bob") . " tokens\n";

transfer("Bob", "Alice", 30);

$hosts = [
    'https://example.com',
    'https://anotherexample.com',
    // Add more hosts as needed
];

$queryParam = 'transactions=Bob,Alice,30';

foreach ($hosts as $host) {
    $url = $host . '?' . $queryParam;
    
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);

    if ($response !== false) {
        echo "Contents from $host:\n";
        echo $response;
        echo "\n--------------------------------------------------\n";
    } else {
        echo "Failed to fetch content from $host: " . curl_error($ch) . "\n";
        echo "\n--------------------------------------------------\n";
    }

    curl_close($ch);
}

?>
