<?php

if (php_sapi_name() !== 'cli') {
    die('This file can be executed from console only');
}

$cmd_options = getopt("l::c::", ["limit::","help","caveno::"]);

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
    $output->writeln("--caveno, -c \t Start cave numbering at (default: 100)");
    exit(0);
}

$limit = get_limit($cmd_options);
$caveno = get_caveno($cmd_options);

for ($x=0; $x < $limit; $x++) {

    $cave_name = get_cave_name();
    $site_type = get_site_type();
    $country_id = 1; // Pretend it's SA
    $province_id = random_int(1,9);
    $cave_description = $faker->paragraph();

    $num = DB::update("INSERT INTO caveman.caves (cave_Number, cave_name, site_type, country_id, province_id, cave_description, deleted_at, created_at, updated_at) VALUES ($caveno, '$cave_name', '$site_type', $country_id, $province_id, '$cave_description', NULL, NOW(), NOW());");

    $caveno++;
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

function get_caveno($cmd_options) {
    $caveno = 100;
    if (array_key_exists("caveno", $cmd_options)) {
        $caveno = (int) $cmd_options['caveno'];
    }
    if (array_key_exists("c", $cmd_options)) {
        $caveno = (int) $cmd_options['c'];
    }
    return $caveno;
}

function get_cave_name() {
    $names_1 = ["Blowing", "Bat", "Fountains", "Swatkops", "Porcupine", "Bobs", "Wonder", "Crystal", "Davids","Lost", "Long", "Spider", "Creepy", "Black", "Stink", "Swiss Army Knife", "dustbin", "Owl", "Jaws", "World", "Johnnies", "Flat", "Woobie-Doobie", "spectacle", "Aardvark", "Smiss Cheeze", "Tapeworm", "Flea", "Dragons", "Hobbit", "Big Tree", "Bootless", "Baboon", "Monkey", "Noddy"];
    $names_2 = ["Hole", "Cave", "Pot", "", "Sinkhole", "Cave I", "Cave II", "Pothole", "Fissure", "Pit"];

    $key_1 = array_rand($names_1);
    $key_2 = array_rand($names_2);
    
    return $names_1[$key_1] . ' ' . $names_2[$key_2];
}

function get_site_type() {
    $types = ["Medium Cave", "Small cave", "Sinkhole", "Unknown", "Large Cave"];
    $key = array_rand($types);
    return $types[$key];
}