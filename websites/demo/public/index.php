<?php

const BASE_PATH = __DIR__ . '/../';

// Critical - leave at the top
require BASE_PATH . 'functions.php';
include base_path('Response.php');
require base_path('Database.php');

require base_path('router.php');
