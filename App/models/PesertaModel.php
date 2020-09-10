<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class PesertaModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){}
        /**
         * 
         * stored new resourece data
         */
        public function store(array $data){
            return Database::table('tbpresensi_peserta')->insert($data);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$cond=null){
                switch ($request) {
                    case 'get_by_id_tpq_jadwal':
                        $result = Database::table('tbpresensi_peserta')
                                                        ->raw('idTpq='.$cond['id'].' and idJadwal='.$cond['idJadwal'])
                                                        ->orderBy("curent_timestamp","asc")
                                                        ->get();
                        break;
                    case 'filtering' :
                        $result = Database::table('tbpresensi_peserta')
                                                ->raw(
                                                    "nama='".$cond['nama']."'".
                                                    " and jenis_kelamin='".$cond['jenis_kelamin']."'".
                                                    " and idTpq='".$cond['idTpq']."'".
                                                    " and idJadwal='".$cond['idJadwal']."'")
                                                ->get();
                        break;
                    case 'countPeserta_by_jadwal':
                        $result = Database::table('tbpresensi_peserta')
                                                ->join('tbpresensi_jadwal')
                                                ->on('tbpresensi_peserta.idJadwal','tbpresensi_jadwal.id and tbpresensi_jadwal.id='.$cond)
                                                ->fetch([
                                                    'COUNT(tbpresensi_peserta.id) as total',
                                                    'tbpresensi_jadwal.tanggal',
                                                    'tbpresensi_jadwal.id as idJadwal'
                                                    ])
                                                ->get();
                        break;
                    case 'countPeserta_by_tpq':
                        $result = Database::table('tbpresensi_peserta')
                                                ->join('tbpresensi_tpq')
                                                ->on('tbpresensi_peserta.idTpq','tbpresensi_tpq.id and tbpresensi_tpq.id='.$cond['tpq'])
                                                ->join('tbpresensi_jadwal')
                                                ->on('tbpresensi_peserta.idJadwal','tbpresensi_jadwal.id and tbpresensi_jadwal.id='.$cond['jadwal'])
                                                ->fetch([
                                                    'COUNT(tbpresensi_peserta.id) as jumlah',
                                                    'tbpresensi_tpq.id as idTpq',
                                                    ])
                                                ->get();

                        break;

                    // case '' :
                    // case '' :
                        // break;
                    
                    default:
                        $result = [];
                        break;
                }
                
                return $result;
            }
                /**
                 * 
                 * display form for editing resource data
                 */
                public function edit($id){}
                    /**
                     * 
                     * update the specified resource data
                     */
                    public function update($id){}
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){}
}
