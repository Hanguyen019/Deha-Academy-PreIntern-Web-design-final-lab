<?php
include_once "./user.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$users = User::search($search); // Sử dụng phương thức tìm kiếm trong lớp User
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Search Results</title>
  </head>
  <body>
    <div class="container mt-4">
      <h1>Search Results</h1>
      <p>Search keyword: <strong><?php echo htmlspecialchars($search); ?></strong></p>
      
      <div class="mt-4">
        <?php if (count($users) > 0) { ?>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user) { ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['name']; ?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td>
                    <a href="./show.php?id=<?php echo $user['id']; ?>" class="btn btn-info">Show</a>
                    <a href="./edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <p>No results found for "<?php echo htmlspecialchars($search); ?>".</p>
        <?php } ?>
      </div>
      
      <a href="./index.php" class="btn btn-secondary">Back to Users</a>
    </div>
  </body>
</html>
