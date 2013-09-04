<?php

/**
 * This is a script for inserting 5 random users by every function request.
 * It's calling http://randomuser.me/g/?results=5 - and this script inserts the response in the database
 * currently with no validation! (Maybe we don't need it - all data responses are okay)
 * 
 * @author Alexander Czichelski <a.czichelski@elitecoder.eu>
 * @version 1.0.0
 */
class randomUserSaver {

    /**
     * Magic construct
     */
    public function __construct() {
        // Mysql connection
        require('config.php');

        if (!empty($_GET) && !empty($_GET['ready'])) {
            // Feel free to add some functional
        }

        // Show a nice summary!
        if (!empty($_GET) && !empty($_GET['showStats'])) {
            // Your database setup                       
            $link = mysql_connect($dbConnection['host'], $dbConnection['user'], $dbConnection['password']);
            mysql_select_db($dbConnection['database'], $link) or die('Could not select database.');

            // Generating some nice stats:
            // - total User
            $totalUserSQL = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM userdata"));
            $totalUser = $totalUserSQL[0];

            // Kill mysql
            mysql_close($link);

            // Inform the template about the stats
            echo json_encode(array('totalUser' => $totalUser));
            die();
        }

        if (!empty($_GET) && !empty($_GET['search'])) {
            // Your database setup                       
            $link = mysql_connect($dbConnection['host'], $dbConnection['user'], $dbConnection['password']);
            mysql_select_db($dbConnection['database'], $link) or die('Could not select database.');

            // Feel free to add some functional
            $field = "";
            switch ($_POST['field']) {
                case 'Gender':
                    $field = 'user_gender';
                    break;
                case 'Title':
                    $field = 'name_title';
                    break;
                case 'Firstname':
                    $field = 'name_first';
                    break;
                case 'Lastname':
                    $field = 'name_last';
                    break;
                case 'Street':
                    $field = 'location_street';
                    break;
                case 'City':
                    $field = 'location_city';
                    break;
                case 'State':
                    $field = 'location_state';
                    break;
                case 'Zip':
                    $field = 'location_zip';
                    break;
                case 'E-Mail':
                    $field = 'spec_email';
                    break;
                case 'Password (plain)':
                    $field = 'spec_password';
                    break;
                case 'Password (md5)':
                    $field = 'spec_md5_hash';
                    break;
                case 'Password (sha1)':
                    $field = 'spec_sha1_hash';
                    break;
                case 'Phone':
                    $field = 'user_phone';
                    break;
                case 'Cell':
                    $field = 'user_cell';
                    break;
                case 'SSN':
                    $field = 'user_ssn';
                    break;
                case 'Picture':
                    $field = 'user_picture';
                    break;
                case 'Seed':
                    $field = 'user_seed';
                    break;
            }
            
            if(empty($field)) {
                return;
            }
            
            $term = $_POST['term'];
            $result = mysql_fetch_row(mysql_query("SELECT * FROM userdata WHERE `$field` = '".$term."'"));
            // Kill mysql
            mysql_close($link);

            echo json_encode(array('search' => $result, 'term' => $term, 'field' => $field));
            die();
        }

        if (!empty($_POST)) {
            // Your database setup           
            $link = mysql_connect($dbConnection['host'], $dbConnection['user'], $dbConnection['password']);
            mysql_select_db($dbConnection['database'], $link) or die('Could not select database.');

            // Setting user array - getting by post
            $users = $_POST['results'];

            // Insert every user in the database
            foreach ($users as $user) {
                $sqlQuery = "INSERT INTO `userdata` (`user_gender`,`name_title`,`name_first`,`name_last`,`location_street`,`location_city`,`location_state`,
                    `location_zip`,`spec_email`,`spec_password`,`spec_md5_hash`,`spec_sha1_hash`,`user_phone`,`user_cell`,`user_ssn`,`user_picture`,`user_seed`) 
                    VALUES (
                        '" . $user['user']['gender'] . "', 
                        '" . $user['user']['name']['title'] . "', 
                        '" . $user['user']['name']['first'] . "', 
                        '" . $user['user']['name']['last'] . "', 
                        '" . $user['user']['location']['street'] . "', 
                        '" . $user['user']['location']['city'] . "', 
                        '" . $user['user']['location']['state'] . "', 
                        '" . $user['user']['location']['zip'] . "', 
                        '" . $user['user']['email'] . "', 
                        '" . $user['user']['password'] . "', 
                        '" . $user['user']['md5 hash'] . "', 
                        '" . $user['user']['sha1 hash'] . "', 
                        '" . $user['user']['phone'] . "', 
                        '" . $user['user']['cell'] . "', 
                        '" . $user['user']['SSN'] . "', 
                        '" . $user['user']['picture'] . "', 
                        '" . $user['seed'] . "'
                    )";

                mysql_query($sqlQuery) or die(mysql_error());
            }
            // Kill mysql
            mysql_close($link);
            // Success!
            echo json_encode(array('status' => 'success'));
            die();
        }
    }

}

// Calling class, showing view
$randomUserSaverClass = new randomUserSaver;
include('view/index.php');
?>