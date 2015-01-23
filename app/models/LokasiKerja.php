<?php

class LokasiKerja extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_lokasi_kerja';
    protected $primaryKey = 'id_lokasi_kerja';
    protected $fillable = array('lokasi_kerja', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownLokasiKerja($query) {
        $data = array();
        $lokasi_kerja = $query->select(array('id_lokasi_kerja', 'lokasi_kerja'))->get();
        if (count($lokasi_kerja) > 0) {
            foreach ($lokasi_kerja as $ese) {
                $data[] = array('id' => $ese->id_lokasi_kerja, 'label' => $ese->lokasi_kerja);
            }
        }
        return $data;
    }

    public function scopeGetColumn() {
        $data = array();
        $columns = DB::table('information_schema.columns')
                ->select('COLUMN_NAME')
                ->where('table_name', $this->table)
                ->where('column_key', '!=', 'PRI')
                ->get();
        foreach ($columns as $col) {
            $data[] = $col->COLUMN_NAME;
        }
        return $data;
    }

}
