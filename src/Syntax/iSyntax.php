<?php namespace Gen\Syntax;

interface iSyntax
{

    function analyse($matches);

    function syntax($word);

}