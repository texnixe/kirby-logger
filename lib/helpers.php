<?php
// adapted from http://www.geekality.net/2011/05/28/php-tail-tackling-large-files/

function tail($filename, $lines = 10, $buffer = 4096)
{
    // Open the file
    $f = fopen($filename, "rb");

    // Jump to last character
    fseek($f, -1, SEEK_END);

    // Read it and adjust line number if necessary
    // (Otherwise the result would be wrong if file doesn't end with a blank line)
    if(fread($f, 1) != "\n") $lines -= 1;

    // Start reading
    $output = '';
    $chunk = '';

    // While we would like more
    while(ftell($f) > 0 && $lines >= 0)
    {
        // Figure out how far back we should jump
        $seek = min(ftell($f), $buffer);

        // Do the jump (backwards, relative to where we are)
        fseek($f, -$seek, SEEK_CUR);

        // Read a chunk and prepend it to our output
        $output = ($chunk = fread($f, $seek)).$output;
        // Jump back to where we started reading
        fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);

        // Decrease our line counter
        $lines -= substr_count($chunk, "\n");

    }

    // While we have too many lines
    // (Because of buffer size we might have read too many)
    while($lines++ < 0)
    {
        // Find first newline and remove all text before that
        $output = substr($output, strpos($output, "\n") + 1);
    }

    $output = explode("\n",rtrim($output, "\n"));

    // Close file and return
    fclose($f);
    return $output;
}


function translation($string) {

  $translations = require __DIR__ . DS . 'translations.php';
  $language = c::get('logger.language', c::get('panel.language', 'en');

  if (! array_key_exists($language, $translations)) {
    $language = 'en';
  }

  $translation = $translations[$language];

  if(array_key_exists($string, $translation)) {
    $string = $translation[$string];

  }

  return $string;
}
