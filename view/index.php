<html>
    <head>
        <!-- CSS //-->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />

        <!-- JS //-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/eventCreate.js"></script>
        <?php
        if (!empty($_GET) && !empty($_GET['ready'])) {
            ?>      
            <!-- Only add, when ready //-->
            <script src="assets/js/ajaxRequestToRandomUser.js"></script>
            <?php
        }
        ?>
        <title>Unlimited Random User</title>
    </head>
    <body>
        <div class="randomUserForm">
            <label class="opener">
                Use this great script for generating fast and unlimited random users.
            </label>

            <select class="form-control searchDropdown">
                <option>Gender</option>
                <option>Title</option>
                <option>Firstname</option>
                <option>Lastname</option>
                <option>Street</option>
                <option>City</option>
                <option>State</option>
                <option>Zip</option>
                <option>E-Mail</option>
                <option>Password (plain)</option>
                <option>Password (md5)</option>
                <option>Password (sha1)</option>
                <option>Phone</option>
                <option>Cell</option>
                <option>SSN</option>
                <option>Picture</option>
                <option>Seed</option>
            </select><br/><br/>
            <div class="row searchBox">
                <div class="col-lg-6">
                    <!-- Searchbox - search a user! //-->
                    <div class="input-group">
                        <input type="text" class="form-control searchTerm" placeholder="Type any search term..." style="width:350px">
                        <span class="input-group-btn">
                            <button class="btn btn-default searchTermButton" type="button">Go!</button>
                        </span>
                    </div>
                </div>               
            </div>
            <!-- Generate some user //-->
            <a href="./?ready=true" class="btn btn-primary generate">Or click her, for generating users!</a>
            <input type="hidden" value="0" name="generatedUsers" class="generatedUsers">
            <div class="generated" style="display:none;">X Users generates</div>
            <a href="./" class="btn btn-danger generateStop">Or stop it!</a>
            <a href="#" class="btn btn-success showStatus">Or show some nice stats about your users</a>
        </div>  

        <!-- Modal stats //-->
        <div class="modal fade statModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Some fine stats</h4>
                    </div>
                    <div class="modal-body">
                        Total users: <label class="totalUserStat">no user found</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal search //-->
        <div class="modal fade searchModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Your search result for <label class="searchedTerm">undefined</label></h4>
                    </div>
                    <div class="modal-body">
                        <label class="searchResult">no user found</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </body>
</html>