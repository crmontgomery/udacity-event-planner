    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Obtaining an API key is recommended,
         the application will work without it however.
         have removed my key.
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjOndRjfvWF8OeTDfwAuBzDXAleT_H-wk&v=3.exp&libraries=places"></script>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=YOURKEYHERE&v=3.exp&sensor=false&libraries=places"></script>-->
    <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>-->
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
