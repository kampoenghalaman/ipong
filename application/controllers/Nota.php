<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nota extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Nota_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'nota/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'nota/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'nota/index.html';
            $config['first_url'] = base_url() . 'nota/index.html';
        }

        $this->load->library('pagination');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Nota_m->total_rows($q);

        $this->pagination->initialize($config);
        $nota = $this->Nota_m->get_limit_data($config['per_page'], $start, $q);

        $data = array(
            'nota_data' => $nota,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','nota/tbl_nota_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Nota_m->get_by_id($id);
        if ($row) {
            $data = array(
		'id_nota' => $row->id_nota,
		'nomor' => $row->nomor,
		'penerimanota' => $row->penerimanota,
        'nomortelepon' => $row->nomortelepon,
		'namateknisi' => $row->namateknisi,
		'namapegawai' => $row->namapegawai,
		'tanggal' => $row->tanggal,
		'totalbiaya' => $row->totalbiaya,
		'keterangan' => $row->keterangan,
		'isservice' => $row->isservice,
	    );
            $this->template->load('template','nota/tbl_nota_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nota'));
        }
    }

    public function updatenota($id){
        echo "uhuy".$id;
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nota', TRUE));
        } else {
            $data = array(
            'nomor' => $this->input->post('nomor',TRUE),
            'penerimanota' => $this->input->post('penerimanota',TRUE),
            'nomortelepon' => $this->input->post('nomortelepon',TRUE),
            'namateknisi' => $this->input->post('namateknisi',TRUE),
            'namapegawai' => $this->input->post('namapegawai',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'totalbiaya' => $this->input->post('totalbiaya',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
            'isservice' => $this->input->post('isservice',TRUE),
            );

            $this->Nota_m->update($this->input->post('id_nota', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nota'));
        }
    }

    public function create() 
    {
        $data['nomornota'] = $this->Nota_m->getnomornota()->id_nota;
        if($this->uri->segment(3) == '1'){
            $data = array(
                'button' => 'Services',
                'action' => site_url('nota/create_services'),
                'id_nota' => set_value('id_nota'),
                'nomor' => date('m'.'y')."Serv".$this->Nota_m->getnomornota()->id_nota,
                'penerimanota' => set_value('penerimanota'),
                'nomortelepon' => set_value('nomortelepon'),
                'namateknisi' => set_value('namateknisi'),
                'namapegawai' => set_value('namapegawai'),
                'tanggal' => set_value('tanggal'),
                'totalbiaya' => set_value('totalbiaya'),
                'keterangan' => set_value('keterangan'),
                'isservice' => set_value('isservice'),
            ); 
        }else{
            $data = array(
                'button' => 'Pembelian Produk',
                'action' => site_url('nota/create_pembelian'),
                'id_nota' => set_value('id_nota'),
                'nomor' => date('m'.'y')."Prod".$this->Nota_m->getnomornota()->id_nota,
                'penerimanota' => set_value('penerimanota'),
                'nomortelepon' => set_value('nomortelepon'),
                // 'namateknisi' => set_value('namateknisi'),
                'namapegawai' => set_value('namapegawai'),
                'tanggal' => set_value('tanggal'),
                'totalbiaya' => set_value('totalbiaya'),
                // 'keterangan' => set_value('keterangan'),
                'isservice' => set_value('isservice'),
            );
        }

        $data['namapegserv'] = $this->Nota_m->getnamapegserv("tbl_peg_service");
        $this->template->load('template','nota/tbl_nota_createnew', $data);
    }
    
    public function create_services() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('nota/create/1'));
            // $this->create();
        } else {
            $data = array(
        		'nomor' => $this->input->post('nomor',TRUE),
        		'penerimanota' => $this->input->post('penerimanota',TRUE),
                'nomortelepon' => $this->input->post('nomortelepon',TRUE),
        		'namateknisi' => $this->input->post('namateknisi',TRUE),
        		'namapegawai' => $this->input->post('namapegawai',TRUE),
        		'tanggal' => $this->input->post('tanggal',TRUE),
        		'totalbiaya' => $this->input->post('totalbiaya',TRUE),
        		'keterangan' => $this->input->post('keterangan',TRUE),
        		'isservice' => 1,
    	    );
            $hmultif = count($_POST['jasa'])-1;
            #insertingdata
            $id_nota = $this->Nota_m->createNota('tbl_nota',$data);
        
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nota/updatenew/'.$id_nota));
        }
    }
    
    public function create_pembelian() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            redirect(base_url('nota/create/0'));
            // $this->create();
        } else {
            $data = array(
        'nomor' => $this->input->post('nomor',TRUE),
        'penerimanota' => $this->input->post('penerimanota',TRUE),
        'nomortelepon' => $this->input->post('nomortelepon',TRUE),
        'namateknisi' => 0,
        'namapegawai' => $this->input->post('namapegawai',TRUE),
        'tanggal' => $this->input->post('tanggal',TRUE),
        'totalbiaya' => $this->input->post('totalbiaya',TRUE),
        'keterangan' => 0,
        'isservice' => 0,
        );
            $hmultif = count($_POST['jasa'])-1;
            #insertingdata
            $id_nota = $this->Nota_m->createNota('tbl_nota',$data);
            
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nota/updatenew/'.$id_nota));
        }
    }

    public function update($id) 
    {
        $row = $this->Nota_m->get_by_id($id);

        if ($row) {
            if($row->isservice == '1'){
                $data = array(
                    'button' => 'Services',
                    'action' => site_url('nota/update_service'),
                    'id_nota' => set_value('id_nota', $row->id_nota),
                    'nomor' => set_value('nomor', $row->nomor),
                    'penerimanota' => set_value('penerimanota', $row->penerimanota),
                    'nomortelepon' => set_value('nomortelepon', $row->nomortelepon),
                    'namateknisi' => set_value('namateknisi', $row->namateknisi),
                    'namapegawai' => set_value('namapegawai', $row->namapegawai),
                    'tanggal' => set_value('tanggal', $row->tanggal),
                    'totalbiaya' => set_value('totalbiaya', $row->totalbiaya),
                    'keterangan' => set_value('keterangan', $row->keterangan),
                    'isservice' => set_value('isservice', $row->isservice),
                );
            }else{
                $data = array(
                    'button' => 'Pembelian Produk',
                    'action' => site_url('nota/update_produk'),
                    'id_nota' => set_value('id_nota', $row->id_nota),
                    'nomor' => set_value('nomor', $row->nomor),
                    'penerimanota' => set_value('penerimanota', $row->penerimanota),
                    'nomortelepon' => set_value('nomortelepon', $row->nomortelepon),
                    'namateknisi' => set_value('namateknisi', $row->namateknisi),
                    'namapegawai' => set_value('namapegawai', $row->namapegawai),
                    'tanggal' => set_value('tanggal', $row->tanggal),
                    'totalbiaya' => set_value('totalbiaya', $row->totalbiaya),
                    'keterangan' => set_value('keterangan', $row->keterangan),
                    'isservice' => set_value('isservice', $row->isservice),
                );
            }
            $data['namapegserv'] = $this->Nota_m->getnamapegserv("tbl_peg_service");
            $this->template->load('template','nota/tbl_nota_formupdate', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nota'));
        }
    }

    public function updatenew($id){
        $row = $this->Nota_m->get_by_id($id);
        if ($row) {
            if($row->isservice == '1'){
                $data = array(
                    'button' => 'Update Nota Services',
                    'action' => base_url('nota/update_service'),
                    'id_nota' => set_value('id_nota', $row->id_nota),
                    'nomor' => set_value('nomor', $row->nomor),
                    'penerimanota' => set_value('penerimanota', $row->penerimanota),
                    'nomortelepon' => set_value('nomortelepon', $row->nomortelepon),
                    'namateknisi' => set_value('namateknisi', $row->namateknisi),
                    'namapegawai' => set_value('namapegawai', $row->namapegawai),
                    'tanggal' => set_value('tanggal', $row->tanggal),
                    'totalbiaya' => set_value('totalbiaya', $row->totalbiaya),
                    'keterangan' => set_value('keterangan', $row->keterangan),
                    'isservice' => set_value('isservice', $row->isservice),
                );
            }else{
                $data = array(
                    'button' => 'Update Nota Penjualan',
                    'action' => base_url('nota/update_produk'),
                    'id_nota' => set_value('id_nota', $row->id_nota),
                    'nomor' => set_value('nomor', $row->nomor),
                    'penerimanota' => set_value('penerimanota', $row->penerimanota),
                    'nomortelepon' => set_value('nomortelepon', $row->nomortelepon),
                    'namateknisi' => set_value('namateknisi', $row->namateknisi),
                    'namapegawai' => set_value('namapegawai', $row->namapegawai),
                    'tanggal' => set_value('tanggal', $row->tanggal),
                    'totalbiaya' => set_value('totalbiaya', $row->totalbiaya),
                    'keterangan' => set_value('keterangan', $row->keterangan),
                    'isservice' => set_value('isservice', $row->isservice),
                );
            }
            // form yang tersembunyi
            $data['namaprodukjasa'] = set_value('namaprodukjasa');
            $data['qty'] = set_value('qty');
            $data['harga'] = set_value('harga');
            $data['jumlah'] = set_value('jumlah');
            $data['namapegserv'] = $this->Nota_m->getnamapegserv("tbl_peg_service");
            $this->template->load('template','nota/tbl_nota_updatenew', $data);
        }
    }

    public function update_service() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nota', TRUE));
        } else {
            $data = array(
            'nomor' => $this->input->post('nomor',TRUE),
            'penerimanota' => $this->input->post('penerimanota',TRUE),
            'nomortelepon' => $this->input->post('nomortelepon',TRUE),
            'namateknisi' => $this->input->post('namateknisi',TRUE),
            'namapegawai' => $this->input->post('namapegawai',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'totalbiaya' => $this->input->post('totalbiaya',TRUE),
            'keterangan' => $this->input->post('keterangan',TRUE),
            'isservice' => $this->input->post('isservice',TRUE),
            );

            $this->Nota_m->update($this->input->post('id_nota', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nota'));
        }
    }

    public function update_produk() 
    {
        $this->_rules();
        $id = $this->uri->segment(3);
        if ($this->form_validation->run() == FALSE) {
            // $this->update($this->input->post('id_nota', TRUE));
               // redirect(site_url('nota/updatenew/'.$id));
        } else {
            $data = array(
            'nomor' => $this->input->post('nomor',TRUE),
            'penerimanota' => $this->input->post('penerimanota',TRUE),
            'nomortelepon' => $this->input->post('nomortelepon',TRUE),
            'namapegawai' => $this->input->post('namapegawai',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'totalbiaya' => $this->input->post('totalbiaya',TRUE),
            'isservice' => $this->input->post('isservice',TRUE),
            );

            $this->Nota_m->update($this->input->post('id_nota', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nota'));
        }
    }

    public function simpandatanota(){
            $data = array(
                'id_nota' => $this->input->post('id_nota',TRUE),
                'namaprodukjasa' => $this->input->post('namaprodukjasa',TRUE),
                'qty' => $this->input->post('qty',TRUE),
                'harga' => $this->input->post('harga',TRUE),
                'jumlah' => $this->input->post('jumlah',TRUE),
            );
            if($_POST['id_notadata'] == NULL){    
                #insertingdata
                $notadata = $this->Nota_m->insertNotadata('tbl_notadata',$data);
            }else{
                echo "ada";
                #updatingdata
                $notadata = $this->Nota_m->updateNotadata($_POST['id_notadata'],$data);
            }

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nota/updatenew/'.$this->input->post('id_nota')));
    }

    public function hapusdatanota($id){
        $in= substr($id, 0, 2);
        $ind= substr($id, 2, 2);
        $this->Nota_m->deleteND('tbl_notadata',$in);
        redirect(site_url('nota/updatenew/'.$ind));
    }
    
    
    
    public function delete($id) 
    {
        $row = $this->Nota_m->get_by_id($id);

        if ($row) {
            $this->Nota_m->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nota'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nota'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
	$this->form_validation->set_rules('penerimanota', 'penerimanota', 'trim|required');
    $this->form_validation->set_rules('nomortelepon', 'nomortelepon', 'trim|required');
	$this->form_validation->set_rules('namateknisi', 'namateknisi', 'trim|required');
	$this->form_validation->set_rules('namapegawai', 'namapegawai', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('totalbiaya', 'totalbiaya', 'trim|required');
	// $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
	// $this->form_validation->set_rules('isservice', 'isservice', 'trim|required');

	$this->form_validation->set_rules('id_nota', 'id_nota', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Nota.php */
/* Location: ./application/controllers/Nota.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-09-04 07:17:11 */
/* http://harviacode.com */