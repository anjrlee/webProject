<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>央氏世界紀錄</title>
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
