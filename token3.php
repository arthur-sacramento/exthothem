<?php

class Token {
    private $balances = [];

    public function createAccount($username) {
        if (!isset($this->balances[$username])) {
            $this->balances[$username] = 100;
        }
    }

    public function getBalance($username) {
        return isset($this->balances[$username]) ? $this->balances[$username] : 0;
    }

    public function transfer($from, $to, $amount) {
        if ($this->getBalance($from) >= $amount) {
            $this->balances[$from] -= $amount;
            $this->balances[$to] += $amount;
            echo "Transfer successful: $amount tokens transferred from $from to $to.\n";
        } else {
            echo "Transfer failed: Insufficient balance.\n";
        }
    }
}

$tokenSystem = new Token();

$tokenSystem->createAccount("Alice");
$tokenSystem->createAccount("Bob");

echo "Alice's balance: " . $tokenSystem->getBalance("Alice") . " tokens\n";
echo "Bob's balance: " . $tokenSystem->getBalance("Bob") . " tokens\n";

$tokenSystem->transfer("Alice", "Bob", 30);

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
