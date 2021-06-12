<?php
session_start();
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn = mysqli_connect("localhost", "root", "", "database_hotel");
    $result = $conn->query("SELECT * FROM `user_id` WHERE `nama_pelanggan` = '$username' && `password` = '$password'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        echo "Login Berhasil!, <a href=\"Logout.php\">Logout!</a>";
    } else {
        header("LOCATION:Login.php");
    }
}

?>
<html>
<style>
    body {
        background-image: url("kasur.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<in <body style="color:springgreen"=>
    <h3> Reservasi Hotel </h3>
    <div class="body" style="color:springgreen">
        <link rel="stylesheet" type="text/CSS" href="hotelcss.css">


        <form action="LoginCheck.php" method="post">
            <table style="color: springgreen;">
                <tr>
                    <td><strong>No Identitas </strong></td>
                    <td>:</td>
                    <td><input type="text" name="noidentitas" /></td>
                </tr>
                <tr>
                    <td><b>Nama Tamu </b></td>
                    <td>:</td>
                    <td><input type="text" name="nama" /></td>
                </tr>
                <tr>
                    <td><b>Alamat </b></td>
                    <td>:</td>
                    <td><input type="text" name="alamat" /></td>
                </tr>
                <tr>
                    <td><b>Tanggal Lahir </b></td>
                    <td>:</td>
                    <td><input type="date" name="tgllahir" /></td>
                </tr>
                <tr>
                    <td><b>Jenis Kamar </b></td>
                    <td>:</td>
                    <td><select name="kamar" class="form-control">
                            <option>Pilih Salah Satu</option>
                            <option value="Singgle Room">Singgle Room</option>
                            <option value="Twin Room">Twin Room</option>
                            <option value="Triple Room">Triple Room</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b> Tanggal Check-In </b></td>
                    <td>:</td>
                    <td><input type="date" name="checkin" /></td>
                </tr>
                <tr>
                    <td><b> Tanggal Check-Out </b></td>
                    <td>:</td>
                    <td><input type="date" name="checkout" /></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><b>
                            <h3> Service Room </h3>
                        </b></td>
                </tr>
                <tr>
                    <td><b> Massage </b></td>
                    <td>:</td>
                    <td><input type="text" name="massage" value="0" /></td>
                </tr>
                <tr>
                    <td><b> Laundry </b></td>
                    <td>:</td>
                    <td><input type="text" name="laundry" value="0" /></td>
                </tr>
                <tr>
                    <td><b> Lunch </b></td>
                    <td>:</td>
                    <td><input type="text" name="lunch" value="0" /></td>
                </tr>
                <tr>
                    <td><b> Dinner </b></td>
                    <td>:</td>
                    <td><input type="text" name="dinner" value="0" /></td>
                </tr>
                <tr>
                    <td><b> Bed </b></td>
                    <td>:</td>
                    <td><input type="text" name="bed" value="0" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="button" value="Simpan" name="submit">
                        <input type="reset" class="button" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        error_reporting(0);

        if (isset($_POST['submit'])) {
            $noidentitas = $_POST['noidentitas'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $tgllahir = $_POST['tgllahir'];
            $kamar = $_POST['kamar'];
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            $massage = $_POST['massage'];
            $laundry = $_POST['laundry'];
            $lunch = $_POST['lunch'];
            $dinner = $_POST['dinner'];
            $bed = $_POST['bed'];
            $xcheckout = new DateTime($checkout);
            $xcheckin = new dateTime($checkin);
            $lama = $xcheckout->diff($xcheckin);
            $xlama = $lama->d;

            if ($kamar == "Singgle Room") {
                $harga = 2500000;
                $jmlmassage = $massage * 150000;
                $jmllaundry = $laundry * 20000;
                $jmllunch = $lunch * 75000;
                $jmldinner = $dinner * 100000;
                $jmlbed = $bed * 200000;
                $gambar = "single bed.jpg";
            } elseif ($kamar == "Twin Room") {
                $harga = 3000000;
                $jmlmassage = $massage * 150000;
                $jmllaundry = $laundry * 20000;
                $jmllunch = $lunch * 75000;
                $jmldinner = $dinner * 100000;
                $jmlbed = $bed * 200000;
                $gambar = "twinbed.jpg";
            } elseif ($kamar == "Triple Room") {
                $harga = 4000000;
                $jmlmassage = $massage * 150000;
                $jmllaundry = $laundry * 20000;
                $jmllunch = $lunch * 75000;
                $jmldinner = $dinner * 100000;
                $jmlbed = $bed * 200000;
                $gambar = "triplebed.jpg";
            } else {
                $harga = 0;
            }

            $total = ($harga * $xlama) + $jmlmassage + $jmllaundry + $jmllunch + $jmldinner + $jmlbed;
            $xtotal = number_format($total, 2, ",", ".");
            //=============================================================
            if ($noidentitas == '') {
        ?><script language="javascript">
                    alert('Data gagal di Proses? data ada yang kosong')
                </script><?php
                            ?><script language="javascript">
                    document.location.href = "LoginCheck.php"
                </script><?php
                        }




                            ?>
            <table width="80%" border="1" style="color: springgreen;" bgcolor="black">
                <tr>
                    <td width="20%">
                        <font size="2">No Identitas </font>
                    </td>
                    <td width="20%"><?php echo $noidentitas; ?></td>
                    <td rowspan="15" width="40%"><img src=" <?php echo $gambar; ?>" width="300" height="250"></td>
                </tr>
                <tr>
                    <td width="10%">
                        <font size="2">Nama Tamu </font>
                    </td>
                    <td><?php echo $nama; ?></td>
                </tr>
                <tr>
                    <td width="10%">
                        <font size="2">ALamat </font>
                    </td>
                    <td><?php echo $alamat; ?></td>
                </tr>
                <tr>
                    <td width="6%">
                        <font size="2">Tanggal TTL </font>
                    </td>
                    <td><?php echo $tgllahir; ?></td>
                </tr>
                <tr>
                    <td width="10%">
                        <font size="2">Kamar </font>
                    </td>
                    <td><?php echo $kamar; ?></td>
                </tr>
                <tr>
                    <td width="6%">
                        <font size="2">Check-In </font>
                    </td>
                    <td><?php echo $checkin; ?></td>
                </tr>
                <tr>
                    <td width="6%">
                        <font size="2">Check-Out</font>
                    </td>
                    <td><?php echo $checkout; ?></td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Lama Inap </font>
                    </td>
                    <td><?php echo $xlama; ?></td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Harga Kamar </font>
                    </td>
                    <td><?php echo $harga; ?></td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Massage </font>
                    </td>
                    <td><?php echo $massage; ?> x 150000 = <?php echo $jmlmassage; ?> </td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Laundry</font>
                    </td>
                    <td><?php echo $laundry; ?> x 20000 = <?php echo $jmllaundry; ?> </td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Lunch </font>
                    </td>
                    <td><?php echo $lunch; ?> x 75000 = <?php echo $jmllunch; ?></td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Dinner</font>
                    </td>
                    <td><?php echo $dinner; ?> x 100000 = <?php echo $jmldinner; ?> </td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Bed</font>
                    </td>
                    <td><?php echo $bed; ?> x 200000 = <?php echo $jmlbed; ?> </td>
                </tr>
                <tr>
                    <td width="5%">
                        <font size="2">Total</font>
                    </td>
                    <td><?php echo $xtotal; ?> </td>

                </tr>

            </table>
        <?php
        }
        ?>
        </body>

</html>