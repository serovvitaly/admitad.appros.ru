<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>{{$title}}</title>
  <link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/packages/jquery/Buttons/css/buttons.css">
  <link rel="stylesheet" type="text/css" href="/packages/custombox/src/jquery.custombox.css">
  <link rel="stylesheet" type="text/css" href="/skins/base/css/popup.css">
  <link rel="stylesheet" type="text/css" href="/packages/jquery/galleria/themes/classic/galleria.classic.css">
  <link rel="stylesheet" type="text/css" href="/skins/admin/css/style.css">
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

</head>
<body>
  @include('admin.topmenu')
  <div style="height: 50px;"></div>
  <div class="container">
    {{$content}}
    <footer>
    
    </footer>
  </div>
  
  <!--script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script-->
  <script src="/packages/jquery/galleria/galleria-1.3.3.js"></script>
  <script src="/packages/jquery/galleria/themes/classic/galleria.classic.min.js"></script>
  <script src="/packages/jquery/easing/jquery.easing.1.3.min.js"></script>
  <script src="/packages/jquery/scrollTo/jquery.scrollTo.min.js"></script>
  <script src="/packages/jquery/sticky/jquery.sticky.js"></script>
  <script src="/packages/jquery/Buttons/js/buttons.js"></script>
  <script src="/packages/bootstrap/js/bootstrap.min.js"></script>
  <script src="/packages/custombox/src/jquery.custombox.js"></script>
  <script src="/packages/jquery/imgLiquid/js/imgLiquid-min.js"></script>
  
  <script src="/packages/handlebars/handlebars-v1.3.0.js"></script>
  <script src="/packages/backbone.marionette/public/javascripts/underscore.js"></script>
  <script src="/packages/backbone/backbone.js"></script>
  <script src="/app/app.js?foo=<?= rand(10000, 99999) ?>"></script>
  
</body>
</html>
