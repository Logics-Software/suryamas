<br>
<?php echomsg(); ?>
<div class="panel panel-primary">
	<div class="panel-heading" id="handme"></i><i class="fa fa-search" aria-hidden="true"></i> Search</div>
	<div class="panel-body" id="hideme">
        <form name="" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Query Nama Barang</label>
                <input type="text" name="namabarang" id="namabarang" placeholder="Cari barang..." class="form-control">
            </div>
            <div class="form-group">
                <label>Stok Barang</label>
                <select name="stokbarang" id="stokbarang" class="form-control">
                    <option value="1">Semua Data Barang</option>
                    <option value="2">Stok > 0</option>
                </select>
            </div>
            <div class="form-group">
                <label>Pabrik</label>
                <select name="namapabrik" id="namapabrik" class="form-control">
                    <option value="">SEMUA PABRIK</option>
                    <?php
                        $A_SQL = mysqli_query($A_CONNECT, "SELECT DISTINCTROW kodepabrik FROM filebarang ORDER BY kodepabrik");
                        while($A_RES = mysqli_fetch_array($A_SQL,MYSQLI_ASSOC)){
                        ?>
                            <option value="<?php echo $A_RES['kodepabrik']; ?>"><?php echo $A_RES['kodepabrik']; ?></option>
                        <?php
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="submitlaporan" class="btn btn-primary btn-block"><i class="fa fa-television" aria-hidden="true"></i> Tampilkan Daftar Harga</button>
        </form>
    </div>
</div>                   

<?php
if(isset($_POST['submitlaporan'])){
    $A_FIND = $_POST['namabarang'];
    $A_STOK = $_POST['stokakhir'];
    $A_NAMAPABRIK = $_POST['kodepabrik'];
    $A_QUERY = '';
    $A_KONDISI1 = '';
    $A_KONDISI2 = '';
    $A_KONDISI3 = '';
    $A_FOLDER_PATH = '';
    ?>
    <h3>Daftar Stok dan Harga Barang</h3>
    <?php
    $A_QUERY = "SELECT b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang, 
                IFNULL(SUM(s.stokakhir),0) AS stokakhir 
                FROM filebarang b 
                LEFT JOIN stokbarang s ON b.kodebarang = S.kodebarang";
    if (trim($A_FIND) <> ''){
        $A_KONDISI1 = "namabarang LIKE '%".$A_FIND."%' ";
    }
    if ($A_STOK == 2){
        $A_KONDISI2 = "IFNULL(SUM(s.stokakhir),0) > 0 ";
    }
    if (trim($A_NAMAPABRIK) <> ''){
        $A_KONDISI3 = "kodepabrik = '".$A_NAMAPABRIK."' ";
    }

    if (trim($A_KONDISI1)<>'' && trim($A_KONDISI2)<>''){
        $A_KONDISI2 = " AND ".$A_KONDISI2;
    }
    if (trim(($A_KONDISI1)<>'' || trim($A_KONDISI2)<>'') && trim($A_KONDISI3)<>''){$A_KONDISI3 = " AND ".$A_KONDISI3;}

    if (trim($A_KONDISI1)<>'' || trim($A_KONDISI2)<>'' || trim($A_KONDISI3)<>''){
        $A_QUERY = $A_QUERY . " WHERE namabarang <> '' AND " . $A_KONDISI1 . $A_KONDISI2 . $A_KONDISI3 . " GROUP BY namabarang, satuan, namapabrik, namagolongan, hargajual, discount, kodebarang ";
    }else{
        $A_QUERY = $A_QUERY . " WHERE namabarang <> '' GROUP BY namabarang, satuan, namapabrik, namagolongan, hargajual, discount, kodebarang ";
    }
    $A_QUERY = $A_QUERY . "GROUP BY b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang";
    $A_FOLDER_PATH = "download-harga.php?querytext=".$A_QUERY;
    ?>
    <a class="btn btn-warning btn-block" target="_blank" href=" <?=$A_FOLDER_PATH?> ">Download Daftar Stok & Harga</a><br/>
    <table class="table table-bordered">
        <tbody>
            <?php
                $A_QUERY = "SELECT b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang, 
                            IFNULL(SUM(s.stokakhir),0) AS stokakhir 
                            FROM filebarang b 
                            LEFT JOIN stokbarang s ON b.kodebarang = S.kodebarang";
                if (trim($A_FIND) <> ''){
                    $A_KONDISI1 = "namabarang LIKE '%".$A_FIND."%' ";
                }
                if ($A_STOK == 2){
                    $A_KONDISI2 = "IFNULL(SUM(s.stokakhir),0) > 0 ";
                }
                if (trim($A_NAMAPABRIK) <> ''){
                    $A_KONDISI3 = "kodepabrik = '".$A_NAMAPABRIK."' ";
                }
                
                if (trim($A_KONDISI1)<>'' && trim($A_KONDISI2)<>''){
                    $A_KONDISI2 = " AND ".$A_KONDISI2;
                }
                if (trim(($A_KONDISI1)<>'' || trim($A_KONDISI2)<>'') && trim($A_KONDISI3)<>''){$A_KONDISI3 = " AND ".$A_KONDISI3;}
    
                if (trim($A_KONDISI1)<>'' || trim($A_KONDISI2)<>'' || trim($A_KONDISI3)<>''){
                    $A_QUERY = $A_QUERY . " WHERE namabarang <> '' AND " . $A_KONDISI1 . $A_KONDISI2 . $A_KONDISI3 . " GROUP BY b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang ";
                }else{
                    $A_QUERY = $A_QUERY . " WHERE namabarang <> '' GROUP BY b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang ";
                }
                $A_SQL = mysqli_query($A_CONNECT,$A_QUERY);
                while($A_RES = mysqli_fetch_array($A_SQL,MYSQLI_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $A_RES['namabarang']; ?></td>
                    <td align="right"><?php echo number_format($A_RES['stokakhir']); ?></td>
                    <td align="right"><?php echo number_format($A_RES['hargar']); ?></td>
                    <td align="right"><?php echo number_format($A_RES['discr1'],2); ?></td>
                </tr>
                <?php
                }
            ?>
        </tbody>
    </table>
    <?php
    echo "<script> document.getElementById('namabarang').value = '".$A_FIND."'; </script>";
    echo "<script> document.getElementById('stokbarang').value = ".$A_STOK."; </script>";
    echo "<script> document.getElementById('namapabrik').value = '".$A_NAMAPABRIK."'; </script>";
}else{
    ?>
    <h3>Daftar Stok dan Harga Barang</h3>
    <a class="btn btn-warning btn-block" href="download-harga.php" target="_blank">Download Daftar Stok & Harga</a><br/>
    <table class="table table-bordered">
        <thead>
            <tr class="heading-table">
                <td>Nama Barang</td>
                <td align="right">Stok</td>
                <td align="right">Harga Jual</td>
                <td align="right">Disc</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $A_QUERY = "SELECT b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang, 
                            IFNULL(SUM(s.stokakhir),0) AS stokakhir 
                            FROM filebarang b 
                            LEFT JOIN stokbarang s ON b.kodebarang = S.kodebarang
                            GROUP BY b.namabarang, b.satuan, b.kodepabrik, b.kodegolongan, b.hargar, b.discr1, b.kodebarang";
                $A_SQL = mysqli_query($A_CONNECT,$A_QUERY);
                while($A_RES = mysqli_fetch_array($A_SQL,MYSQLI_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $A_RES['namabarang']; ?></td>
                    <td align="right"><?php echo number_format($A_RES['stokakhir']); ?></td>
                    <td align="right"><?php echo number_format($A_RES['hargar']); ?></td>
                    <?php
                    if ($A_RES['discr1']>100){
                        ?>
                        <td align="right"><?php echo number_format($A_RES['discr1'],2); ?></td>
                        <?php
                    }else{
                        ?>
                        <td align="right"><?php echo number_format($A_RES['discr1'],2); ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                }
            ?>
        </tbody>
    </table>
    <?php
}
?>