<?php

class Hukuman extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_hukuman';
    protected $primaryKey = 'id_hukuman';
    protected $fillable = array('nama_hukuman', 'level');
    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function scopeDropdownHukuman($query) {
        $data = array();
        $hukuman = $query->select(array('id_hukuman', 'nama_hukuman'))->get();
        if (count($hukuman) > 0) {
            foreach ($hukuman as $ese) {
                $data[] = array('id' => $ese->id_hukuman, 'label' => $ese->nama_hukuman);
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
