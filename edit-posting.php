<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Sosmed Native!</title>
  </head>
  <body class="background">
  <?php
    session_start();
    if (empty($_SESSION['login'])) {
        echo "<script>window.location.href = 'login.php'</script>";
    }
    include "koneksi.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $post = mysqli_query($koneksi,"SELECT * FROM post WHERE id=$id") or die(mysqli_error($koneksi));
        $post = mysqli_fetch_assoc($post);
    }
    if(isset($_POST['caption'])){
      $id = $_GET['id'];
      $caption = $_POST['caption'];
      if(isset($_FILES['photo'])){
          echo "test";
        $photo = $_FILES['photo'];
        $rand = rand();
        $ekstensi =  array('png','jpg','jpeg','gif');
        $filename = $_FILES['photo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
        if(!in_array($ext,$ekstensi) ) {
          echo "<script>alert('Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif')</script>";
        }else{
          $xx = $rand.'_'.$filename;
          move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$rand.'_'.$filename);
          mysqli_query($koneksi, "UPDATE post SET photo='images/$xx', caption='$caption' WHERE id=$id");
          echo "<script>alert('Berhasil Memposting Photo')</script>";
          echo "<script>window.location.href = 'profile.php'</script>";
        }
      }else{
        mysqli_query($koneksi, "UPDATE post SET caption='$caption' WHERE id=$id");
        echo "<script>alert('Berhasil Memposting Photo')</script>";
        echo "<script>window.location.href = 'profile.php'</script>";
      }

    }
    ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sosmed Native</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="tambah-posting.php">Posting</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <h3 class="text-center mt-5 text-primary">Edit Post!</h3>
  <div class="col-12 col-md-6 offset-md-3 mt-5">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="photo" class="col-sm-2 col-form-label">Photo</label>
            <div class="col-sm-10">
            <input type="file" class="form-control" id="photo" name="photo">
            </div>
        </div>
        <div class="row mb-3">
            <label for="caption" class="col-sm-2 col-form-label">Caption</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="caption" rows="3" name="caption"><?= $post['caption'] ?></textarea>
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-block btn-primary">Posting</button>
        </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>