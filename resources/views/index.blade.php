
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}} {{$goodcatch}}</title>
    <meta name="keywords" content="{{$keywords}}">
    <meta name="description" content="{{$description}}" />
    <link rel="stylesheet" href="{{ mix('css/app.css','dist') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css','dist/module-approval') }}">

    <script src="/dist/vendor/vue/vue.min.js"></script>
    <script src="/dist/vendor/vue-router/vue-router.min.js"></script>
    <script src="/dist/vendor/moment/moment.min.js"></script>
    <script src="/dist/vendor/clipboard/clipboard.min.js"></script>
    <script src="/dist/vendor/ant-design-vue/antd.min.js"></script>
    <script src="/dist/vendor/ant-design-vue/antd-with-locales.min.js"></script>
</head>

<body>

<div id="app">
    <app></app>
</div>


</body>

<script type="text/javascript">
    window.baseUrl = '{{$base_url}}';
</script>
<script src="{{ mix('js/app.js','dist/module-approval') }}"></script>
