<?php

class GolonganController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => Golongan::getColumn(),
            'values' => Golongan::orderBy('golongan')->get()
        );
        return Response::json($data);
    }

    public function getGolongan() {
        $data = array(
            'field' => Golongan::getColumn(),
            'values' => Golongan::get()
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
        $golongan = new Golongan(Input::All());
        if ($golongan->save()) {
            return Response::json(array('success' => TRUE));
        };
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
        $golongan = Golongan::find($id);
        return Response::json($golongan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $golongan = Golongan::find($id);
        if ($golongan->update(Input::All())) {
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
        $golongan = Golongan::find($id);
        if ($golongan->delete()) {
            return Response::json(array('success' => TRUE));
        };
    }

}
