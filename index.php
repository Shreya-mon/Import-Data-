<?php
session_start();
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<link href="style.css" rel="stylesheet">  
</head>

<body>
    
        <?php
        if(isset($_SESSION['status'])){
            echo "<h1>".$_SESSION['status']."</h1>";
            unset($_SESSION['status']);
        }
        ?>

    <form action="import_data.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select File</label>
            <input type="file" name="import_file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">upload Your CSV file here.</div>
        </div>
       
        <div class="mb-4">
        <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>

    
</body>

</html>