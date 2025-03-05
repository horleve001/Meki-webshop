<?php

// Felhasználók adatainak mentése, betöltése, módosítása, törlése
  function save_users(string $path, array $data) {
    $users = load_users($path);

    $users["users"][] = $data;

    $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }

  function load_users(string $path): array {

    $json = file_get_contents($path);

    return json_decode($json, true);
  }

  function update_user(string $path, array $data) {
    $users = load_users($path);
    $index = 0;
    foreach ($users["users"] as $user) {
      if ($user["username"] === $_SESSION["user"]["username"]) {
        $users["users"][$index] = $data;
        break;
      }
      $index++;
    }

    $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }

  function delete_user(string $path) {
    $users = load_users($path);
    $index = 0;
    foreach ($users["users"] as $user) {
      if ($user["username"] === $_SESSION["user"]["username"]) {
        unset($users["users"][$index]);
        break;
      }
      $index++;
    }

    $json_data = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
  // Termékek adatainak mentése, betöltése, módosítása, törlése, hozzáadása
  function save_products(string $path, array $data) {
    $products = load_products($path);

    $products["products"][] = $data;

    $json_data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
  function load_products(string $path): array{

    $json = file_get_contents($path);

    return json_decode($json, true);
  }
  function update_product(string $path, array $data) {
    $products = load_products($path);
    $index = 0;
    foreach ($products["products"] as $product) {
      if ($product["id"] === $_GET["id"]) {
        $products["products"][$index] = $data;
        break;
      }
      $index++;
    }

    $json_data = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
// Kosár adatainak mentése, betöltése, módosítása, törlése
  function load_cart(string $path) {
    $json_data = file_get_contents($path);

    return json_decode($json_data, true);
  }
    
  function add_cart(string $path, array $data) {

    $json_data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }

  function delete_cart(string $path) {

    $cart = [];

    $json_data = json_encode($cart, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
// Kalkulátor adatainak mentése, törlése
  function load_calc(string $path) {
    $json_data = file_get_contents($path);

    return json_decode($json_data, true);
  }
  function add_calc(string $path, array $data) {

    $json_data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
  function delete_calc(string $path) {

    $products = [];

    $json_data = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
  }
  // Értékelések adatainak mentése, betöltése
  function save_rating(string $path, array $data) {
    $ratings = load_ratings($path);

    $ratings["ratings"][] = $data;

    $json_data = json_encode($ratings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($path, $json_data);
}

function load_ratings(string $path): array {

    $json = file_get_contents($path);

    return json_decode($json, true);
}
