</body>
    <footer>
        <!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
        <div class="footer">
            Created with the joint effort of SFSU and Fulda
        </div>

        <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
        <script>
            var url = "<?php echo URL; ?>";
        </script>

        <!-- Include Jquery from CDN -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

        <!-- our JavaScript -->
        <script src="<?php echo URL; ?>js/application.js"></script>

        <!-- include less compiler -->
        <script src="<?php echo URL; ?>js/less.min.js"></script>

        <!-- Include Bootstrap from CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </footer>
</html>
