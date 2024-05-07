<?php

namespace App\Http\Controllers;

use App\Models\HangXe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HangXeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hx = DB::table('hangxe')->get();
        return view('dashboard.category.vehicle.automaker.automaker-info', ['hangxe' => $hx]);
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
        $logo = $request->file('logo');
        $path = $logo->store('logo', 'public');

        // Sau đó, chèn đường dẫn của từng tập tin vào cơ sở dữ liệu
        DB::table('hangxe')->insert([
            'mahx' => $request->mahx,
            'tenhang' => $request->tenhang,
            'logo' => $path,
            'xuatxu' => $request->xs,
        ]);

        return redirect('dashboard/category/vehicle/automaker-info')->with('success', 'Post created successfully!');
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
        DB::table('hangxe')->where('mahx', $id)->delete();
        return redirect('dashboard/category/vehicle/automaker-info')->with('success', 'Post created successfully!');
    }
    public function data()
    {
        $hangxe = array(
            array('mahx' => 'HX01','tenhang' => 'Honda','logo' => 'logo/2IHtzazFp1GjqQ5PFsdorq67k5Gcp8Zhb6E4Q7Nj.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX02','tenhang' => 'Yamaha','logo' => 'logo/JTyfQd2xxYDqFfY66sWi5uiCzblFp81q4r3N4CTV.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX03','tenhang' => 'Suzuki','logo' => 'logo/0hxl1IG3eGZwneO99tDe8VLt4W2waiNnxR9C4JTN.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX04','tenhang' => 'Sym','logo' => 'logo/jdnnfzEoSkP1r4l9C2tIYBTQ67BmkjpM8aBktqqT.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX05','tenhang' => 'Piaggio','logo' => 'logo/rOs1aW53cnuDOedURUaVk6S8sqYl5L27ocBXDH1D.png','xuatxu' => 'Ý'),
            array('mahx' => 'HX06','tenhang' => 'Kawasaki','logo' => 'logo/86hye9WVlDwMlDuSKdD2CmyeFPsGWSyRT1UMn0cQ.png','xuatxu' => 'Nhật Bản'),
            array('mahx' => 'HX07','tenhang' => 'Dibao','logo' => 'logo/roHL0ccJ7HZPUguSE2MxKehghmo9xpoZxLad4sum.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX08','tenhang' => 'Asama','logo' => 'logo/ivu7FJgdPnfHzlKuxRvguP16DnH0ectwkKlAyxiw.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX09','tenhang' => 'Espero','logo' => 'logo/40AOE1AbJPidg9zm8edYWI00TRc594FXt6G38D8T.jpg','xuatxu' => 'Việt Nam'),
            array('mahx' => 'HX10','tenhang' => 'Nijia','logo' => 'logo/SwaOxEwSCwTkWTvo5mxPHHArEaQPgOkPHuZPXE6n.png','xuatxu' => 'Đài Loan'),
            array('mahx' => 'HX11','tenhang' => 'Xiaomi','logo' => 'logo/Fuaz8KwifNLknB46q9Pk7wYbHPptME5GwOFSiDAI.png','xuatxu' => 'Trung Quốc')
        );

        HangXe::insert($hangxe);
    }
}
