<?php

if (php_sapi_name() !== 'cli') {
    die('This file can be executed from console only');
}

$cmd_options = getopt("l::", ["limit::","help"]);

require_once __DIR__.'/../vendor/autoload.php';
/* @var $app \Illuminate\Foundation\Application */
/* @var $kernel \App\Http\Kernel */
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = 0; // success
$input = new Symfony\Component\Console\Input\ArgvInput;
$output = new Symfony\Component\Console\Output\ConsoleOutput;
$kernel->bootstrap();

$faker = Faker\Factory::create();

if (array_key_exists("help", $cmd_options)) {
    $output->writeln("--limit, -l \t Number of records to create (default: 10)");
    exit(0);
}

$limit = get_limit($cmd_options);

for ($x=0; $x < $limit; $x++) {

    $name = $faker->firstName() . ' ' . $faker->lastName();
    $username = str_replace(' ', '', $name);
    $email = $faker->safeEmail();
    $password = '$2y$10$Mt7rqv/p3uhXUP8HH4ffi.oXyxfPjyll.Z70xh8ZBuLlVqqAURLem';

    $num = DB::update("INSERT INTO caveman.users (username, name, email, email_verified_at, password, remember_token, created_at, updated_at) VALUES('$username', '$name','$email', NULL, '$password', NULL, NOW(), NOW());");

}

$kernel->terminate($input, $status);
exit($status);

function get_limit($cmd_options) {
    $limit = 10;
    if (array_key_exists("limit", $cmd_options)) {
        $limit = (int) $cmd_options['limit'];
    }
    if (array_key_exists("l", $cmd_options)) {
        $limit = (int) $cmd_options['l'];
    }
    return $limit;
}