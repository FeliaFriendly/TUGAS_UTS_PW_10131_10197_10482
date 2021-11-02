<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data id yang di kirim dari url
$id = $_GET['id'];
$id_post = $_GET['id_post'];
 
// menghapus data dari database
mysqli_query($koneksi,"delete from comment where id='$id'");
 
// mengalihkan halaman kembali ke index.php
echo "<script>window.location.href = 'comment.php?id=$id_post'</script>";

 
?>