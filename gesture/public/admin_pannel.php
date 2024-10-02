<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/admin.css">
</head>

<body>
    <?php include 'includes/nav_admin.view.php'; ?>
    <?php include 'includes/sidebar_admin.view.php'; ?>

    <div class="main">
        <div class="container-fluid p-4">
            <div class="row g-3">
              
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-people-fill" style="font-size: 2rem; color: green;"></i>
                            <h3>Student's</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-person-fill" style="font-size: 2rem; color: blue;"></i>
                            <h3>Teacher's</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-person-badge-fill" style="font-size: 2rem; color: orange;"></i>
                            <h3>Parent's</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-houses-fill" style="font-size: 2rem; color: teal;"></i>
                            <h3>School's</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-ui-checks-grid" style="font-size: 2rem; color: green;"></i>
                            <h3>Categories</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-file-richtext-fill" style="font-size: 2rem; color: blue;"></i>
                            <h3>Contents</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-question-circle-fill" style="font-size: 2rem; color: orange;"></i>
                            <h3>Quiz</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-file-text-fill" style="font-size: 2rem; color: teal;"></i>
                            <h3>Activity</h3>
                            <p>0</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Fees Collection & Expenses
                    </div>
                    <div class="card-body">
                        <p><i class="bi bi-bar-chart-fill" style="font-size: 2rem;"></i></p>
                        <div class="d-flex justify-content-around">
                            <div>
                                <p class="text-primary">$10,000</p>
                                <p>Collections</p>
                            </div>
                            <div>
                                <p class="text-danger">$8,000</p>
                                <p>Fees</p>
                            </div>
                            <div>
                                <p class="text-warning">$5,000</p>
                                <p>Expenses</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                       <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Notice Board
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>16 May, 2017</strong> - Great School management system simply dummy text</li>
                            <li><strong>16 May, 2017</strong> - Killar Miller said great school management system</li>
                            <li><strong>15 May, 2017</strong> - Jennyfar Lopez said great school system</li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Recent Activities
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-circle-fill text-success"></i> Followed Olivia Williamson 9 mins ago</li>
                            <li><i class="bi bi-circle-fill text-danger"></i> Subscribed to Harold Fuller 20 mins ago</li>
                            <li><i class="bi bi-circle-fill text-primary"></i> Updated your profile picture 30 mins ago</li>
                            <li><i class="bi bi-circle-fill text-warning"></i> Deleted homepage.psd 35 mins ago</li>
                        </ul>
                    </div>
                </div>
            </div>





            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>