<html>
    <head><title>Data Mahasiswa</title></head>

<body>
<center>
<?php
error_reporting(E_ALL ^ E_NOTICE);
$conn = mysqli_connect('localhost', 'root', '', 'informatika1');
$NIML=$_POST['NIML'];
$nim =$_POST['nim'];
$nama=$_POST['nama'];
$kelas=$_POST['kelas'];
$alamat=$_POST['alamat'];
$submit=$_POST['submit'];
$ubah=$_POST['ubah'];

if($submit){
    if($nim==''){
        echo "</br>NIM tidak boleh kosong, diisi dulu";
    }elseif($nama==''){
        echo "</br>Nama tidak boleh kosong, diisi dulu";
    }elseif($alamat==''){
        echo "</br>Alamat tidak boleh kosong, diisi dulu";
    }else{
        $insert = "INSERT INTO mahasiswa (NIM, Nama, Kelas, alamat) 
								VALUES ('$nim','$nama','$kelas','$alamat')
							";
        mysqli_query($conn,$insert);
        echo'</br>Data berhasil dimasukkan';
    }
}elseif ($ubah) {
    if ($nim == "") {
        echo "</br>NIM tidak boleh kosong";
    } elseif ($nama == "") {
        echo "</br>Nama tidak boleh kosong";
    } elseif ($kelas == "") {
        echo "</br>Kelas tidak boleh kosong";
    } elseif ($alamat == "") {
        echo "</br>Alamat tidak boleh kosong";
    } else {
        $update = " UPDATE mahasiswa
                    SET NIM='$nim', Nama='$nama', Kelas='$kelas', alamat='$alamat'
                    WHERE NIM = '$NIML'
                ";
        mysqli_query($conn, $update); 
        echo "</br>Data Berhasil Diubah";
    }
}
if ($_GET["hps"]) {
    $nim = $_GET["hps"]; 
    $hapus = "DELETE FROM mahasiswa WHERE NIM = '$nim'";
    mysqli_query($conn, $hapus);
    echo "</br>Data berhasil di hapus";

} elseif ($_GET["ubh"]) {
    $nim = $_GET["ubh"]; 
    $cari = "SELECT * FROM mahasiswa WHERE NIM='$nim'";
    $hasil_cari = mysqli_query($conn, $cari);
    $dataMahasiswa = mysqli_fetch_row($hasil_cari); 
}
?>
<h3>Masukkan Data Mahasiswa</h3>
<form method="post" action="form.php">
	<table>
		<tr>
			<td>NIM</td>
			<td>:</td>
			<td> 
				<input type="text" name="nim" value="<?php echo $dataMahasiswa[0] ?>">
				<input type="hidden" name="NIML" value="<?php echo $dataMahasiswa[0] ?>">
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td>
				<input type="text" name="nama" value="<?php echo $dataMahasiswa[1] ?>">
			</td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td>:</td>
			<td>
				<input type="radio" name="kelas" value="A" <?php if ($dataMahasiswa[2]=="A") { echo "checked"; } ?> >A
				<input type="radio" name="kelas" value="B" <?php if ($dataMahasiswa[2]=="B") { echo "checked"; } ?> >B
				<input type="radio" name="kelas" value="C" <?php if ($dataMahasiswa[2]=="C") { echo "checked"; } ?> >C
			</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td>
				<input type="text" name="alamat" value="<?php echo $dataMahasiswa[3] ?>">
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				<?php
					if ($dataMahasiswa) {
						echo "<input type='submit' name='ubah' value='Ubah'>";
					} else {
						echo "<input type='submit' name='submit' value='Submit'>";
					}
				?>
			</td>
		</tr>
    </table>
</form>


<hr>
<h3>Data Mahasiswa</h3>
<table border='1' width='50%'>
    <tr>
        <td align='center' width='20%'><b>NIM</b></td>
        <td align='center' width='30%'><b>Nama</b></td>
        <td align='center' width='10%'><b>Kelas</b></td>
        <td align='center' width='30%'><b>Alamat</b></td>
        <td align='center' width='30%'><b>Keterangan</b></td>
    </tr>
<?php
$cari="SELECT * FROM mahasiswa order by nim";
$hasil_cari=mysqli_query($conn,$cari);
while($data=mysqli_fetch_row($hasil_cari)){
    echo"
    <tr>
        <td width='20%'>$data[0]</td>
        <td width='30%'>$data[1]</td>
        <td width='10%'>$data[2]</td>
        <td width='30%'>$data[3]</td>
        <td>
            <a href='form.php?ubh=$data[0]'>Ubah</a>
            <a href='form.php?hps=$data[0]'>Hapus</a>
        </td>
    </tr>";
}
?>

</table></center></body></html>