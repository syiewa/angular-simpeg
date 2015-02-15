<?php

class Dp3Controller extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('tahun', 'rata_rata', 'atasan', 'penilai', 'mengetahui'),
            'values' => Dp3::orderBy('tahun')->where('id_pegawai', '=', $id)->get()
        );
        return Response::json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $data = Input::All();
        $data['rata_rata'] = strval(($data['kesetiaan'] + $data['prestasi'] + $data['tanggung_jawab'] + $data['ketaatan'] + $data['kejujuran'] + $data['kerjasama'] + $data['prakarsa'] + $data['kepemimpinan']) / 8);
        $riwayat = new Dp3($data);
        if ($riwayat->save()) {
            return Response::json(array('success' => true));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $riwayat = Dp3::find($id);
        return Response::json($riwayat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //

        $data = Input::All();
        $riwayat = Dp3::find($id);
        $data['rata_rata'] = strval(($data['kesetiaan'] + $data['prestasi'] + $data['tanggung_jawab'] + $data['ketaatan'] + $data['kejujuran'] + $data['kerjasama'] + $data['prakarsa'] + $data['kepemimpinan']) / 8);
        if ($riwayat->update($data)) {
            return Response::json(array('success' => TRUE));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        $riwayat = Dp3::find($id);
        if ($riwayat->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
