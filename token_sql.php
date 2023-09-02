<?php

class Block {
    public $index;
    public $timestamp;
    public $transactions;
    public $previousHash;
    public $hash;
    public $nonce;

    public function __construct($index, $timestamp, $transactions, $previousHash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
        return hash('sha256', $this->index . $this->timestamp . json_encode($this->transactions) . $this->previousHash . $this->nonce);
    }

    public function mineBlock($difficulty) {
        while (substr($this->hash, 0, $difficulty) !== str_repeat('0', $difficulty)) {
            $this->nonce++;
            $this->hash = $this->calculateHash();
        }
        echo "Block mined: {$this->hash}\n";
    }
}

class Blockchain {
    public $chain;
    public $difficulty;

    public function __construct() {
        $this->chain = [ $this->createGenesisBlock() ];
        $this->difficulty = 4; // Adjust difficulty as needed
    }

    public function createGenesisBlock() {
        return new Block(0, date('Y-m-d H:i:s'), [], '0');
    }

    public function addBlock($newBlock) {
        $newBlock->previousHash = end($this->chain)->hash;
        $newBlock->mineBlock($this->difficulty);
        $this->chain[] = $newBlock;
    }

    public function isChainValid() {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i - 1];

            if ($currentBlock->hash !== $currentBlock->calculateHash() || $currentBlock->previousHash !== $previousBlock->hash) {
                return false;
            }
        }
        return true;
    }
}

class User {
    public $username;
    public $balance;

    public function __construct($username, $balance) {
        $this->username = $username;
        $this->balance = $balance;
    }
}

// Initialize blockchain
$blockchain = new Blockchain();

// Create users with initial balances
$alice = new User('Alice', 100);
$bob = new User('Bob', 50);
$charlie = new User('Charlie', 200);

// Simulate transactions
$blockchain->addBlock(new Block(1, date('Y-m-d H:i:s'), [
    ['sender' => 'Alice', 'recipient' => 'Bob', 'amount' => 10],
    ['sender' => 'Charlie', 'recipient' => 'Alice', 'amount' => 20]
]));

$blockchain->addBlock(new Block(2, date('Y-m-d H:i:s'), [
    ['sender' => 'Bob', 'recipient' => 'Charlie', 'amount' => 5]
]));

// Display blockchain
echo "Is blockchain valid? " . ($blockchain->isChainValid() ? "Yes" : "No") . "\n";
echo json_encode($blockchain, JSON_PRETTY_PRINT);

// Display user balances
echo "Alice's balance: {$alice->balance}\n";
echo "Bob's balance: {$bob->balance}\n";
echo "Charlie's balance: {$charlie->balance}\n";
