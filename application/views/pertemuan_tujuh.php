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
    <script src="<?php echo base_url('assets/js/pertemuan_tujuh.js')?>"></script>
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
                    <div class="mdl-cell mdl-cell--6-col">
						<button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored show-modal-tambah" id="tambah-data"><i class="material-icons">add</i></button>
                    </div>
					<div class="mdl-cell mdl-cell--6-col">
						<form id="form-cari-data">
							<div class="mdl-grid">
								<div class="mdl-cell mdl-cell--4-col">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
										<label class="mdl-button mdl-js-button mdl-button--icon" for="field-cari"><i class="material-icons">search</i></label>
										<div class="mdl-textfield__expandable-holder">
											<input class="mdl-textfield__input" type="text" id="field-cari" name="field-cari">
											<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
										</div>
									</div>
								</div>
								<div class="mdl-cell mdl-cell--2-col">
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="cari-data">Cari</button>
								</div>
							</div>
						</form>
                    </div>
                </div>
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col table-responsive">
						<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
							<thead>
								<tr>
									<th>Action</th>
									<th>Kode Lokasi</th>
									<th>Nama Lokasi</th>
									<th>Wilayah</th>
									<th>Pusat Kota</th>
									<th>Pusat UKM</th>
									<th>Nama Bupati</th>
									<th>Jumlah Penduduk</th>
									<th>Jumlah UKM</th>
								</tr>
							</thead>
							<tbody id="table-body-data">
								<?php
									foreach($lokasi as $key=>$lokasi){
										echo "<tr>";
										echo '<td><a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored edit-data show-modal-edit" id="edit-data" data-id='.$lokasi['id'].'>Edit</a> <a href="javascript:void(0)" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-data" id="delete-data" data-id='.$lokasi['id'].'>Delete</a></td>';
										echo "<td>".$lokasi['kode_kabupaten']."</td>";
										echo "<td>".$lokasi['nama_kabupaten']."</td>";
										echo "<td>".$lokasi['plain_wilayah']."</td>";
										echo "<td>".$lokasi['pusat_kota']."</td>";
										echo "<td>".$lokasi['pusat_ukm']."</td>";
										echo "<td>".$lokasi['nama_bupati']."</td>";
										echo "<td>".$lokasi['jumlah_penduduk']."</td>";
										echo "<td>".$lokasi['jumlah_ukm']."</td>";
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
									<input class="mdl-textfield__input" type="text" id="P7-kode-kabupaten" name="P7-kode-kabupaten">
									<label class="mdl-textfield__label">Kode Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-nama-kabupaten" name="P7-nama-kabupaten">
									<label class="mdl-textfield__label">Nama Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-nama-bupati" name="P7-nama-bupati">
									<label class="mdl-textfield__label">Nama Bupati</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-jumlah-penduduk" name="P7-jumlah-penduduk">
									<label class="mdl-textfield__label">Jumlah Penduduk</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-jumlah-ukm" name="P7-jumlah-ukm">
									<label class="mdl-textfield__label">Jumlah UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-pusat-kota" name="P7-pusat-kota">
									<label class="mdl-textfield__label">Pusat Kota</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-pusat-ukm" name="P7-pusat-ukm">
									<label class="mdl-textfield__label">Pusat UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<textarea class="mdl-textfield__input" type="text" name="P7-wilayah" id="P7-wilayah"></textarea>
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
							<input type="text" name="P7-id-edit" hidden>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-kode-kabupaten-edit" name="P7-kode-kabupaten-edit">
									<label class="mdl-textfield__label">Kode Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-nama-kabupaten-edit" name="P7-nama-kabupaten-edit">
									<label class="mdl-textfield__label">Nama Kabupaten</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-nama-bupati-edit" name="P7-nama-bupati-edit">
									<label class="mdl-textfield__label">Nama Bupati</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-jumlah-penduduk-edit" name="P7-jumlah-penduduk-edit">
									<label class="mdl-textfield__label">Jumlah Penduduk</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-jumlah-ukm-edit" name="P7-jumlah-ukm-edit">
									<label class="mdl-textfield__label">Jumlah UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-pusat-kota-edit" name="P7-pusat-kota-edit">
									<label class="mdl-textfield__label">Pusat Kota</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="P7-pusat-ukm-edit" name="P7-pusat-ukm-edit">
									<label class="mdl-textfield__label">Pusat UKM</label>
								</div>
							</div>
							<div class="mdl-cell mdl-cell--2-col">
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<textarea class="mdl-textfield__input" type="text" name="P7-wilayah-edit" id="P7-wilayah-edit"></textarea>
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
