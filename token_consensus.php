<?php

class Block {
    public $index;
    public $timestamp;
    public $data;
    public $previousHash;
    public $hash;
    public $nonce;

    public function __construct($index, $timestamp, $data, $previousHash = '') {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->nonce = 0;
        $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
        return hash('sha256', $this->index . $this->timestamp . json_encode($this->data) . $this->previousHash . $this->nonce);
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
        $this->chain = [$this->createGenesisBlock()];
        $this->difficulty = 4; // Adjust difficulty as needed
    }

    public function createGenesisBlock() {
        return new Block(0, date('Y-m-d H:i:s'), 'Genesis Block', '0');
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

class Node {
    public $blockchain;

    public function __construct($blockchain) {
        $this->blockchain = $blockchain;
    }

    public function mine() {
        $data = "Transaction data for Block " . (count($this->blockchain->chain) + 1);
        $newBlock = new Block(count($this->blockchain->chain), date('Y-m-d H:i:s'), $data);
        $this->blockchain->addBlock($newBlock);
    }
}

// Create a blockchain
$blockchain = new Blockchain();

// Create two nodes
$node1 = new Node($blockchain);
$node2 = new Node($blockchain);

// Both nodes mine new blocks
$node1->mine();
$node2->mine();

// Check the validity of the blockchain
echo "Is blockchain valid? " . ($blockchain->isChainValid() ? "Yes" : "No") . "\n";
