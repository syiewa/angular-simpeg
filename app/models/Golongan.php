<?php

class Golongan extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_golongan';
    protected $primaryKey = 'id_golongan';
    protected $fillable = array('golongan', 'uraian', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownGolongan($query) {
        $data = array();
        $golongan = $query->select(array('id_golongan', 'golongan'))->get();
        if (count($golongan) > 0) {
            foreach ($golongan as $gol) {
                $data[] = array('id' => $gol->id_golongan, 'label' => $gol->golongan);
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
