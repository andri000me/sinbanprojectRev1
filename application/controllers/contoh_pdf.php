<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allowed!');
class Contoh_pdf extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($download_pdf='')
	{
		$pdf_filename = 'membuat_laporan_pdf.pdf';
		$link_download = ($download_pdf == TRUE)?'':anchor(site_url('contoh_pdf/index/true/'),'Download Pdf');
		$this->data['link_download'] = $link_download;
		$this->data['nama'] = 'Raessa Fathul Alim';
		$this->data['jurusan'] = 'Teknik Informatika';

		$output 	= $this->load->view('contohpdf_view', $this->data, TRUE);

        if($download_pdf == TRUE){
            buat_pdf($output, $pdf_filename);
        }else{
            echo $output;
        }

	}
}