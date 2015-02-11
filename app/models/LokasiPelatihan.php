<?php

class LokasiPelatihan extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_lokasi_pelatihan';
    protected $primaryKey = 'id_lokasi_pelatihan';
    protected $fillable = array('nama_lokasi', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownLokasiPelatihan($query) {
        $data = array();
        $lokasi_pelatihan = $query->select(array('id_lokasi_pelatihan', 'nama_lokasi'))->get();
        if (count($lokasi_pelatihan) > 0) {
            foreach ($lokasi_pelatihan as $ese) {
                $data[] = array('id' => $ese->id_lokasi_pelatihan, 'label' => $ese->nama_lokasi);
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
