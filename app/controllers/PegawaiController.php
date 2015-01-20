<?php

class PegawaiController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    protected $layout = 'backend.layouts.index';


    public function index() {
        //
        $data['title'] = $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('backend.index', $data);
    }

    public function getPegawai() {
        $pegawai = Pegawai::PegawaiDataTable();
        return Datatables::of($pegawai)
                        ->add_column('action', '<div class="btn-group">
	          <a class="btn btn-small" href=""><i class="icon-ok-circle"></i> Lihat Detail</a>
	          <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="h"><i class="icon-pencil"></i> Edit Data</a></li>
	            <li><a href="" ><i class="icon-trash"></i> Hapus Data</a></li>
	          </ul>
	        </div>')
                        ->make();
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
