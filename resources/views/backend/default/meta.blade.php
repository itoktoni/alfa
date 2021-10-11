<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('website.name') }}</title>
<meta name="keywords" content="{{ config('website.name') }}" />
<meta name="description" content="{{ config('website.description') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="turbolinks-cache-control" content="no-cache">
<link href="{{ config('website.favicon') ? Helper::files('logo/'.config('website.favicon')) : Avatar::create(config('website.name'))->setShape('square')->setBackground(config('website.colors')) }}" rel="shortcut icon">
