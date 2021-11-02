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

    $id_users = $_SESSION['id_users'];
    $posts=mysqli_query($koneksi,"SELECT * FROM post JOIN users ON post.id_user = users.id_users where id_users=$id_users") or die(mysqli_error($koneksi));
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
            <a class="nav-link active" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tambah-posting.php">Posting</a>
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

  <h3 class="text-center mt-5 text-primary">Newest Post!</h3>
  <div class="col-12 col-md-6 offset-md-3 mt-5">
      <div class="w-100 text-end">
          <a href="edit-profile.php" class="btn btn-primary text-end">Edit Profile!</a>
      </div>
    <div class="row">
        <?php
        while ($post = mysqli_fetch_assoc($posts)) {
        ?>
        <div class="col-12 col-md-4 d-flex">
            <div class="card mb-3" style="">
                <img src="<?=$post['photo']?>" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title"><?= $post['nama']?></h5>
                <p class="card-text"><?= $post['caption'] ?></p>
                <p class="card-text "><b><?= $post['likes'] ?? 0 ?> Likes</b></p>
                <div class="text-end h-100">
                    <a href="edit-posting.php?id=<?= $post['id'] ?>"><i class=" h2 fas fa-edit align-text-bottom"></i></a>
                    <a href="#delete" onclick="confirmDelete(<?= $post['id'] ?>)"><i class=" h2 fas fa-trash text-danger align-text-bottom"></i></i></a>
                </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div> 

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="script.js">
  </script>
  </body>
</html>