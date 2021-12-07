<?php return array (
  'app' => 
  array (
    'name' => 'alfa',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://alfa.local',
    'asset_url' => 'https://alfa.local/public',
    'timezone' => 'Asia/Jakarta',
    'locale' => 'en',
    'faker_locale' => 'id_ID',
    'fallback_locale' => 'en',
    'key' => 'base64:RZo77laPM25Qdaudzbv6P+FU9APcqOR7qscEYSjtMx0=',
    'cipher' => 'AES-256-CBC',
    'log' => 'single',
    'log_level' => 'debug',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\BroadcastServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'App\\Providers\\TelescopeServiceProvider',
      28 => 'Thedevsaddam\\LaravelSchema\\LaravelSchemaServiceProvider',
      29 => 'Jackiedo\\DotenvEditor\\DotenvEditorServiceProvider',
      30 => 'Modules\\System\\Providers\\CacheableAuthUserServiceProvider',
      31 => 'Intervention\\Image\\ImageServiceProvider',
      32 => 'Barryvdh\\DomPDF\\ServiceProvider',
      33 => 'Alkhachatryan\\LaravelWebConsole\\LaravelWebConsoleServiceProvider',
      34 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      35 => 'Laravolt\\Avatar\\ServiceProvider',
      36 => 'Ixudra\\Curl\\CurlServiceProvider',
      37 => 'GeoSot\\EnvEditor\\ServiceProvider',
      38 => 'Kirschbaum\\PowerJoins\\PowerJoinsServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Larapack\\ConfigWriter\\Facade',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Modules\\System\\Plugins\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Str' => 'Illuminate\\Support\\Str',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'Datatables' => 'Yajra\\Datatables\\Facades\\Datatables',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Helper' => 'Modules\\System\\Plugins\\Helper',
      'Views' => 'Modules\\System\\Plugins\\Views',
      'Notes' => 'Modules\\System\\Plugins\\Notes',
      'Alert' => 'Modules\\System\\Plugins\\Alert',
      'Cards' => 'Modules\\System\\Plugins\\Cards',
      'Chrome' => 'Chrome',
      'LinenStatus' => 'Modules\\Linen\\Dao\\Enums\\LinenStatus',
      'TransactionStatus' => 'Modules\\Linen\\Dao\\Enums\\TransactionStatus',
      'PdfFacade' => 'Barryvdh\\DomPDF\\PdfFacade',
      'DotenvEditor' => 'Jackiedo\\DotenvEditor\\Facades\\DotenvEditor',
      'Curl' => 'Ixudra\\Curl\\Facades\\Curl',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Avatar' => 'Laravolt\\Avatar\\Facade',
      'Client' => 'Webklex\\IMAP\\Facades\\Client',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'EnvEditor' => 'GeoSot\\EnvEditor\\Facades\\EnvEditor',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'cacheableEloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'avatar' => 
  array (
    'driver' => 'gd',
    'generator' => 'Laravolt\\Avatar\\Generator\\DefaultGenerator',
    'ascii' => false,
    'shape' => 'circle',
    'width' => 100,
    'height' => 100,
    'chars' => 2,
    'fontSize' => 48,
    'uppercase' => false,
    'fonts' => 
    array (
      0 => 'F:\\laragon\\www\\alfa\\config/../fonts/OpenSans-Bold.ttf',
      1 => 'F:\\laragon\\www\\alfa\\config/../fonts/rockwell.ttf',
    ),
    'foregrounds' => 
    array (
      0 => '#FFFFFF',
    ),
    'backgrounds' => 
    array (
      0 => '#f44336',
      1 => '#E91E63',
      2 => '#9C27B0',
      3 => '#673AB7',
      4 => '#3F51B5',
      5 => '#2196F3',
      6 => '#03A9F4',
      7 => '#00BCD4',
      8 => '#009688',
      9 => '#4CAF50',
      10 => '#8BC34A',
      11 => '#CDDC39',
      12 => '#FFC107',
      13 => '#FF9800',
      14 => '#FF5722',
    ),
    'border' => 
    array (
      'size' => 1,
      'color' => 'background',
      'radius' => 0,
    ),
    'theme' => 
    array (
      0 => 'colorful',
    ),
    'themes' => 
    array (
      'grayscale-light' => 
      array (
        'backgrounds' => 
        array (
          0 => '#edf2f7',
          1 => '#e2e8f0',
          2 => '#cbd5e0',
        ),
        'foregrounds' => 
        array (
          0 => '#a0aec0',
        ),
      ),
      'grayscale-dark' => 
      array (
        'backgrounds' => 
        array (
          0 => '#2d3748',
          1 => '#4a5568',
          2 => '#718096',
        ),
        'foregrounds' => 
        array (
          0 => '#e2e8f0',
        ),
      ),
      'colorful' => 
      array (
        'backgrounds' => 
        array (
          0 => '#f44336',
          1 => '#E91E63',
          2 => '#9C27B0',
          3 => '#673AB7',
          4 => '#3F51B5',
          5 => '#2196F3',
          6 => '#03A9F4',
          7 => '#00BCD4',
          8 => '#009688',
          9 => '#4CAF50',
          10 => '#8BC34A',
          11 => '#CDDC39',
          12 => '#FFC107',
          13 => '#FF9800',
          14 => '#FF5722',
        ),
        'foregrounds' => 
        array (
          0 => '#FFFFFF',
        ),
      ),
      'pastel' => 
      array (
        'backgrounds' => 
        array (
          0 => '#ef9a9a',
          1 => '#F48FB1',
          2 => '#CE93D8',
          3 => '#B39DDB',
          4 => '#9FA8DA',
          5 => '#90CAF9',
          6 => '#81D4FA',
          7 => '#80DEEA',
          8 => '#80CBC4',
          9 => '#A5D6A7',
          10 => '#E6EE9C',
          11 => '#FFAB91',
          12 => '#FFCCBC',
          13 => '#D7CCC8',
        ),
        'foregrounds' => 
        array (
          0 => '#FFF',
        ),
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => '',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'F:\\laragon\\www\\alfa\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'alfa_cache',
  ),
  'captcha' => 
  array (
    'secret' => NULL,
    'sitekey' => NULL,
    'options' => 
    array (
      'timeout' => 30,
    ),
  ),
  'charts' => 
  array (
    'default_library' => 'Chartjs',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'F:\\laragon\\www\\alfa\\database\\database.sqlite',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'alfa',
        'username' => 'root',
        'password' => 'mysql',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
          20 => true,
        ),
      ),
      'server' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'adin',
        'username' => 'root',
        'password' => 'mysql',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => false,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'alfa',
        'username' => 'root',
        'password' => 'mysql',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'alfa',
        'username' => 'root',
        'password' => 'mysql',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => '',
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_Row_Index',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
        1 => 'checkbox',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => false,
    'except' => 
    array (
      0 => 'telescope*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'F:\\laragon\\www\\alfa\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => true,
      'default_request' => false,
      'logs' => false,
      'files' => true,
      'config' => true,
      'cache' => true,
      'models' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'deploy' => 
  array (
    'default' => 'basic',
    'strategies' => 
    array (
    ),
    'hooks' => 
    array (
      'start' => 
      array (
      ),
      'build' => 
      array (
      ),
      'ready' => 
      array (
        0 => 'artisan:storage:link',
        1 => 'artisan:view:clear',
        2 => 'artisan:cache:clear',
        3 => 'artisan:config:cache',
        4 => 'artisan:horizon:terminate',
      ),
      'done' => 
      array (
      ),
      'success' => 
      array (
      ),
      'fail' => 
      array (
      ),
      'rollback' => 
      array (
      ),
    ),
    'options' => 
    array (
      'application' => 'alfa',
      'repository' => 'yes',
    ),
    'hosts' => 
    array (
      'itoktoni.com' => 
      array (
        'deploy_path' => '/public_html/apps/system',
        'user' => 'root',
      ),
    ),
    'localhost' => 
    array (
    ),
    'include' => 
    array (
    ),
    'custom_deployer_file' => false,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'F:\\laragon\\www\\alfa\\storage\\fonts/',
      'font_cache' => 'F:\\laragon\\www\\alfa\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\itoktoni\\AppData\\Local\\Temp',
      'chroot' => 'F:\\laragon\\www\\alfa',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'dotenv-editor' => 
  array (
    'autoBackup' => true,
    'backupPath' => 'F:\\laragon\\www\\alfa\\storage/dotenv-editor/backups/',
    'alwaysCreateBackupFolder' => false,
  ),
  'env-editor' => 
  array (
    'paths' => 
    array (
      'env' => 'F:\\laragon\\www\\alfa',
      'backupDirectory' => 'env-editor',
    ),
    'envFileName' => '.env',
    'route' => 
    array (
      'prefix' => 'setting',
      'name' => 'setting',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
      ),
    ),
    'timeFormat' => 'd/m/Y H:i:s',
    'layout' => 'env-editor::layout',
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\itoktoni\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
    ),
  ),
  'ext' => 
  array (
    'blade' => 'php_laravel_blade',
    'php' => 'php',
    'json' => 'json',
    'html' => 'html',
    'css' => 'css',
    'env' => 'gear',
    'xml' => 'code',
    'js' => 'javascript',
    'txt' => 'txt',
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\storage\\app',
      ),
      'system' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa',
      ),
      'model' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\app',
      ),
      'view' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\resources',
      ),
      'controller' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\app\\Http/Controllers/',
      ),
      'modules' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\Modules/',
      ),
      'middleware' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\app\\Http/Middleware/',
      ),
      'config' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\config',
      ),
      'database' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\database',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'F:\\laragon\\www\\alfa\\public\\files',
        'url' => 'http://DESKTOP-8RRD29D./public/files/',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
      'cloudinary' => 
      array (
        'driver' => 'cloudinary',
        'api_key' => '',
        'api_secret' => '',
        'cloud_name' => '',
      ),
      'ftp' => 
      array (
        'driver' => 'ftp',
        'host' => '',
        'username' => '',
        'password' => '',
        'port' => 21,
        'passive' => true,
      ),
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'laravelwebconsole' => 
  array (
    'no_login' => false,
    'user' => 
    array (
      'name' => '',
      'password' => '',
    ),
    'accounts' => 
    array (
    ),
    'password_hash_algorithm' => '',
    'home_dir' => '',
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => 'F:\\laragon\\www\\alfa\\resources\\views/livewire',
    'layout' => 'frontend.tokomuh.layouts',
    'asset_url' => NULL,
    'app_url' => NULL,
    'middleware_group' => 'web',
    'temporary_file_upload' => 
    array (
      'disk' => NULL,
      'rules' => NULL,
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpg',
        12 => 'jpeg',
        13 => 'mpga',
        14 => 'webp',
        15 => 'wma',
      ),
      'max_upload_time' => 5,
    ),
    'manifest_path' => NULL,
    'back_button_cache' => false,
    'render_on_redirect' => false,
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'F:\\laragon\\www\\alfa\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'F:\\laragon\\www\\alfa\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'F:\\laragon\\www\\alfa\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => '',
    'port' => '465',
    'from' => 
    array (
      'address' => '',
      'name' => 'alfa',
    ),
    'encryption' => 'tls',
    'username' => '',
    'password' => '',
    'sendmail' => '/usr/sbin/sendmail -t',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'F:\\laragon\\www\\alfa\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'mailpreview' => 
  array (
    'path' => 'F:\\laragon\\www\\alfa\\storage\\email-previews',
    'maximum_lifetime' => 60,
    'show_link_to_preview' => true,
    'popup_timeout' => 8000,
    'middleware_groups' => 
    array (
      0 => 'web',
    ),
    'middleware' => 
    array (
      0 => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'modules' => 
  array (
    'namespace' => 'Modules',
    'stubs' => 
    array (
      'enabled' => false,
      'path' => 'F:\\laragon\\www\\alfa/vendor/nwidart/laravel-modules/src/Commands/stubs',
      'files' => 
      array (
        'routes/web' => 'Routes/web.php',
        'routes/api' => 'Routes/api.php',
        'views/index' => 'Resources/views/index.blade.php',
        'views/master' => 'Resources/views/layouts/master.blade.php',
        'scaffold/config' => 'Config/config.php',
        'composer' => 'composer.json',
        'assets/js/app' => 'Resources/assets/js/app.js',
        'assets/sass/app' => 'Resources/assets/sass/app.scss',
        'webpack' => 'webpack.mix.js',
        'package' => 'package.json',
      ),
      'replacements' => 
      array (
        'routes/web' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'routes/api' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'webpack' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'json' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'MODULE_NAMESPACE',
        ),
        'views/index' => 
        array (
          0 => 'LOWER_NAME',
        ),
        'views/master' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
        ),
        'scaffold/config' => 
        array (
          0 => 'STUDLY_NAME',
        ),
        'composer' => 
        array (
          0 => 'LOWER_NAME',
          1 => 'STUDLY_NAME',
          2 => 'VENDOR',
          3 => 'AUTHOR_NAME',
          4 => 'AUTHOR_EMAIL',
          5 => 'MODULE_NAMESPACE',
        ),
      ),
      'gitkeep' => true,
    ),
    'paths' => 
    array (
      'modules' => 'F:\\laragon\\www\\alfa\\Modules',
      'assets' => 'F:\\laragon\\www\\alfa\\public\\modules',
      'migration' => 'F:\\laragon\\www\\alfa\\database/migrations',
      'generator' => 
      array (
        'config' => 
        array (
          'path' => 'Config',
          'generate' => true,
        ),
        'command' => 
        array (
          'path' => 'Console',
          'generate' => true,
        ),
        'migration' => 
        array (
          'path' => 'Database/Migrations',
          'generate' => true,
        ),
        'seeder' => 
        array (
          'path' => 'Database/Seeders',
          'generate' => true,
        ),
        'factory' => 
        array (
          'path' => 'Database/factories',
          'generate' => true,
        ),
        'model' => 
        array (
          'path' => 'Entities',
          'generate' => true,
        ),
        'controller' => 
        array (
          'path' => 'Http/Controllers',
          'generate' => true,
        ),
        'filter' => 
        array (
          'path' => 'Http/Middleware',
          'generate' => true,
        ),
        'request' => 
        array (
          'path' => 'Http/Requests',
          'generate' => true,
        ),
        'provider' => 
        array (
          'path' => 'Providers',
          'generate' => true,
        ),
        'assets' => 
        array (
          'path' => 'Resources/assets',
          'generate' => true,
        ),
        'lang' => 
        array (
          'path' => 'Resources/lang',
          'generate' => true,
        ),
        'views' => 
        array (
          'path' => 'Resources/views',
          'generate' => true,
        ),
        'test' => 
        array (
          'path' => 'Tests/Unit',
          'generate' => true,
        ),
        'test-feature' => 
        array (
          'path' => 'Tests/Feature',
          'generate' => true,
        ),
        'repository' => 
        array (
          'path' => 'Repositories',
          'generate' => false,
        ),
        'event' => 
        array (
          'path' => 'Events',
          'generate' => false,
        ),
        'listener' => 
        array (
          'path' => 'Listeners',
          'generate' => false,
        ),
        'policies' => 
        array (
          'path' => 'Policies',
          'generate' => false,
        ),
        'rules' => 
        array (
          'path' => 'Rules',
          'generate' => false,
        ),
        'jobs' => 
        array (
          'path' => 'Jobs',
          'generate' => false,
        ),
        'emails' => 
        array (
          'path' => 'Emails',
          'generate' => false,
        ),
        'notifications' => 
        array (
          'path' => 'Notifications',
          'generate' => false,
        ),
        'resource' => 
        array (
          'path' => 'Transformers',
          'generate' => false,
        ),
      ),
    ),
    'scan' => 
    array (
      'enabled' => false,
      'paths' => 
      array (
        0 => 'F:\\laragon\\www\\alfa\\vendor/*/*',
      ),
    ),
    'composer' => 
    array (
      'vendor' => 'nwidart',
      'author' => 
      array (
        'name' => 'Nicolas Widart',
        'email' => 'n.widart@gmail.com',
      ),
    ),
    'cache' => 
    array (
      'enabled' => false,
      'key' => 'laravel-modules',
      'lifetime' => 60,
    ),
    'register' => 
    array (
      'translations' => true,
      'files' => 'register',
    ),
  ),
  'phpsettings' => 1,
  'pretty-routes' => 
  array (
    'url' => 'routes',
    'middlewares' => 
    array (
    ),
    'debug_only' => true,
    'hide_methods' => 
    array (
      0 => 'HEAD',
    ),
    'hide_matching' => 
    array (
      0 => '#^_debugbar#',
      1 => '#^routes$#',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'recaptcha' => 
  array (
    'secret_key' => NULL,
    'site_key' => NULL,
    'is_active' => true,
    'score' => 0.5,
    'options' => 
    array (
      'timeout' => 5.0,
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => '127.0.0.1',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'F:\\laragon\\www\\alfa\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'alfa_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'telescope' => 
  array (
    'domain' => NULL,
    'path' => 'telescope',
    'driver' => 'database',
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'mysql',
        'chunk' => 1000,
      ),
    ),
    'enabled' => false,
    'middleware' => 
    array (
      0 => 'web',
      1 => 'Laravel\\Telescope\\Http\\Middleware\\Authorize',
    ),
    'only_paths' => 
    array (
    ),
    'ignore_paths' => 
    array (
      0 => 'nova-api*',
    ),
    'ignore_commands' => 
    array (
    ),
    'watchers' => 
    array (
      'Laravel\\Telescope\\Watchers\\BatchWatcher' => true,
      'Laravel\\Telescope\\Watchers\\CacheWatcher' => true,
      'Laravel\\Telescope\\Watchers\\CommandWatcher' => 
      array (
        'enabled' => true,
        'ignore' => 
        array (
        ),
      ),
      'Laravel\\Telescope\\Watchers\\DumpWatcher' => true,
      'Laravel\\Telescope\\Watchers\\EventWatcher' => 
      array (
        'enabled' => true,
        'ignore' => 
        array (
        ),
      ),
      'Laravel\\Telescope\\Watchers\\ExceptionWatcher' => true,
      'Laravel\\Telescope\\Watchers\\JobWatcher' => true,
      'Laravel\\Telescope\\Watchers\\LogWatcher' => true,
      'Laravel\\Telescope\\Watchers\\MailWatcher' => true,
      'Laravel\\Telescope\\Watchers\\ModelWatcher' => 
      array (
        'enabled' => true,
        'events' => 
        array (
          0 => 'eloquent.*',
        ),
        'hydrations' => true,
      ),
      'Laravel\\Telescope\\Watchers\\NotificationWatcher' => true,
      'Laravel\\Telescope\\Watchers\\QueryWatcher' => 
      array (
        'enabled' => true,
        'ignore_packages' => true,
        'slow' => 100,
      ),
      'Laravel\\Telescope\\Watchers\\RedisWatcher' => true,
      'Laravel\\Telescope\\Watchers\\RequestWatcher' => 
      array (
        'enabled' => true,
        'size_limit' => 64,
      ),
      'Laravel\\Telescope\\Watchers\\GateWatcher' => 
      array (
        'enabled' => true,
        'ignore_abilities' => 
        array (
        ),
        'ignore_packages' => true,
      ),
      'Laravel\\Telescope\\Watchers\\ScheduleWatcher' => true,
      'Laravel\\Telescope\\Watchers\\ViewWatcher' => true,
    ),
  ),
  'translation' => 
  array (
    'driver' => 'file',
    'route_group_config' => 
    array (
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
      ),
    ),
    'translation_methods' => 
    array (
      0 => 'trans',
      1 => '__',
    ),
    'scan_paths' => 
    array (
      0 => 'F:\\laragon\\www\\alfa\\app',
      1 => 'F:\\laragon\\www\\alfa\\resources',
    ),
    'ui_url' => 'languages',
    'database' => 
    array (
      'connection' => '',
      'languages_table' => 'languages',
      'translations_table' => 'translations',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'F:\\laragon\\www\\alfa\\resources\\views',
    ),
    'compiled' => 'F:\\laragon\\www\\alfa\\storage\\framework\\views',
  ),
  'website' => 
  array (
    'name' => 'rework',
    'logo' => 'logo.png',
    'favicon' => 'favicon.png',
    'description' => 'description',
    'owner' => '',
    'email' => '',
    'phone' => '0812-8849-5099',
    'address' => 'jln. tanah koja RT. 001/02 No. 65, Kelurahan Duri Kosambi, Kecamatan Cengkareng, Kota Jakarta Barat. Kode Post 11750',
    'developer_setting' => 'developer',
    'backend' => 'default',
    'frontend' => '',
    'secure' => true,
    'autonumber' => '15',
    'pagination' => '10',
    'pjax' => false,
    'loading' => true,
    'application' => false,
    'notification' => true,
    'information' => false,
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'laravolt' => 
  array (
    'avatar' => 
    array (
      'driver' => 'gd',
      'generator' => 'Laravolt\\Avatar\\Generator\\DefaultGenerator',
      'ascii' => false,
      'shape' => 'circle',
      'width' => 100,
      'height' => 100,
      'chars' => 2,
      'fontSize' => 48,
      'uppercase' => false,
      'rtl' => false,
      'fonts' => 
      array (
        0 => 'F:\\laragon\\www\\alfa\\vendor\\laravolt\\avatar\\config/../fonts/OpenSans-Bold.ttf',
        1 => 'F:\\laragon\\www\\alfa\\vendor\\laravolt\\avatar\\config/../fonts/rockwell.ttf',
      ),
      'foregrounds' => 
      array (
        0 => '#FFFFFF',
      ),
      'backgrounds' => 
      array (
        0 => '#f44336',
        1 => '#E91E63',
        2 => '#9C27B0',
        3 => '#673AB7',
        4 => '#3F51B5',
        5 => '#2196F3',
        6 => '#03A9F4',
        7 => '#00BCD4',
        8 => '#009688',
        9 => '#4CAF50',
        10 => '#8BC34A',
        11 => '#CDDC39',
        12 => '#FFC107',
        13 => '#FF9800',
        14 => '#FF5722',
      ),
      'border' => 
      array (
        'size' => 1,
        'color' => 'background',
        'radius' => 0,
      ),
      'theme' => 
      array (
        0 => 'colorful',
      ),
      'themes' => 
      array (
        'grayscale-light' => 
        array (
          'backgrounds' => 
          array (
            0 => '#edf2f7',
            1 => '#e2e8f0',
            2 => '#cbd5e0',
          ),
          'foregrounds' => 
          array (
            0 => '#a0aec0',
          ),
        ),
        'grayscale-dark' => 
        array (
          'backgrounds' => 
          array (
            0 => '#2d3748',
            1 => '#4a5568',
            2 => '#718096',
          ),
          'foregrounds' => 
          array (
            0 => '#e2e8f0',
          ),
        ),
        'colorful' => 
        array (
          'backgrounds' => 
          array (
            0 => '#f44336',
            1 => '#E91E63',
            2 => '#9C27B0',
            3 => '#673AB7',
            4 => '#3F51B5',
            5 => '#2196F3',
            6 => '#03A9F4',
            7 => '#00BCD4',
            8 => '#009688',
            9 => '#4CAF50',
            10 => '#8BC34A',
            11 => '#CDDC39',
            12 => '#FFC107',
            13 => '#FF9800',
            14 => '#FF5722',
          ),
          'foregrounds' => 
          array (
            0 => '#FFFFFF',
          ),
        ),
        'pastel' => 
        array (
          'backgrounds' => 
          array (
            0 => '#ef9a9a',
            1 => '#F48FB1',
            2 => '#CE93D8',
            3 => '#B39DDB',
            4 => '#9FA8DA',
            5 => '#90CAF9',
            6 => '#81D4FA',
            7 => '#80DEEA',
            8 => '#80CBC4',
            9 => '#A5D6A7',
            10 => '#E6EE9C',
            11 => '#FFAB91',
            12 => '#FFCCBC',
            13 => '#D7CCC8',
          ),
          'foregrounds' => 
          array (
            0 => '#FFF',
          ),
        ),
      ),
    ),
  ),
  'Item' => 
  array (
    'name' => 'Product',
  ),
  'Linen' => 
  array (
    'name' => 'Product',
  ),
  'Report' => 
  array (
    'name' => 'Product',
  ),
  'System' => 
  array (
    'name' => 'Product',
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
