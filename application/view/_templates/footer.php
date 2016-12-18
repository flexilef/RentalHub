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
    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
`
    <script>
        $(document).ready(function () {

            $('.delete_product').click(function (e) {

                e.preventDefault();

                var pid = $(this).attr('data-id');
                var parent = $(this).parent("td").parent("tr");

                bootbox.dialog({
                    message: "Are you sure you want to Delete ?",
                    title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
                    buttons: {
                        success: {
                            label: "No",
                            className: "btn-success",
                            callback: function () {
                                $('.bootbox').modal('hide');
                            }
                        },
                        danger: {
                            label: "Delete!",
                            className: "btn-danger pull-left",
                            callback: function () {

                                /*

                                 using $.ajax();

                                 $.ajax({

                                 type: 'POST',
                                 url: 'delete.php',
                                 data: 'delete='+pid

                                 })
                                 .done(function(response){

                                 bootbox.alert(response);
                                 parent.fadeOut('slow');

                                 })
                                 .fail(function(){

                                 bootbox.alert('Something Went Wrog ....');

                                 })
                                 */

                                $.post('delete', {'delete': pid})
                                        .done(function (response) {
                                            bootbox.alert(response);
                                            parent.fadeOut('slow');
                                        })
                                        .fail(function () {
                                            bootbox.alert('Something Went Wrog ....');
                                        })


                            }
                        }
                    }
                });


            });

            $('#contact-btn').click(function (e) {

                e.preventDefault();

                var pid = $(this).attr('data-id');
                var parent = $(this).parent("td").parent("tr");

                bootbox.dialog({
                    message: "Your contact details will be shared with the owner",
                    title: "<i class='glyphicon glyphicon-envelope'></i> Send Email Now!",
                    buttons: {
                        success: {
                            label: "No",
                            className: "btn-info pull-left",
                            callback: function () {
                                $('.bootbox').modal('hide');
                            }
                        },
                        danger: {
                            label: "Yes!",
                            className: "btn-success",
                            callback: function () {

                                $.post('sendEmail', {'email': pid})
                                        .done(function (response) {
                                            bootbox.alert(response);
                                            parent.fadeOut('slow');
                                        })
                                        .fail(function () {
                                            bootbox.alert('Something Went Wrog ....');
                                        })


                            }
                        }
                    }
                });


            });

            $('#contact-btn-again').click(function (e) {

                e.preventDefault();

                var pid = $(this).attr('data-id');
                var parent = $(this).parent("td").parent("tr");

                bootbox.dialog({
                    message: "Your contact details will be shared with the owner",
                    title: "<i class='glyphicon glyphicon-envelope'></i> Send Email Now!",
                    buttons: {
                        success: {
                            label: "No",
                            className: "btn-success",
                            callback: function () {
                                $('.bootbox').modal('hide');
                            }
                        },
                        danger: {
                            label: "Yes!",
                            className: "btn-success",
                            callback: function () {

                                $.post('sendEmail', {'email': pid})
                                        .done(function (response) {
                                            bootbox.alert(response);
                                            parent.fadeOut('slow');
                                        })
                                        .fail(function () {
                                            bootbox.alert('Something Went Wrong ....');
                                        })


                            }
                        }
                    }
                });


            });

        });
    </script>
</footer>
</html>
