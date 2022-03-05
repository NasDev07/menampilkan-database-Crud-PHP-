<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <!-- Bootstrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

    <?php 
        include_once("connect.php");
        $books = mysqli_query($mysqli, "SELECT buku. *, katalog.nama AS nama_katalog, nama_penerbit, nama_pengarang FROM buku 
        LEFT JOIN katalog ON katalog.id_katalog = buku.id_katalog
        LEFT JOIN penerbit ON penerbit.id_penerbit = buku.id_penerbit
        LEFT JOIN pengarang ON pengarang.id_pengarang = buku.id_pengarang
        ORDER BY judul ASC");
    ?>

    <div class="container">
        <div class="row" style="margin: 30px;">
            <div class="col-md-2"></div>

            <div class="col-md-2 text-center">
                <h5><a href="index.php">Buku</a></h5>
            </div>
            <div class="col-md-2 text-center">
                <h5><a href="katalog.php">Katalog</a></h5>
            </div>
            <div class="col-md-2 text-center">
                <h5><a href="penerbit.php">Penerbit</a></h5>
            </div>
            <div class="col-md-2 text-center">
                <h5><a href="pengarang.php">Pengarang</a></h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="add.php" class="btn btn-primary my-3">Add New Buku</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <table class="table table-bordered">
               <thead>
               <tr>
                    <td class="text-center">ISBN</td>
                    <td class="text-center">Judul</td>
                    <td class="text-center">Tahun</td>
                    <td class="text-center">Penerbit</td>
                    <td class="text-center">Pengarang</td>
                    <td class="text-center">Katalog</td>
                    <td class="text-center">Stok</td>
                    <td class="text-center">Harga Pinjam</td>
                    <td class="text-center">Action</td>
                </tr>
               </thead>
               <tbody>
                   <?php 
                        while($book = mysqli_fetch_array($books)){
                            echo"
                            <tr>
                                <td>".$book['isbn']."</td>
                                <td>".$book['judul']."</td>
                                <td>".$book['tahun']."</td>
                                <td>".$book['nama_penerbit']."</td>
                                <td>".$book['nama_pengarang']."</td>
                                <td>".$book['nama_katalog']."</td>
                                <td>".$book['qty_stok']."</td>
                                <td>".$book['harga_pinjam']."</td>
                                <td class='text-center'>
                                    <a href='edit.php?isbn=".$book['isbn']."' class='btn btn-warning'>Edit</a>
                                    <a href='#' class='btn btn-danger' onclick='confirmation(`".$book['isbn']."`)'>Delete</a>
                                </td>
                            </tr>
                            ";
                        }
                   ?>
               </tbody>
            </table>
            </div>
        </div>
    </div>

</body>
</html>

<script>
    function confirmation(isbn){
        alert(isbn);
        if(confirm("Apakah anda yakin akan menghapus data ini?")){
            window.location.href = "delete.php?isbn="+isbn;
        }
    }
</script>