<?php

class EselonController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => Eselon::getColumn(),
            'values' => Eselon::orderBy('nama_eselon')->get()
        );
        return Response::json($data);
    }

    public function getEselon() {
        $data = array(
            'dropdown' => Eselon::DropdownEselon()
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
        $eselon = new Eselon(Input::All());
        if ($eselon->save()) {
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
        $eselon = Eselon::find($id);
        return Response::json($eselon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $unitkerja = Eselon::find($id);
        if ($unitkerja->update(Input::All())) {
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
        $eselon = Eselon::find($id);
        if ($eselon->delete()) {
            return Response::json(array('success' => TRUE));
        };
    }

}
