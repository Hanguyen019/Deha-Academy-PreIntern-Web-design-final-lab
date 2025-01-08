<?php
include_once "./user.php";
$users=User::all();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CURD</title>
<body>

   
    </head>
  <body>
  <?php

if (isset($_SESSION['user'])) {
    echo "Hello, " . $_SESSION['user']['name'];
    echo "<a href='logout.php'>LogoutLogout</a>";
} else {
    echo "<a href='login.php'>Login</a><br>";
    echo "<a href='register.php'>Register</a>";
}
?>
    <div class ="container">
        <div>
           <h1> Users list</h1>
                   
        <form action="./search.php" method="get" class="d-flex">
          <input type="text" name="search" class="form-control me-2" placeholder="Search by name" required>
          <button type="submit" class="btn btn-primary">Search</button>
        </form>

        </div>
        <?php if(isset($_SESSION['message'])){
        ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <p>
          <?php echo($_SESSION['message']); unset($_SESSION['message']);
        ?>
        </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
      <?php }?>
    <a href="./create.php" class="btn btn-primary">Create</a>
   
    <div>
      <?php
        if (count($users)>0){
      ?>
    <table class="table">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
   foreach ($users as $user){
?> 
    <tr>
      <th scope="row"> <?php echo $user['id']?> </th>
      <td><?php echo $user['name']?></td>
      <td><?php echo $user['email']?></td>
      <td>
        <a href="./show.php?id=<?=$user['id']?>" class ="btn btn-info">Show</a>
        <a href="./edit.php?id=<?=$user['id']?>" class ="btn btn-warning">Edit</a>
      
        <form action="./delete.php" method="post" id="formDelete-<?= $user['id']?>">
         <input type="hidden" name="id" value="<?=$user['id']?>">
        
        <button type="button" class ="btn btn-danger btn-delete" id="<?=$user['id']?>">Delete</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
<?php } else { ?>
<h2>No Data.</h2>
<?php } ?>
   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <script>
    let deleteBtns=document.querySelectorAll('.btn-delete');
    deleteBtns.forEach(function (item){
      item.addEventListener('click',function(event){
        if(confirm('Delete user')){
     let id=this.getAttribute('id');
     document.querySelector('#formDelete-'+id).submit();
        }  
    })
    })
  </script>

  </body>
</html>