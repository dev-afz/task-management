<?php

if (!isset($_SESSION['kfabfdnf4534tddfnskjfdi'])) {
    session_start();
}

if (isset($_SESSION['kfabfdnf4534tddfnskjfdi'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard Admin</title>
        <!-- plugins:css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/vendors/feather/feather.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.5.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-3.2.5.min.css" rel="stylesheet">

        <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <?php include 'layouts/navbar.php'; ?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include 'layouts/sidebar.php'; ?>
                <!-- partial -->

                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-12 col-12">
                            <div class="card">
                                <div class="widget-header card-header ">
                                    <div class="row">
                                        <div class="col-lg-6 col-6">
                                            <div class="card-title">Task Management</div>
                                        </div>
                                        <div class="col-lg-6 col-6 text-right">
                                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#addTask" aria-controls="addTaskLabel">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="taskTable"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->


                <!--Add task modal-->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="addTask" aria-labelledby="addTask">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form id="add-task" method="post">
                            <div class="row form-group">
                                <div class="col-lg-12 col-12">
                                    <label for="taskname">Task Name</label>
                                    <input type="text" name="taskname" class="form-control" placeholder="Enter task name" required>
                                </div>
                                <div class="col-lg-12 col-12">
                                    <label for="taskname">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" id="start_date" placeholder="Select start date">
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="date" id="datepicker">
                                        <label for="taskname">Due Date</label>
                                        <input type="date" name="due_date" class="form-control" id="due_date" placeholder="Select start date">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 text-center mt-2">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Add task modal-->
                <!--Edit task modal-->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="editTask" aria-labelledby="editTask">
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Offcanvas right</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form id="updateTask" method="post">
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row form-group">
                                <div class="col-lg-12 col-12">
                                    <label for="taskname">Task Name</label>
                                    <input type="text" name="taskname" id="edit-taskname" class="form-control" placeholder="Enter task name">
                                </div>
                                <div class="col-lg-12 col-12">
                                    <label for="taskname">Start Date</label>
                                    <input type="date" name="start_date" id="edit-start_date" class="form-control" id="start_date" placeholder="Select start date">
                                </div>
                                <div class="col-lg-12 col-12">
                                    <div class="date" id="datepicker">
                                        <label for="taskname">Due Date</label>
                                        <input type="date" name="due_date" id="edit-due_date" class="form-control" id="due_date" placeholder="Select start date">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 text-center mt-2">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--Edit task modal-->
                <!-- partial:partials/_footer.html -->
                <?php include 'layouts/footer.php'; ?>


                <script>
                    $(document).ready(function() {
                        OnloadFunction();
                    });
                    $('#add-task').submit(function(e) {
                        e.preventDefault();

                        var form = $('#add-task')[0];
                        var formData = new FormData(form);
                        $.ajax({
                            url: "ajax/addTask.php",
                            data: formData,
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            success: function(data) {
                                console.log(data);
                                Notiflix.Notify.success('Task added successfully');
                                $("#add-task").trigger('reset');
                                $('#addTask').offcanvas('hide');
                                OnloadFunction();
                            },
                            error: function(xhr, status, error) {
                                if (xhr.status === 422) {
                                    console.log(xhr);
                                    $.each(xhr.responseJSON, function(key, item) {
                                        Notiflix.Notify.failure(item[0]);
                                        // $('#' + key).addClass('is-invalid');
                                        console.log(item);
                                    });
                                } else if (xhr.status == 500) {
                                    Notiflix.Notify.failure(error);
                                } else {
                                    Notiflix.Notify.failure(error);
                                }
                            }
                        });

                    });

                    function setData(id, taskname, start_date, due_date) {
                        // const modal = $('#editTaskk');
                        $('#id').val(id);
                        $('#edit-taskname').val(taskname);
                        $('#edit-start_date').val(start_date);
                        $('#edit-due_date').val(due_date);

                        $('#editTask').offcanvas('show');
                    }

                    $("#updateTask").submit(function(e) {

                        var form1 = $('#updateTask')[0];
                        var formData1 = new FormData(form1);
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            url: 'ajax/updateTask.php',
                            data: formData1,
                            success: function(data) {
                                console.log(data);
                                Notiflix.Notify.success('Task updated successfully');
                                $("#updateTask").trigger('reset');
                                OnloadFunction();
                                $('#editTask').offcanvas('hide');
                            },
                            error: function(xhr, status, error) {
                                if (xhr.status === 422) {
                                    console.log(xhr);
                                    $.each(xhr.responseJSON, function(key, item) {
                                        Notiflix.Notify.failure(item[0]);
                                        // $('#' + key).addClass('is-invalid');
                                        console.log(item);
                                    });
                                } else if (xhr.status == 500) {
                                    Notiflix.Notify.failure(error);
                                } else {
                                    Notiflix.Notify.failure(error);
                                }
                            }
                        });


                    });


                    function del(id) {

                        const swalWithBootstrapButtons = swal.mixin({
                            confirmButtonClass: 'btn btn-success btn-rounded',
                            cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                            buttonsStyling: false,
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true,
                            padding: '2em'
                        }).then((result) => {
                            if (result.value) {
                                deleteTask(id, 'tasks')
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            } else if (
                                // Read more about handling dismissals
                                result.dismiss === swal.DismissReason.cancel
                            ) {
                                swalWithBootstrapButtons(
                                    'Cancelled',
                                    'Your data is safe :)',
                                    'error',
                                )
                            }
                        })
                    }

                    function deleteTask(id, tableName) {
                        $.ajax({
                            type: "post",
                            url: "ajax/deleteTask.php",
                            data: {
                                id: id,
                                tableName: tableName,
                            },
                            success: function(data) {
                                console.log(data);
                                OnloadFunction();
                            },
                            error: function(data) {}
                        });
                    }


                    function OnloadFunction() {
                        $('#taskTable').html('<div class="text-center"><div class="spinner-border text-danger  align-self-center"></div></div>');
                        $.ajax({
                            type: "POST",
                            url: "ajax/taskTable.php",
                            data: {},
                            success: function(data) {
                                $('#taskTable').html(data);
                                //snb('loaded');
                            },
                            error: function(data) {}
                        });
                    }
                </script>
    </body>

    </html>
<?php
    // mysqli_close($conn);
} else {
    header('Location: unAuth.php');
} ?>