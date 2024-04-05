<?php

$db = new Database((require 'config.php')['database']);

$heading = "My Notes";

$notes = $db->query('select * from notes where user_id = 1')->findAll();

require "views/notes.view.php";