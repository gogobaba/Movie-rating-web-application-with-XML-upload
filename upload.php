<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sky Rate and Recommendations</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sky.css" rel="stylesheet">

</head>

<body>

    <?php include_once 'header.php' ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-12 text-center"> 
                <form method="post" enctype="multipart/form-data">
                    
                            <div style="margin-bottom:20px" class="row">
                                <h4>Upload File</h4>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span style="border-radius: 5px" class="btn btn-primary btn-file">
                                            Browse&hellip; <input type="file" name="my_file[]">
                                        </span>
                                    </span>

                                </div>
                            </div>

                            <div class="row">
                                 <input style="font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif" type="submit" class="btn btn-success" value="Process File">
                            </div>
                   
                </form>      

                <!-- Processing XML File -->

                 <?php
                ob_start();
                
                // Starting to process XML File
                if (isset($_FILES['my_file'])) {
                    $myFile = $_FILES['my_file'];
                    
                    // Checking how many files there are
                    $fileCount = count($myFile["name"]);

                    // If file is XML, we start processing it.
                    $done = false;

                    if($myFile["type"][0] == "text/xml")
                    {
                        // Process file

                        // Checking XML File

                        $myMovies = simplexml_load_file($myFile["name"][0]);

                        // Connecting to database 

                        $DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
                        $DBUser   = 'root';
                        $DBPass   = 'root';
                        $DBName   = 'sky_challenge';

                        $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Checking Row Count of Movies - If greater than 10, don't add more.
                        $query = "SELECT * FROM movies";

                        $result = $conn->query($query);
                        $rowcount = $result->num_rows;

                        if ($rowcount<10)
                        {
                            for ($i = 0; $i < 10; $i++) {
                              $sql = "INSERT INTO movies (title, description, image, rating_score, rating_submitted) VALUES ('".$myMovies->Programme[$i]->name."', '".$myMovies->Programme[$i]->description."', '".$myMovies->Programme[$i]->image_path."', '".$myMovies->Programme[$i]->rating_score."', '".$myMovies->Programme[$i]->rating_submitted."')"; 

                              if ($conn->query($sql) === TRUE) {
                                 $page = "index.php";
                                 echo '<script type="text/javascript">';
                                 echo 'window.location.href="'.$page.'";';
                                 echo '</script>';
                              } 
                              else 
                              {
                                 echo "Error: " . $sql . "<br>" . $conn->error;
                              }
                            }
                        }
                        else
                        {
                            echo '<p>
                            Sorry. You already introduced 10 values.
                            </p>';
                        }
                          $conn->close();
                          
                    }

                    // If file is not XML, show message to select an XML.                   
                    else
                    {
                        ?>
                        <p>
                            Please select an XML File.
                        </p>
                        <?php
                    }

                }
            ?>
            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer class="footer">
            <div class="row">
                <div class="col-lg-12">
                    <p>Sky Rate and Recommendations 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
