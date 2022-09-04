<?php

namespace App\Controllers;


use App\Models\KomikModel as ModelsKomikModel;

class Komik extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new ModelsKomikModel();
    }
    public function index()
    {
        $komik =  $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik',
            'komik' =>  $komik
        ];
        return view('komik/index', $data);
    }


    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];
        //Jika Komik Ga Ada
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('judul Komik' . $slug . 'Tidak ada yaa');
        }

        return view('komik/detail', $data);
    }
    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} Komik harus di isi',
                    'is_unique' => '{field} Komik Sudah ada'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukurun Gambar terlalu BESAR',
                    'is_image' => 'Yang Anda pilih bukan Gambar',
                    'mime_in' => 'Yang Anda pilih bukan Gambar'
                ]
            ]


        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/tambah')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/tambah')->withInput();
        }
        //ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah ada foto yg di upload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'kosong.png';
        } else {
            //generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }


        // //ambil nama file img
        // $namaSampul = $fileSampul->getName();

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul

        ]);

        session()->setFlashdata('pesan', 'Data berhasil di tambahkan.');

        return redirect()->to('/komik');
    }
    public function delete($id)
    {
        //cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        //cek jika gambarnya defauld atau kosong.png
        if ($komik['sampul'] != 'kosong.png') {

            //Hpus Gambar   
            unlink('img/' . $komik['sampul']);
        }
        $this->komikModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Data berhasil di HAPUS.');

        return redirect()->to('/komik');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Tambah Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];
        return view('komik/edit', $data);
    }
    public function update($id)
    {
        //Cek Komik
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} Komik harus di isi',
                    'is_unique' => '{field} Komik Sudah ada'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukurun Gambar terlalu BESAR',
                    'is_image' => 'Yang Anda pilih bukan Gambar',
                    'mime_in' => 'Yang Anda pilih bukan Gambar'
                ]
            ]
        ])) {


            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $fileSampul = $this->request->getFile('sampul');

        //cek gambar apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama file  random
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            //hapus sampul lama
            // unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' =>  $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul

        ]);

        session()->setFlashdata('pesan', 'Data berhasil di ubah.');

        return redirect()->to('/komik');
    }
    public function tambah()
    {

        $data = [
            'title' => 'Tambah Komik',
            'validation' => \Config\Services::validation()
        ];
        return view('komik/tambah', $data);
    }
}
