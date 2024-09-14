<?php
if (!empty($errorMessage)) {
    echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Gender</label>
        <div class="col-sm-6">
            <?php
            if ($gender == "M") echo "<input type='radio' name='gender' value='M' checked>Male<br>";
            else echo "<input type='radio' name='gender' value='M'>Male<br>";
            if ($gender == "F") echo "<input type='radio' name='gender' value='F' checked>Female<br>";
            else echo "<input type='radio' name='gender' value='F'>Female<br>";
            ?>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Start Working Date</label>
        <div class="col-sm-6">
            <?php echo $date; ?>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Department</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="department" value="<?php echo $department; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Position</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Working Status</label>
        <div class="col-sm-6">
            <?php
            if ($status == "1") echo "<input type='radio' name='status' value='1' checked>Working<br>";
            else echo "<input type='radio' name='status' value='1'>Working<br>";
            if ($status == "0") echo "<input type='radio' name='status' value='0' checked>Not Working<br>";
            else echo "<input type='radio' name='status' value='0'>Not Working<br>";
            ?>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">IMAGE</label>
        <div class="col-sm-6">
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" onchange="displayImage(this);">
        </div>
    </div>

    <!-- <?php
            if (!empty($successMessage)) {
                echo "
        <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            </div>
        </div>
    ";
            }
            ?> -->

    <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
            <a class="btn btn-outline-primary" href="/hr_management/index.php" role="button">Go back</a>
        </div>
    </div>
</form>