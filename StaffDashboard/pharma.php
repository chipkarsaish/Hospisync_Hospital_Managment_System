<?php
include('../database.php'); // Include your database connection file

$query = "SELECT id, name, barcode, vendor, category, quantity FROM pharmaceuticals;";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../Images/logo.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
          HospiSync
        </a>
      </div>
    </nav>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link " aria-current="page" href="../Staffinfo/staffinfo.php">Staff Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="doctorpatient2.php">Patients Checklist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="doctorapprove1.php">Patients Approved</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="prevpatients1.php">Previous Patients Info.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="pharma.php">Pharmaceutical Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../opd/main.php">OPD Managment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../Ward/ward.php">Ward Managment</a>
      </li>
      
    </ul>
    <br>
    <button class="btn btn-primary" onclick="showAddForm()">Add New Pharmaceutical</button>
    <br>
    <table class="table table-striped-columns">
        <tr>
            <th>Name</th>
            <th>Barcode</th>
            <th>Vendor</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
        while($row = mysqli_fetch_assoc($result))
        {
        ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['barcode']; ?></td>
            <td><?php echo $row['vendor']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <button class="btn btn-success" onclick="showUpdateForm(<?php echo $row['id']; ?>)">Update</button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <!-- Add Form Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add New Pharmaceutical</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addForm">
              <div class="mb-3">
                <label for="addName" class="form-label">Name</label>
                <input type="text" class="form-control" id="addName" name="name" required>
              </div>
              <div class="mb-3">
                <label for="addBarcode" class="form-label">Barcode</label>
                <input type="text" class="form-control" id="addBarcode" name="barcode" required>
              </div>
              <div class="mb-3">
                <label for="addVendor" class="form-label">Vendor</label>
                <input type="text" class="form-control" id="addVendor" name="vendor" required>
              </div>
              <div class="mb-3">
                <label for="addCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="addCategory" name="category" required>
              </div>
              <div class="mb-3">
                <label for="addQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="addQuantity" name="quantity" required>
              </div>
              <button type="submit" class="btn btn-primary">Add Pharmaceutical</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Update Form Modal -->
    <!-- Add Form Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add New Pharmaceutical</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addForm">
          <div class="mb-3">
            <label for="addName" class="form-label">Name</label>
            <input type="text" class="form-control" id="addName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="addBarcode" class="form-label">Barcode</label>
            <input type="text" class="form-control" id="addBarcode" name="barcode" required>
          </div>
          <div class="mb-3">
            <label for="addVendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="addVendor" name="vendor" required>
          </div>
          <div class="mb-3">
            <label for="addCategory" class="form-label">Category</label>
            <input type="text" class="form-control" id="addCategory" name="category" required>
          </div>
          <div class="mb-3">
            <label for="addQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="addQuantity" name="quantity" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Pharmaceutical</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Update Form Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Pharmaceutical</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateForm">
          <input type="hidden" id="pharmaceuticalId" name="pharmaceuticalId">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="barcode" class="form-label">Barcode</label>
            <input type="text" class="form-control" id="barcode" name="barcode" required>
          </div>
          <div class="mb-3">
            <label for="vendor" class="form-label">Vendor</label>
            <input type="text" class="form-control" id="vendor" name="vendor" required>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
          </div>
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
          </div>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <script>
        function showAddForm() {
            var addModal = new bootstrap.Modal(document.getElementById('addModal'));
            addModal.show();
        }

        function showUpdateForm(pharmaceuticalId) {
            // Set the pharmaceutical ID in the hidden input field
            document.getElementById('pharmaceuticalId').value = pharmaceuticalId;
            // Show the modal
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();
        }

        document.getElementById('addForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    fetch('add_pharmaceutical.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // This should now show the server response
        location.reload();
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    fetch('update_pharmaceutical.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // This should now show the server response
        location.reload();
    })
    .catch(error => console.error('Error:', error));
});

        document.getElementById('updateForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            fetch('update_pharmaceutical.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

