<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nv = DB::select('SELECT nhanvien.*,chucvu.tencv FROM nhanvien INNER JOIN chucvu ON nhanvien.macv = chucvu.macv');
        return view('dashboard.category.sales-agent.staff-infor', ['nhanvien'=>$nv]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function data(){
        $nhanvien = array(
            array('manv' => 'MNV-0001','macv' => 'CV-01','hovaten' => 'Ms. Cassandre Corkery','ngaysinh' => '1986-04-06','gioitinh' => 'Nữ','sodienthoai' => '02933348279','email' => 'flatley.lawrence@example.net','diachi' => '481 VonRueden Dale Apt. 727','ghichu' => 'Quia et voluptas officia dolorum est.'),
            array('manv' => 'MNV-0002','macv' => 'CV-01','hovaten' => 'Scarlett Jaskolski II','ngaysinh' => '1983-12-01','gioitinh' => 'Nữ','sodienthoai' => '01187119495','email' => 'jschultz@example.net','diachi' => '472 Reichel Ports','ghichu' => 'Ut non beatae iure enim atque.'),
            array('manv' => 'MNV-0003','macv' => 'CV-01','hovaten' => 'Leopoldo Connelly','ngaysinh' => '1994-08-29','gioitinh' => 'Nam','sodienthoai' => '06926184416','email' => 'laura49@example.net','diachi' => '42000 Eleonore Brook','ghichu' => 'Officia eos labore.'),
            array('manv' => 'MNV-0004','macv' => 'CV-01','hovaten' => 'Mckenzie Mills','ngaysinh' => '1992-01-14','gioitinh' => 'Nữ','sodienthoai' => '00695490373','email' => 'bryana96@example.net','diachi' => '1081 Antoinette Circles Suite 341','ghichu' => 'Qui reiciendis dolores impedit.'),
            array('manv' => 'MNV-0005','macv' => 'CV-01','hovaten' => 'Lyla Nolan PhD','ngaysinh' => '1971-07-04','gioitinh' => 'Nữ','sodienthoai' => '03919816770','email' => 'emmet53@example.net','diachi' => '969 Merlin Parkway','ghichu' => 'Perspiciatis praesentium magni est.'),
            array('manv' => 'MNV-0006','macv' => 'CV-01','hovaten' => 'Gregoria Cummerata','ngaysinh' => '1986-09-04','gioitinh' => 'Nữ','sodienthoai' => '04545394462','email' => 'zokon@example.org','diachi' => '31019 Eldridge Hollow Suite 533','ghichu' => 'Doloribus nostrum laudantium fuga.'),
            array('manv' => 'MNV-0007','macv' => 'CV-01','hovaten' => 'Mr. Maxwell Hamill','ngaysinh' => '1970-04-22','gioitinh' => 'Nữ','sodienthoai' => '05627814767','email' => 'upfeffer@example.net','diachi' => '1236 Conroy Island','ghichu' => 'Commodi consequatur odio vero neque.'),
            array('manv' => 'MNV-0008','macv' => 'CV-01','hovaten' => 'Kaleigh Johnson','ngaysinh' => '2009-11-28','gioitinh' => 'Nữ','sodienthoai' => '03882265168','email' => 'jmorar@example.net','diachi' => '5154 Terry Centers Suite 336','ghichu' => 'Reiciendis eveniet et ipsam veniam optio.'),
            array('manv' => 'MNV-0009','macv' => 'CV-01','hovaten' => 'Carrie Pfannerstill','ngaysinh' => '1994-10-14','gioitinh' => 'Nữ','sodienthoai' => '03046235605','email' => 'watson25@example.net','diachi' => '441 Goodwin Canyon Apt. 142','ghichu' => 'Quis expedita et perferendis.'),
            array('manv' => 'MNV-0010','macv' => 'CV-01','hovaten' => 'Russel Jakubowski','ngaysinh' => '1980-08-30','gioitinh' => 'Nam','sodienthoai' => '06954121245','email' => 'kraig37@example.net','diachi' => '106 Yundt Coves Apt. 773','ghichu' => 'Natus molestias molestiae sit sit.')
        );
        NhanVien::insert($nhanvien);
    }
}
