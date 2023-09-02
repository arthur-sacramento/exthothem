<?php

class Transaction {
    public $sender;
    public $recipient;
    public $amount;

    public function __construct($sender, $recipient, $amount) {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->amount = $amount;
    }
}

class Block {
    public $index;
    public $timestamp;
    public $transactions;
    public $previousHash;
    public $hash;

    public function __construct($index, $timestamp, $transactions, $previousHash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
        return hash('sha256', $this->index . $this->timestamp . json_encode($this->transactions) . $this->previousHash);
    }
}

class Blockchain {
    public $chain;
    public $pendingTransactions;
    public $difficulty;
    public $reward;

    public function __construct() {
        $this->chain = [$this->createGenesisBlock()];
        $this->pendingTransactions = [];
        $this->difficulty = 2; // Adjust difficulty as needed
        $this->reward = 100; // Reward for miners
    }

    public function createGenesisBlock() {
        return new Block(0, date('Y-m-d H:i:s'), [], '0');
    }

    public function getLastBlock() {
        return end($this->chain);
    }

    public function minePendingTransactions($minerAddress) {
        $rewardTransaction = new Transaction(null, $minerAddress, $this->reward);
        $this->pendingTransactions[] = $rewardTransaction;

        $block = new Block(count($this->chain), date('Y-m-d H:i:s'), $this->pendingTransactions, $this->getLastBlock()->hash);
        $block->calculateHash();
        $this->chain[] = $block;

        $this->pendingTransactions = [];
    }

    public function createTransaction($transaction) {
        $this->pendingTransactions[] = $transaction;
    }

    public function getBalance($address) {
        $balance = 0;

        foreach ($this->chain as $block) {
            foreach ($block->transactions as $transaction) {
                if ($transaction->sender === $address) {
                    $balance -= $transaction->amount;
                }

                if ($transaction->recipient === $address) {
                    $balance += $transaction->amount;
                }
            }
        }

        return $balance;
    }
}

// Create a blockchain
$blockchain = new Blockchain();

// Create some transactions
$blockchain->createTransaction(new Transaction('Alice', 'Bob', 50));
$blockchain->createTransaction(new Transaction('Bob', 'Charlie', 30));

// Mine pending transactions
$blockchain->minePendingTransactions('MinerA');

// Check balances
echo 'Alice balance: ' . $blockchain->getBalance('Alice') . "\n";
echo 'Bob balance: ' . $blockchain->getBalance('Bob') . "\n";
echo 'Charlie balance: ' . $blockchain->getBalance('Charlie') . "\n";
echo 'MinerA balance: ' . $blockchain->getBalance('MinerA') . "\n";
