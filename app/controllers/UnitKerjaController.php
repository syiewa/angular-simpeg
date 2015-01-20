<?php

class UnitKerjaController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        $data = array(
            'field' => Unitkerja::getColumn(),
            'values' => UnitKerja::orderBy('nama_unit_kerja')->get(),
        );
        return Response::json($data);
    }

    public function getUnitKerja() {
        $data = array(
            'dropdown' => UnitKerja::DropDownUnit()
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
        $unitkerja = new UnitKerja(Input::All());
        if ($unitkerja->save()) {
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
        $telo = UnitKerja::find($id);
        $data = array(
            'value' => $telo,
            'unitkerja' => UnitKerja::DropDownUnit($id),
            'eselon' => Eselon::DropdownEselon()
        );
        return Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
        $unitkerja = UnitKerja::find($id);
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
        $unitkerja = UnitKerja::find($id);
        UnitKerja::where('parent_unit', $id)->update(array('parent_unit' => 0));
        if ($unitkerja->delete()) {
            return Response::json(array('success' => TRUE));
        }
    }

}
