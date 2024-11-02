<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$dbname = "hospital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT room_name, status, block_name, patient_name FROM hospital_rooms";
$result = $conn->query($query);

$rooms_by_block = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rooms_by_block[$row['block_name']][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Bed Status</title>
    <link rel="stylesheet" href="Bed.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
    
        <h1>Hospisync</h1>
        <div class="header-info">
            <span>Hospital Managment System</span>
            <span>Time: <?php echo date('d/m/Y H:i'); ?></span>
            <a href="add_room.php">
                <button type="button" class="btn btn-primary">Edit Rooms</button>
            </a>
        </div>
    </header>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="../Doctorinfo/doc.php">Doctor Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../DoctorDashboard/doctorpatient.php">New Appointments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../DoctorDashboard/doctorapprove.php">Patients Checked</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../DoctorDashboard/prevpatients.php">Previous Patients Info.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="../Main_page/main.php">OPD Managment</a>
      </li>
      
    </ul>
    
    <div class="toolbar">
        
        <input type="text" id="searchInput" placeholder="Search patient or room">
    </div>


    <div class="legend">
        <div class="status vacant">Vacant</div>
        <div class="status occupied">Occupied</div>
        <div class="status housekeeping">Housekeeping</div>
        <div class="status retain">Retain</div>
        <div class="status blocked">Blocked</div>
    </div>

    <main>
        <?php foreach ($rooms_by_block as $block_name => $rooms): ?>
        <section>
            <h2><?php echo $block_name; ?></h2>
            <div class="room-grid">
                <?php foreach ($rooms as $room): ?>
                    <div class="room <?php echo $room['status']; ?>" data-room-name="<?php echo $room['room_name']; ?>" data-patient-name="<?php echo $room['patient_name']; ?>" data-status="<?php echo $room['status']; ?>">
                        <strong><?php echo $room['room_name']; ?></strong>
                        <br>
                        <small>
                            <?php echo !empty($room['patient_name']) ? 'Patient: ' . $room['patient_name'] : 'No Patient'; ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </main>

    <div class="modal fade" id="editRoomModal" tabindex="-1" aria-labelledby="editRoomModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editRoomModalLabel">Edit Room Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editRoomForm">
              <div class="mb-3">
                <label for="roomName" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="roomName" name="room_name" readonly>
              </div>
              <div class="mb-3">
                <label for="patientName" class="form-label">Patient Name</label>
                <input type="text" class="form-control" id="patientName" name="patient_name">
              </div>
              <div class="mb-3">
                <label for="roomStatus" class="form-label">Room Status</label>
                <select class="form-control" id="roomStatus" name="status">
                    <option value="Vacant">Vacant</option>
                    <option value="Occupied">Occupied</option>
                    <option value="Housekeeping">Housekeeping</option>
                    <option value="Retain">Retain</option>
                    <option value="Blocked">Blocked</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for search functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchQuery = this.value.toLowerCase();
            const rooms = document.querySelectorAll('.room');

            rooms.forEach(room => {
                const roomName = room.getAttribute('data-room-name').toLowerCase();
                const patientName = room.getAttribute('data-patient-name').toLowerCase();

                if (roomName.includes(searchQuery) || patientName.includes(searchQuery)) {
                    room.style.display = 'block';
                } else {
                    room.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.room').forEach(room => {
            room.addEventListener('click', () => {
                const roomName = room.getAttribute('data-room-name');
                const patientName = room.getAttribute('data-patient-name');
                const roomStatus = room.getAttribute('data-status');

                document.getElementById('roomName').value = roomName;
                document.getElementById('patientName').value = patientName;
                document.getElementById('roomStatus').value = roomStatus;

                var editRoomModal = new bootstrap.Modal(document.getElementById('editRoomModal'));
                editRoomModal.show();
            });
        });

        document.getElementById('editRoomForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(this);

            fetch('update_room.php', {
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
</body>
</html>
