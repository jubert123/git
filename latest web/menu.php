<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Gallery</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="menu.css">
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

    <div class="container">
        <h2 class="text-center mt-4 mb-4">Menu Gallery</h2>
        <div class="product-list">
            <!-- Product items will be added dynamically here -->
        </div>
        <!-- Add button to add new product item -->
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#addProductModal">
            Add Product
        </button>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add form to upload new photo and description -->
                    <form id="addProductForm">
                        <div class="form-group">
                            <label for="productImage">Product Image</label>
                            <input type="file" class="form-control-file" id="productImage" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product Description</label>
                            <textarea class="form-control" id="productDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addProductBtn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to handle adding a new product item and persisting it in local storage
$(document).ready(function () {
    // Function to load product items from local storage
    function loadProductItems() {
        var products = JSON.parse(localStorage.getItem('products')) || [];
        products.forEach(function (product) {
            $('.product-list').append(product);
        });
    }

    loadProductItems(); // Load product items when the page is loaded

    $('#addProductBtn').click(function () {
        // Get image file and description from the form
        var image = $('#productImage')[0].files[0];
        var description = $('#productDescription').val();

        // Check if image and description are provided
        if (image && description) {
            // Create a FileReader object to read the image file
            var reader = new FileReader();
            reader.onload = function (e) {
                // Create new product item HTML with uploaded image and description
                var newItemHtml = `
                    <div class="row product-item">
                        <div class="col-md-4">
                            <img src="${e.target.result}" class="img-fluid" alt="New Product">
                        </div>
                        <div class="col-md-8">
                            <p>${description}</p>
                            <button class="btn btn-danger delete-btn">Delete</button>
                        </div>
                    </div>
                    <hr>
                `;

                // Append new product item to the product list
                $('.product-list').append(newItemHtml);

                // Save product list to local storage
                var products = JSON.parse(localStorage.getItem('products')) || [];
                products.push(newItemHtml);
                localStorage.setItem('products', JSON.stringify(products));

                // Clear form fields and close the modal
                $('#addProductModal').modal('hide');
                $('#productImage').val('');
                $('#productDescription').val('');
            };
            reader.readAsDataURL(image); // Read the image file as a data URL
        } else {
            // Display an alert if image or description is missing
            alert('Please provide both an image and a description.');
        }
    });

    // Handle delete button click
    $('.product-list').on('click', '.delete-btn', function () {
        $(this).closest('.product-item').remove();

        // Update product list in local storage after deleting an item
        var products = [];
        $('.product-item').each(function () {
            products.push($(this).prop('outerHTML'));
        });
        localStorage.setItem('products', JSON.stringify(products));
    });
});

    </script>
</body>

</html>
