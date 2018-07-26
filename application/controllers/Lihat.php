<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihat extends CI_Controller {

	/**
	 * Kita load dulu ya databasenya :)
	 */
    public function __construct(){
        parent::__construct();
        $this->load->model('M_main','main');
    }

	/**
	 * Disini kita manual untuk penentuan materinya :D
	 */
    public function index(){
		$data['materi'] = $this->ListMateri();
        $this->load->view('main',$data);
    }

    public function materi($page=null){
        switch($page){
			case 'pertemuan_satu':
				$data['materi'] = $this->ListMateri();
                $this->load->view('pertemuan_satu',$data);
                break;
			case 'pertemuan_dua':
				$data['materi'] = $this->ListMateri();
                $this->load->view('pertemuan_dua',$data);
                break;
			case 'pertemuan_tiga':
				$data['materi'] = $this->ListMateri();
                $this->load->view('pertemuan_tiga',$data);
                break;
			case 'pertemuan_empat':
				$data['materi'] = $this->ListMateri();
                $this->load->view('pertemuan_empat',$data);
                break;
			case 'pertemuan_lima':
				$data['materi'] = $this->ListMateri();
                $data['lokasi'] = $this->main->selectData('id, kode_lokasi, nama_lokasi, ST_AsWKT(lokasi) as plain_lokasi','tb_titik','')->result_array();
                $this->load->view('pertemuan_lima',$data);
                break;
			case 'pertemuan_enam':
				$data['materi'] = $this->ListMateri();
				$data['lokasi'] = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
                $this->load->view('pertemuan_enam',$data);
                break;
			case 'pertemuan_tujuh':
				$data['materi'] = $this->ListMateri();
				$data['lokasi'] = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
                $this->load->view('pertemuan_tujuh',$data);
                break;
            case 'pertemuan_delapan':
				$data['materi'] = $this->ListMateri();
				$data['lokasi'] = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
				$this->load->view('pertemuan_delapan',$data);
                break;
			case 'pertemuan_sembilan':
				$data['materi'] = $this->ListMateri();
				$data['lokasi'] = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
                $this->load->view('pertemuan_sembilan',$data);
                break;
            case 'pertemuan_sepuluh':
				$data['materi'] = $this->ListMateri();
				$data['lokasi'] = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result_array();
				$this->load->view('pertemuan_sepuluh',$data);
                break;
            case 'pertemuan_sebelas':
                $this->load->view('pertemuan_sebelas');
                break;
            case 'pertemuan_duabelas':
                $this->load->view('pertemuan_duabelas');
                break;
            case 'pertemuan_tigabelas':
                $this->load->view('pertemuan_tigabelas');
                break;
            case 'pertemuan_empatbelas':
                $this->load->view('pertemuan_empatbelas');
                break;
            case 'pertemuan_limabelas':
                $this->load->view('pertemuan_limabelas');
                break;
            case 'pertemuan_enambelas':
                $this->load->view('pertemuan_enambelas');
                break;
			default:
				redirect('lihat');
                break;
        }
    }

    public function saveMapP5(){
        $lat = $this->input->post('p5-lat');
        $long = $this->input->post('p5-long');
        $namaLokasi = $this->input->post('p5-nama-lokasi');
        $kodeLokasi = $this->input->post('p5-kode-lokasi');
        if($lat === '' || $long === '' || $namaLokasi === '' || $kodeLokasi === ''){
            echo json_encode(array('status'=>false));
        }else{
            $data = array(
                'kode_lokasi' => $kodeLokasi,
                'nama_lokasi' => $namaLokasi,
                'lokasi' => 'ST_GeomFromText("POINT('.$lat.' '.$long.')")'
                );
            $tambah = $this->main->insertDataWithoutEscape('tb_titik',$data);
            echo json_encode(array('status'=>true));
        }
    }

    public function updateMapP5(){
        $id = $this->input->post('p5-id-edit');
        $lat = $this->input->post('p5-lat-edit');
        $long = $this->input->post('p5-long-edit');
        $namaLokasi = $this->input->post('p5-nama-lokasi-edit');
        $kodeLokasi = $this->input->post('p5-kode-lokasi-edit');
        if($id === '' || $lat === '' || $long === '' || $namaLokasi === '' || $kodeLokasi === ''){
            echo json_encode(array('status'=>false));
        }else{
            $where = array('id'=>$id);
            $data = array(
                'kode_lokasi' => $kodeLokasi,
                'nama_lokasi' => $namaLokasi,
                'lokasi' => 'ST_GeomFromText("POINT('.$lat.' '.$long.')")'
                );
            $tambah = $this->main->updateDataWithoutEscape('tb_titik',$data,$where);
            echo json_encode(array('status'=>true));
        }
    }

    public function deleteMapP5(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_titik',$where);
        echo json_encode(array('status'=>true));
    }

    public function editMapP5(){
        $id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_lokasi, nama_lokasi, ST_AsWKT(lokasi) as plain_lokasi','tb_titik','where id='.$id)->result();
		echo json_encode($data);
	}

	public function saveMapP6(){
		$kode_kabupaten = $this->input->post('p6-kode-kabupaten');
		$nama_kabupaten = $this->input->post('p6-nama-kabupaten');
		$nama_bupati = $this->input->post('p6-nama-bupati');
		$jumlah_penduduk = $this->input->post('p6-jumlah-penduduk');
		$jumlah_ukm = $this->input->post('p6-jumlah-ukm');
		$pusat_kota = $this->input->post('p6-pusat-kota');
		$pusat_ukm = $this->input->post('p6-pusat-ukm');
		$wilayah = $this->input->post('p6-wilayah');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$tambah = $this->main->insertDataWithoutEscape('tb_kumpulan_point_uts',$data);
            echo json_encode(array('status'=>true));
		}
        
    }

    public function updateMapP6(){
        $id = $this->input->post('p6-id-edit');
        $kode_kabupaten = $this->input->post('p6-kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('p6-nama-kabupaten-edit');
		$nama_bupati = $this->input->post('p6-nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('p6-jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('p6-jumlah-ukm-edit');
		$pusat_kota = $this->input->post('p6-pusat-kota-edit');
		$pusat_ukm = $this->input->post('p6-pusat-ukm-edit');
		$wilayah = $this->input->post('p6-wilayah-edit');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$where = array('id'=>$id);
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$update = $this->main->updateDataWithoutEscape('tb_kumpulan_point_uts',$data,$where);
            echo json_encode(array('status'=>true));
		}
        
    }

    public function deleteMapP6(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_kumpulan_point_uts',$where);
        echo json_encode(array('status'=>true));
    }

    public function editMapP6(){
		$id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id='.$id)->result();
		echo json_encode($data);
	}

	public function saveMapP7(){
		$kode_kabupaten = $this->input->post('P7-kode-kabupaten');
		$nama_kabupaten = $this->input->post('P7-nama-kabupaten');
		$nama_bupati = $this->input->post('P7-nama-bupati');
		$jumlah_penduduk = $this->input->post('P7-jumlah-penduduk');
		$jumlah_ukm = $this->input->post('P7-jumlah-ukm');
		$pusat_kota = $this->input->post('P7-pusat-kota');
		$pusat_ukm = $this->input->post('P7-pusat-ukm');
		$wilayah = $this->input->post('P7-wilayah');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$tambah = $this->main->insertDataWithoutEscape('tb_kumpulan_point_uts',$data);
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function updateMapP7(){
        $id = $this->input->post('P7-id-edit');
        $kode_kabupaten = $this->input->post('P7-kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('P7-nama-kabupaten-edit');
		$nama_bupati = $this->input->post('P7-nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('P7-jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('P7-jumlah-ukm-edit');
		$pusat_kota = $this->input->post('P7-pusat-kota-edit');
		$pusat_ukm = $this->input->post('P7-pusat-ukm-edit');
		$wilayah = $this->input->post('P7-wilayah-edit');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$where = array('id'=>$id);
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$update = $this->main->updateDataWithoutEscape('tb_kumpulan_point_uts',$data,$where);
            $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function deleteMapP7(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_kumpulan_point_uts',$where);
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
        echo json_encode(array('status'=>true,'data'=>$data));
    }

    public function editMapP7(){
		$id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id='.$id)->result();
		echo json_encode($data);
	}

	public function searchMapP7(){
		$id = $this->input->post('id');
		if($id === '' || $id == null){
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
		}else{
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where kode_kabupaten='.$id)->result();
		}
		echo json_encode($data);
	}

	public function saveMapP8(){
		$kode_kabupaten = $this->input->post('P8-kode-kabupaten');
		$nama_kabupaten = $this->input->post('P8-nama-kabupaten');
		$nama_bupati = $this->input->post('P8-nama-bupati');
		$jumlah_penduduk = $this->input->post('P8-jumlah-penduduk');
		$jumlah_ukm = $this->input->post('P8-jumlah-ukm');
		$pusat_kota = $this->input->post('P8-pusat-kota');
		$pusat_ukm = $this->input->post('P8-pusat-ukm');
		$wilayah = $this->input->post('P8-wilayah');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$tambah = $this->main->insertDataWithoutEscape('tb_kumpulan_point_uts',$data);
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function updateMapP8(){
        $id = $this->input->post('P8-id-edit');
        $kode_kabupaten = $this->input->post('P8-kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('P8-nama-kabupaten-edit');
		$nama_bupati = $this->input->post('P8-nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('P8-jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('P8-jumlah-ukm-edit');
		$pusat_kota = $this->input->post('P8-pusat-kota-edit');
		$pusat_ukm = $this->input->post('P8-pusat-ukm-edit');
		$wilayah = $this->input->post('P8-wilayah-edit');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$where = array('id'=>$id);
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$update = $this->main->updateDataWithoutEscape('tb_kumpulan_point_uts',$data,$where);
            $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function deleteMapP8(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_kumpulan_point_uts',$where);
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
        echo json_encode(array('status'=>true,'data'=>$data));
    }

    public function editMapP8(){
		$id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id='.$id)->result();
		echo json_encode($data);
	}

	public function searchMapP8(){
		$id = $this->input->post('id');
		if($id === '' || $id == null){
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
		}else{
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where kode_kabupaten='.$id)->result();
		}
		echo json_encode($data);
	}

	public function saveMapP9(){
		$kode_kabupaten = $this->input->post('P9-kode-kabupaten');
		$nama_kabupaten = $this->input->post('P9-nama-kabupaten');
		$nama_bupati = $this->input->post('P9-nama-bupati');
		$jumlah_penduduk = $this->input->post('P9-jumlah-penduduk');
		$jumlah_ukm = $this->input->post('P9-jumlah-ukm');
		$pusat_kota = $this->input->post('P9-pusat-kota');
		$pusat_ukm = $this->input->post('P9-pusat-ukm');
		$wilayah = $this->input->post('P9-wilayah');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$tambah = $this->main->insertDataWithoutEscape('tb_kumpulan_point_uts',$data);
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function updateMapP9(){
        $id = $this->input->post('P9-id-edit');
        $kode_kabupaten = $this->input->post('P9-kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('P9-nama-kabupaten-edit');
		$nama_bupati = $this->input->post('P9-nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('P9-jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('P9-jumlah-ukm-edit');
		$pusat_kota = $this->input->post('P9-pusat-kota-edit');
		$pusat_ukm = $this->input->post('P9-pusat-ukm-edit');
		$wilayah = $this->input->post('P9-wilayah-edit');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$where = array('id'=>$id);
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$update = $this->main->updateDataWithoutEscape('tb_kumpulan_point_uts',$data,$where);
            $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function deleteMapP9(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_kumpulan_point_uts',$where);
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
        echo json_encode(array('status'=>true,'data'=>$data));
    }

    public function editMapP9(){
		$id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id='.$id)->result();
		echo json_encode($data);
	}

	public function searchMapP9(){
		$id = $this->input->post('id');
		if($id === '' || $id == null){
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
		}else{
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where kode_kabupaten='.$id)->result();
		}
		echo json_encode($data);
	}

	public function saveMapP10(){
		$kode_kabupaten = $this->input->post('P10-kode-kabupaten');
		$nama_kabupaten = $this->input->post('P10-nama-kabupaten');
		$nama_bupati = $this->input->post('P10-nama-bupati');
		$jumlah_penduduk = $this->input->post('P10-jumlah-penduduk');
		$jumlah_ukm = $this->input->post('P10-jumlah-ukm');
		$pusat_kota = $this->input->post('P10-pusat-kota');
		$pusat_ukm = $this->input->post('P10-pusat-ukm');
		$wilayah = $this->input->post('P10-wilayah');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$tambah = $this->main->insertDataWithoutEscape('tb_kumpulan_point_uts',$data);
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function updateMapP10(){
        $id = $this->input->post('P10-id-edit');
        $kode_kabupaten = $this->input->post('P10-kode-kabupaten-edit');
		$nama_kabupaten = $this->input->post('P10-nama-kabupaten-edit');
		$nama_bupati = $this->input->post('P10-nama-bupati-edit');
		$jumlah_penduduk = $this->input->post('P10-jumlah-penduduk-edit');
		$jumlah_ukm = $this->input->post('P10-jumlah-ukm-edit');
		$pusat_kota = $this->input->post('P10-pusat-kota-edit');
		$pusat_ukm = $this->input->post('P10-pusat-ukm-edit');
		$wilayah = $this->input->post('P10-wilayah-edit');
		if($kode_kabupaten === '' || $nama_kabupaten === '' 
		|| $nama_bupati === '' || $jumlah_penduduk === '' || $jumlah_ukm === ''
		|| $pusat_kota === '' || $pusat_ukm === '' || $wilayah === ''){
			echo json_encode(array('status'=>false));
		}else{
			$where = array('id'=>$id);
			$data = array(
				'kode_kabupaten' => $kode_kabupaten,
				'nama_kabupaten' => $nama_kabupaten,
				'wilayah' => 'ST_MPointFromText("MULTIPOINT('.$wilayah.')")',
				'pusat_kota' => 'ST_GeomFromText("POINT('.$pusat_kota.')")',
				'pusat_ukm'	 => 'ST_GeomFromText("POINT('.$pusat_ukm.')")',
				'nama_bupati' => $nama_bupati,
				'jumlah_penduduk' => $jumlah_penduduk,
				'jumlah_ukm' => $jumlah_ukm
			);
			$update = $this->main->updateDataWithoutEscape('tb_kumpulan_point_uts',$data,$where);
            $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
            echo json_encode(array('status'=>true,'data'=>$data));
		}
        
    }

    public function deleteMapP10(){
        $id = $this->input->post('id');
        $where = array('id'=>$id);
        $delete = $this->main->deleteData('tb_kumpulan_point_uts',$where);
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
        echo json_encode(array('status'=>true,'data'=>$data));
    }

    public function editMapP10(){
		$id = $this->input->post('id');
        $data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where id='.$id)->result();
		echo json_encode($data);
	}

	public function searchMapP10(){
		$id = $this->input->post('id');
		if($id === '' || $id == null){
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','')->result();
		}else{
			$data = $this->main->selectData('id, kode_kabupaten, nama_kabupaten, ST_AsWKT(wilayah) as plain_wilayah, ST_AsWKT(pusat_kota) as pusat_kota, ST_AsWKT(pusat_ukm) as pusat_ukm, nama_bupati, jumlah_penduduk, jumlah_ukm','tb_kumpulan_point_uts','where kode_kabupaten='.$id)->result();
		}
		echo json_encode($data);
	}

	protected function createArrayMultipoint($arrayMultipoint){
		$value = '';
		for($i = 0; $i < count($arrayMultipoint); $i++){
			$_multipoint =explode(',',$arrayMultipoint[$i]);
			if($i == (count($arrayMultipoint) - 1)){
				$value .= $_multipoint[0].' '.$_multipoint[1];
			}else{
				$value .= $_multipoint[0].' '.$_multipoint[1].',';
			}
			
		}
		return $value;
	}
	
	protected function ListMateri(){
		$data = array(
			(object) array(
				'Bab'=>'Pertemuan Satu',
				'Materi'=>'Kontrak Kuliah',
				'Link'=>'pertemuan_satu'
			),
			(object) array(
				'Bab'=>'Pertemuan Dua',
				'Materi'=>'Pengenalan dan Instalasi Javascript API',
				'Link'=>'pertemuan_dua'
			),
			(object) array(
				'Bab'=>'Pertemuan Tiga',
				'Materi'=>'Pemasangan Marker',
				'Link'=>'pertemuan_tiga'
			),
			(object) array(
				'Bab'=>'Pertemuan Empat',
				'Materi'=>'Event Listener di Google Maps',
				'Link'=>'pertemuan_empat'
			),
			(object) array(
				'Bab'=>'Pertemuan Lima',
				'Materi'=>'Menghubungkan Database dengan Google Maps, ditampilkan dengan polyline atau polygon',
				'Link'=>'pertemuan_lima'
			),
			(object) array(
				'Bab'=>'Pertemuan Enam',
				'Materi'=>'Multipoint dengan polygon',
				'Link'=>'pertemuan_enam'
			),
			(object) array(
				'Bab'=>'Pertemuan Tujuh',
				'Materi'=>'AJAX Change MAP',
				'Link'=>'pertemuan_tujuh'
			),
			(object) array(
				'Bab'=>'Pertemuan Delapan',
				'Materi'=>'Styling Map',
				'Link'=>'pertemuan_delapan'
			),
			(object) array(
				'Bab'=>'Pertemuan Sembilan',
				'Materi'=>'Styling Map bag. 2',
				'Link'=>'pertemuan_sembilan'
			),
			(object) array(
				'Bab'=>'Pertemuan Sepuluh',
				'Materi'=>'Styling Map bag. 3',
				'Link'=>'pertemuan_sepuluh'
			),
			(object) array(
				'Bab'=>'Pertemuan Sebelas',
				'Materi'=>'Luas Area',
				'Link'=>'pertemuan_sebelas'
			),
		);

		return $data;
	}

}
