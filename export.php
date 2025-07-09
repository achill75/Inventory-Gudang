<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="icon" href="images/icon stock barang.png" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  
    <style>
        .dataTables_filter {
            display: none !important;
        }

        h1 {
            display: none !important;
        }

        .kop-surat {
             margin-bottom: 20px;
        }

        .kop-surat table {
            border-collapse: collapse;
        }

        .kop-surat table td {
            padding: 10px;
        }
        image{
            width: 100%; 
            max-width: 21cm; 
            height: auto;
            display: block; 
            margin: 0 auto; 
        }
        
        
    </style>

</head>

<body>
<div class="container">
			<h4 class="text-center">Stock Barang</h4>
			<!--<img src="images/pdi.png" class="image"> -->
             
				<div class="data-tables datatable-dark">
					
                <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $ambilsemuadatastock = mysqli_query($conn, "select * from stock");
                                             $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $namabarang = $data['namabarang'];
                                                $deskripsi =$data['deskripsi'];
                                                $stock = $data['stock'];
                                                $idb = $data['idbarang'];
                                            
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $namabarang;?></td>
                                                <td><?php echo $deskripsi;?></td>
                                                <td><?php echo $stock?></td>
                                            </tr>


                                            <?php
                                            };
                                            ?>
                                            
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>  
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print <img src="images/print.png" alt="Print" width="35" height="35">',
                customize: function (win) {
                    var logo = '<img src="images/pdi.png" width="130" height="100">';
                    var kopSurat = `
                        <div class="kop-surat" style="text-align: center; margin-bottom: 10px; padding: 20px 0;">
                            <table width="100%" style="border-collapse: collapse; table-layout: fixed;">
                                <tr>
                                    <!-- Logo Kiri -->
                                    <td width="30%" style="vertical-align: top; text-align: center; margin-left: 50px" padding-left: 50px>
                                        ${logo}
                                    </td>
                                    <!-- Informasi Perusahaan Kanan -->
                                    <td width="70%" style="vertical-align: top; text-align: center; padding-right: 270px">
                                        <h3  style="margin: 0; font-size: 24px; font-weight: bold;">PT. PARTAI DEMOKRAT INDONESIA</h3>
                                        <p style="margin: 5px 0; font-size: 14px;">Jl. Angker No. 008 (Saraz), Jakarta Pusat, Jakarta, DKI Jakarta, 10210</p>
                                        <p style="margin: 5px 0; font-size: 14px;">(021) 12345678</p>
                                        <p style="margin: 5px 0; font-size: 14px;"><a href="mailto:info@xyzindonesia.com" style="text-decoration: none; color: black;">info@xyzindonesia.com</a></p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    `;
                    
                    // Menambahkan kop surat ke dalam body halaman print
                    $(win.document.body).prepend(kopSurat);

                    // Menambahkan CSS untuk hanya menampilkan kop surat di halaman pertama
                    $(win.document.body).find('style').remove(); // Menghapus style lama jika ada
                    $(win.document.body).prepend(`
                        <style>
                            @media print {
                                body {
                                    -webkit-print-color-adjust: exact;
                                }
                                .kop-surat {
                                    page-break-before: always; /* memastikan kop surat hanya muncul di halaman pertama */
                                }
                                .kop-surat table {
                                    border-collapse: collapse;
                                }
                                /* Menyembunyikan kop surat pada halaman berikutnya */
                                .kop-surat + * {
                                    page-break-before: always;
                                }
                            }
                        </style>
                    `);
                }
            }
        ]
    });
});
</script>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>