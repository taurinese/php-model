<?php

require __DIR__ . '/../vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();


try {
    $db = new PDO("{$_ENV['DB_CONNECTION']}:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
} catch (\PDOException $e) {
    die($e->getMessage());
}

/* $user['created_at']= $faker->dateTime($max = 'now');
$user['updated_at'] = $faker->dateTime($startDate = '-30 years', $endDate = 'now');
$user['first_name'] = $faker->firstName();
$user['last_name'] = $faker->lastName();
$user['email'] = $faker->email();
$user['password'] = $faker->password();


print_r($user); */

for ($i=0; $i < 10; $i++) { 

    $createdAt = $faker->dateTime($max = 'now')->format('Y-m-d H:i:s');
    $query = $db->prepare('INSERT INTO users (created_at, updated_at, first_name, last_name, email, password) VALUES (:created_at, :updated_at, :first_name, :last_name, :email, :password)');
    $query->execute([
        "created_at" => $createdAt,
        "updated_at" => $faker->dateTimeBetween($startDate = $createdAt, $endDate = 'now')->format('Y-m-d H:i:s'),
        "first_name" => $faker->firstName(),
        "last_name" => $faker->lastName(),
        "email" => $faker->email(),
        "password" => $faker->password(),
    ]);
}