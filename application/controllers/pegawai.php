<?php

class pegawai extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('pegawai_model');
	}

	public function index() {
		$data['logo'] = $this->pegawai_model->GetLogo();
		$this->load->view('pegawai/login',$data);
	}

	public function login() {

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if ($this->form_validation->run()==FALSE) {

		$data['logo'] = $this->pegawai_model->GetLogo();
		$this->load->view('pegawai/login',$data);

		}
		else {

			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			$this->pegawai_model->CekAdminLogin($data);

		}
	}

	public function home() {

		if($this->session->userdata("logged_in")!=="") {
			$this->template->load('template_pegawai','pegawai/home');
		}
		else{
			redirect('pegawai');

		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("pegawai");
	} 

	//Awal Seo
	public function seo() {
		if ($this->session->userdata("logged_in")!=="") {

			$query = $this->pegawai_model->GetSeo();
			foreach ($query->result_array() as $tampil) {
				$data['id_seo']=$tampil['id_seo'];
				$data['tittle']=$tampil['tittle'];
				$data['keyword']=$tampil['keyword'];
				$data['description']=$tampil['description'];
			}

			$this->template_pegawai->load('template_pegawai','pegawai/seo/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function seo_simpan() {
		$id_seo = $this->input->post('id_seo');
		$tittle = $this->input->post('tittle');
		$keyword = $this->input->post('keyword');
		$description = $this->input->post('description');

		$this->pegawai_model->UpdateSeo($id_seo,$tittle,$keyword,$description);redirect("pegawai/seo");
	}
	//Akhir Seo

	//Awal Kategori Galeri
	public function kategorigaleri() {

		$data['data_kategorigaleri']= $this->pegawai_model->Getkategorigaleri();
		$this->template_pegawai->load('template_pegawai','pegawai/kategorigaleri/index',$data);
	}

	public function kategorigaleri_simpan() {
		$nama_kategorigaleri = $this->input->post("nama_kategorigaleri");
		$cek = $this->pegawai_model->kategorigaleriSama($nama_kategorigaleri);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','kategorigaleri Berhasil Disimpan');
			$this->pegawai_model->kategorigaleriSimpan($nama_kategorigaleri);
			$success="0";
		}

		echo $success;
	}

	public function kategorigaleri_edit() {
		$id_kategorigaleri = $this->uri->segment(3);
		$query = $this->pegawai_model->GetEditkategorigaleri($id_kategorigaleri);
		foreach ($query->result_array() as $tampil) {
			$data['id_kategorigaleri'] = $tampil['id_kategorigaleri'];
			$data['nama_kategorigaleri'] = $tampil['nama_kategorigaleri'];
		}

		$this->template_pegawai->load('template_pegawai','pegawai/kategorigaleri/edit',$data);
	}

	public function kategorigaleri_delete() {
		$id_kategorigaleri = $this->uri->segment(3);
		$this->pegawai_model->Deletekategorigaleri($id_kategorigaleri);

		$this->session->set_flashdata('message','kategorigaleri Berhasil Dihapus');
		redirect("pegawai/kategorigaleri");
	}

	public function kategorigaleri_update() {
		$id_kategorigaleri = $this->input->post('id_kategorigaleri');
		$nama_kategorigaleri = $this->input->post('nama_kategorigaleri');

		$cek = $this->pegawai_model->kategorigaleriSama($nama_kategorigaleri);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','kategorigaleri Berhasil Disimpan');
			$this->pegawai_model->kategorigaleriUpdate($id_kategorigaleri,$nama_kategorigaleri);
			$success="0";
		}

		echo $success;
	}
	//Akhir kategori

	//Awal Galeri
	public function galeri() {

		$data['data_galeri'] = $this->pegawai_model->GetGaleri();
		$this->template_pegawai->load('template_pegawai','pegawai/galeri/index',$data);

	}

	public function galeri_tambah() {
		$data['data_kategorigaleri'] = $this->pegawai_model->Getkategorigaleri();
		$this->template_pegawai->load('template_pegawai','pegawai/galeri/add',$data);
	}

	public function galeri_simpan() {

			
			$this->form_validation->set_rules('kategorigaleri_id', 'Album', 'required');
			$this->form_validation->set_rules('nama_galeri', 'Nama Gallery', 'required');
			
		
			

			if ($this->form_validation->run() == FALSE)
			{
				$data['data_kategorigaleri']= $this->pegawai_model->Getkategorigaleri();
				$this->template_pegawai->load('template_pegawai','pegawai/galeri/add',$data);
			}
			else {

				if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama_galeri'] = $this->input->post('nama_galeri');
						$in_data['kategorigaleri_id'] = $this->input->post('kategorigaleri');
						$this->db->insert("tbl_galeri",$in_data);

					$this->session->set_flashdata('berhasil','Gallery Berhasil Disimpan');
					redirect("pegawai/galeri");
				}
				else
				{
					$config['upload_path'] = './images/galeri/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/galeri/".$data['file_name'] ;
						$destination_thumb	= "./images/galeri/thumb/" ;
						$destination_medium	= "./images/galeri/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 800 ;
						$limit_thumb    = 270 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama_galeri'] = $this->input->post('nama_galeri');
						$in_data['gambar'] = $data['file_name'];
						$in_data['kategorigaleri_id'] = $this->input->post('kategorigaleri_id');
						
						
						$this->db->insert("tbl_galeri",$in_data);

				
						
						$this->session->set_flashdata('berhasil','Gallery Berhasil Disimpan');
						redirect("pegawai/galeri");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/galeri/error');
					}
				}
				
			}

	}

	public function galeri_delete() {
		$id_galeri = $this->uri->segment(3);
		$this->pegawai_model->DeleteGaleri($id_galeri);

		$this->session->set_flashdata('message','Gallery Berhasil Dihapus');
		redirect('pegawai/galeri');

	}

	public function galeri_edit() {
		$id_galeri = $this->uri->segment(3);
		$query = $this->pegawai_model->GetGaleriEdit($id_galeri);
		foreach ($query->result_array() as $tampil) {
			$data['id_galeri'] = $tampil['id_galeri'];
			$data['nama_galeri'] = $tampil['nama_galeri'];
			$data['gambar'] = $tampil['gambar'];
			$data['kategorigaleri_id'] = $tampil['kategorigaleri_id'];
		}
		$data['data_kategorigaleri'] = $this->pegawai_model->Getkategorigaleri();
		$this->template_pegawai->load('template_pegawai','pegawai/galeri/edit',$data);
	}

	public function galeri_update() {
		$id['id_galeri'] = $this->input->post("id_galeri");

		if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama_galeri'] = $this->input->post('nama_galeri');
						$in_data['kategorigaleri_id'] = $this->input->post('kategorigaleri_id');
						
						$this->db->update("tbl_galeri",$in_data,$id);

					$this->session->set_flashdata('update','Gallery Berhasil Diupdate');
					redirect("pegawai/galeri");
				}
				else
				{
					$config['upload_path'] = './images/galeri/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/galeri/".$data['file_name'] ;
						$destination_thumb	= "./images/galeri/thumb/" ;
						$destination_medium	= "./images/galeri/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 800 ;
						$limit_thumb    = 270 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama_galeri'] = $this->input->post('nama_galeri');
						$in_data['gambar'] = $data['file_name'];
						$in_data['kategorigaleri_id'] = $this->input->post('kategorigaleri');
						
						$this->db->update("tbl_galeri",$in_data,$id);
				
						
						$this->session->set_flashdata('update','Gallery Berhasil Diupdate');
						redirect("pegawai/galeri");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/galeri/error');
					}
				}

	}
	//Akhir Galeri

	//Awal Logo
	public function logo () {
		$query = $this->pegawai_model->GetLogo();
		foreach ($query->result_array() as $tampil) {
			$data['id_logo']=$tampil['id_logo'];
			$data['gambar']=$tampil['gambar'];
		}
		$this->template_pegawai->load('template_pegawai','pegawai/logo/index',$data);
	}

	 public function logo_simpan()
   {
		if($this->session->userdata("logged_in")!=="") {
			$id['id_logo'] = $this->input->post("id_logo");
			$id_logo = $this->input->post("id_logo");
			

				if(empty($_FILES['userfile']['name']))
				{
					
					
					$this->session->set_flashdata('message','Logo Berhasil Diupdate');
					redirect("pegawai/logo");
				}
				else
				{
					$config['upload_path'] = './images/logo/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '500';
					$config['max_height']  	= '250';
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/logo/".$data['file_name'] ;
						$destination_thumb	= "./images/logo/thumb/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_thumb    = 640 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['gambar'] = $data['file_name'];
						$this->db->update("tbl_logo",$in_data,$id);
				
						
						$this->session->set_flashdata('message','Logo Berhasil Diupdate');
						redirect("pegawai/logo");
						
					}
					else 
					{
						echo $this->upload->display_errors('<p>','</p>');
					}
				}
			
		}
		else
		{
			redirect("pegawai");
		}
   }
	//Akhir Logo

   //Awal kontak
	public function kontak() {
		if($this->session->userdata("logged_in")!=="") {

			$query=$this->pegawai_model->Getkontak();
			foreach ($query->result_array() as $tampil) {
				$data["id_kontak"]=$tampil["id_kontak"];
				$data["alamat"]=$tampil["alamat"];
				$data["phone"]=$tampil["phone"];
				$data["email"]=$tampil["email"];
			}

			$this->template_pegawai->load('template_pegawai','pegawai/kontak/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function kontak_simpan() {
		$id_kontak =$this->input->post("id_kontak");
		$alamat =$this->input->post("alamat");
		$phone =$this->input->post("phone");
		$email =$this->input->post("email");

		$this->pegawai_model->Simpankontak($id_kontak,$alamat,$phone,$email);redirect("pegawai/kontak");
	}
	//Akhir kontak

	//Awal Sosial Media 
   public function sosial_media() {
   	if($this->session->userdata("logged_in")!=="") {
		   	$query = $this->pegawai_model->GetSosialMedia();
		   	foreach ($query->result_array() as $tampil) {
		   		$data['id_sosial_media'] = $tampil['id_sosial_media'];
		   		$data['tw'] = $tampil['tw'];
		   		$data['fb'] = $tampil['fb'];
		   		$data['gp'] = $tampil['gp'];
		   	}
   		$this->template_pegawai->load('template_pegawai','pegawai/sosial_media/index',$data);
	}
	else {
		redirect("pegawai");
	}
   }

   public function sosial_media_simpan() {
		$id_sosial_media =$this->input->post("id_sosial_media");
		$tw =$this->input->post("tw");
		$fb =$this->input->post("fb");
		$gp =$this->input->post("gp");
		

		$this->pegawai_model->SimpanSosialMedia($id_sosial_media,$tw,$fb,$gp);redirect("pegawai/sosial_media");
	}
   //Akhir Sosial Media

	//Awal Kategori
	public function kategori() {

		$data['data_kategori']= $this->pegawai_model->GetKategori();
		$this->template_pegawai->load('template_pegawai','pegawai/kategori/index',$data);
	}

	public function kategori_simpan() {
		$nama_kategori = $this->input->post("nama_kategori");
		$cek = $this->pegawai_model->KategoriSama($nama_kategori);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Kategori Berhasil Disimpan');
			$this->pegawai_model->KategoriSimpan($nama_kategori);
			$success="0";
		}

		echo $success;
	}

	public function kategori_edit() {
		$id_kategori = $this->uri->segment(3);
		$query = $this->pegawai_model->GetEditKategori($id_kategori);
		foreach ($query->result_array() as $tampil) {
			$data['id_kategori'] = $tampil['id_kategori'];
			$data['nama_kategori'] = $tampil['nama_kategori'];
		}

		$this->template_pegawai->load('template_pegawai','pegawai/kategori/edit',$data);
	}

	public function kategori_delete() {
		$id_kategori = $this->uri->segment(3);
		$this->pegawai_model->DeleteKategori($id_kategori);

		$this->session->set_flashdata('message','Kategori Berhasil Dihapus');
		redirect("pegawai/kategori");
	}

	public function kategori_update() {
		$id_kategori = $this->input->post('id_kategori');
		$nama_kategori = $this->input->post('nama_kategori');

		$cek = $this->pegawai_model->KategoriSama($nama_kategori);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Kategori Berhasil Disimpan');
			$this->pegawai_model->KategoriUpdate($id_kategori,$nama_kategori);
			$success="0";
		}

		echo $success;
	}
	//Akhir kategori

	//Awal Brand
	public function brand() {

		$data['data_brand']= $this->pegawai_model->GetBrand();
		$this->template_pegawai->load('template_pegawai','pegawai/brand/index',$data);
	}

	public function brand_simpan() {
		$nama_brand = $this->input->post("nama_brand");
		$cek = $this->pegawai_model->BrandSama($nama_brand);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Brand Berhasil Disimpan');
			$this->pegawai_model->BrandSimpan($nama_brand);
			$success="0";
		}

		echo $success;
	}

	public function brand_edit() {
		$id_brand = $this->uri->segment(3);
		$query = $this->pegawai_model->GetEditBrand($id_brand);
		foreach ($query->result_array() as $tampil) {
			$data['id_brand'] = $tampil['id_brand'];
			$data['nama_brand'] = $tampil['nama_brand'];
		}

		$this->template_pegawai->load('template_pegawai','pegawai/brand/edit',$data);
	}

	public function brand_delete() {
		$id_brand = $this->uri->segment(3);
		$this->pegawai_model->DeleteBrand($id_brand);

		$this->session->set_flashdata('message','Brand Berhasil Dihapus');
		redirect("pegawai/brand");
	}

	public function brand_update() {
		$id_brand = $this->input->post('id_brand');
		$nama_brand = $this->input->post('nama_brand');

		$cek = $this->pegawai_model->BrandSama($nama_brand);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Brand Berhasil Disimpan');
			$this->pegawai_model->BrandUpdate($id_brand,$nama_brand);
			$success="0";
		}

		echo $success;
	}
	//Akhir kategori

	//Awal Kota
	public function kota() {

		$data['data_kota']= $this->pegawai_model->GetKota();
		$this->template_pegawai->load('template_pegawai','pegawai/kota/index',$data);
	}

	public function kota_simpan() {
		$nama_kota = $this->input->post("nama_kota");
		$cek = $this->pegawai_model->KotaSama($nama_kota);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Kota Berhasil Disimpan');
			$this->pegawai_model->KotaSimpan($nama_kota);
			$success="0";
		}

		echo $success;
	}

	public function kota_edit() {
		$id_kota = $this->uri->segment(3);
		$query = $this->pegawai_model->GetEditKota($id_kota);
		foreach ($query->result_array() as $tampil) {
			$data['id_kota'] = $tampil['id_kota'];
			$data['nama_kota'] = $tampil['nama_kota'];
		}

		$this->template_pegawai->load('template_pegawai','pegawai/kota/edit',$data);
	}

	public function kota_delete() {
		$id_kota = $this->uri->segment(3);
		$this->pegawai_model->DeleteKota($id_kota);

		$this->session->set_flashdata('message','Kota Berhasil Dihapus');
		redirect("pegawai/kota");
	}

	public function kota_update() {
		$id_kota = $this->input->post('id_kota');
		$nama_kota = $this->input->post('nama_kota');

		$cek = $this->pegawai_model->KotaSama($nama_kota);

		if ($cek->num_rows()>0) {
			$success = "1";
		}
		else {
			$this->session->set_flashdata('berhasil','Kota Berhasil Disimpan');
			$this->pegawai_model->KotaUpdate($id_kota,$nama_kota);
			$success="0";
		}

		echo $success;
	}
	//Akhir Kota

	//Awal Bank
	public function bank() {

		$data['data_bank'] = $this->pegawai_model->GetBank();
		$this->template_pegawai->load('template_pegawai','pegawai/bank/index',$data);

	}

	public function bank_tambah() {
		
		$this->template_pegawai->load('template_pegawai','pegawai/bank/add');
	}

	public function bank_simpan() {

			
			$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
			$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required');
			$this->form_validation->set_rules('no_rekening', 'No Rekening', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				
				$this->template_pegawai->load('template_pegawai','pegawai/bank/add');
			}
			else {

				if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$this->db->insert("tbl_bank",$in_data);

					$this->session->set_flashdata('berhasil','Bank Berhasil Disimpan');
					redirect("pegawai/bank");
				}
				else
				{
					$config['upload_path'] = './images/bank/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/bank/".$data['file_name'] ;
						$destination_thumb	= "./images/bank/thumb/" ;
						$destination_medium	= "./images/bank/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 800 ;
						$limit_thumb    = 270 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$in_data['gambar'] = $data['file_name'];
						
						
						$this->db->insert("tbl_bank",$in_data);

				
						
						$this->session->set_flashdata('berhasil','Bank Berhasil Disimpan');
						redirect("pegawai/bank");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/bank/error');
					}
				}
				
			}

	}

	public function bank_delete() {
		$id_bank = $this->uri->segment(3);
		$this->pegawai_model->DeleteBank($id_bank);

		$this->session->set_flashdata('message','Bank Berhasil Dihapus');
		redirect('pegawai/bank');

	}

	public function bank_edit() {
		$id_bank = $this->uri->segment(3);
		$query = $this->pegawai_model->GetBankEdit($id_bank);
		foreach ($query->result_array() as $tampil) {
			$data['id_bank'] = $tampil['id_bank'];
			$data['nama_bank'] = $tampil['nama_bank'];
			$data['nama_pemilik'] = $tampil['nama_pemilik'];
			$data['no_rekening'] = $tampil['no_rekening'];
			$data['gambar'] = $tampil['gambar'];
		}
		$this->template_pegawai->load('template_pegawai','pegawai/bank/edit',$data);
	}

	public function bank_update() {
		$id['id_bank'] = $this->input->post("id_bank");

		if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						
						$this->db->update("tbl_bank",$in_data,$id);

					$this->session->set_flashdata('update','Bank Berhasil Diupdate');
					redirect("pegawai/bank");
				}
				else
				{
					$config['upload_path'] = './images/bank/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '260';
					$config['max_height']  	= '100';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/bank/".$data['file_name'] ;
						$destination_thumb	= "./images/bank/thumb/" ;
						$destination_medium	= "./images/bank/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 90 ;
						$limit_thumb    = 60 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama_bank'] = $this->input->post('nama_bank');
						$in_data['nama_pemilik'] = $this->input->post('nama_pemilik');
						$in_data['no_rekening'] = $this->input->post('no_rekening');
						$in_data['gambar'] = $data['file_name'];
						
						$this->db->update("tbl_bank",$in_data,$id);
				
						
						$this->session->set_flashdata('update','Bank Berhasil Diupdate');
						redirect("pegawai/bank");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/bank/error');
					}
				}

	}
	//Akhir Bank

	//Awal Tentang Kami
	public function tentangkami() {
		if ($this->session->userdata("logged_in")!=="") {

			$query = $this->pegawai_model->GetTentangkami();
			foreach ($query->result_array() as $tampil) {
				$data['id_tentangkami']=$tampil['id_tentangkami'];
				$data['judul']=$tampil['judul'];
				$data['deskripsi']=$tampil['deskripsi'];
			}

			$this->template_pegawai->load('template_pegawai','pegawai/tentangkami/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function tentangkami_simpan() {
		$id_tentangkami = $this->input->post('id_tentangkami');
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');

		$this->pegawai_model->UpdateTentangkami($id_tentangkami,$judul,$deskripsi);redirect("pegawai/tentangkami");
	}
	//Akhir Tentang Kami

	//Awal Cara Belanja
	public function carabelanja() {
		if ($this->session->userdata("logged_in")!=="") {

			$query = $this->pegawai_model->GetCarabelanja();
			foreach ($query->result_array() as $tampil) {
				$data['id_carabelanja']=$tampil['id_carabelanja'];
				$data['judul']=$tampil['judul'];
				$data['deskripsi']=$tampil['deskripsi'];
			}

			$this->template_pegawai->load('template_pegawai','pegawai/carabelanja/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function carabelanja_simpan() {
		$id_carabelanja = $this->input->post('id_carabelanja');
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');

		$this->pegawai_model->UpdateCarabelanja($id_carabelanja,$judul,$deskripsi);redirect("pegawai/carabelanja");
	}
	//Akhir Cara Belanja

	//Awal Sambutan
	public function sambutan() {
		if ($this->session->userdata("logged_in")!=="") {

			$query = $this->pegawai_model->GetSambutan();
			foreach ($query->result_array() as $tampil) {
				$data['id_sambutan']=$tampil['id_sambutan'];
				$data['judul']=$tampil['judul'];
				$data['deskripsi']=$tampil['deskripsi'];
			}

			$this->template_pegawai->load('template_pegawai','pegawai/sambutan/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function sambutan_simpan() {
		$id_sambutan = $this->input->post('id_sambutan');
		$judul = $this->input->post('judul');
		$deskripsi = $this->input->post('deskripsi');

		$this->pegawai_model->UpdateSambutan($id_sambutan,$judul,$deskripsi);
	}
	//Akhir Sambutan

	//Awal Admin
	public function pegservice() {
		if($this->session->userdata("logged_in")!=="") {

			$data['data_pegser'] = $this->pegawai_model->Getpegser();
			$this->template->load('template_pegawai','pegawai/pegservice/index',$data);
		}
		else {
			redirect("pegawai");
		}
	} 

	public function pegservice_delete() {
		$id = $this->uri->segment(3);
		$this->pegawai_model->DeletePeg($id);

		$this->session->set_flashdata('message','Admin Berhasil Dihapus');
		redirect('pegawai/pegservice');
	}

	public function pegservice_tambah() {
		$this->template->load('template_pegawai','pegawai/pegservice/add');
	}

	public function pegservice_simpan() {

			$this->form_validation->set_rules('nama', 'Nama Pegawai Service', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat ', 'required');
			$this->form_validation->set_rules('tlpn', 'Telepon', 'required');
			
			

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->load('template_pegawai','pegawai/pegservice/add');
			}
			else {

						$in_data['nama'] 		= $this->input->post('nama');
						$in_data['alamat'] 			= $this->input->post('alamat');
						$in_data['tlpn'] 		= $this->input->post('tlpn');
						$this->db->insert("tbl_peg_service",$in_data);

					$this->session->set_flashdata('berhasil','Admin Berhasil Disimpan');
					redirect("pegawai/pegservice");
				
			}

	}

	public function pegservice_edit() {
		$id = $this->uri->segment(3);
		$query = $this->pegawai_model->GetPegEdit($id);
		foreach ($query->result_array() as $tampil) {
			$data['id_peg_service'] = $tampil['id_peg_service'];
			$data['nama'] = $tampil['nama'];
			$data['alamat'] = $tampil['alamat'];
			$data['tlpn'] = $tampil['tlpn'];
			
			
		}
		$this->template->load('template_pegawai','pegawai/pegservice/edit',$data);
	}

	public function pegservice_update() {
		$id['id_peg_service'] = $this->input->post("id_peg_service");


			$in_data['nama'] = $this->input->post('nama');
			$in_data['alamat'] = $this->input->post('alamat');
			$in_data['tlpn'] = $this->input->post('tlpn');
		

	
								
		$this->db->update("tbl_peg_service",$in_data,$id);

		$this->session->set_flashdata('update','Admin Berhasil Diupdate');
		redirect("pegawai/pegservice");
		
	}
	//Akhir Admin

	//Awal Jasa Pengirman
	public function jasapengiriman() {

		$data['data_jasapengiriman'] = $this->pegawai_model->GetJasapengiriman();
		$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/index',$data);

	}

	public function jasapengiriman_tambah() {
		$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/add');
	}

	public function jasapengiriman_simpan() {

			$this->form_validation->set_rules('nama', 'Nama Jasa Pengiriman', 'required');
			
		
			

			if ($this->form_validation->run() == FALSE)
			{
			
				$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/add');
			}
			else {

				if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama'] = $this->input->post('nama');
						$this->db->insert("tbl_jasapengiriman",$in_data);

					$this->session->set_flashdata('berhasil','Jasa Pengiriman Berhasil Disimpan');
					redirect("pegawai/jasapengiriman");
				}
				else
				{
					$config['upload_path'] = './images/jasapengiriman/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '150';
					$config['max_height']  	= '60';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/jasapengiriman/".$data['file_name'] ;
						$destination_thumb	= "./images/jasapengiriman/thumb/" ;
						$destination_medium	= "./images/jasapengiriman/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 150 ;
						$limit_thumb    = 60 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama'] = $this->input->post('nama');
						$in_data['gambar'] = $data['file_name'];
						
						
						
						$this->db->insert("tbl_jasapengiriman",$in_data);

				
						
						$this->session->set_flashdata('berhasil','Jasa Pengiriman Berhasil Disimpan');
						redirect("pegawai/jasapengiriman");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/error');
					}
				}
				
			}

	}

	public function jasapengiriman_delete() {
		$id_jasapengiriman = $this->uri->segment(3);
		$this->pegawai_model->DeleteJasapengiriman($id_jasapengiriman);

		$this->session->set_flashdata('message','Jasa Pengiriman Berhasil Dihapus');
		redirect('pegawai/jasapengiriman');

	}

	public function jasapengiriman_edit() {
		$id_jasapengiriman = $this->uri->segment(3);
		$query = $this->pegawai_model->GetJasapengirimanEdit($id_jasapengiriman);
		foreach ($query->result_array() as $tampil) {
			$data['id_jasapengiriman'] = $tampil['id_jasapengiriman'];
			$data['nama'] = $tampil['nama'];
			$data['gambar'] = $tampil['gambar'];
		}
		$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/edit',$data);
	}

	public function jasapengiriman_update() {
		$id['id_jasapengiriman'] = $this->input->post("id_jasapengiriman");

		if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['nama'] = $this->input->post('nama');
					
						$this->db->update("tbl_jasapengiriman",$in_data,$id);

					$this->session->set_flashdata('update','Jasa Pengiriman Berhasil Diupdate');
					redirect("pegawai/jasapengiriman");
				}
				else
				{
					$config['upload_path'] = './images/jasapengiriman/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '150';
					$config['max_height']  	= '60';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/jasapengiriman/".$data['file_name'] ;
						$destination_thumb	= "./images/jasapengiriman/thumb/" ;
						$destination_medium	= "./images/jasapengiriman/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 800 ;
						$limit_thumb    = 270 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['nama'] = $this->input->post('nama');
						$in_data['gambar'] = $data['file_name'];
						
						$this->db->update("tbl_jasapengiriman",$in_data,$id);
				
						
						$this->session->set_flashdata('update','Jasa Pengiriman Berhasil Diupdate');
						redirect("pegawai/jasapengiriman");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/jasapengiriman/error');
					}
				}

	}
	//Akhir Jasa Pengiriman

	//Awal Produk 
	public function produk () {

		$data['data_produk'] = $this->pegawai_model->GetProduk();
		$this->template_pegawai->load('template_pegawai','pegawai/produk/index',$data);
	}
	//Akhir Produk

	public function produk_tambah(){
		$data['kode_produk'] = $this->pegawai_model->GetMaxKodeProduk();
		$data['data_brand'] = $this->pegawai_model->GetBrand();
		$data['data_kategori'] = $this->pegawai_model->GetKategori();
		$this->template_pegawai->load('template_pegawai','pegawai/produk/add',$data);
	}

	public function produk_simpan() {
		$this->form_validation->set_rules('nama_produk','Nama Produk','required');
		$this->form_validation->set_rules('brand_id','Brand','required');
		$this->form_validation->set_rules('kategori_id','Kategori','required');
		$this->form_validation->set_rules('harga','Harga','required');
		$this->form_validation->set_rules('stok','Stok','required');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');

		if ($this->form_validation->run()==FALSE) {

			$data['kode_produk'] = $this->pegawai_model->GetMaxKodeProduk();
			$data['data_brand'] = $this->pegawai_model->GetBrand();
			$data['data_kategori'] = $this->pegawai_model->GetKategori();
			$this->template_pegawai->load('template_pegawai','pegawai/produk/add',$data);

		}
		else {

			if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['kode_produk'] = $this->input->post('kode_produk');
						$in_data['nama_produk'] = $this->input->post('nama_produk');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['stok'] = $this->input->post('stok');
						$in_data['deskripsi'] = $this->input->post('deskripsi');
						$in_data['kategori_id'] = $this->input->post('kategori_id');
						$in_data['brand_id'] = $this->input->post('brand_id');
						$this->db->insert("tbl_produk",$in_data);

					$this->session->set_flashdata('berhasil','Produk Berhasil Disimpan');
					redirect("pegawai/produk");
				}
				else
				{
					$config['upload_path'] = './images/produk/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '268';
					$config['max_height']  	= '249';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/produk/".$data['file_name'] ;
						$destination_thumb	= "./images/produk/thumb/" ;
						$destination_medium	= "./images/produk/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 268 ;
						$limit_thumb    = 249 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['kode_produk'] = $this->input->post('kode_produk');
						$in_data['nama_produk'] = $this->input->post('nama_produk');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['stok'] = $this->input->post('stok');
						$in_data['deskripsi'] = $this->input->post('deskripsi');
						$in_data['kategori_id'] = $this->input->post('kategori_id');
						$in_data['brand_id'] = $this->input->post('brand_id');
						$in_data['gambar'] = $data['file_name'];
						
						
						
						$this->db->insert("tbl_produk",$in_data);

						

				
						
						$this->session->set_flashdata('berhasil','Produk Berhasil Disimpan');
						redirect("pegawai/produk");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/produk/error');
					}
				}

		}
	}

	public function produk_delete() {
		$id_produk = $this->uri->segment(3);
		$this->pegawai_model->DeleteProduk($id_produk);

		$this->session->set_flashdata('message','Produk Berhasil Dihapus');
		redirect('pegawai/produk');

	}

	public function produk_edit() {
		$id_produk = $this->uri->segment(3);
		$query = $this->pegawai_model->EditProduk($id_produk);
		foreach ($query->result_array() as $tampil) {

			$data['id_produk']= $tampil['id_produk'];
			$data['kode_produk']= $tampil['kode_produk'];
			$data['nama_produk']= $tampil['nama_produk'];
			$data['harga']= $tampil['harga'];
			$data['stok']= $tampil['stok'];
			$data['deskripsi']= $tampil['deskripsi'];
			$data['kategori_id']= $tampil['kategori_id'];
			$data['brand_id']= $tampil['brand_id'];
			
		}
		$data['data_kategori'] = $this->pegawai_model->GetKategori();
		$data['data_brand']  = $this->pegawai_model->GetBrand();
		$this->template_pegawai->load('template_pegawai','pegawai/produk/edit',$data);
	}

	public function produk_update() {
		$id['id_produk'] = $this->input->post("id_produk");

		if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['kode_produk'] = $this->input->post('kode_produk');
						$in_data['nama_produk'] = $this->input->post('nama_produk');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['stok'] = $this->input->post('stok');
						$in_data['deskripsi'] = $this->input->post('deskripsi');
						$in_data['kategori_id'] = $this->input->post('kategori_id');
						$in_data['brand_id'] = $this->input->post('brand_id');
					
						$this->db->update("tbl_produk",$in_data,$id);

					$this->session->set_flashdata('update','Produk Berhasil Diupdate');
					redirect("pegawai/produk");
				}
				else
				{
					$config['upload_path'] = './images/produk/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '268';
					$config['max_height']  	= '249';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/produk/".$data['file_name'] ;
						$destination_thumb	= "./images/produk/thumb/" ;
						$destination_medium	= "./images/produk/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 268 ;
						$limit_thumb    = 249 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['kode_produk'] = $this->input->post('kode_produk');
						$in_data['nama_produk'] = $this->input->post('nama_produk');
						$in_data['harga'] = $this->input->post('harga');
						$in_data['stok'] = $this->input->post('stok');
						$in_data['deskripsi'] = $this->input->post('deskripsi');
						$in_data['kategori_id'] = $this->input->post('kategori_id');
						$in_data['brand_id'] = $this->input->post('brand_id');
						$in_data['gambar'] = $data['file_name'];
						
						$this->db->update("tbl_produk",$in_data,$id);
				
						
						$this->session->set_flashdata('update','Produk Berhasil Diupdate');
						redirect("pegawai/produk");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/produk/error');
					}
				}

	}

	//Akhir Produk

	//Awal Slider 
	public function slider () {

		$data['data_slider'] = $this->pegawai_model->GetSlider();
		$this->template_pegawai->load('template_pegawai','pegawai/slider/index',$data);
	}
	

	public function slider_tambah(){
		
		$this->template_pegawai->load('template_pegawai','pegawai/slider/add');
	}

	public function slider_simpan() {
		$this->form_validation->set_rules('tittle','Tittle','required');
		$this->form_validation->set_rules('description','Description','required');

		if ($this->form_validation->run()==FALSE) {

			$this->template_pegawai->load('template_pegawai','pegawai/produk/add');

		}
		else {

			if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['tittle'] = $this->input->post('tittle');
						$in_data['description'] = $this->input->post('description');
						$in_data['status'] = $this->input->post('status');
						$this->db->insert("tbl_slider",$in_data);

					$this->session->set_flashdata('berhasil','Slider Berhasil Disimpan');
					redirect("pegawai/produk");
				}
				else
				{
					$config['upload_path'] = './images/slider/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '484';
					$config['max_height']  	= '441';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/slider/".$data['file_name'] ;
						$destination_thumb	= "./images/slider/thumb/" ;
						$destination_medium	= "./images/slider/medium/" ;
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 481 ;
						$limit_thumb    = 441 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;

						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
			 			// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['tittle'] = $this->input->post('tittle');
						$in_data['description'] = $this->input->post('description');
						$in_data['status'] = $this->input->post('status');
						$in_data['gambar'] = $data['file_name'];
						
						
						
						$this->db->insert("tbl_slider",$in_data);

						

				
						
						$this->session->set_flashdata('berhasil','Slider Berhasil Disimpan');
						redirect("pegawai/slider");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/slider/error');
					}
				}

		}
	}

	public function slider_delete() {
		$id_slider = $this->uri->segment(3);
		$this->pegawai_model->DeleteSlider($id_slider);

		$this->session->set_flashdata('message','Slider Berhasil Dihapus');
		redirect('pegawai/slider');

	}

	public function slider_edit() {
		$id_slider = $this->uri->segment(3);
		$query = $this->pegawai_model->EditSlider($id_slider);
		foreach ($query->result_array() as $tampil) {

			$data['id_slider']= $tampil['id_slider'];
			$data['tittle']= $tampil['tittle'];
			$data['description']= $tampil['description'];
			$data['status']= $tampil['status'];
			
			
		}
		
		$this->template_pegawai->load('template_pegawai','pegawai/slider/edit',$data);
	}

	public function slider_update() {
		$id['id_slider'] = $this->input->post("id_slider");

		if(empty($_FILES['userfile']['name']))
				{
					
						$in_data['tittle'] = $this->input->post('tittle');
						$in_data['description'] = $this->input->post('description');
						$in_data['status'] = $this->input->post('status');
						
					
						$this->db->update("tbl_slider",$in_data,$id);

					$this->session->set_flashdata('update','Slider Berhasil Diupdate');
					redirect("pegawai/slider");
				}
				else
				{
					$config['upload_path'] = './images/slider/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$config['encrypt_name']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '481';
					$config['max_height']  	= '441';
					
			 
					$this->load->library('upload', $config);
	 
					if ($this->upload->do_upload("userfile")) {
						$data	 	= $this->upload->data();
			 
						/* PATH */
						$source             = "./images/slider/".$data['file_name'] ;
						$destination_thumb	= "./images/slider/thumb/" ;
						$destination_medium	= "./images/slider/medium/" ;
			 
						// Permission Configuration
						chmod($source, 0777) ;
			 
						/* Resizing Processing */
						// Configuration Of Image Manipulation :: Static
						$this->load->library('image_lib') ;
						$img['image_library'] = 'GD2';
						$img['create_thumb']  = TRUE;
						$img['maintain_ratio']= TRUE;
			 
						/// Limit Width Resize
						$limit_medium   = 481 ;
						$limit_thumb    = 441 ;
			 
						// Size Image Limit was using (LIMIT TOP)
						$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
			 
						// Percentase Resize
						if ($limit_use > $limit_thumb) {
							$percent_medium = $limit_medium/$limit_use ;
							$percent_thumb  = $limit_thumb/$limit_use ;
						}
			 
						//// Making THUMBNAIL ///////
						$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
						$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_thumb ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
	 
						////// Making MEDIUM /////////////
						$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
						$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;
			 
						// Configuration Of Image Manipulation :: Dynamic
						$img['thumb_marker'] = '';
						$img['quality']      = '100%' ;
						$img['source_image'] = $source ;
						$img['new_image']    = $destination_medium ;
			 
						// Do Resizing
						$this->image_lib->initialize($img);
						$this->image_lib->resize();
						$this->image_lib->clear() ;
						
						$in_data['tittle'] = $this->input->post('tittle');
						$in_data['description'] = $this->input->post('description');
						$in_data['status'] = $this->input->post('status');
						$in_data['gambar'] = $data['file_name'];
						
						$this->db->update("tbl_slider",$in_data,$id);
				
						
						$this->session->set_flashdata('update','Slider Berhasil Diupdate');
						redirect("pegawai/slider");
						
					}
					else 
					{
						$this->template_pegawai->load('template_pegawai','pegawai/slider/error');
					}
				}

	}

	//Akhir Slider

	//Awal Buku Tamu
	public function buku_tamu() {

		if($this->session->userdata("logged_in")!=="") {

			$data['data_buku_tamu'] = $this->pegawai_model->GetBukuTamu();

			$this->template->load('template_pegawai','pegawai/buku_tamu/index',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function buku_tamu_hapus() {

		$id = $this->uri->segment(3);
		$this->pegawai_model->DeleteBukuTamu($id);
		
		$this->session->set_flashdata('message','Pesan Berhasil Dihapus');
		redirect("pegawai/buku_tamu");
	}

	public function buku_tamu_detail() {

		$id = $this->uri->segment(3);
		$status ="1";
		$query = $this->pegawai_model->DetailBukuTamu($id);
		foreach ($query->result_array() as $tampil) {
			$data['id_hubungikami'] = $tampil['id_hubungikami'];
			$data['nama'] = $tampil['nama'];
			$data['email'] = $tampil['email'];
			$data['hp'] = $tampil['hp'];
			$data['alamat'] = $tampil['alamat'];
			$data['pesan'] = $tampil['pesan'];
			$data['tanggal'] = $tampil['tanggal'];
		}

		$this->pegawai_model->UpdateStatusBukuTamu($status,$id);
		
		$this->template->load('template_pegawai','pegawai/buku_tamu/detail',$data);
	}

	public function buku_tamu_balas() {
		if($this->session->userdata("logged_in")!=="") {

			$id = $this->uri->segment(3);
			$query = $this->pegawai_model->DetailBukuTamu($id);
			foreach ($query->result_array() as $tampil) {
				$data['id_hubungikami'] = $tampil['id_hubungikami'];
				$data['nama'] = $tampil['nama'];
				$data['email'] = $tampil['email'];
				$data['hp'] = $tampil['hp'];
				$data['alamat'] = $tampil['alamat'];
				$data['pesan'] = $tampil['pesan'];
				$data['tanggal'] = $tampil['tanggal'];
			}

			$this->template->load('template_pegawai','pegawai/buku_tamu/balas',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function buku_tamu_balas_simpan() {
		$email = $this->input->post("email");
		$judul = $this->input->post("judul");
		$isi_hubungi_kami_kirim = $this->input->post("isi_hubungi_kami_kirim");

		$this->pegawai_model->SimpanBukuTamuAdd($email,$judul,$isi_hubungi_kami_kirim);

		$this->load->library('email');
		$this->email->from('info@adriano.com', 'Adriano MX Online Shop');
		$this->email->to($email); 	
		$this->email->subject($judul);
		$this->email->message($isi_hubungi_kami_kirim);	
		$this->email->send();
	}


	public function buku_tamu_add() {
		if($this->session->userdata("logged_in")!=="") {

			$this->template->load('template_pegawai','pegawai/buku_tamu/add');
		}
		else {
			redirect("pegawai");
		}
	}

	public function buku_tamu_add_simpan() {
		$email = $this->input->post("email");
		$judul = $this->input->post("judul");
		$isi_hubungi_kami_kirim = $this->input->post("isi_hubungi_kami_kirim");

		$this->pegawai_model->SimpanBukuTamuAdd($email,$judul,$isi_hubungi_kami_kirim);

		$this->load->library('email');
		$this->email->from('info@adriano.com', 'Adriano MX Online Shop');
		$this->email->to($email); 	
		$this->email->subject($judul);
		$this->email->message($isi_hubungi_kami_kirim);	
		$this->email->send();
	}

	public function buku_tamu_kirim() {

		if($this->session->userdata("logged_in")!=="") {

			$data['data_buku_tamu_kirim'] = $this->pegawai_model->GetBukuTamuKirim();

			$this->template->load('template_pegawai','pegawai/buku_tamu/kirim',$data);
		}
		else {
			redirect("pegawai");
		}
	}

	public function buku_tamu_kirim_hapus() {

		$id = $this->uri->segment(3);
		$this->pegawai_model->DeleteBukuTamuKirim($id);
		
		$this->session->set_flashdata('message','Pesan Berhasil Dihapus');
		redirect("pegawai/buku_tamu_kirim");
	}

	public function buku_tamu_kirim_detail() {

		$id = $this->uri->segment(3);
		$query = $this->pegawai_model->DetailBukuTamuKirim($id);
		foreach ($query->result_array() as $tampil) {
			$data['id_hubungi_kami_kirim'] = $tampil['id_hubungi_kami_kirim'];
			$data['kepada'] = $tampil['kepada'];
			$data['judul'] = $tampil['judul'];
			$data['isi_hubungi_kami_kirim'] = $tampil['isi_hubungi_kami_kirim'];
			
		}

		
		$this->template->load('template_pegawai','pegawai/buku_tamu/detail_kirim',$data);
	}
	//Akhir Buku Tamu


	public function transaksi() {


		if($this->session->userdata("logged_in")!=="") {

			$data['data_transaksi'] = $this->pegawai_model->GetTransaksi();

			$this->template->load('template_pegawai','pegawai/transaksi/index',$data);
		}
		else {
			redirect("pegawai");
		}

	}

	public function transaksi_proses () {

		if($this->session->userdata("logged_in")!=="") {

			$id  = $this->uri->segment(3);

			$this->pegawai_model->UpdateTransaksiHeader($id);

			$this->session->set_flashdata('berhasil','Transaksi Berhasil Di Proses');
			redirect("pegawai/transaksi");




		}
		else {
			redirect("pegawai");
		}

	}

	public function transaksi_detail () {

		if($this->session->userdata("logged_in")!=="") {

			$id  			= $this->uri->segment(3);
			$kode_transaksi = $this->uri->segment(4);

			$data['data_header'] 	= $this->pegawai_model->GetTransaksiheader($id);  
			$data['data_detail']	= $this->pegawai_model->GetDetailTransaksi($kode_transaksi);
			$data['data_total']		= $this->pegawai_model->GetDetailTotal($kode_transaksi);

			$this->template->load('template_pegawai','pegawai/transaksi/detail',$data);

		}
		else {
			redirect("pegawai");
		}

	}

	public function semua_transaksi () {

		if($this->session->userdata("logged_in")!=="") {

			$data['data_transaksi'] = $this->pegawai_model->GetTransaksiSudah();

			$this->template->load('template_pegawai','pegawai/transaksi/sudah',$data);


		}
		else {
			redirect("pegawai");
		}

	}

	public function semua_transaksi_detail () {

		if($this->session->userdata("logged_in")!=="") {

			$id  			= $this->uri->segment(3);
			$kode_transaksi = $this->uri->segment(4);

			$data['data_header'] 	= $this->pegawai_model->GetTransaksiheader($id);  
			$data['data_detail']	= $this->pegawai_model->GetDetailTransaksi($kode_transaksi);
			$data['data_total']		= $this->pegawai_model->GetDetailTotal($kode_transaksi);

			$this->template->load('template_pegawai','pegawai/transaksi/detail_semua',$data);

		}
		else {
			redirect("pegawai");
		}

	}

}