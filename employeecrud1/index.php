<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Advance Crud</title>

    <!-- CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1 class="bg-dark text-light text-center mb-3 py-2">Employee Master</h1>


<div class="container">
    <div class="displaymessage"></div>

<?php include 'form.php' ?>


<!-- Input search and Add new employee button -->
    <div class="row mb-3">
        <div class="col-10">
            <div class="input-group mb-3">
                <span class="input-group-text bg-dark text-light"><i class="fa fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Search employee">
            </div>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addemployee" id="adduserbtn">
                Add Employee
              </button>
        </div>
    </div>

<!-- Table -->
<?php include 'tabledata.php'; ?>
<!-- profile -->
<?php include 'profile.php' ?>


<!-- Pagination -->
<nav aria-label="Page navigation example" id="pagination">
    <!-- <ul class="pagination justify-content-center mt-5">
      <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item active"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul> -->
</nav>

<input type="hidden" value="1" name="currentpage" id="currentpage">


</div>

<!-- Form modal -->


    

<!-- Jquery CDN link -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
<script src="jquery.js"></script>
<!-- JavaScript Bundle with Popper CDN link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>