<?php 

use Parle\Token;
use Parle\Lexer;

/* 
* Process text and return lexical analysis
* @param string $text
* @return array 
*/
function getLexicalAnalysis($text) {
    $tokens = [
        "SPACE" => 1,
        "DIGIT" => 2,
    ];

    $lex = new Lexer;

    $lex->push("\s", $tokens['SPACE']);
    $lex->push("\D", $tokens['DIGIT']);

    $lex->build();

    $lex->consume($text);

    $validTokens = [];
    $words = [];
    $currentWord = '';

    do {
        $lex->advance();
        $tok = $lex->getToken();

        $validTokens []= [
            'value' => $tok->value,
            'position' => $lex->marker,
            'valid' => Token::UNKNOWN !== $tok->id,
        ];

        if (Token::UNKNOWN === $tok->id || $tok->id === 1) {
            if (!empty($currentWord)) {
                $words []= $currentWord;
            }

            $currentWord = '';
        } else {
            $currentWord .= $tok->value;
        }
    } while (Token::EOI != $tok->id);

    // for the last word
    if (!empty($currentWord)) {
        $words []= $currentWord;
    }

    return [
        'validTokens' => $validTokens,
        'words' => $words,
    ];
}

function getValidWords($words) {
    $count = 0;

    foreach ($words as $word) {
        if (strlen($word) >= 5) {
            $count++;
        }
    }

    return $count;
}