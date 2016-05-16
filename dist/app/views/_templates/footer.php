    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>-->
    <!--<script src="<?=PUBLIC_URL;?>js/datetime-local-polyfill.min.js" type="text/javascript"></script>-->
    <!-- Obtaining an API key is recommended,
         the application will work without it however.
         have removed my key.
    -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script src="<?=PUBLIC_URL;?>js/app.js" type="text/javascript"></script>
    <?php
      if (isset($this->js)){
        foreach($this->js as $js) {
          print '<script src="' . APP_URL . 'views/' . $js . '.js" type="text/javascript"></script>';

        }
      }
    ?>
    
    <script>
      function initialize() {
        var input = document.getElementById('ip-location');
        var autocomplete = new google.maps.places.Autocomplete(input);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
     </script>
  </body>
</html>
