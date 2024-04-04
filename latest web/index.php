<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <style>
        
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpeg" alt="Logo">
        </div>
        <nav>
        <a href="index.php">Home</a>
            <a href="calendar.php">Calendar</a>
            <a href="inventory.php">Inventory</a>
            <a href="menu.php">Menu</a>
            <a href="users.php">Accounts</a>
            <a href="aboutus.html">About Us</a>
        </nav>
        <a href="logout.php" class="btn btn-warning logout-btn">Logout</a>
    </header>

    <div class="carousel-container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="yas.jpeg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 1</h5>
                        <p>This is the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="yasuo.jpeg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 2</h5>
                        <p>This is the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="yaz.jpeg" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 3</h5>
                        <p>This is the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
