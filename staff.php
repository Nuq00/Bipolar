<?php
include_once 'db3.php';
include_once 'session.php';
if ($category != 'Admin') {
    echo '<script type="text/javascript">window.location.href = "restricted.php";</script>';
    exit;
}

if (isset($_POST['submit'])) {

    try {
        $sid = strtolower($_POST['sid']);
        $sname = $_POST['sname'];
        $semail = $_POST['semail'];
        $spassword = $_POST['spassword'];
        $scategory = $_POST['scategory'];
        $contact = $_POST['contact'];

        $stmtCheck = $conn->prepare("SELECT * FROM user_data WHERE fld_userID = :sid");
        $stmtCheck->bindParam(':sid', $sid);
        $stmtCheck->execute();
        $user = $stmtCheck->fetch();
        if ($user) {
            $message = 'Matric Number already in use';
        } else {
            $stmt = $conn->prepare("INSERT INTO user_data (fld_userID,
     fld_username,fld_email,fld_password,fld_category,fld_contact) VALUES(:sid, :sname,:semail,:spassword,:scategory,:contact)");

            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
            $stmt->bindParam(':sname', $sname, PDO::PARAM_STR);
            $stmt->bindParam(':semail', $semail, PDO::PARAM_STR);
            $stmt->bindParam(':spassword', $spassword, PDO::PARAM_STR);
            $stmt->bindParam(':scategory', $scategory, PDO::PARAM_STR);
            $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);

            $stmt->execute();

            echo '<script type="text/javascript">window.location.href = "staff.php";</script>';
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if (isset($_POST['rm-btn'])) {
    try {
        $user_id = $_POST['user_id']; // Assuming you have a hidden input field for user_id in your HTML form

        // Delete the corresponding row from the counselling table
        $stmt = $conn->prepare("DELETE FROM user_data WHERE fld_userID = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Redirect to the same page after successful deletion
        echo '<script type="text/javascript">window.location.href = "staff.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if (isset($_POST['edit-btn'])) {
    try {
        $user_id = $_POST['user_id'];

        $stmtEdit = $conn->prepare('SELECT * FROM user_data WHERE fld_userID = :user_id');
        $stmtEdit->bindParam(':user_id', $user_id);
        $stmtEdit->execute();
        $edit = $stmtEdit->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['update'])) {
    // Update staff record
    try {
        $sid = $_POST['sid'];
        $sname = $_POST['sname'];
        $semail = $_POST['semail'];
        $spassword = $_POST['spassword'];
        $scategory = $_POST['scategory'];
        $contact = $_POST['contact'];

        $stmt = $conn->prepare("UPDATE user_data SET fld_username = :sname, fld_email = :semail, fld_password = :spassword, fld_category = :scategory, fld_contact = :contact WHERE fld_userID = :sid");

        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
        $stmt->bindParam(':sname', $sname, PDO::PARAM_STR);
        $stmt->bindParam(':semail', $semail, PDO::PARAM_STR);
        $stmt->bindParam(':spassword', $spassword, PDO::PARAM_STR);
        $stmt->bindParam(':scategory', $scategory, PDO::PARAM_STR);
        $stmt->bindParam(':contact', $contact, PDO::PARAM_STR);

        $stmt->execute();

        // Redirect to the same page after successful update
        echo '<script type="text/javascript">window.location.href = "staff.php";</script>';
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<html lang="en">

<head>
    <?php include_once 'head.php'; ?>
</head>

<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register New Staff</h3>
                        <form method="post">

                            <div class=" form-outline mb-3">
                                <input type="text" class="form-control" id="sname" name="sname" required value="<?php if (isset($edit)) echo $edit['fld_username']; ?>">
                                <label for="sname" class="form-label">Name</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input type="text" pattern="[A-Za-z`][0-9]{6}" class="form-control text-uppercase" id="sid" name="sid" required value="<?php if (isset($edit)) echo $edit['fld_userID']; ?>">
                                <label for="sid" class="form-label">Matric Number</label>

                            </div>
                            <div class="form-outline mb-3">
                                <input type="email" class="form-control" id="semail" name="semail" required value="<?php if (isset($edit)) echo $edit['fld_email']; ?>">
                                <label for="semail" class="form-label">Email</label>

                            </div>
                            <div class="form-outline mb-3">
                                <input type="password" class="form-control" id="spassword" name="spassword" required value="<?php if (isset($edit)) echo $edit['fld_password']; ?>">
                                <label for="spassword" class="form-label">Password</label>

                            </div>
                            <div class="form-outline mb-3">
                                <input type="text" class="form-control" id="contact" name="contact" required value="<?php if (isset($edit)) echo $edit['fld_contact']; ?>">
                                <label for="contact" class="form-label">Contact</label>

                            </div>
                            <div class="mb-3">
                                <select class="form-select" id="scategory" name="scategory" required>
                                    <option selected disabled value="">Choose Staff position</option>
                                    <option value="Admin" <?php if (isset($edit) && $edit['fld_category'] == 'Admin') echo 'selected'; ?>>Admin</option>
                                    <option value="Counsellor" <?php if (isset($edit) && $edit['fld_category'] == 'Counsellor') echo 'selected'; ?>>Counsellor</option>
                                </select>
                            </div>
                            <?php if (isset($message)) {
                                echo
                                '<div class="alert alert-danger alert-dismissible fade show mb-3 text-center" role="alert">'
                                    . $message . '</div>';
                            } ?>

                            <div class="d-grid gap-2 mt-4">
                                <?php if (isset($edit)) { ?>
                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                                <?php } else { ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <?php }
                                ?>
                                <button type="reset" class="btn btn-secondary">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            try {
                $stmtStaff = $conn->prepare("SELECT * FROM user_data WHERE fld_category!='Client'");
                $stmtStaff->execute();
                $staffData = $stmtStaff->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Error:   ' . $e->getMessage();
            }
            ?>
            <div class="my-5 shadow-4 rounded-3 py-3" style="background-color:white;">
                <table id="staffTable" class="table table-striped table-bordered py-2">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Position</th>
                            <th>Contact</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($staffData as $staff) { ?>
                            <tr>
                                <td><?php echo $staff['fld_userID'] ?></td>
                                <td><?php echo $staff['fld_username'] ?></td>
                                <td><?php echo $staff['fld_email'] ?></td>
                                <td><?php echo $staff['fld_password'] ?></td>
                                <td><?php echo $staff['fld_category'] ?></td>
                                <td><?php echo $staff['fld_contact'] ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $staff['fld_userID']; ?>">
                                        <?php if ($staff['fld_category'] != 'Admin') { ?>
                                            <button class="btn btn-sm btn-primary" name="edit-btn">Edit</button>
                                            <button class="btn btn-sm btn-danger" name="rm-btn">Delete</button>
                                        <?php } ?>

                                    </form>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include_once 'script.php'; ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#staffTable').DataTable();
        });
    </script>
</body>

</html>