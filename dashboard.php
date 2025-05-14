<?php
// Start the session and include the database configuration.
session_start();
include "config.php";

// Redirect to login if the user is not authenticated.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Process form submissions based on a hidden "action" field.
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action === "add") {
        // -- Add a new contact --
        $name      = trim($_POST["name"]);
        $email     = trim($_POST["email"]);
        $phone     = trim($_POST["phone"]);
        $company   = trim($_POST["company"]);
        $job_title = trim($_POST["job_title"]);
        $birthday  = trim($_POST["birthday"]);
        $tags      = trim($_POST["tags"]);
        $notes     = trim($_POST["notes"]);
        $address   = trim($_POST["address"]);
        $user_id   = $_SESSION["user_id"];

        // Ensure required fields are filled.
        if ($name && $email && $phone) {
            $sql  = "INSERT INTO contacts (user_id, name, email, phone, company, job_title, birthday, tags, notes, address, created_at)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            // "i" represents integer, while "s" represents string.
            $stmt->bind_param("isssssssss", $user_id, $name, $email, $phone, $company, $job_title, $birthday, $tags, $notes, $address);
            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<script>alert('Error adding contact: " . $stmt->error . "');</script>";
            }
        }
    } elseif ($action === "delete") {
        // -- Delete a contact --
        $delete_id = $_POST["delete_id"];
        $sql       = "DELETE FROM contacts WHERE id = ?";
        $stmt      = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Error deleting contact: " . $stmt->error . "');</script>";
        }
    } elseif ($action === "edit") {
        // -- Edit an existing contact --
        $edit_id   = $_POST["edit_id"];
        $name      = trim($_POST["edit_name"]);
        $email     = trim($_POST["edit_email"]);
        $phone     = trim($_POST["edit_phone"]);
        $company   = trim($_POST["edit_company"]);
        $job_title = trim($_POST["edit_job_title"]);
        $birthday  = trim($_POST["edit_birthday"]);
        $tags      = trim($_POST["edit_tags"]);
        $notes     = trim($_POST["edit_notes"]);
        $address   = trim($_POST["edit_address"]);

        // Ensure required fields are filled.
        if ($name && $email && $phone) {
            $sql  = "UPDATE contacts 
                     SET name = ?, email = ?, phone = ?, company = ?, job_title = ?, birthday = ?, tags = ?, notes = ?, address = ?
                     WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssi", $name, $email, $phone, $company, $job_title, $birthday, $tags, $notes, $address, $edit_id);
            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<script>alert('Error updating contact: " . $stmt->error . "');</script>";
            }
        }
    }
}

// Retrieve contacts for the logged-in user.
$user_id = $_SESSION["user_id"];
$result  = $conn->query("SELECT * FROM contacts WHERE user_id = $user_id");
if (! $result) {
  die("MySQL error in SELECT: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
        }
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body class="p-5 bg-light text-dark">
    <div class="theme-toggle">
        <button id="toggleTheme" class="btn btn-secondary"> 🌙 </button>
    </div>

    <div class="container">
        <h1 class="mb-4">Welcome, <?php echo $_SESSION["user_name"]; ?>!</h1>
        <a href="logout.php" class="btn btn-danger mb-4">Logout</a>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Contacts</h2>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContactModal">Add Contact</button>
            </div>
            <div class="card-body">
                <table id="contactsTable" class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Job Title</th>
                            <th>Birthday</th>
                            <th>Tags</th>
                            <th>Notes</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["email"]); ?></td>
                            <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                            <td><?php echo htmlspecialchars($row["company"]); ?></td>
                            <td><?php echo htmlspecialchars($row["job_title"]); ?></td>
                            <td><?php echo htmlspecialchars($row["birthday"]); ?></td>
                            <td><?php echo htmlspecialchars($row["tags"]); ?></td>
                            <td><?php echo htmlspecialchars($row["notes"]); ?></td>
                            <td><?php echo htmlspecialchars($row["address"]); ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editContactModal"
                                    onclick="setEditData(
                                        '<?php echo $row['id']; ?>',
                                        '<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['phone'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['company'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['job_title'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['birthday'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['tags'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['notes'], ENT_QUOTES); ?>',
                                        '<?php echo htmlspecialchars($row['address'], ENT_QUOTES); ?>'
                                    )">Edit</button>

                                <form method="POST" style="display:inline-block;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Contact Modal -->
    <div class="modal fade" id="addContactModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST">
          <input type="hidden" name="action" value="add">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Contact</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
              <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
              <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
              <input type="text" name="company" class="form-control mb-2" placeholder="Company">
              <input type="text" name="job_title" class="form-control mb-2" placeholder="Job Title">
              <input type="date" name="birthday" class="form-control mb-2">
              <input type="text" name="tags" class="form-control mb-2" placeholder="Tags">
              <textarea name="notes" class="form-control mb-2" placeholder="Notes"></textarea>
              <input type="text" name="address" class="form-control mb-2" placeholder="Address">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save Contact</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Contact Modal -->
    <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="edit_id" id="edit_id">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Contact</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="edit_name" id="edit_name" class="form-control mb-2" required>
              <input type="email" name="edit_email" id="edit_email" class="form-control mb-2" required>
              <input type="text" name="edit_phone" id="edit_phone" class="form-control mb-2" required>
              <input type="text" name="edit_company" id="edit_company" class="form-control mb-2">
              <input type="text" name="edit_job_title" id="edit_job_title" class="form-control mb-2">
              <input type="date" name="edit_birthday" id="edit_birthday" class="form-control mb-2">
              <input type="text" name="edit_tags" id="edit_tags" class="form-control mb-2">
              <textarea name="edit_notes" id="edit_notes" class="form-control mb-2"></textarea>
              <input type="text" name="edit_address" id="edit_address" class="form-control mb-2" placeholder="Address">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-warning">Update Contact</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#contactsTable').DataTable({
    columnDefs: [
        { orderable: false, targets: -1 } // Disable sorting for the last column (Actions)
    ]
});

        });

        function setEditData(id, name, email, phone, company, job_title, birthday, tags, notes, address) {
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_email").value = email;
            document.getElementById("edit_phone").value = phone;
            document.getElementById("edit_company").value = company;
            document.getElementById("edit_job_title").value = job_title;
            document.getElementById("edit_birthday").value = birthday;
            document.getElementById("edit_tags").value = tags;
            document.getElementById("edit_notes").value = notes;
            document.getElementById("edit_address").value = address;
        }

        document.getElementById("toggleTheme").addEventListener("click", function () {
            const htmlEl = document.documentElement;
            const isDark = htmlEl.getAttribute("data-bs-theme") === "dark";
            htmlEl.setAttribute("data-bs-theme", isDark ? "light" : "dark");
            document.body.classList.toggle("bg-light", isDark);
            document.body.classList.toggle("text-dark", isDark);
            document.body.classList.toggle("bg-dark", !isDark);
            document.body.classList.toggle("text-light", !isDark);
        });
    </script>
</body>
</html>
