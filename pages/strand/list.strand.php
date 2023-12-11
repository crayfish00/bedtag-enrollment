<?php
require '../../includes/session.php';

if (isset($_POST['grade_level'])) {
    $grade_level = $_POST['grade_level'];
} else {
    $grade_level = 'Nursery';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Strand List | BED Taguig</title>

  <?php include '../../includes/links.php'; ?>

</head>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include '../../includes/navbar.php' ?>

    <?php include '../../includes/sidebar.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Strand List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"></a></li>
                <li class="breadcrumb-item active"></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Strand List</h3>
            <div class="card-tools">
            </div>
          </div>
          <div class="card-body">
            <form method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control select2 select2-info custom-select" data-dropdown-css-class="select2-info" data-placeholder="Select Grade Level" name="grade_level" required>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * from tbl_strands WHERE strand_name = '$strand_name'");
                                    while ($row2 = mysqli_fetch_array($query)) {
                                        echo '<option selected value="' . $row2['strand_name'] . '">' . $row2['strand_name'] . '</option>';
                                    }
                                    ?>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * from tbl_grade_levels WHERE strand_name NOT IN ('$strand_name') AND strand_id NOT IN ('$strand_id')");
                                    while ($row2 = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $row2['strand_name'] . '">' . $row2['strand_name'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>Strand</th>
                    <th>Strand Description</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $get_strands = mysqli_query($conn, "SELECT * FROM tbl_strands") or die(mysqli_error($conn));
                    while ($row = mysqli_fetch_array($get_strands)) {
                ?>
                <tr>
                    <td><?php echo $row['strand_def']; ?></td>
                    <td><?php echo $row['strand_name']; ?></td>
                  <td>
                    <a type="button" href="edit.strand.php?strand_id=<?php echo $row['strand_id']; ?>" class="btn btn-primary btn-sm m-1">
                      Edit
                    </a>
                    <button class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modal-md<?php echo $row['strand_id']; ?>">Delete</button>
                    
                  </td>
                </tr>
                <!-- Modal for grade input -->
                <div class="modal fade" id="modal-md<?php echo $row['strand_id']; ?>">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-danger"><b>Delete strand</b></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div class="modal-body">
                            <div class="row justify-content-center">
                              <div class="col-sm-12">
                                <div class="form-group">
                                    <p>Are you sure you want to delete <b><?php echo $row['strand_name'] .' '. $row['strand_def']; ?></b>?</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a href="userData/ctrl.del.strand.php?strand_id=<?php echo $row['strand_id'];?>" type="submit" name="submit" class="btn btn-danger">Delete</a>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php
                    }
                ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer"></div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include '../../includes/footer.php'; ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php include '../../includes/script.php'; ?>
</body>

</html>