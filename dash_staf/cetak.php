<!-- 
  Project       : Aplikasi KARTU PELAJAR V.03
  Description   : CRUD (Create, read, Update, Delete) PHP 5.6, QR Code, MySQLi, Bootstrap & Google Chrome
  Author        : SYAIFUL AMRI, ST., MM
  Contact       : Hp/Wa. +628161422223
  Powered by    : TOMSTONE.ID
-->

<?php
  session_start();
  error_reporting(1);
  include '../assets/config/koneksi.php';
  if(empty($_SESSION))
  {
    header("Location: ../login");
  }
?>
<!DOCTYPE html>
<html> <!-- Bagian halaman HTML yang akan konvert -->
<head>
    <meta charset='UTF-8'>
    <title><?php $i = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM identitas LIMIT 1"));  echo "$i[nama] "; ?></title>
  <link rel="shortcut icon" href="../assets/img/logo/<?php echo "$i[gambar] "; ?>">
<style>
img {
    width: 100%;
    height: auto;
}
</style>

</head>

<body onload='window.print()' style="font-family: arial;font-size: 12px;">
        <?php 

                $a=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM identitas 
                    INNER JOIN kelurahan ON identitas.id_kel= kelurahan.id_kel
                    INNER JOIN kabupaten ON identitas.id_kab= kabupaten.id_kab 
                    INNER JOIN kecamatan ON identitas.id_kec= kecamatan.id_kec 
                    INNER JOIN provinsi ON identitas.id_prov= provinsi.id_prov WHERE id = '1'"));
            $id=$_POST['selector'];
            $N = count($id);
            for($i=0; $i < $N; $i++)
            {
                $data=mysqli_query($koneksi, "SELECT * FROM user 
                    INNER JOIN kelurahan ON user.id_kel= kelurahan.id_kel
                    INNER JOIN kabupaten ON user.id_kab= kabupaten.id_kab 
                    INNER JOIN kecamatan ON user.id_kec= kecamatan.id_kec 
                    INNER JOIN provinsi ON user.id_prov= provinsi.id_prov 
                    WHERE id='$id[$i]'");
            while($r=mysqli_fetch_array($data))
            {
                $t = date("d - m - Y", strtotime($r['tgl_lhr']));
                $tgl = date("dmY", strtotime($r['tgl_lhr']));
                $blangko=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM blangko WHERE id = '1'"));
        ?>
                <div style="width: 1063px;height: 307px;margin-bottom: 25px;padding:; background-image: url('../assets/img/blangko/<?php echo $blangko["gambar"];?>');">

            <img style="border-radius: 6px;border: 1px solid #222; position: absolute;margin-left: 30px;margin-top: 110px; width: 90px; height: 110px;overflow: hidden;" class="img-responsive img" src="../assets/img/user/<?php echo $r["gambar"];?>">
            
            <img style="position: absolute;margin-left: 40px;margin-top: 8px; width: 70px;" src="../assets/img/logo/<?php echo "$a[gambar] "?>">

            <p style="color: #fff;position: absolute;padding-left: 130px;padding-top: 1px; width:300px; height: 40px;text-transform: uppercase;text-align: center;letter-spacing: 4px;">Provinsi <?php echo "$a[nama_provinsi] "?><br>Kabupaten <?php echo "$a[nama_kabupaten] "?> <br>Kecamatan <?php echo "$a[nama_kecamatan] "?><br><b><?php echo "$a[sekolah] "?></b></p>


            <p style="font-family: arial;font-size: 11px;position: absolute;margin-left: 35px;margin-top: 80px;width: 93px;height:30px;text-align:center;position: center;float: center"><?php
                $tanggal = date ("j");
                $bulan = array(1=>"Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember");
                $bulan = $bulan[date("n")];
                $tahun = date("Y");
                $thn = $tahun+3;
            ?>Berlaku Hingga:<br><b><?php echo $tanggal ." ". $bulan ." ". $thn;?></b></p>
            <!-- <img style="border:2px solid #fff;position: absolute;margin-left: 50px;margin-top: 65px;width: 50px; height: 50px;" src="../assets/img/qrcode/<?php echo $r["qrcode"];?>"> -->
             <table cellspacing="0em" style="margin-top: -10px; padding-left: 190px; position: relative;font-family: arial;font-size: 12px;transition-property: 500px;width: 490px;height: 130px;">  
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo "$r[nama]";?></td>
                </tr> 
                <tr>
                    <td>NIS/NISN</td>
                    <td>:</td>
                    <td><?php echo "$r[nis]";?></td>
                </tr> 
                <tr>
                    <td>TTL</td>
                    <td>:</td>
                    <td><?php echo "$r[tmp_lhr]";?>, <?php echo "$t";?></td>
                </tr>
                <tr>
                    <td>JURUSAN</td>
                    <td>:</td>
                    <td><?php echo "$r[jurusan]";?>, <?php echo "$t";?></td>
                </tr>
                <tr>
                    <td>JK</td>
                    <td>:</td>
                    <td><?php echo "$r[jk]";?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo "$r[alamat]";?></td>
                </tr>
                <tr>
                    <td>Kelurahan/Desa</td>
                    <td>:</td>
                    <td><?php echo "$r[nama_kelurahan]";?></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td><?php echo "$r[nama_kecamatan]";?></td>
                </tr>
                <tr>
                    <td>Kota/Kabupaten</td>
                    <td>:</td>
                    <td><?php echo "$r[nama_kabupaten]";?></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td><?php echo "$r[nama_provinsi]";?></td>
                </tr>
            </table>
            <p style="margin-top: -250px;padding-left: 760px;padding-top: 10px;font-size: 14px;"> <b style="font-size: 12px;">TATA TERTIB SEKOLAH</b>
            <ol style="padding-left: 610px;font-family: arial;font-size: 12px;text-align: justify;padding-right: 25px;margin-top: -8px;">
              <li>Bertakqwa kepada Tuhan Yang Maha Esa</a></li>
                      <li>Menggalang kesatuan kerukunan pelajar</li>
                      <li>Belajar hidup berorganisasi untuk menyiapkan diri dalam mental, moral budi pekerti yang luhur, meningkatkan kecerdasan dan keterampilan</li>
                      <li>Dapat menduduki fungsinya sebagai pewaris, penerus perjuangan bangsa dan pancasila yang penuh dengan kratif, aktif dan disiplin Nasional demi suksesnya program pendidikan sekolah</li>
            </ol>
            <p style="margin-left: 610px;font-family: arial;font-size: 11px;text-align: justify;padding-right: 25px;width: 35%;text-align: right;"><?php echo "$a[nama_kecamatan] "?>, <?php echo $tanggal ." ". $bulan ." ". $tahun;?></p>
            <p style="padding-left: 840px;font-family: arial;font-size: 11px;text-align: justify;padding-right: 25px;width: 35%;margin-top: -6px;">Mengetahui,<br><b>Kepala Madrasah<br><br><br><br><?php echo $blangko["kepsek"];?><br><?php echo $blangko["nip"];?></b></p>
            <img style="padding-left: 760px;font-family: arial;font-size: 10px;text-align: justify;padding-right: 25px;width: 15%;margin-top: -75px;position: absolute;" src="../assets/img/tandatangan/<?php echo $blangko["ttd"];?>">
            <img style="border-radius: 2px;border:4px solid #fff;margin-left: 610px;font-family: arial;font-size: 10px;text-align: justify;width: 70px;margin-top: -100px;position: absolute;" src="../assets/img/qrcode/<?php echo $r["qrcode"];?>">
            </p>
        </div>

</body>
</html>
<?php }?>