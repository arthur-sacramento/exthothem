<?php

// Script to select a table related to the user input.


// Redirect to synonyms
$adult_search_pt = array("sexo", "gostosa", "bunda", "buceta", "bct", "tesuda", "rabuda", "puta", "sensual", "porno", "pornô", "erótico", "erotico", "foda", "erotica");

if (in_array($database, $adult_search_pt)) {
  $database = "porn";    
}

$adult_search = array("sex", "sexy", "fuck", "fucking", "fucked", "porn", "pornography", "erotic", "erotism", "cum", "orgams", "masturbate", "masturbation", "masturbates", "nude", "nudity", "nudism", "naturism", "milf", "striptease", "strip tease", "strip-tease", "asshole", "ass hole", "boobs", "titts", "pussy", "dildo", "lesbians", "lesbians", "doggy", "erotic", "erotism", "sensuality", "sensual");

if (in_array($database, $adult_search)) {
    $database = "porn";    
}

$book_search = array("pdf", "ebook", "e-book", "book", "books", "livro", "livros");

if (in_array($database, $book_search)) {
    $database = "ebook";    
}

// Check if there are any words in the user input that can be used to redirect to a category or table name
$search_terms = array("music", "art","video", "software", "game", "philosophy", "programming");

foreach ($search_terms as $word) {
  if (strpos($database, strtolower($word)) !== false) {
    $database = strtolower($word);
  }
}


?>

<script>
/*/

// Redirect to synonym with JS
const bookSearch = ["pdf", "ebook", "e-book", "book", "books", "livro", "livros"];
let database = /* Assign a value to database variable */;

if (bookSearch.includes(database)) {
    database = "ebook";
}

// Redirect to category detection with JS
const searchTerms = ["music", "art", "video", "software", "game", "philosophy", "programming"];
let database = /* Assign a value to the database variable */;

searchTerms.forEach(word => {
  if (database.toLowerCase().includes(word)) {
    database = word.toLowerCase();
  }
});
/*/
</script>