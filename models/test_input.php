<?php

/**
 * This function test input data
 * @param string $data
 * @return string
 */
function test_input(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }