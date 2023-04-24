


<script src="http://yastatic.net/jquery/2.1.1/jquery.min.js"></script>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
  window.onload = function () {
      jQuery("#user-city").text(ymaps.geolocation.city);
  }

</script>

