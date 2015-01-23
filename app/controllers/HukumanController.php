<?php

class HukumanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    protected $layout = 'backend.layouts.index';

    public function index() {
        //
        $data = array(
            'field' => Hukuman::getColumn(),
            'values' => Hukuman::orderBy('nama_hukuman')->get()
        );
        return Response::json($data);
    }

    public function getHukuman() {
        // data array yang menampung data berupa nama field tabel dan values dari tabel.
        $data = array(
            'field' => Hukuman::getColumn(),
            'values' => Hukuman::get()
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
        // membuat object baru dari Hukuman() dengan input nama_hukuman
        $hukuman = new Hukuman();
        $hukuman->nama_hukuman = Input::get('nama_hukuman');
        // bila proses memasukan data berhasil maka akan mengirimkan response dalam bentuk json
        if ($hukuman->save()) {
            return Response::json(array('success' => TRUE));
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
        $hukuman = Hukuman::find($id);
        return Response::json($hukuman);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $hukuman = Hukuman::find($id);
        $hukuman->nama_hukuman = Input::get('nama_hukuman');
        if ($hukuman->save()) {
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
        $hukuman = Hukuman::find($id);
        if ($hukuman->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
