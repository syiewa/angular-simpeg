<?php

class RiwayatJabatanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('nama_status','penempatan', 'nama_jabatan', 'nama_unit_kerja', 'nama_eselon'),
            'values' => RiwayatJabatan::orderBy('status')->where('id_pegawai', '=', $id)->get()
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
