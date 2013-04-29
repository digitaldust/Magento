<!-- **************************************************** -->
<!-- IF IT DOES NOT WORK, PLEASE CHECK MAMP IS STARTED!!! -->
<!-- **************************************************** -->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        
        <p style="font-family: Verdana; font-weight: bold">MagentoGo Data Retrieval for MBSTORE</p>
        <?php
        echo("Retrieve soap client...");
        $store = htmlspecialchars($_POST['store']);
        $storelink = 'http://' . $store . '/api/v2_soap/?wsdl';
        $proxy = new SoapClient($storelink);
        echo("Done<br />");
        // If somestuff requires api authentification,
        // then get a session token
        /* @var $session type */
        echo("Retrieve session ID...");
        $user = htmlspecialchars($_POST['user']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $sessionId = $proxy->login($user, $pwd);
        echo("Done<br />");
        // introduce a complex filter to filter for date and just update records on the db
//        $complexFilter = array(
//            'complex_filter' => array(
//                array(
//                    'key' => 'created_at',
//                    'value' => array('key' => 'in', 'value' => '1,3')
//                )
//            )
//        );
        echo("Retrieve results...");
        /* @var $result type */
        $result = $proxy->customerCustomerList($sessionId);
        echo("Done<br />");
        // array to hold customer results
        $csv_fields = array();
        $csv_fields[0] = array();
        $csv_fields[0][] = 'customer_id';
        $csv_fields[0][] = 'created_at';
        $csv_fields[0][] = 'updated_at';
        $csv_fields[0][] = 'increment_id';
        $csv_fields[0][] = 'store_id';
        $csv_fields[0][] = 'website_id';
        $csv_fields[0][] = 'created_in';
        $csv_fields[0][] = 'email';
        $csv_fields[0][] = 'firstname';
        $csv_fields[0][] = 'middlename';
        $csv_fields[0][] = 'lastname';
        $csv_fields[0][] = 'group_id';
        $csv_fields[0][] = 'prefix';
        $csv_fields[0][] = 'suffix';
        $csv_fields[0][] = 'taxvat';
        $csv_fields[0][] = 'password_hash';

        $i = 1;
        foreach ($result as $inner) {
            $csv_fields[$i][0] = 'not set';
            $csv_fields[$i][1] = 0;
            $csv_fields[$i][2] = 0;
            $csv_fields[$i][3] = 0;
            $csv_fields[$i][4] = 0;
            $csv_fields[$i][5] = 0;
            $csv_fields[$i][6] = 0;
            $csv_fields[$i][7] = 'not set';
            $csv_fields[$i][8] = 'not set';
            $csv_fields[$i][9] = 'not set';
            $csv_fields[$i][10] = 'not set';
            $csv_fields[$i][11] = 0;
            $csv_fields[$i][12] = 'not set';
            $csv_fields[$i][13] = 'not set';
            $csv_fields[$i][14] = 0;
            $csv_fields[$i][15] = 'not set';
            foreach ($inner as $key => $value) {
                switch ($key) {
                    case 'customer_id':
                        if (isset($value)) {
                            $csv_fields[$i][0] = $value;
                        } else {
                            $csv_fields[$i][0] = 0;
                        }
                        break;
                    case 'created_at':
                        if (isset($value)) {
                            $csv_fields[$i][1] = $value;
                        } else {
                            $csv_fields[$i][1] = 0;
                        }
                        break;
                    case 'updated_at':
                        if (isset($value)) {
                            $csv_fields[$i][2] = $value;
                        } else {
                            $csv_fields[$i][2] = 0;
                        }
                        break;
                    case 'increment_id':
                        if (isset($value)) {
                            $csv_fields[$i][3] = $value;
                        } else {
                            $csv_fields[$i][3] = 0;
                        }
                        break;
                    case 'store_id':
                        if (isset($value)) {
                            $csv_fields[$i][4] = $value;
                        } else {
                            $csv_fields[$i][4] = 0;
                        }
                        break;
                    case 'website_id':
                        if (isset($value)) {
                            $csv_fields[$i][5] = $value;
                        } else {
                            $csv_fields[$i][5] = 0;
                        }
                        break;
                    case 'created_in':
                        if (isset($value)) {
                            $csv_fields[$i][6] = $value;
                        } else {
                            $csv_fields[$i][6] = 0;
                        }
                        break;
                    case 'email':
                        if (isset($value)) {
                            $csv_fields[$i][7] = $value;
                        } else {
                            $csv_fields[$i][7] = 0;
                        }
                        break;
                    case 'firstname':
                        if (isset($value)) {
                            $csv_fields[$i][8] = $value;
                        } else {
                            $csv_fields[$i][8] = 0;
                        }
                        break;
                    case 'middlename':
                        if (isset($value)) {
                            $csv_fields[$i][9] = $value;
                        } else {
                            $csv_fields[$i][9] = 0;
                        }
                        break;
                    case 'lastname':
                        if (isset($value)) {
                            $csv_fields[$i][10] = $value;
                        } else {
                            $csv_fields[$i][10] = 0;
                        }
                        break;
                    case 'group_id':
                        if (isset($value)) {
                            $csv_fields[$i][11] = $value;
                        } else {
                            $csv_fields[$i][11] = 0;
                        }
                        break;
                    case 'prefix':
                        if (isset($value)) {
                            $csv_fields[$i][12] = $value;
                        } else {
                            $csv_fields[$i][12] = 0;
                        }
                        break;
                    case 'suffix':
                        if (isset($value)) {
                            $csv_fields[$i][13] = $value;
                        } else {
                            $csv_fields[$i][13] = 0;
                        }
                        break;
                    case 'taxvat':
                        if (isset($value)) {
                            $csv_fields[$i][14] = $value;
                        } else {
                            $csv_fields[$i][14] = 0;
                        }
                        break;
                    case 'password_hash':
                        if (isset($value)) {
                            $csv_fields[$i][15] = $value;
                        } else {
                            $csv_fields[$i][15] = 0;
                        }
                        break;
                }
            }
            $i++;
        }

        // If you don't need the session anymore
        $proxy->endSession($sessionId);
        echo("<p>SOAP Process Completed</p>");

        // create CSV file
        $csv_folder = '/Users/digitaldust/Desktop';
        // format time
        $filename = "customers_" . time();
        $CSVFileName = $csv_folder . '/' . $filename . '.csv';
        echo($CSVFileName);
        $FileHandle = fopen($CSVFileName, 'w') or die("can't open file");
        fclose($FileHandle);
        $fp = fopen($CSVFileName, 'w');
        foreach ($csv_fields as $fields) {
            \fputcsv($fp, $fields);
        }
        fclose($fp);
        ?>
    </body>
</html>
