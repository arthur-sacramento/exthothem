<?php

// Define the constants
define("BLOCKCHAIN_FILENAME", "blockchain.txt");
define("DIFFICULTY", 4);

// Create a new blockchain
$blockchain = [];

// Add the genesis block to the blockchain
$genesisBlock = new Block(0, "Genesis block", "", 0);
$blockchain[] = $genesisBlock;

// Function to mine a new block
function mineBlock($previousBlockHash, $data) {
  // Create a new block
  $block = new Block(
    $blockchain[count($blockchain) - 1]->index + 1,
    $data,
    $previousBlockHash,
    $blockchain[count($blockchain) - 1]->difficulty
  );

  // Calculate the hash of the new block
  $blockHash = $block->calculateHash();

  // Check if the hash meets the difficulty requirements
  while ($blockHash[0] != "0" . str_repeat("0", DIFFICULTY - 1)) {
    $block->nonce++;
    $blockHash = $block->calculateHash();
  }

  // Return the new block
  return $block;
}

// Function to add a block to the blockchain
function addBlock($block) {
  global $blockchain;

  // Check if the block is valid
  if ($block->previousBlockHash != $blockchain[count($blockchain) - 1]->hash) {
    return false;
  }

  // Add the block to the blockchain
  $blockchain[] = $block;

  // Return true
  return true;
}

// Function to get the latest block in the blockchain
function getLatestBlock() {
  global $blockchain;

  return $blockchain[count($blockchain) - 1];
}

// Function to print the blockchain
function printBlockchain() {
  global $blockchain;

  echo "<pre>";
  foreach ($blockchain as $block) {
    echo $block->toString() . "\n";
  }
  echo "</pre>";
}

// Main function
function main() {
  // Mine a new block
  $block = mineBlock($blockchain[count($blockchain) - 1]->hash, "This is the second block");

  // Add the block to the blockchain
  addBlock($block);

  // Print the blockchain
  printBlockchain();
}

// Call the main function
main();

?>
