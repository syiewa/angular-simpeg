<?php

class KeluargaController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {
        //
        $data = array(
            'field' => array('nama_anggota_keluarga', 'tanggal_lahir', 'status_kawin', 'pekerjaan'),
            'values' => Keluarga::orderBy('nama_anggota_keluarga')->where('id_pegawai', '=', $id)->get()
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
        $data['tanggal_lahir'] = $this->formatDate($data['tanggal_lahir']);
        if (isset($data['tanggal_nikah']))
            $data['tanggal_nikah'] = $this->formatDate($data['tanggal_nikah']);
        if (isset($data['tanggal_cerai_meninggal']))
            $data['tanggal_cerai_meninggal'] = $this->formatDate($data['tanggal_cerai_meninggal']);
        $keluarga = new Keluarga($data);
        if ($keluarga->save()) {
            return Response::json(array('success' => TRUE));
        }
    }

    private function formatDate($array) {
        $telo = explode(' ', $array);
        $kampret = $telo[2] . ' ' . $telo[1] . ' ' . $telo[3];
        $string = date('d/m/Y', strtotime($kampret));
        return $string;
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
        $keluarga = Keluarga::find($id);
        return Response::json($keluarga);
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
        $keluarga = Keluarga::find($id);
        if ($keluarga->update($data)) {
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
        $keluarga = Keluarga::find($id);
        if ($keluarga->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
