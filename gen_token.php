<?php

// JWT Builder is required:
// Install: composer require lcobucci/jwt paragonie/sodium_compat
// Then copy and paste the code below
// run: php turso-token-generator.php

$requiredExtensions = ['openssl', 'sodium'];
foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        die("Error: PHP extension '$ext' is not installed or enabled." . PHP_EOL);
    }
}

if (!shell_exec('which openssl')) {
    die("Error: OpenSSL command-line tool is not installed or not in your PATH." . PHP_EOL);
}

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die("Error: Composer autoload file not found. Did you run 'composer install'?" . PHP_EOL);
}

use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Eddsa;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;

require __DIR__ . '/vendor/autoload.php';

$requiredClasses = [
    'Lcobucci\JWT\JwtFacade',
    'Lcobucci\JWT\Signer\Eddsa',
    'Lcobucci\JWT\Signer\Key\InMemory',
    'Lcobucci\JWT\Token\Builder'
];
foreach ($requiredClasses as $class) {
    if (!class_exists($class)) {
        die("Error: Required class '$class' is not available. Did you run 'composer install'?" . PHP_EOL);
    }
}

// Set your expires time in days
$tokenExpiration = 30;

$accessKeysDir = getcwd() . '/access_keys';
if(!is_dir($accessKeysDir)) {
    mkdir($accessKeysDir);
}

// Generate privateKey and publicKey
shell_exec("openssl genpkey -algorithm ed25519 -out {$accessKeysDir}/jwt_private.pem");
shell_exec("openssl pkey -in {$accessKeysDir}/jwt_private.pem -outform DER | tail -c 32 > {$accessKeysDir}/jwt_private.binary");
shell_exec("openssl pkey -in {$accessKeysDir}/jwt_private.pem -pubout -out {$accessKeysDir}/jwt_public.pem");

$privateKey = sodium_crypto_sign_secretkey(
    sodium_crypto_sign_seed_keypair(
        file_get_contents("{$accessKeysDir}/jwt_private.binary")
    )
);
unlink("{$accessKeysDir}/jwt_private.binary");

$publicKeyPem = trim(file_get_contents("{$accessKeysDir}/jwt_public.pem"));
$pubKeyBase64 = str_replace(["-----BEGIN PUBLIC KEY-----", "-----END PUBLIC KEY-----", "\n", "\r"], '', $publicKeyPem);

$key = InMemory::base64Encoded(
    base64_encode($privateKey)
);

// Generate JWT tokens
$now = new DateTimeImmutable();
$fullAccessToken = (new JwtFacade())->issue(
    new Eddsa(),
    $key,
    static fn(
    Builder $builder,
    DateTimeImmutable $issuedAt
): Builder => $builder
        ->expiresAt($issuedAt->modify("+$tokenExpiration days"))
);

$readOnlyToken = (new JwtFacade())->issue(
    new Eddsa(),
    $key,
    static fn(
    Builder $builder,
    DateTimeImmutable $issuedAt
): Builder => $builder
        ->withClaim('a', 'ro')
        ->expiresAt($issuedAt->modify("+$tokenExpiration days"))
);

// Prepare response data
$data = [
    'full_access_token' => $fullAccessToken->toString(),
    'read_only_token' => $readOnlyToken->toString(),
    'public_key_pem' => $publicKeyPem,
    'public_key_base64' => $pubKeyBase64,
];

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . PHP_EOL;
