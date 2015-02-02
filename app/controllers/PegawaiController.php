<?php

class PegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => array('nip', 'nama_pegawai', 'golongan', 'nama_status_pegawai'),
            'values' => Pegawai::orderBy('nama_pegawai')->get()
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
        $data = array(
            'status' => StatusPegawai::DropdownStatusPegawai(),
            'golongan' => Golongan::DropdownGolongan(),
            'jabatan' => Jabatan::DropdownJabatan(),
            'unitkerja' => UnitKerja::DropdownUnit(),
            'satuankerja' => SatuanKerja::DropdownSatKer(),
            'lokasikerja' => LokasiKerja::DropdownLokasiKerja(),
            'eselon' => Eselon::DropdownEselon()
        );
        return Response::json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        dd(Input::All());
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
