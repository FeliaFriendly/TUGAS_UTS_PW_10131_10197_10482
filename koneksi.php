<?php
    $koneksi = mysqli_connect("localhost","root","","sosmed_native");
     
    if (mysqli_connect_errno()){
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }
?>