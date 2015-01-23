<?php

class Penghargaan extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_penghargaan';
    protected $primaryKey = 'id_penghargaan';
    protected $fillable = array('nama_penghargaan', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownPenghargaan($query) {
        $data = array();
        $penghargaan = $query->select(array('id_penghargaan', 'nama_penghargaan'))->get();
        if (count($penghargaan) > 0) {
            foreach ($penghargaan as $ese) {
                $data[] = array('id' => $ese->id_penghargaan, 'label' => $ese->nama_penghargaan);
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
