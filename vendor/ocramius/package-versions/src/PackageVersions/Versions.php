<?php

declare(strict_types=1);

namespace PackageVersions;

use OutOfBoundsException;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = 'laravel/laravel';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    public const VERSIONS          = array (
  'asm89/stack-cors' => '1.3.0@b9c31def6a83f84b4d4a40d35996d375755f0e08',
  'aws/aws-sdk-php' => '3.133.40@f89562eaab7f9e5695b10960abb727b64df3da10',
  'aws/aws-sdk-php-laravel' => '3.5.0@7a3705461c06dc1ce8496fbf9b22ec96f769b3a7',
  'barryvdh/laravel-cors' => 'v1.0.5@0e0500133dbb6325266133dd72f040617c9cdbd0',
  'clue/stream-filter' => 'v1.4.1@5a58cc30a8bd6a4eb8f856adf61dd3e013f53f71',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/cache' => '1.10.0@382e7f4db9a12dc6c19431743a2b096041bcdd62',
  'doctrine/dbal' => 'v2.10.1@c2b8e6e82732a64ecde1cddf9e1e06cb8556e3d8',
  'doctrine/event-manager' => '1.1.0@629572819973f13486371cb611386eb17851e85c',
  'doctrine/inflector' => '1.3.1@ec3a55242203ffa6a4b27c58176da97ff0a7aec1',
  'doctrine/lexer' => '1.2.0@5242d66dbeb21a30dd8a3e66bf7a73b66e05e1f6',
  'dragonmantank/cron-expression' => 'v2.3.0@72b6fbf76adb3cf5bc0db68559b33d41219aba27',
  'drivezy/laravel-access-manager' => 'v1.0.3@39bdfccf4cc72647cc1f348a64f172153a6bca38',
  'drivezy/laravel-admin' => 'v0.3.7@720a65a5ff01c65965d0791deef1bea62303514c',
  'drivezy/laravel-record-manager' => 'v1.0.3@5043d66f5df797259b98227b16505c3c8aef8b52',
  'drivezy/laravel-utility' => 'v1.0.4@6d7db81343b11fe564f6bfb7818c2f8a9fb6ded2',
  'egulias/email-validator' => '2.1.17@ade6887fd9bd74177769645ab5c474824f8a418a',
  'fideloper/proxy' => '4.3.0@ec38ad69ee378a1eec04fb0e417a97cfaf7ed11a',
  'guzzlehttp/guzzle' => '6.5.2@43ece0e75098b7ecd8d13918293029e555a50f82',
  'guzzlehttp/promises' => 'v1.3.1@a59da6cf61d80060647ff4d3eb2c03a2bc694646',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'http-interop/http-factory-guzzle' => '1.0.0@34861658efb9899a6618cef03de46e2a52c80fc0',
  'jakub-onderka/php-console-color' => 'v0.2@d5deaecff52a0d61ccb613bb3804088da0307191',
  'jakub-onderka/php-console-highlighter' => 'v0.4@9f7a229a69d52506914b4bc61bfdb199d90c5547',
  'jean85/pretty-package-versions' => '1.2@75c7effcf3f77501d0e0caa75111aff4daa0dd48',
  'laravel/framework' => 'v6.18.2@9425a2f410d05d5bba493f62cff03854a8b19559',
  'laravel/helpers' => 'v1.2.0@1f978fc5dad9f7f906b18242c654252615201de4',
  'laravel/tinker' => 'v2.3.0@5271893ec90ad9f8d3e34792ac6b72cad3b84cc2',
  'league/commonmark' => '1.3.1@8015f806173c6ee54de25a87c2d69736696e88db',
  'league/flysystem' => '1.0.66@021569195e15f8209b1c4bebb78bd66aa4f08c21',
  'league/flysystem-aws-s3-v3' => '1.0.24@4382036bde5dc926f9b8b337e5bdb15e5ec7b570',
  'monolog/monolog' => '2.0.2@c861fcba2ca29404dc9e617eedd9eff4616986b8',
  'mtdowling/jmespath.php' => '2.5.0@52168cb9472de06979613d365c7f1ab8798be895',
  'nesbot/carbon' => '2.31.0@bbc0ab53f41a4c6f223c18efcdbd9bc725eb5d2d',
  'nikic/php-parser' => 'v4.3.0@9a9981c347c5c49d6dfe5cf826bb882b824080dc',
  'ocramius/package-versions' => '1.7.0@651c372efc914aea8223e049f85afaf65e09ba23',
  'opis/closure' => '3.5.1@93ebc5712cdad8d5f489b500c59d122df2e53969',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'php-http/client-common' => '2.1.0@a8b29678d61556f45d6236b1667db16d998ceec5',
  'php-http/discovery' => '1.7.4@82dbef649ccffd8e4f22e1953c3a5265992b83c0',
  'php-http/guzzle6-adapter' => 'v2.0.1@6074a4b1f4d5c21061b70bab3b8ad484282fe31f',
  'php-http/httplug' => '2.1.0@72d2b129a48f0490d55b7f89be0d6aa0597ffb06',
  'php-http/message' => '1.8.0@ce8f43ac1e294b54aabf5808515c3554a19c1e1c',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => 'v1.0.0@dc494cdc9d7160b9a09bd5573272195242ce7980',
  'phpoption/phpoption' => '1.7.2@77f7c4d2e65413aff5b5a8cc8b3caf7a28d81959',
  'predis/predis' => 'v1.1.1@f0210e38881631afeafb56ab43405a92cafd9fd1',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-client' => '1.0.0@496a823ef742b632934724bf769560c2a5c7c44e',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.2@446d54b4cb6bf489fc9d75f55843658e6f25d801',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.0@e361c8b7e5114534078e0ce04ddc442b39018a3c',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.3@7e1633a6964b48589b142d60542f9ed31bd37a92',
  'sentry/sdk' => '2.1.0@18921af9c2777517ef9fb480845c22a98554d6af',
  'sentry/sentry' => '2.3.2@b3e71feb32f1787b66a3b4fdb8686972e9c7ba94',
  'sentry/sentry-laravel' => '1.7.0@72684758f15aae4562149460b70fea81e9a06a25',
  'swiftmailer/swiftmailer' => 'v6.2.3@149cfdf118b169f7840bbe3ef0d4bc795d1780c9',
  'symfony/console' => 'v4.4.5@4fa15ae7be74e53f6ec8c83ed403b97e23b665e9',
  'symfony/css-selector' => 'v5.0.5@a0b51ba9938ccc206d9284de7eb527c2d4550b44',
  'symfony/debug' => 'v4.4.5@a980d87a659648980d89193fd8b7a7ca89d97d21',
  'symfony/error-handler' => 'v4.4.5@89aa4b9ac6f1f35171b8621b24f60477312085be',
  'symfony/event-dispatcher' => 'v4.4.5@4ad8e149799d3128621a3a1f70e92b9897a8930d',
  'symfony/event-dispatcher-contracts' => 'v1.1.7@c43ab685673fb6c8d84220c77897b1d6cdbe1d18',
  'symfony/finder' => 'v4.4.5@ea69c129aed9fdeca781d4b77eb20b62cf5d5357',
  'symfony/http-foundation' => 'v4.4.5@7e41b4fcad4619535f45f8bfa7744c4f384e1648',
  'symfony/http-kernel' => 'v4.4.5@8c8734486dada83a6041ab744709bdc1651a8462',
  'symfony/mime' => 'v5.0.5@9b3e5b5e58c56bbd76628c952d2b78556d305f3c',
  'symfony/options-resolver' => 'v5.0.5@b1ab86ce52b0c0abe031367a173005a025e30e04',
  'symfony/polyfill-ctype' => 'v1.14.0@fbdeaec0df06cf3d51c93de80c7eb76e271f5a38',
  'symfony/polyfill-iconv' => 'v1.14.0@926832ce51059bb58211b7b2080a88e0c3b5328e',
  'symfony/polyfill-intl-idn' => 'v1.14.0@6842f1a39cf7d580655688069a03dd7cd83d244a',
  'symfony/polyfill-mbstring' => 'v1.14.0@34094cfa9abe1f0f14f48f490772db7a775559f2',
  'symfony/polyfill-php72' => 'v1.14.0@46ecacf4751dd0dc81e4f6bf01dbf9da1dc1dadf',
  'symfony/polyfill-php73' => 'v1.14.0@5e66a0fa1070bf46bec4bea7962d285108edd675',
  'symfony/polyfill-uuid' => 'v1.14.0@80781e68dbd85373eb36a1b67608b1a731931000',
  'symfony/process' => 'v4.4.5@bf9166bac906c9e69fb7a11d94875e7ced97bcd7',
  'symfony/routing' => 'v4.4.5@4124d621d0e445732520037f888a0456951bde8c',
  'symfony/service-contracts' => 'v2.0.1@144c5e51266b281231e947b51223ba14acf1a749',
  'symfony/translation' => 'v4.4.5@0a19a77fba20818a969ef03fdaf1602de0546353',
  'symfony/translation-contracts' => 'v2.0.1@8cc682ac458d75557203b2f2f14b0b92e1c744ed',
  'symfony/var-dumper' => 'v4.4.5@2572839911702b0405479410ea7a1334bfab0b96',
  'tijsverkoyen/css-to-inline-styles' => '2.2.2@dda2ee426acd6d801d5b7fd1001cde9b5f790e15',
  'vlucas/phpdotenv' => 'v3.6.1@8f7961f7b9deb3b432452c18093cf16f88205902',
  'doctrine/instantiator' => '1.3.0@ae466f726242e637cebdd526a7d991b9433bacf1',
  'facade/flare-client-php' => '1.3.2@db1e03426e7f9472c9ecd1092aff00f56aa6c004',
  'facade/ignition' => '1.16.1@af05ac5ee8587395d7474ec0681c08776a2cb09d',
  'facade/ignition-contracts' => '1.0.0@f445db0fb86f48e205787b2592840dd9c80ded28',
  'filp/whoops' => '2.7.1@fff6f1e4f36be0e0d0b84d66b413d9dcb0c49130',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'hamcrest/hamcrest-php' => 'v2.0.0@776503d3a8e85d4f9a1148614f95b7a608b046ad',
  'mockery/mockery' => '1.3.1@f69bbde7d7a75d6b2862d9ca8fab1cd28014b4be',
  'myclabs/deep-copy' => '1.9.5@b2c28789e80a97badd14145fda39b545d83ca3ef',
  'nunomaduro/collision' => 'v3.0.1@af42d339fe2742295a54f6fdd42aaa6f8c4aca68',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.0.0@63a995caa1ca9e5590304cd845c15ad6d482a62a',
  'phpdocumentor/reflection-docblock' => '5.1.0@cd72d394ca794d3466a3b2fc09d5a6c1dc86b47e',
  'phpdocumentor/type-resolver' => '1.1.0@7462d5f123dfc080dfdf26897032a6513644fc95',
  'phpspec/prophecy' => 'v1.10.3@451c3cd1418cf640de218914901e51b064abb093',
  'phpunit/php-code-coverage' => '7.0.10@f1884187926fbb755a9aaf0b3836ad3165b478bf',
  'phpunit/php-file-iterator' => '2.0.2@050bedf145a257b1ff02746c31894800e5122946',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.2@1038454804406b0b5f5f520358e78c1c2f71501e',
  'phpunit/php-token-stream' => '3.1.1@995192df77f63a59e47f025390d2d1fdf8f425ff',
  'phpunit/phpunit' => '8.5.2@018b6ac3c8ab20916db85fa91bf6465acb64d1e0',
  'scrivo/highlight.php' => 'v9.18.1.1@52fc21c99fd888e33aed4879e55a3646f8d40558',
  'sebastian/code-unit-reverse-lookup' => '1.0.1@4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
  'sebastian/comparator' => '3.0.2@5de4fc177adf9bce8df98d8d141a7559d7ccf6da',
  'sebastian/diff' => '3.0.2@720fcc7e9b5cf384ea68d9d930d480907a0c1a29',
  'sebastian/environment' => '4.2.3@464c90d7bdf5ad4e8a6aea15c091fec0603d4368',
  'sebastian/exporter' => '3.1.2@68609e1261d215ea5b21b7987539cbfbe156ec3e',
  'sebastian/global-state' => '3.0.0@edf8a461cf1d4005f19fb0b6b8b95a9f7fa0adc4',
  'sebastian/object-enumerator' => '3.0.3@7cfd9e65d11ffb5af41198476395774d4c8a84c5',
  'sebastian/object-reflector' => '1.1.1@773f97c67f28de00d397be301821b06708fca0be',
  'sebastian/recursion-context' => '3.0.0@5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
  'sebastian/resource-operations' => '2.0.1@4d7a795d35b889bf80a0cc04e08d77cedfa917a9',
  'sebastian/type' => '1.1.3@3aaaa15fa71d27650d62a948be022fe3b48541a3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.1.3@11336f6f84e16a720dae9d8e6ed5019efa85a0f9',
  'webmozart/assert' => '1.7.0@aed98a490f9a8f78468232db345ab9cf606cf598',
  'laravel/laravel' => 'dev-master@12bde1fe85791cc2e4f3cb6d61971a839cc087c0',
);

    private function __construct()
    {
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
