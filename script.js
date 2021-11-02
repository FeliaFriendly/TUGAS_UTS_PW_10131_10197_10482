function confirmDelete(id) {
    var txt;
    var r = confirm("Yakin Menghapus Postingan ini?");
    if (r == true) {
        window.location.href = "delete.php?id=" + id;
    }
}