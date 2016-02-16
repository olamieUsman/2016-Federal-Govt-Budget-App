<?php
    include('search.php');

    //Get ministry function
    $query_parent = mysql_query("SELECT distinct ministry FROM projects") or die("Query failed: ".mysql_error());

    //Query to post all search list
    if(isset($_POST['parent_ministry']) && isset($_POST['ministry_agency'])){
        $parent_ministry = $_POST['parent_ministry'];
        $ministry_agency = $_POST['ministry_agency'];
        
        $listmy = listhere($parent_ministry,$ministry_agency);
        $total = getTotal($parent_ministry,$ministry_agency);
    }
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>FG's 2016 Budget</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" media="screen">

    <script src="js/jquery.min.js"></script>
    <script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        
        $("#parent_ministry").change(function() {
            $(this).after('<div id="loader"><img src="img/loading.gif" alt="Loading Ministry Agency" /></div>');
            $.get('loadagencypage.php?parent_ministry=' + $(this).val(), function(data) {
                $("#ministry_agency").html(data);
                $('#loader').slideUp(200, function() {
                    $(this).remove();
                });
            }); 
        }); 
    });
    </script>  

    <script type="text/javascript">
        $(function () {
            $( '#table' ).searchable({
            striped: true,
            oddRow: { 'background-color': '#f5f5f5' },
            evenRow: { 'background-color': '#fff' },
            searchType: 'fuzzy'
        });
    });

    </script>

</head>
<body>

<header>
    <div class="container">
        <h1>FG's 2016 Proposed Budget</h1>
        <h3>The Government Spending plan</h3>

    </div>
</header>

<main class="container">
    <!-- Select section -->
    <section class="select">

        <div class="row">
            <div class="col-md-1">

            </div>

            <div class="col-md-10">
            <form method="post" action="">
                <div class="box1 col-lg-5">
                    <div class="">
                        <label>Select Ministry</label>
                        <select class="sel-1 form-control" name="parent_ministry" id="parent_ministry">
                            <?php while($row = mysql_fetch_array($query_parent)):?>
        <option value="<?php echo $row['ministry']; ?>"><?php echo $row['ministry']; ?></option>
        <?php endwhile; ?>
    </select>
                    </div>

                    <div style="margin-top: 40px;">
                        <label>Select Agency</label>
                        <select class="sel-1" name="ministry_agency" id="ministry_agency">
                        </select>
                    </div>
                    <button type="submit" name="search" class="btn btn-lg btn-success">Search</button>
                </div>
                <div class="box2 col-lg-7">
                    <div class="">
                        <h3>Total Amount</h3>
                        <h1><?php if(isset($total)){echo "N" . number_format($total);}?></h1>
                    </div>
                </div>
                </form>
                <div class="col-md-3">

                </div>
                    
                <div class="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="search" class="search-query form-control" placeholder="Search" autocomplete="off" id="search" />
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                </div>

            <div class="col-md-1">
                
        </div>

    </section>

    <!-- Table section -->
    <section class="table">

        <div class="row">
            <div class="col-md-1">

            </div>

            <div class="col-md-10">
                <div class="table-1">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table">
                            <?php if(isset($listmy)) {
                               echo $listmy;
                            }?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-1">

            </div>
        </div>



    </section>


    <!-- download -->

    <section class="download">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
                <div class="download-1">
                    <div class="i-img col-lg-4 ">
                        <img src="img/unboxing.png">
                    </div>

                    <div class="col-lg-8">
                        <h1>Download BudgIT's unboxing FG's 2016 Proposed Budget Document here</h1>
                        <p><a class="btn btn-success" href="http://yourbudgit.com/wp-content/uploads/2016/02/Unboxing-FGs-2016-Budget.pdf" style="width: 300px;  height: 50px;">Download</a></p>

                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="container">
        <div class="">
           <span>&copy; <script type="text/javascript">
            var theDate=new Date()
            document.write(theDate.getFullYear())
        </script> Powered by <a href="yourbudgit.com" target="_blank"> BudgIT</a></span>
        </div>
    </div>
</footer>

</body>
</html>