<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihat extends CI_Controller {

    public function index(){
        $this->load->view('main');
    }

    public function materi($page){
        switch($page){
            case 'pertemuan_satu':
                $this->load->view('pertemuan_satu');
                break;
            case 'pertemuan_dua':
                $this->load->view('pertemuan_dua');
                break;
            case 'pertemuan_tiga':
                $this->load->view('pertemuan_tiga');
                break;
            case 'pertemuan_empat':
                $this->load->view('pertemuan_empat');
                break;
            case 'pertemuan_lima':
                $this->load->view('pertemuan_lima');
                break;
            case 'pertemuan_enam':
                $this->load->view('pertemuan_enam');
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
                break;
        }
    }

}