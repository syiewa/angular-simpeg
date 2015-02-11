<?php

class PendidikanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('tingkat_pendidikan', 'jurusan', 'teknik', 'sekolah', 'tanggal_lulus'),
            'values' => Pendidikan::where('id_pegawai', '=', $id)->get()
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
        $data['tanggal_sttb'] = formatDate($data['tanggal_sttb']);
        $data['tanggal_lulus'] = formatDate($data['tanggal_lulus']);
        $pendidikan = new Pendidikan($data);
        if ($pendidikan->save()) {
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
        $pendidikan = Pendidikan::find($id);
        return Response::json($pendidikan);
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
        $pendidikan = Pendidikan::find($id);
        if ($pendidikan->update($data)) {
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
        $pendidikan = Pendidikan::find($id);
        if ($pendidikan->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
