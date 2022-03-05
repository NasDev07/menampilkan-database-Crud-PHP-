<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku</title>

    <!-- Bootstrep -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
        include_once("connect.php");
        $array_penerbit = mysqli_query($mysqli, "SELECT * FROM penerbit");
        $array_pengarang = mysqli_query($mysqli, "SELECT * FROM pengarang");
        $array_katalog = mysqli_query($mysqli, "SELECT * FROM katalog");
    ?>


    <div class="container">

        <div class="row" style="margin: 30px;">
            <div class="col-md-12">
                <h3>Form Buku</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="add.php" method="POST" name="forml">
                    <table width="100%" class="table-bordered" cellpadding="10" border="0">
                        <tr>
                            <td>ISBN</td>
                            <td><input type="text" class="form-control" name="isbn"></td>
                        </tr>
                        <tr>
                            <td>Judul</td>
                            <td><input type="text" class="form-control" name="judul"></td>
                        </tr>
                        <tr>
                            <td>Tahun</td>
                            <td><input type="text" class="form-control" name="tahun"></td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td>
                                <select class="form_control" name="id_penerbit">
                                    <?php 
                                        while($penerbit = mysqli_fetch_array($array_penerbit)){
                                            echo "
                                                <option value=".$penerbit['id_penerbit'].">".$penerbit['nama_penerbit']."</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Pengarang</td>
                            <td>
                                <select class="form_control" name="id_pengarang">
                                <?php 
                                        while($pengarang = mysqli_fetch_array($array_pengarang)){
                                            echo "
                                                <option value=".$pengarang['id_pengarang'].">".$pengarang['nama_pengarang']."</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Katalog</td>
                            <td>
                                <select class="form_control" name="id_katalog">
                                <?php 
                                        while($katalog = mysqli_fetch_array($array_katalog)){
                                            echo "
                                                <option value=".$katalog['id_katalog'].">".$katalog['nama']."</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>QtyStok</td>
                            <td><input type="text" class="form-control" name="qty_stok"></td>
                        </tr>
                        <tr>
                            <td>Harga Pinjam</td>
                            <td><input type="text" class="form-control" name="harga_pinjam"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="form-control btn btn-primary" name="Submit" value="Add"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>
</html>


<?php 
    if(isset($_POST['Submit'])){
        $isbn = $_POST['isbn'];
        $judul = $_POST['judul'];
        $tahun = $_POST['tahun'];
        $id_penerbit = $_POST['id_penerbit'];
        $id_pengarang = $_POST['id_pengarang'];
        $id_katalog = $_POST['id_katalog'];
        $qty_stok = $_POST['qty_stok'];
        $harga_pinjam = $_POST['harga_pinjam'];

        //print_r($_POST); // test data menggunakan print_r / udah jalan apa belum

        $sql = "INSERT INTO buku (isbn, judul, tahun, id_penerbit, id_pengarang, id_katalog, qty_stok, harga_pinjam) 
        VALUES ('$isbn', '$judul', '$tahun', '$id_penerbit', '$id_pengarang', '$id_katalog', '$qty_stok', '$harga_pinjam')";
        $query = mysqli_query($mysqli, $sql);

        header("location:index.php");

        if($query){
            echo "<script>alert('Data Berhasil Ditambahkan');</script>";
            echo "<script>location='index.php';</script>";
        }else{
            echo "<script>alert('Data Gagal Ditambahkan');</script>";
            echo "<script>location='add.php';</script>";
        }
    }