<?php

class JabatanController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => Jabatan::getColumn(),
            'values' => Jabatan::orderBy('nama_jabatan')->get()
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
        $jabatan = new Jabatan(Input::All());
        if ($jabatan->save()) {
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
        $jabatan = Jabatan::find($id);
        return Response::json($jabatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $jabatan = Jabatan::find($id);
        if ($jabatan->update(Input::All())) {
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
        $jabatan = Jabatan::find($id);
        if ($jabatan->delete()) {
            return Response::json(array('success' => TRUE));
        };
    }

}
