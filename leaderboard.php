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

    <?php 
    // MARK: IMPORTS
    include_once 'header.php' ?> 
    <?php include_once 'connection.php' ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

                <div style="font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif" class="row carousel-holder">
                     
                    <div class="col-md-12">
                        
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th></th>
                              <th>Title</th>
                              <th>Rating</th>
                            </tr>
                          </thead>
                          <tbody>
                    <?php 

                        // MARK: MAIN BODY

                        // Creating new DBConnection object
                        $db_handle = new DBConnection();

                        // Getting list of movies
                        $query = "SELECT * FROM movies ORDER BY rating_score/rating_submitted DESC";
                        $result = $db_handle->runQuery($query);
                        
                        // If Result from Query is not empty
                        if(!empty($result)) {
                            $count = 0;
                            foreach ($result as $movie) {
                                    // Count for ratings + 1 
                                    $count = $count + 1;
                                    // Score of rating = Score of rating + The score selected, rounded to nearest integer
                                    $rating = round($movie["rating_score"] / $movie["rating_submitted"]);
                                    echo '
                                            <tr>
                                              <th style="font-size:20px" scope="row">'.$count.'</th>
                                              <td> <img style="max-width:60px" class="img-responsive img-rounded" src="'.$movie["image"].'" alt=""> </td> 
                                              <td>'.$movie["title"].'</td>
                                              <td>
                                                <div class="ratings">

                                                    <p>
                                                    ';
                                                    for ($i = 1; $i <= $rating; $i++)
                                                    {
                                                        echo '<span class="glyphicon glyphicon-star"></span>';
                                                    }
                                                    for ($i = 1; $i <= 5 - $rating; $i++)
                                                    {
                                                        echo '<span class="glyphicon glyphicon-star-empty"></span>';
                                                    }

                                     echo ' ('.$movie["rating_submitted"].' Ratings)
                                                    </p>
                                                        
                                                </div>
                                            </td>
                                            </tr>';
                            }
                        }
                   
                    ?>
                        </tbody>
                        </table>
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
