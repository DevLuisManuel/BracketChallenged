<?php

$case1 = "(())";
$case2 = "({()()}[()])";
$case3 = "{[}()]";
$case4 = "({(fgfgfgfgfg)(dfgdfgdfgdf)}[dfgdfg(dfgdfgdfgdfg)]dfgdfgdfgdfg)";
$case5 = "";

$response = "Resultado de la prueba";
$length = strlen($response) + 12;
print_r(str_repeat("*", $length) . "\n");
print_r("*     $response     *\n");
print_r(str_repeat("*", $length) . "\n");

print_r("Case 1: [$case1] => " . validateBrackets($case1) . "\n");
print_r("Case 2: [$case2] => " . validateBrackets($case2) . "\n");
print_r("Case 3: [$case3] => " . validateBrackets($case3) . "\n");
print_r("Case 4: [$case4] => " . validateBrackets($case4) . "\n");
print_r("Case 5: [$case5] => " . validateBrackets($case5) . "\n");

function validateBrackets(string $string): string
{
    if (trim($string) === "") {
        return "false";
    }
    $string = preg_replace("/[a-zA-Z]/", '', $string);
    $stack = [];
    foreach (str_split($string) as $character) {
        if (isOpen($character)) {
            $stack[] = $character;
        } else {
            $topChar = array_pop($stack);
            if (!closes($topChar, $character)) {
                return "false";
            }
        }
    }
    return (count($stack) === 0) ? "true" : "false";
}

function closes(string $characterA, string $characterB): bool
{
    $pairs = [
        "(" => ")",
        "{" => "}",
        "[" => "]",
    ];
    return $pairs[$characterA] === $characterB;
}

function isOpen(string $character): bool
{
    return in_array($character, ['(', '{', '[']);
}
