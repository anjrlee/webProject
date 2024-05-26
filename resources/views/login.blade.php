<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>央氏世界紀錄</title>
    <link href="../css/app.css" rel="stylesheet">
  </head>
  <body>
    <div id="app">
      <App :msg="{{ json_encode(session('message')) }}"></App>
      
      
    </div> 
    
    <!-- 引入 Vue app -->
    <script src="/js/app.js"></script>
  </body>

</html>