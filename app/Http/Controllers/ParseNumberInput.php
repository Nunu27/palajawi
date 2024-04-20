<?php
namespace App\Http\Controllers;

trait ParseNumberInput
{

    public static function parseNumberInput(string $input)
    {
        return preg_replace('/[^\d]*/', '', $input);
    }
}