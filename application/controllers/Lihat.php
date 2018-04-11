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
                $data['lokasi'] = $this->main->selectData('id, kode_lokasi, nama_lokasi, astext(lokasi) as plain_lokasi','tb_titik','')->result_array();
                $this->load->view('pertemuan_lima',$data);
                break;
			case 'pertemuan_enam':
				$data['materi'] = $this->ListMateri();
                $this->load->view('pertemuan_enam',$data);
                break;
            case 'pertemuan_tujuh':
                $this->load->view('pertemuan_tujuh');
                break;
            case 'pertemuan_delapan':
                $this->load->view('pertemuan_delapan');
                break;
            case 'pertemuan_sembilan':
                $this->load->view('pertemuan_sembilan');
                break;
            case 'pertemuan_sepuluh':
                $this->load->view('pertemuan_sepuluh');
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
                'lokasi' => 'geomfromtext("POINT('.$lat.' '.$long.')")'
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
                'lokasi' => 'geomfromtext("POINT('.$lat.' '.$long.')")'
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
        $data = $this->main->selectData('id, kode_lokasi, nama_lokasi, astext(lokasi) as plain_lokasi','tb_titik','where id='.$id)->result();
        echo json_encode($data);
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
				'Materi'=>'Menghubungkan Database dengan Google Maps',
				'Link'=>'pertemuan_lima'
			),
			(object) array(
				'Bab'=>'Pertemuan Enam',
				'Materi'=>'Waiting ....',
				'Link'=>'pertemuan_enam'
			),
		);

		return $data;
	}

}
