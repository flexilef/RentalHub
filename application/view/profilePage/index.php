<?php
if (isset($_SESSION['is_auth'])) {?>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h1><?php echo $_SESSION['name'] ?></h1>
            <a href="<?php echo URL; ?>protoController/index" class="btn btn-lg btn-info listing-btn pull-right" type="button">
                <span>Post Listing</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Joined</strong></span><?php echo $_SESSION['createdDate'] ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>User Type</strong></span> <?php echo $_SESSION['userTypeDescription'] ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?php echo $_SESSION['email'] ?></li>
            </ul>

        </div><!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#listings" data-toggle="tab">Property Listings</a></li>
                <li><a href="#settings" data-toggle="tab">User Setting</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="listings">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>Price</th>
                                    <th>Delete </th>
                                </tr>
                            </thead>
                            <tbody id="items">

                                <?php
                                $count = 1;
                                if (!empty($this->posted_rental_properties)) {
                                       foreach ( $this->posted_rental_properties as $value) {
                                        ?>  
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><a href="<?php echo URL . 'rentalListing/index?rental_listing_id=' . $value['ID']?>" target="_blank"><?php echo $value['TITLE']; ?></a></td>
                                            <td><?php echo $value['DESCRIPTION']; ?></td>
                                            <td><?php echo $value['ADDRESS']; ?></td>
                                            <td><?php echo $value['PRICE']; ?></td>
                                            <td>
                                                <a class="delete_product" data-id="<?php echo $value['ID']; ?>" href="javascript:void(0)">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                           $count++;
                                    }
                                } else {
                                    ?>  <tr>
                                        <td>No result found</td>
                                    </tr>
                                    <?php
                                }
                                ?>    
                            </tbody>
                        </table>
                        <hr>
                    </div><!--/table-resp-->
                </div><!--/tab-pane-->
                <div class="tab-pane" id="settings">

                    <hr>
                    <form id="registrationForm" class="form" action="<?php echo URL . "profile/index"; ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name"><h4>First name</h4></label>
                                <input type="text" class="form-control"  name="firstName" id="first_name" placeholder="first name" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name"><h4>Last name</h4></label>
                                <input type="text" class="form-control" name="lastName" id="last_name" placeholder="last name" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone"><h4>Phone</h4></label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile"><h4>Mobile</h4></label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email"><h4>Location</h4></label>
                                <input type="text" class="form-control" name="address" id="location" placeholder="somewhere" title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password"><h4>Password</h4></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password2"><h4>Verify</h4></label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg" name="update" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div><!--/row-->
    <?php
}
?>
