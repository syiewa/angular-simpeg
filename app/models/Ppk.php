<?php

class Ppk extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_ppk';
    protected $primaryKey = 'id_ppk';
    protected $fillable = array('nama_ppk', 'parent_satuan_kerja');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function satuankerja() {
        return $this->belongsTo('SatuanKerja', 'parent_satuan_kerja', 'id_satuan_kerja');
    }

    public function scopeDropdownPpk($query, $where = null) {
        $data = array();
        if ($where != null) {
            $satuankerja = $query->select(array('id_ppk', 'nama_ppk'))->where('id_ppk', '!=', $where)->get();
        } else {
            $satuankerja = $query->select(array('id_ppk', 'nama_ppk'))->get();
        }
        foreach ($satuankerja as $unit) {
            $data[0] = "-";
            $data[$unit->id_satuan_kerja] = $unit->nama_satuan_kerja;
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
            if ($col->COLUMN_NAME == 'parent_unit')
                $col->COLUMN_NAME = 'nama_unit_kerja';
            $data[] = $col->COLUMN_NAME;
        }
        return $data;
    }

}
