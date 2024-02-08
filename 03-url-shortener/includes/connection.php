<?php

function db(): SQLite3
{
    return new SQLite3('/Users/asciito/Documents/GitHub/vanilla-php/03-url-shortener/database/database.sqlite');
}