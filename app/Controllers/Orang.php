<?php

namespace App\Controllers;


use App\Models\OrangModel as ModelsOrangModel;

class Orang extends BaseController
{
    protected $orangModel;

    public function __construct()
    {
        $this->orangModel = new ModelsOrangModel();
    }
    public function index()
    {
        $currentPage =  $this->request->getvar('page_orang') ? $this->request->getvar('page_orang') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->orangModel->cariOrang($keyword);
        } else {
            $orang = $this->orangModel;
        }

        $data = [
            'title' => 'Daftar orang',
            // 'orang' =>  $this->orangModel->findAll()
            'orang' =>  $orang->paginate(7, 'orang'),
            'pager' => $this->orangModel->pager,
            'currentPage' => $currentPage
        ];
        return view('orang/index', $data);
    }
}
