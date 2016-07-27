<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rate and Recommendations</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sky.css" rel="stylesheet">

</head>

<body>

    <?php
    // MARK: IMPORTS
    include_once 'header.php' ?>


    <?php

    // MARK: ERROR REPORTING
    require_once("connection.php");
    ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

                <div class="row carousel-holder">


                    <?php

                        // MARK: MAIN BODY

                        // Creating new DBConnection object
                        $db_handle = new DBConnection();

                        // Getting list of movies
                        $query = "SELECT * FROM movies";
                        $result = $db_handle->runQuery($query);

                        if(!empty($result)) {
                            foreach ($result as $movie) {
                                    echo '<div class="col-md-15 col-sm-3">
                                          <div class="thumbnail">
                                            <img src="'.$movie["image"].'" alt="">
                                            <div class="caption">
                                                <h4><a href="#">'.$movie["title"].'</a>
                                                </h4>
                                                <p>'.$movie["description"].'</p>
                                            </div>
                                            <div class="ratings">
                                            <form action="#" method="post">
                                                <div>
                                                <div class="rating pull-left">
                                                <input name="myrating" type="radio" value="5-'.$movie["id"].'" />
                                                <span>☆</span>

                                                <input name="myrating" type="radio" value="4-'.$movie["id"].'" />
                                                <span>☆</span>

                                                <input name="myrating" type="radio" value="3-'.$movie["id"].'" />
                                                <span>☆</span>

                                                <input name="myrating" type="radio" value="2-'.$movie["id"].'" />
                                                <span>☆</span>

                                                <input name="myrating" type="radio" value="1-'.$movie["id"].'" />
                                                <span>☆</span>

                                                </div>
                                                <div class="pull-right">
                                                <input class="btn btn-link" type="submit" name="submit" value="Submit" />
                                                </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>';
                            }
                        }
                        else
                        {
                            for ($i = 1; $i <= 10; $i++) {
                                    echo '<div class="col-md-15 col-sm-3">
                                          <div class="thumbnail">
                                            <img src="images/nocontent.jpg" alt="">
                                            <div style="height:55px" class="caption">
                                                <h4><a href="#">No Content</a>
                                                </h4>
                                            </div>
                                        </div>
                                        </div>';
                                }
                        }

                    // If submit button press, update to database
                    if(isset($_POST['submit'])){

                        $selected_val = $_POST['myrating'];  // Storing Selected Value In Variable

                        $pieces = explode("-", $selected_val);


                        // Updating to database the new ratings
                        $query = "SELECT * FROM movies WHERE id = ".$pieces[1]." LIMIT 1";
                        $result = $db_handle->runQuery($query);
                        if(!empty($result)) {
                            foreach ($result as $movie) {
                                $movieRating = $movie["rating_score"] + $pieces[0];
                                $ratingsSubmitted = $movie["rating_submitted"] + 1;

                                // Updating rating
                                $update = "UPDATE movies SET rating_score = ".$movieRating.", rating_submitted = ".$ratingsSubmitted." WHERE id = ".$pieces[1]."";
                                $result = $db_handle->updateQuery($update);
                                if ($result) {
                                    echo "<p>You gave " .$pieces[0]. " stars. Rating successfully added.</p>";  // Displaying Selected Value
                                }
                            }
                        }


                    }
                    ?>

                    <div class="col-sm-12 col-lg-12 col-md-12">
                        <h4><a href="leaderboard.php">Leaderboard?</a>
                        </h4>
                        <p>If you would like too see how these moves compare to each other, then check out <a target="_blank" href="leaderboard.php">Leaderboard page</a>!</p>
                        <a class="btn btn-primary" target="_blank" href="upload.php">Add Content</a>
                    </div>

                </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Rate and Recommendations 2016</p>
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
