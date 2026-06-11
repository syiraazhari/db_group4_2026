<?php
session_start();

// file utk register a NEW VEHICLE, ADD, UPDATE, DELETE semue ADA
if (!isset($_SESSION['vehicles'])) {
    $_SESSION['vehicles'] = []; // Zero mock data. Totally blank until the user adds one.
}

// Handle Form Submission (Add Vehicle)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $new_vehicle = [
        'id' => time(),
        'nickname' => htmlspecialchars($_POST['nickname']),
        'make' => htmlspecialchars($_POST['make']),
        'model' => htmlspecialchars($_POST['model']),
        'year' => htmlspecialchars($_POST['year']),
        'plate' => strtoupper(htmlspecialchars($_POST['plate'])),
        'next_service' => '10,000 km' // Default rule for fresh user entries
    ];
    
    $_SESSION['vehicles'][] = $new_vehicle;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle Vehicle Deletion
if (isset($_GET['delete'])) {
    $id_to_delete = intval($_GET['delete']);
    foreach ($_SESSION['vehicles'] as $key => $vehicle) {
        if ($vehicle['id'] === $id_to_delete) {
            unset($_SESSION['vehicles'][$key]);
        }
    }
    $_SESSION['vehicles'] = array_values($_SESSION['vehicles']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - My Vehicles</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <h1 class="fw-bold text-dark m-0">My Vehicles</h1>
                <p class="text-muted small m-0 mt-1">Manage your registered cars and book swift services.</p>
            </div>
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                <i class="bi bi-plus-lg"></i> Register New Vehicle
            </button>
        </div>

        <?php if (empty($_SESSION['vehicles'])): ?>
            <div class="card shadow-sm text-center mx-auto my-5 p-5" style="max-width: 500px;">
                <div class="card-body">
                    <div class="text-muted mb-3">
                        <i class="bi bi-car-front" style="font-size: 3rem;"></i>
                    </div>
                    <h4 class="fw-semibold text-secondary">No Vehicles Registered</h4>
                    <p class="text-muted mb-4">Add your car details now to quickly secure appointments and monitor car health history.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Add Your First Car</button>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($_SESSION['vehicles'] as $vehicle): ?>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 shadow-sm border-light-subtle">
                            <div class="card-body d-flex flex-column justify-content-between p-4">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <span class="badge bg-primary-subtle text-primary text-uppercase px-2.5 py-1.5 rounded-pill font-monospace small"><?php echo $vehicle['make']; ?></span>
                                            <h3 class="h5 fw-bold text-dark mt-2 mb-1"><?php echo $vehicle['nickname']; ?></h3>
                                        </div>
                                        <a href="?delete=<?php echo $vehicle['id']; ?>" onclick="return confirm('Remove this vehicle?')" class="text-secondary link-danger" title="Delete Vehicle">
                                            <i class="bi bi-trash3 fs-5"></i>
                                        </a>
                                    </div>

                                    <p class="text-muted small mb-3"><?php echo $vehicle['make'] . ' ' . $vehicle['model'] . ' (' . $vehicle['year'] . ')'; ?></p>
                                    
                                    <div class="row g-2 bg-light rounded p-3 mb-3 text-center">
                                        <div class="col-6 text-start border-end">
                                            <span class="d-block text-muted text-uppercase small fw-bold" style="font-size: 0.75rem;">Plate Number</span>
                                            <span class="font-monospace fw-bold text-dark tracking-wider"><?php echo $vehicle['plate']; ?></span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 mb-4 small text-muted">
                                        <span class="p-1 rounded-circle bg-warning"></span>
                                        <span>Next Service: <strong class="text-dark"><?php echo $vehicle['next_service']; ?></strong></span>
                                    </div>
                                </div>

                                <div class="row g-2 pt-3 border-top mt-auto">
                                    <div class="col-6">
                                        <a href="addBooking.php" class="btn btn-primary w-100 btn-sm py-2 shadow-sm">Book Service</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="addVehicleModalLabel">Register Vehicle Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="modal-body p-4">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Vehicle Nickname</label>
                            <input type="text" name="nickname" placeholder="e.g., My Daily Myvi" required class="form-control form-control-sm py-2">
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Make / Brand</label>
                                <select name="make" required class="form-select form-select-sm py-2">
                                    <option value="Perodua">Perodua</option>
                                    <option value="Proton">Proton</option>
                                    <option value="Honda">Honda</option>
                                    <option value="Toyota">Toyota</option>
                                    <option value="Nissan">Nissan</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Model Variant</label>
                                <input type="text" name="model" placeholder="e.g., Civic 1.5 VTEC" required class="form-control form-control-sm py-2">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Year Produced</label>
                                <input type="number" name="year" min="2000" max="2027" placeholder="2022" required class="form-control form-control-sm py-2">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-secondary">Plate Number</label>
                                <input type="text" name="plate" placeholder="e.g., WYY 9999" required class="form-control form-control-sm py-2">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm px-3 py-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3 py-2">Save Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>