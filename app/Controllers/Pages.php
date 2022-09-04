<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => ' Home | Web Aja '
        ];

        return view('pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => ' About Me '
        ];

        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact As',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl.AjaDulu',
                    'kota' => 'Jakarta'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl.Ituaja',
                    'kota' => 'Depok'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
