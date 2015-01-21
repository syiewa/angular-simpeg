<?php

class SatuanKerja extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_master_satuan_kerja';
    protected $primaryKey = 'id_satuan_kerja';
    protected $fillable = array('nama_satuan_kerja', 'parent_unit');
    public $timestamps = false;
    protected $appends = ['nama_unit_kerja'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
// loads only direct children - 1 level

    public function unitkerja() {
        return $this->belongsTo('UnitKerja', 'parent_unit', 'id_unit_kerja');
    }

    public function scopeDropdownSatker($query, $where = null) {
        $data = array();
        if ($where != null) {
            $satuankerja = $query->select(array('id_satuan_kerja', 'nama_satuan_kerja'))->where('id_satuan_kerja', '!=', $where)->get();
        } else {
            $satuankerja = $query->select(array('id_satuan_kerja', 'nama_satuan_kerja'))->get();
        }
        foreach ($satuankerja as $unit) {
            $data[] = array('id' => $unit->id_satuan_kerja, 'label' => $unit->nama_satuan_kerja);
        }
        return $data;
    }

    public function getNamaUnitKerjaAttribute() {
        $name = $this->attributes['parent_unit'];
        $parent = UnitKerja::find($name);
        if ($parent) {
            return $parent->nama_unit_kerja;
        }
        return '-';
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

    // recursive, loads all descendants
//    public function children()
//    {
//       return $this->child()->with('children')->orderBy('sort_order');
//    }
}
