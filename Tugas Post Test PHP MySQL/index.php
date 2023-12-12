<?php
// Memanggil file interkoneksi database
require('connect.php');

function getDataById($con, $id)
{
  $query = "SELECT * FROM loginpage WHERE id = $id";
  $result = mysqli_query($con, $query);
  return mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['action']) && $_POST['action'] === 'tambah') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO loginpage (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $query);

    if ($result) {
      header("Location: " . $_SERVER['PHP_SELF']);
    } else {
      echo "Error: " . mysqli_error($con);
    }
  } elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE loginpage SET username = '$username', password = '$password' WHERE id = $id";
    $result = mysqli_query($con, $query);

    if ($result) {
      header("Location: " . $_SERVER['PHP_SELF']);
    } else {
      echo "Error: " . mysqli_error($con);
    }
  }
}

$query = "SELECT * FROM loginpage";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
  </style>
</head>

<body>
  <h2>Tambah Users</h2>
  <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="text" name="password" required>
    <input type="hidden" name="action" value="tambah">
    <input type="submit" value="Tambah">
  </form>

  <h2>Data Users</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Password</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['password']; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <?php
  if (isset($_POST['edit'])) {
    $editId = $_POST['id'];
    $data = getDataById($conn, $editId);
    // Display your edit form or other actions here
  }
  ?>
</body>

</html>