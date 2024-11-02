<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Bed Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

header {
    background-color: rgb(114, 144, 214) ;
    color: #fff;
    padding: 10px;
    text-align: center;
}

.header-info {
    display: flex;
    justify-content: space-between;
    padding: 5px;
}

.toolbar {
    background-color: #e6e6e6;
    padding: 10px;
    display: flex;
    gap: 10px;
    align-items: center;
}

.toolbar button, .toolbar select, .toolbar input {
    padding: 5px 10px;
}

.legend {
    display: flex;
    justify-content: space-around;
    padding: 10px;
    background-color: #fff;
}

.status {
    padding: 5px 10px;
    border-radius: 4px;
}

.vacant {
    background-color: green;
    color: white;
}

.occupied {
    background-color: red;
    color: white;
}

.housekeeping {
    background-color: orange;
    color: white;
}

.retain {
    background-color: blue;
    color: white;
}

.blocked {
    background-color: gray;
    color: white;
}

main {
    padding: 20px;
}

.room-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    padding: 10px;
    background-color: #fff;
    margin-bottom: 20px;
}

.room {
    padding: 10px;
    text-align: center;
    border-radius: 4px;
    cursor: pointer;
}

.vacant { background-color: #28a745; }
.occupied { background-color: #dc3545; }
.selected {
    background-color: yellow !important;
    color: black;
}
.vacant {
    background-color: green;
    color: white;
}
</style>
</head>
<body>
    <header>
        <h1>Hospisync</h1>
        <div class="header-info">
            <span>IP Address: 192.168.4.124</span>
            <span>Time: 20/10/2024 17:20</span>
        </div>
    </header>

    <div class="toolbar">
        <button>Bed Status</button>
        <button>Discharge Approval</button>
        <button>Admission Request</button>
        <button>Record Patient Arrival</button>
        <select>
            <option>All Items Checked</option>
        </select>
        <input type="text" placeholder="Search patient">
    </div>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link " aria-current="page" href="Staffinfo/staffinfo.php">Staff Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="../StaffDashboard/doctorpatient2.php">Patients Checklist</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="../StaffDashboard/doctorapprove1.php">Patients Approved</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="../StaffDashboard/prevpatients1.php">Previous Patients Info.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../StaffDashboard/pharma.php">Pharmaceutical Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../opd/main.php">OPD Managment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="Ward/ward.php">Ward Managment</a>
      </li>
      
    </ul>

    <div class="legend">
        <div class="status vacant">Vacant (10%)</div>
        <div class="status occupied">Occupied (25%)</div>
        <div class="status housekeeping">House Keeping</div>
        <div class="status retain">Retain</div>
        <div class="status blocked">Blocked</div>
    </div>

    <main>
        <section>
            <h2>Old Block 2nd Floor PVT Rooms</h2>
            <div class="room-grid">
                <div class="room occupied">PVT-21</div>
                <div class="room occupied">PVT-22</div>
                <div class="room occupied">PVT-23</div>
                <div class="room occupied">PVT-24</div>
                <div class="room occupied">PVT-25</div>
                <div class="room occupied">PVT-26</div>
                <div class="room occupied">PVT-27</div>
            </div>
        </section>

        <section>
            <h2>Old Block 3rd Floor - Day Care</h2>
            <div class="room-grid">
                <div class="room vacant">DC-11</div>
                <div class="room vacant">DC-12</div>
                <div class="room occupied">DC-13</div>
                <div class="room occupied">DC-14</div>
                <div class="room occupied">DC-15</div>
                <div class="room occupied">DC-16</div>
                <div class="room occupied">DC-17</div>
            </div>
        </section>

        <section>
            <h2>Old Block 3rd Floor - General Ward</h2>
            <div class="room-grid">
                <div class="room occupied">GW-011</div>
                <div class="room occupied">GW-012</div>
                <div class="room occupied">GW-013</div>
                <div class="room occupied">GW-014</div>
                <div class="room occupied">GW-015</div>
            </div>
        </section>

        <section>
            <h2>Old Block 3rd Floor - Dialysis Ward</h2>
            <div class="room-grid">
                <div class="room occupied">DIALYSIS-1</div>
                <div class="room occupied">DIALYSIS-2</div>
            </div>
        </section>

        <section>
            <h2>Kailash - Virtual Beds</h2>
            <div class="room-grid">
                <div class="room vacant">RD1</div>
                <div class="room occupied">RD2</div>
            </div>
        </section>
    </main>

    <script>
        document.querySelectorAll('.room').forEach(room => {
    room.addEventListener('click', () => {
        alert(`Room ${room.textContent} clicked!`);
    });
});
document.querySelectorAll('.room').forEach(room => {
    room.addEventListener('click', () => {
        room.classList.toggle('selected');
    });
});
document.querySelectorAll('.room').forEach(room => {
    room.addEventListener('click', () => {
        room.classList.toggle('selected');
    });

    room.addEventListener('dblclick', () => {
        room.classList.remove('selected');
        room.classList.add('vacant');
    });
});

    </script>
</body>
</html>

