<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '34b58645449f61907fc4be90a27a4e7edf013b9f',
    'name' => 'laravel/laravel',
  ),
  'versions' => 
  array (
    'appstract/laravel-options' => 
    array (
      'pretty_version' => '2.2.0',
      'version' => '2.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '22e034c1ad1d7b03000e554bb09813954d2ab188',
    ),
    'balping/json-raw-encoder' => 
    array (
      'pretty_version' => 'v1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e2b0ab888342b0716f1f0628e2fa13b345c5f276',
    ),
    'barryvdh/laravel-debugbar' => 
    array (
      'pretty_version' => 'v3.6.4',
      'version' => '3.6.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '3c2d678269ba60e178bcd93e36f6a91c36b727f1',
    ),
    'barryvdh/laravel-dompdf' => 
    array (
      'pretty_version' => 'v0.8.7',
      'version' => '0.8.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '30310e0a675462bf2aa9d448c8dcbf57fbcc517d',
    ),
    'bensampo/laravel-enum' => 
    array (
      'pretty_version' => 'v3.4.2',
      'version' => '3.4.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fba54d86b4865e63db3502c4e23bab192fb75314',
    ),
    'box/spout' => 
    array (
      'pretty_version' => 'v2.7.3',
      'version' => '2.7.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '3681a3421a868ab9a65da156c554f756541f452b',
    ),
    'brick/math' => 
    array (
      'pretty_version' => '0.9.3',
      'version' => '0.9.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ca57d18f028f84f777b2168cd1911b0dee2343ae',
    ),
    'chriskonnertz/string-calc' => 
    array (
      'pretty_version' => 'v1.0.12',
      'version' => '1.0.12.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bddc5aaea1c1c0a270e6c96f3719c48afa6cb7f0',
    ),
    'composer/package-versions-deprecated' => 
    array (
      'pretty_version' => '1.11.99.4',
      'version' => '1.11.99.4',
      'aliases' => 
      array (
      ),
      'reference' => 'b174585d1fe49ceed21928a945138948cb394600',
    ),
    'consoletvs/charts' => 
    array (
      'pretty_version' => '6.5.5',
      'version' => '6.5.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '0005d14e4fe6715f4146a4dc3b56add768233001',
    ),
    'cordoval/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'davedevelopment/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'dflydev/dot-access-data' => 
    array (
      'pretty_version' => 'v3.0.1',
      'version' => '3.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '0992cc19268b259a39e86f296da5f0677841f42c',
    ),
    'doctrine/cache' => 
    array (
      'pretty_version' => '2.1.1',
      'version' => '2.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '331b4d5dbaeab3827976273e9356b3b453c300ce',
    ),
    'doctrine/dbal' => 
    array (
      'pretty_version' => '3.1.3',
      'version' => '3.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '96b0053775a544b4a6ab47654dac0621be8b4cf8',
    ),
    'doctrine/deprecations' => 
    array (
      'pretty_version' => 'v0.5.3',
      'version' => '0.5.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '9504165960a1f83cc1480e2be1dd0a0478561314',
    ),
    'doctrine/event-manager' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '41370af6a30faa9dc0368c4a6814d596e81aba7f',
    ),
    'doctrine/inflector' => 
    array (
      'pretty_version' => '2.0.4',
      'version' => '2.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
    ),
    'doctrine/instantiator' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd56bf6102915de5702778fe20f2de3b2fe570b5b',
    ),
    'doctrine/lexer' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e864bbf5904cb8f5bb334f99209b48018522f042',
    ),
    'dompdf/dompdf' => 
    array (
      'pretty_version' => 'v0.8.6',
      'version' => '0.8.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'db91d81866c69a42dad1d2926f61515a1e3f42c5',
    ),
    'dragonmantank/cron-expression' => 
    array (
      'pretty_version' => 'v3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7a8c6e56ab3ffcc538d05e8155bb42269abf1a0c',
    ),
    'egulias/email-validator' => 
    array (
      'pretty_version' => '2.1.25',
      'version' => '2.1.25.0',
      'aliases' => 
      array (
      ),
      'reference' => '0dbf5d78455d4d6a41d186da50adc1122ec066f4',
    ),
    'ezyang/htmlpurifier' => 
    array (
      'pretty_version' => 'v4.13.0',
      'version' => '4.13.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '08e27c97e4c6ed02f37c5b2b20488046c8d90d75',
    ),
    'fideloper/proxy' => 
    array (
      'pretty_version' => '4.4.1',
      'version' => '4.4.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c073b2bd04d1c90e04dc1b787662b558dd65ade0',
    ),
    'filp/whoops' => 
    array (
      'pretty_version' => '2.14.4',
      'version' => '2.14.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f056f1fe935d9ed86e698905a957334029899895',
    ),
    'fzaninotto/faker' => 
    array (
      'pretty_version' => 'v1.9.2',
      'version' => '1.9.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
    ),
    'geo-sot/laravel-env-editor' => 
    array (
      'pretty_version' => 'v0.9.12',
      'version' => '0.9.12.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fc6f83787d86119bcdab016b2fdb8ebc57ebb1a5',
    ),
    'graham-campbell/result-type' => 
    array (
      'pretty_version' => 'v1.0.3',
      'version' => '1.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '296c015dc30ec4322168c5ad3ee5cc11dae827ac',
    ),
    'guzzlehttp/guzzle' => 
    array (
      'pretty_version' => '7.4.0',
      'version' => '7.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '868b3571a039f0ebc11ac8f344f4080babe2cb94',
    ),
    'guzzlehttp/promises' => 
    array (
      'pretty_version' => '1.5.1',
      'version' => '1.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fe752aedc9fd8fcca3fe7ad05d419d32998a06da',
    ),
    'guzzlehttp/psr7' => 
    array (
      'pretty_version' => '2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '089edd38f5b8abba6cb01567c2a8aaa47cec4c72',
    ),
    'hamcrest/hamcrest-php' => 
    array (
      'pretty_version' => 'v2.0.1',
      'version' => '2.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
    ),
    'hanneskod/classtools' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd365ddac0e602027c0471ea292f4ba2afcb49394',
    ),
    'illuminate/auth' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/broadcasting' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/bus' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/cache' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/collections' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/config' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/console' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/container' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/contracts' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/cookie' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/database' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/encryption' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/events' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/filesystem' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/hashing' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/http' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/log' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/macroable' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/mail' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/notifications' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/pagination' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/pipeline' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/queue' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/redis' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/routing' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/session' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/support' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/testing' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/translation' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/validation' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'illuminate/view' => 
    array (
      'replaced' => 
      array (
        0 => 'v8.70.2',
      ),
    ),
    'imliam/laravel-env-set-command' => 
    array (
      'pretty_version' => 'v1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be51ce036f8d5c935a5bb2d21768831a4efd0d17',
    ),
    'intervention/image' => 
    array (
      'pretty_version' => '2.7.0',
      'version' => '2.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9a8cc99d30415ec0b3f7649e1647d03a55698545',
    ),
    'ixudra/curl' => 
    array (
      'pretty_version' => '6.21.0',
      'version' => '6.21.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '796bd307ca35c66a3f6a47b559f8ccad9f06e93f',
    ),
    'jackiedo/dotenv-editor' => 
    array (
      'pretty_version' => '1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f93690a80915d51552931d9406d79b312da226b9',
    ),
    'jaybizzle/crawler-detect' => 
    array (
      'pretty_version' => 'v1.2.108',
      'version' => '1.2.108.0',
      'aliases' => 
      array (
      ),
      'reference' => '69a38c09f99ee056e7cca9fe7c8b1952fd62b837',
    ),
    'jenssegers/agent' => 
    array (
      'pretty_version' => 'v2.6.4',
      'version' => '2.6.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'daa11c43729510b3700bc34d414664966b03bffe',
    ),
    'joedixon/laravel-translation' => 
    array (
      'pretty_version' => 'v1.1.2',
      'version' => '1.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '4a467398bae73cd16522d523b557e96f3455b9d2',
    ),
    'kirschbaum-development/eloquent-power-joins' => 
    array (
      'pretty_version' => '2.5.0',
      'version' => '2.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '042a17abd5348303ac53ca72f689909b963b3e03',
    ),
    'kodova/hamcrest-php' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'laminas/laminas-code' => 
    array (
      'pretty_version' => '3.5.1',
      'version' => '3.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b549b70c0bb6e935d497f84f750c82653326ac77',
    ),
    'laminas/laminas-eventmanager' => 
    array (
      'pretty_version' => '3.4.0',
      'version' => '3.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a93fd278c97b2d41ebbce5ba048a24e3e6f580ba',
    ),
    'laminas/laminas-zendframework-bridge' => 
    array (
      'pretty_version' => '1.4.0',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bf180a382393e7db5c1e8d0f2ec0c4af9c724baf',
    ),
    'larapack/config-writer' => 
    array (
      'pretty_version' => 'v1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b36a716833240fe9e8b4b4d007b68ef9e91a1124',
    ),
    'laravel-lang/lang' => 
    array (
      'pretty_version' => '8.1.3',
      'version' => '8.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '54048d1319b211daa8ab73655b698feb09588876',
    ),
    'laravel/framework' => 
    array (
      'pretty_version' => 'v8.70.2',
      'version' => '8.70.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dec9524cd0f9fa35a6eb8e25d0b40f8bbc8ec225',
    ),
    'laravel/laravel' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '34b58645449f61907fc4be90a27a4e7edf013b9f',
    ),
    'laravel/legacy-factories' => 
    array (
      'pretty_version' => 'v1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '8091d6d64e0e6ea22fb3326ef0b21936d0a0217c',
    ),
    'laravel/sanctum' => 
    array (
      'pretty_version' => 'v2.12.1',
      'version' => '2.12.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e610647b04583ace6b30c8eb74cee0a866040420',
    ),
    'laravel/serializable-closure' => 
    array (
      'pretty_version' => 'v1.0.3',
      'version' => '1.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '6cfc678735f22ccedad761b8cae2bab14c3d8e5b',
    ),
    'laravel/telescope' => 
    array (
      'pretty_version' => 'v4.6.6',
      'version' => '4.6.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '8607c0f30b666104da47a6a81812397369c002b9',
    ),
    'laravel/tinker' => 
    array (
      'pretty_version' => 'v2.6.2',
      'version' => '2.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c808a7227f97ecfd9219fbf913bad842ea854ddc',
    ),
    'laravel/ui' => 
    array (
      'pretty_version' => 'v3.3.2',
      'version' => '3.3.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '28f3d190fe270b6dcd6fdab4a77a392e693ceca5',
    ),
    'laravelcollective/html' => 
    array (
      'pretty_version' => 'v6.2.1',
      'version' => '6.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ae15b9c4bf918ec3a78f092b8555551dd693fde3',
    ),
    'laravolt/avatar' => 
    array (
      'pretty_version' => '4.1.5',
      'version' => '4.1.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '9207253a1e76d6c8441325d6895b57f244aa3580',
    ),
    'league/commonmark' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '2df87709f44b0dd733df86aef0830dce9b1f0f13',
    ),
    'league/config' => 
    array (
      'pretty_version' => 'v1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a9d39eeeb6cc49d10a6e6c36f22c4c1f4a767f3e',
    ),
    'league/flysystem' => 
    array (
      'pretty_version' => '1.1.5',
      'version' => '1.1.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '18634df356bfd4119fe3d6156bdb990c414c14ea',
    ),
    'league/mime-type-detection' => 
    array (
      'pretty_version' => '1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b38b25d7b372e9fddb00335400467b223349fd7e',
    ),
    'livewire/livewire' => 
    array (
      'pretty_version' => 'v2.7.2',
      'version' => '2.7.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '991e5bd8a48e450d23cd55336964f916e92a6464',
    ),
    'maatwebsite/excel' => 
    array (
      'pretty_version' => '3.1.33',
      'version' => '3.1.33.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b2de5ba92c5c1ad9415f0eb7c72838fb3eaaa5b8',
    ),
    'maennchen/zipstream-php' => 
    array (
      'pretty_version' => '2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c4c5803cc1f93df3d2448478ef79394a5981cc58',
    ),
    'markbaker/complex' => 
    array (
      'pretty_version' => '3.0.1',
      'version' => '3.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ab8bc271e404909db09ff2d5ffa1e538085c0f22',
    ),
    'markbaker/matrix' => 
    array (
      'pretty_version' => '3.0.0',
      'version' => '3.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c66aefcafb4f6c269510e9ac46b82619a904c576',
    ),
    'maximebf/debugbar' => 
    array (
      'pretty_version' => 'v1.17.3',
      'version' => '1.17.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e8ac3499af0ea5b440908e06cc0abe5898008b3c',
    ),
    'mehradsadeghi/laravel-filter-querystring' => 
    array (
      'pretty_version' => 'v1.1.10',
      'version' => '1.1.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '0acbca160bb64e5c2d1409d8b723e0827e26af27',
    ),
    'mobiledetect/mobiledetectlib' => 
    array (
      'pretty_version' => '2.8.37',
      'version' => '2.8.37.0',
      'aliases' => 
      array (
      ),
      'reference' => '9841e3c46f5bd0739b53aed8ac677fa712943df7',
    ),
    'mockery/mockery' => 
    array (
      'pretty_version' => '1.4.4',
      'version' => '1.4.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e01123a0e847d52d186c5eb4b9bf58b0c6d00346',
    ),
    'monolog/monolog' => 
    array (
      'pretty_version' => '2.3.5',
      'version' => '2.3.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fd4380d6fc37626e2f799f29d91195040137eba9',
    ),
    'mtdowling/cron-expression' => 
    array (
      'replaced' => 
      array (
        0 => '^1.0',
      ),
    ),
    'myclabs/deep-copy' => 
    array (
      'pretty_version' => '1.10.2',
      'version' => '1.10.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '776f831124e9c62e1a2c601ecc52e776d8bb7220',
      'replaced' => 
      array (
        0 => '1.10.2',
      ),
    ),
    'myclabs/php-enum' => 
    array (
      'pretty_version' => '1.8.3',
      'version' => '1.8.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b942d263c641ddb5190929ff840c68f78713e937',
    ),
    'nesbot/carbon' => 
    array (
      'pretty_version' => '2.54.0',
      'version' => '2.54.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'eed83939f1aed3eee517d03a33f5ec587ac529b5',
    ),
    'nette/schema' => 
    array (
      'pretty_version' => 'v1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '9a39cef03a5b34c7de64f551538cbba05c2be5df',
    ),
    'nette/utils' => 
    array (
      'pretty_version' => 'v3.2.5',
      'version' => '3.2.5.0',
      'aliases' => 
      array (
      ),
      'reference' => '9cd80396ca58d7969ab44fc7afcf03624dfa526e',
    ),
    'nikic/php-parser' => 
    array (
      'pretty_version' => 'v4.13.1',
      'version' => '4.13.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '63a79e8daa781cac14e5195e63ed8ae231dd10fd',
    ),
    'nwidart/laravel-modules' => 
    array (
      'pretty_version' => '5.1.0',
      'version' => '5.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd4edc3465d471644ca44b1b303803492609957cd',
    ),
    'ocramius/package-versions' => 
    array (
      'replaced' => 
      array (
        0 => '1.11.99',
      ),
    ),
    'opis/closure' => 
    array (
      'pretty_version' => '3.6.2',
      'version' => '3.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '06e2ebd25f2869e54a306dda991f7db58066f7f6',
    ),
    'phar-io/manifest' => 
    array (
      'pretty_version' => '2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '97803eca37d319dfa7826cc2437fc020857acb53',
    ),
    'phar-io/version' => 
    array (
      'pretty_version' => '3.1.0',
      'version' => '3.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'bae7c545bef187884426f042434e561ab1ddb182',
    ),
    'phenx/php-font-lib' => 
    array (
      'pretty_version' => '0.5.2',
      'version' => '0.5.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ca6ad461f032145fff5971b5985e5af9e7fa88d8',
    ),
    'phenx/php-svg-lib' => 
    array (
      'pretty_version' => '0.3.4',
      'version' => '0.3.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f627771eb854aa7f45f80add0f23c6c4d67ea0f2',
    ),
    'phpdocumentor/reflection-common' => 
    array (
      'pretty_version' => '2.2.0',
      'version' => '2.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1d01c49d4ed62f25aa84a747ad35d5a16924662b',
    ),
    'phpdocumentor/reflection-docblock' => 
    array (
      'pretty_version' => '5.3.0',
      'version' => '5.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '622548b623e81ca6d78b721c5e029f4ce664f170',
    ),
    'phpdocumentor/type-resolver' => 
    array (
      'pretty_version' => '1.5.1',
      'version' => '1.5.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a12f7e301eb7258bb68acd89d4aefa05c2906cae',
    ),
    'phpoffice/phpspreadsheet' => 
    array (
      'pretty_version' => '1.19.0',
      'version' => '1.19.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a9ab55bfae02eecffb3df669a2e19ba0e2f04bbf',
    ),
    'phpoption/phpoption' => 
    array (
      'pretty_version' => '1.8.0',
      'version' => '1.8.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5455cb38aed4523f99977c4a12ef19da4bfe2a28',
    ),
    'phpspec/prophecy' => 
    array (
      'pretty_version' => '1.14.0',
      'version' => '1.14.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd86dfc2e2a3cd366cee475e52c6bb3bbc371aa0e',
    ),
    'phpunit/php-code-coverage' => 
    array (
      'pretty_version' => '9.2.8',
      'version' => '9.2.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cf04e88a2e3c56fc1a65488afd493325b4c1bc3e',
    ),
    'phpunit/php-file-iterator' => 
    array (
      'pretty_version' => '3.0.5',
      'version' => '3.0.5.0',
      'aliases' => 
      array (
      ),
      'reference' => 'aa4be8575f26070b100fccb67faabb28f21f66f8',
    ),
    'phpunit/php-invoker' => 
    array (
      'pretty_version' => '3.1.1',
      'version' => '3.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5a10147d0aaf65b58940a0b72f71c9ac0423cc67',
    ),
    'phpunit/php-text-template' => 
    array (
      'pretty_version' => '2.0.4',
      'version' => '2.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '5da5f67fc95621df9ff4c4e5a84d6a8a2acf7c28',
    ),
    'phpunit/php-timer' => 
    array (
      'pretty_version' => '5.0.3',
      'version' => '5.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '5a63ce20ed1b5bf577850e2c4e87f4aa902afbd2',
    ),
    'phpunit/phpunit' => 
    array (
      'pretty_version' => '9.5.10',
      'version' => '9.5.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c814a05837f2edb0d1471d6e3f4ab3501ca3899a',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.1.2',
      'version' => '1.1.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '513e0666f7216c7459170d56df27dfcefe1689ea',
    ),
    'psr/container-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/event-dispatcher' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dbefd12671e8a14ec7f180cab83036ed26714bb0',
    ),
    'psr/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-client' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
    ),
    'psr/http-client-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-factory' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
    ),
    'psr/http-factory-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/http-message' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6561bf28d520154e4b0ec72be95418abe6d9363',
    ),
    'psr/http-message-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.4',
      'version' => '1.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0.0 || 2.0.0 || 3.0.0',
        1 => '1.0|2.0',
      ),
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
    ),
    'psr/simple-cache-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psy/psysh' => 
    array (
      'pretty_version' => 'v0.10.9',
      'version' => '0.10.9.0',
      'aliases' => 
      array (
      ),
      'reference' => '01281336c4ae557fe4a994544f30d3a1bc204375',
    ),
    'ralouphie/getallheaders' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '120b605dfeb996808c31b6477290a714d356e822',
    ),
    'ramsey/collection' => 
    array (
      'pretty_version' => '1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cccc74ee5e328031b15640b51056ee8d3bb66c0a',
    ),
    'ramsey/uuid' => 
    array (
      'pretty_version' => '4.2.3',
      'version' => '4.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fc9bb7fb5388691fd7373cd44dcb4d63bbcf24df',
    ),
    'rap2hpoutre/fast-excel' => 
    array (
      'pretty_version' => 'v2.5.0',
      'version' => '2.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c8032e9146765e01a025f7f98d38b13f32f63e32',
    ),
    'rhumsaa/uuid' => 
    array (
      'replaced' => 
      array (
        0 => '4.2.3',
      ),
    ),
    'sabberworm/php-css-parser' => 
    array (
      'pretty_version' => '8.3.1',
      'version' => '8.3.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd217848e1396ef962fb1997cf3e2421acba7f796',
    ),
    'sebastian/cli-parser' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '442e7c7e687e42adc03470c7b668bc4b2402c0b2',
    ),
    'sebastian/code-unit' => 
    array (
      'pretty_version' => '1.0.8',
      'version' => '1.0.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '1fc9f64c0927627ef78ba436c9b17d967e68e120',
    ),
    'sebastian/code-unit-reverse-lookup' => 
    array (
      'pretty_version' => '2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ac91f01ccec49fb77bdc6fd1e548bc70f7faa3e5',
    ),
    'sebastian/comparator' => 
    array (
      'pretty_version' => '4.0.6',
      'version' => '4.0.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '55f4261989e546dc112258c7a75935a81a7ce382',
    ),
    'sebastian/complexity' => 
    array (
      'pretty_version' => '2.0.2',
      'version' => '2.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '739b35e53379900cc9ac327b2147867b8b6efd88',
    ),
    'sebastian/diff' => 
    array (
      'pretty_version' => '4.0.4',
      'version' => '4.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '3461e3fccc7cfdfc2720be910d3bd73c69be590d',
    ),
    'sebastian/environment' => 
    array (
      'pretty_version' => '5.1.3',
      'version' => '5.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '388b6ced16caa751030f6a69e588299fa09200ac',
    ),
    'sebastian/exporter' => 
    array (
      'pretty_version' => '4.0.4',
      'version' => '4.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '65e8b7db476c5dd267e65eea9cab77584d3cfff9',
    ),
    'sebastian/global-state' => 
    array (
      'pretty_version' => '5.0.3',
      'version' => '5.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '23bd5951f7ff26f12d4e3242864df3e08dec4e49',
    ),
    'sebastian/lines-of-code' => 
    array (
      'pretty_version' => '1.0.3',
      'version' => '1.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c1c2e997aa3146983ed888ad08b15470a2e22ecc',
    ),
    'sebastian/object-enumerator' => 
    array (
      'pretty_version' => '4.0.4',
      'version' => '4.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '5c9eeac41b290a3712d88851518825ad78f45c71',
    ),
    'sebastian/object-reflector' => 
    array (
      'pretty_version' => '2.0.4',
      'version' => '2.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b4f479ebdbf63ac605d183ece17d8d7fe49c15c7',
    ),
    'sebastian/recursion-context' => 
    array (
      'pretty_version' => '4.0.4',
      'version' => '4.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'cd9d8cf3c5804de4341c283ed787f099f5506172',
    ),
    'sebastian/resource-operations' => 
    array (
      'pretty_version' => '3.0.3',
      'version' => '3.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0f4443cb3a1d92ce809899753bc0d5d5a8dd19a8',
    ),
    'sebastian/type' => 
    array (
      'pretty_version' => '2.3.4',
      'version' => '2.3.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b8cd8a1c753c90bc1a0f5372170e3e489136f914',
    ),
    'sebastian/version' => 
    array (
      'pretty_version' => '3.0.2',
      'version' => '3.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6c1022351a901512170118436c764e473f6de8c',
    ),
    'swiftmailer/swiftmailer' => 
    array (
      'pretty_version' => 'v6.3.0',
      'version' => '6.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8a5d5072dca8f48460fce2f4131fcc495eec654c',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd4e409d9fbcfbf71af0e5a940abb7b0b4bad0bd3',
    ),
    'symfony/css-selector' => 
    array (
      'pretty_version' => 'v5.3.4',
      'version' => '5.3.4.0',
      'aliases' => 
      array (
      ),
      'reference' => '7fb120adc7f600a59027775b224c13a33530dd90',
    ),
    'symfony/debug' => 
    array (
      'pretty_version' => 'v4.4.31',
      'version' => '4.4.31.0',
      'aliases' => 
      array (
      ),
      'reference' => '43ede438d4cb52cd589ae5dc070e9323866ba8e0',
    ),
    'symfony/deprecation-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '5f38c8804a9e97d23e0c8d63341088cd8a22d627',
    ),
    'symfony/error-handler' => 
    array (
      'pretty_version' => 'v5.3.7',
      'version' => '5.3.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '3bc60d0fba00ae8d1eaa9eb5ab11a2bbdd1fc321',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v5.3.7',
      'version' => '5.3.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ce7b20d69c66a20939d8952b617506a44d102130',
    ),
    'symfony/event-dispatcher-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '69fee1ad2332a7cbab3aca13591953da9cdb7a11',
    ),
    'symfony/event-dispatcher-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.0',
      ),
    ),
    'symfony/finder' => 
    array (
      'pretty_version' => 'v5.3.7',
      'version' => '5.3.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a10000ada1e600d109a6c7632e9ac42e8bf2fb93',
    ),
    'symfony/http-client-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7e82f6084d7cae521a75ef2cb5c9457bbda785f4',
    ),
    'symfony/http-foundation' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '9f34f02e8a5fdc7a56bafe011cea1ce97300e54c',
    ),
    'symfony/http-kernel' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '703e4079920468e9522b72cf47fd76ce8d795e86',
    ),
    'symfony/mime' => 
    array (
      'pretty_version' => 'v5.3.8',
      'version' => '5.3.8.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a756033d0a7e53db389618653ae991eba5a19a11',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '46cd95797e9df938fdd2b03693b5fca5e64b01ce',
    ),
    'symfony/polyfill-iconv' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '63b5bb7db83e5673936d6e3b8b3e022ff6474933',
    ),
    'symfony/polyfill-intl-grapheme' => 
    array (
      'pretty_version' => 'v1.23.1',
      'version' => '1.23.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '16880ba9c5ebe3642d1995ab866db29270b36535',
    ),
    'symfony/polyfill-intl-idn' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '65bd267525e82759e7d8c4e8ceea44f398838e65',
    ),
    'symfony/polyfill-intl-normalizer' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '8590a5f561694770bdcd3f9b5c69dde6945028e8',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.23.1',
      'version' => '1.23.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '9174a3d80210dca8daa7f31fec659150bbeabfc6',
    ),
    'symfony/polyfill-php72' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '9a142215a36a3888e30d0a9eeea9766764e96976',
    ),
    'symfony/polyfill-php73' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'fba8933c384d6476ab14fb7b8526e5287ca7e010',
    ),
    'symfony/polyfill-php80' => 
    array (
      'pretty_version' => 'v1.23.1',
      'version' => '1.23.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '1100343ed1a92e3a38f9ae122fc0eb21602547be',
    ),
    'symfony/polyfill-php81' => 
    array (
      'pretty_version' => 'v1.23.0',
      'version' => '1.23.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'e66119f3de95efc359483f810c4c3e6436279436',
    ),
    'symfony/process' => 
    array (
      'pretty_version' => 'v5.3.7',
      'version' => '5.3.7.0',
      'aliases' => 
      array (
      ),
      'reference' => '38f26c7d6ed535217ea393e05634cb0b244a1967',
    ),
    'symfony/routing' => 
    array (
      'pretty_version' => 'v5.3.7',
      'version' => '5.3.7.0',
      'aliases' => 
      array (
      ),
      'reference' => 'be865017746fe869007d94220ad3f5297951811b',
    ),
    'symfony/service-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f040a30e04b57fbcc9c6cbcf4dbaa96bd318b9bb',
    ),
    'symfony/string' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd70c35bb20bbca71fc4ab7921e3c6bda1a82a60c',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '6ef197aea2ac8b9cd63e0da7522b3771714035aa',
    ),
    'symfony/translation-contracts' => 
    array (
      'pretty_version' => 'v2.4.0',
      'version' => '2.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '95c812666f3e91db75385749fe219c5e494c7f95',
    ),
    'symfony/translation-implementation' => 
    array (
      'provided' => 
      array (
        0 => '2.3',
      ),
    ),
    'symfony/var-dumper' => 
    array (
      'pretty_version' => 'v5.3.10',
      'version' => '5.3.10.0',
      'aliases' => 
      array (
      ),
      'reference' => '875432adb5f5570fff21036fd22aee244636b7d1',
    ),
    'thedevsaddam/laravel-schema' => 
    array (
      'pretty_version' => '2.0.3',
      'version' => '2.0.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ce787b3b5d6f558cd5fb615f373beabb1939e724',
    ),
    'theseer/tokenizer' => 
    array (
      'pretty_version' => '1.2.1',
      'version' => '1.2.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '34a41e998c2183e22995f158c581e7b5e755ab9e',
    ),
    'tijsverkoyen/css-to-inline-styles' => 
    array (
      'pretty_version' => '2.2.3',
      'version' => '2.2.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b43b05cf43c1b6d849478965062b6ef73e223bb5',
    ),
    'vkovic/laravel-custom-casts' => 
    array (
      'pretty_version' => 'v1.4',
      'version' => '1.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '1b0292ff4c93bc4938e22edeb6334988d491eddd',
    ),
    'vlucas/phpdotenv' => 
    array (
      'pretty_version' => 'v5.4.0',
      'version' => '5.4.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd4394d044ed69a8f244f3445bcedf8a0d7fe2403',
    ),
    'voku/portable-ascii' => 
    array (
      'pretty_version' => '1.5.6',
      'version' => '1.5.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '80953678b19901e5165c56752d087fc11526017c',
    ),
    'webmozart/assert' => 
    array (
      'pretty_version' => '1.10.0',
      'version' => '1.10.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '6964c76c7804814a842473e0c8fd15bab0f18e25',
    ),
    'wildside/userstamps' => 
    array (
      'pretty_version' => '2.1.0',
      'version' => '2.1.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '98c38d2f487e5168ef559cb29ed6cc63fbe70a18',
    ),
    'yajra/laravel-datatables-oracle' => 
    array (
      'pretty_version' => 'v9.18.2',
      'version' => '9.18.2.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f4eebc1dc2b067058dfb91e7c067de862353c40f',
    ),
    'zendframework/zend-code' => 
    array (
      'replaced' => 
      array (
        0 => '^3.4.1',
      ),
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {
foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
