<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Geografis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/front.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/mdl/material.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('node_modules/dialog-polyfill/dialog-polyfill.css')?>">
    <link href="<?php echo base_url('assets/css/front.css');?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/vendor/mdl/material.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.js');?>"></script>
    <script src="<?php echo base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>
    <script src="<?php echo base_url('node_modules/dialog-polyfill/dialog-polyfill.js')?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo getenv('GMAPS_API_KEY')?>"></script>
    <script>
		let base_url = '<?php echo base_url();?>';
		let lokasiFromDatabase  = <?php echo json_encode($lokasi)?>;
    </script>
    <script src="<?php echo base_url('assets/js/pertemuan_enam.js')?>"></script>
</head>
<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <span class="mdl-layout-title">SISTEM INFORMASI GEOGRAFIS</span>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="<?php  echo base_url(); ?>">SISTEM INFORMASI GEOGRAFIS</a>
            <?php 
				foreach($materi as $key=>$value){
			?>
				<a class="mdl-navigation__link" href="<?php echo base_url('lihat/materi/'.$value->Link); ?>"><?php echo $value->Bab?></a>
			<?php
				}
			?>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="map-view" id="map"></div>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
						<button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored show-modal-tambah" id="tambah-data"><i class="material-icons">add</i></button>
                    </div>
                </div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col table-responsive">
                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                            <thead>
                                <tr>
                                    <th>Kode Lokasi</th>
                                    <th>Nama Lokasi</th>
                                    <th>Wilayah</th>
									<th>Pusat Kota</th>
									<th>Pusat UKM</th>
									<th>Nama Bupati</th>
									<th>Jumlah Penduduk</th>
									<th>Jumlah UKM</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($lokasi as $key=>$lokasi){
                                        echo "<tr>";
                                        echo "<td>".$lokasi['kode_kabupaten']."</td>";
                                        echo "<td>".$lokasi['nama_kabupaten']."</td>";
										echo "<td>".$lokasi['plain_wilayah']."</td>";
										echo "<td>".$lokasi['pusat_kota']."</td>";
										echo "<td>".$lokasi['pusat_ukm']."</td>";
										echo "<td>".$lokasi['nama_bupati']."</td>";
										echo "<td>".$lokasi['jumlah_penduduk']."</td>";
										echo "<td>".$lokasi['jumlah_ukm']."</td>";
                                        echo '<td><a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit-data show-modal-edit" id="edit-data" data-id='.$lokasi['id'].'>Edit</a>
                                        <a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-data" id="delete-data" data-id='.$lokasi['id'].'>Delete</a></td>';
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

	<!-- Dialog untuk tambah data -->
  	<dialog class="mdl-dialog gis-dialog dialog-tambah">
		<div class="mdl-dialog__content">
			<h5>Tambah Data</h5>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--12-col">
					<div class="map-view" id="add-map"></div>
				</div>
				<div class="mdl-cell mdl-cell--12-col">
					<form id="form-tambah-data">
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-kode-kabupaten" name="p6-kode-kabupaten">
									<label class="mdl-textfield__label">Kode Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-nama-kabupaten" name="p6-nama-kabupaten">
									<label class="mdl-textfield__label">Nama Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-nama-bupati" name="p6-nama-bupati">
									<label class="mdl-textfield__label">Nama Bupati</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-jumlah-penduduk" name="p6-jumlah-penduduk">
									<label class="mdl-textfield__label">Jumlah Penduduk</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-jumlah-ukm" name="p6-jumlah-ukm">
									<label class="mdl-textfield__label">Jumlah UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-pusat-kota" name="p6-pusat-kota">
									<label class="mdl-textfield__label">Pusat Kota</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-pusat-ukm" name="p6-pusat-ukm">
									<label class="mdl-textfield__label">Pusat UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<textarea class="mdl-textfield__input" type="text" name="p6-wilayah" id="p6-wilayah"></textarea>
									<label class="mdl-textfield__label">Wilayah</label>
								</div>
							</div>
						</div>
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--4-col mdl-textfield">
								<input value="tambah" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="simpan-data">
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-textfield">
								<input value="Batal" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored close-tambah" id="batal-simpan">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
  	</dialog>

	  <!-- Dialog untuk edit data -->
  	<dialog class="mdl-dialog gis-dialog dialog-edit">
		<div class="mdl-dialog__content">
			<h5>Edit Data</h5>
		</div>
		<div class="mdl-dialog__actions mdl-dialog__actions--full-width">
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--12-col">
					<div class="map-view" id="edit-map"></div>
				</div>
				<div class="mdl-cell mdl-cell--12-col">
					<form id="form-edit-data">
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-kode-kabupaten-edit" name="p6-kode-kabupaten-edit">
									<label class="mdl-textfield__label">Kode Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-nama-kabupaten-edit" name="p6-nama-kabupaten-edit">
									<label class="mdl-textfield__label">Nama Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-nama-bupati-edit" name="p6-nama-bupati-edit">
									<label class="mdl-textfield__label">Nama Bupati</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-jumlah-penduduk-edit" name="p6-jumlah-penduduk-edit">
									<label class="mdl-textfield__label">Jumlah Penduduk</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-jumlah-ukm-edit" name="p6-jumlah-ukm-edit">
									<label class="mdl-textfield__label">Jumlah UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-pusat-kota-edit" name="p6-pusat-kota-edit">
									<label class="mdl-textfield__label">Pusat Kota</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="p6-pusat-ukm-edit" name="p6-pusat-ukm-edit">
									<label class="mdl-textfield__label">Pusat UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<textarea class="mdl-textfield__input" type="text" name="p6-wilayah-edit" id="p6-wilayah-edit"></textarea>
									<label class="mdl-textfield__label">Wilayah</label>
								</div>
							</div>
						</div>
						<div class="mdl-grid">
							<div class="mdl-cell mdl-cell--4-col mdl-textfield">
								<input value="Simpan" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="simpan-edit-data">
							</div>
							<div class="mdl-cell mdl-cell--4-col mdl-textfield">
								<input value="Batal" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored close-edit" id="batal-simpan">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
  	</dialog>
</body>
</html>
