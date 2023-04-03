<?php

if (!isset($_SESSION['kfabfdnf4534tddfnskjfdi'])) {
    session_start();
}
if (isset($_SESSION['kfabfdnf4534tddfnskjfdi'])) {
?>


    <div class="table-responsive mb-4 mt-4">

        <div id="html5-extension_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row justify-content-center ">

                <div class="col-md-12">
                    <table id="html5-extension" class="table table-hover  dataTable  no-footer">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>ID</th>
                                <th>Task Name</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Created At</th>
                                <th class='noExport'>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once('../connection/worker.php');

                            $w = new Worker();

                            $user = $w->query("SELECT * FROM users WHERE id=:id")->bind(['id' => $_SESSION['kfabfdnf4534tddfnskjfdi'][0]['id']])->fetch();

                            $tasks = $w->query("SELECT * FROM tasks WHERE status=:status AND user_id=:user_id ORDER BY id DESC")->bind(['status' => 'active', 'user_id' => $user[0]['id']])->fetch();
                            $a = 1;
                            foreach ($tasks as $row) { ?>
                                <tr>
                                    <td><?php echo $a++; ?></td>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['taskname'] ?></td>
                                    <td><?php echo $row['start_date'] ?></td>
                                    <td><?php echo $row['due_date'] ?></td>
                                    <td>
                                        <span class="badge badge-primary"><?php echo date('jS M, Y', strtotime($row['created_at'])) ?></span>
                                    </td>


                                    <td><button style="padding: 0.2rem 0.5rem;" class="btn btn-warning mb-2 mr-2" onclick="setData(<?php echo $row['id'] ?>,'<?php echo $row['taskname'] ?>','<?php echo $row['start_date']; ?>','<?php echo $row['due_date']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg></button>
                                        <button style="padding: 0.2rem 0.5rem;" class="btn btn-danger mb-2 mr-2" onclick="del(<?php echo $row['id'] ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg></button>
                                    </td>

                                </tr>

                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>



<?php
    // mysqli_close($conn);
} else {
    header('Location:unAuth.php');
}
