<?php

class StatusPegawai extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_status_pegawai';
    protected $primaryKey = 'id_status_pegawai';
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
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

    public function scopeDropdownStatusPegawai($query, $where = null) {
        $data = array();
        if ($where != null) {
            $status = $query->select(array('id_status_pegawai', 'nama_status'))->where('id_status_pegawai', '!=', $where)->get();
        } else {
            $status = $query->select(array('id_status_pegawai', 'nama_status'))->get();
        }
        foreach ($status as $unit) {
            $data[] = array('id' => $unit->id_status_pegawai, 'label' => $unit->nama_status);
        }
        return $data;
    }

}
