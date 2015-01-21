<?php

class Pelatihan extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_pelatihan';
    protected $primaryKey = 'id_pelatihan';
    protected $fillable = array('nama_pelatihan', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownPelatihan($query) {
        $data = array();
        $pelatihan = $query->select(array('id_pelatihan', 'nama_pelatihan'))->get();
        if (count($pelatihan) > 0) {
            foreach ($pelatihan as $ese) {
                $data[] = array('id' => $ese->id_pelatihan, 'label' => $ese->nama_pelatihan);
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
