<?php
// Your PHP code to retrieve planned dates and descriptions from local storage or database
$plannedDates = []; // Example: array of planned dates and descriptions

// Output the planned dates as JSON
header('Content-Type: application/json');
echo json_encode($plannedDates);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Planner</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Include Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="calendar.css">
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
            <a href="#">Calendar</a>
            <a href="inventory.php">Inventory</a>
            <a href="menu.php">Menu</a>
            <a href="users.php">Accounts</a>
            <a href="aboutus.html">About Us</a>
        </nav>
        <a href="logout.php" class="btn btn-warning logout-btn">Logout</a>
    </header>
    <div class="container">
        <h2 class="text-center mb-4">Date Planner</h2>
        <form id="datePlannerForm">
            <div class="form-group">
                <label for="datepicker">Select Date:</label>
                <input type="text" class="form-control" id="datepicker" placeholder="Select date" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <hr>
        <h3 class="mb-3">Planned Dates</h3>
        <ul id="dateList" class="list-group">
            <!-- Selected dates will be displayed here -->
        </ul>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Include Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize datepicker
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            // Load planned dates from local storage
            loadPlannedDates();

            // Handle form submission
            $('#datePlannerForm').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Get selected date and description
                var selectedDate = $('#datepicker').val();
                var description = $('#description').val();

                // Display selected date and description in list form
                if (selectedDate && description) {
                    var listItem = $('<li class="list-group-item">').html('<b>Date:</b> ' + selectedDate + ' <br> <b>Description:</b> ' + description);
                    var deleteButton = $('<button type="button" class="btn btn-danger btn-sm float-right ml-2">Delete</button>').click(function() {
                        listItem.remove(); // Remove the list item from the DOM

                        // Remove the date from local storage
                        var plannedDates = JSON.parse(localStorage.getItem('plannedDates')) || [];
                        plannedDates = plannedDates.filter(function(item) {
                            return item.date !== selectedDate;
                        });
                        localStorage.setItem('plannedDates', JSON.stringify(plannedDates));
                    });
                    listItem.append(deleteButton); // Append the delete button to the list item
                    $('#dateList').append(listItem);

                    // Save planned dates to local storage
                    var plannedDates = JSON.parse(localStorage.getItem('plannedDates')) || [];
                    plannedDates.push({ date: selectedDate, description: description });
                    localStorage.setItem('plannedDates', JSON.stringify(plannedDates));

                    // Clear form fields
                    $('#datepicker').val('');
                    $('#description').val('');
                } else {
                    alert('Please select a date and provide a description.');
                }
            });

            // Function to load planned dates from local storage
            function loadPlannedDates() {
                var plannedDates = JSON.parse(localStorage.getItem('plannedDates')) || [];
                plannedDates.forEach(function (item) {
                    var listItem = $('<li class="list-group-item">').html('<b>Date:</b> ' + item.date + ' <br> <b>Description:</b> ' + item.description);
                    var deleteButton = $('<button type="button" class="btn btn-danger btn-sm float-right ml-2">Delete</button>').click(function() {
                        listItem.remove(); // Remove the list item from the DOM

                        // Remove the date from local storage
                        var plannedDates = JSON.parse(localStorage.getItem('plannedDates')) || [];
                        plannedDates = plannedDates.filter(function(data) {
                            return data.date !== item.date;
                        });
                        localStorage.setItem('plannedDates', JSON.stringify(plannedDates));
                    });
                    listItem.append(deleteButton); // Append the delete button to the list item
                    $('#dateList').append(listItem);
                });
            }
        });
    </script>
</body>
</html>
