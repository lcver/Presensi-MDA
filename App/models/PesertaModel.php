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
            return Database::table('peserta')->insert($data);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$cond=null){
                switch ($request) {
                    case 'get_by_id_kategori_jadwal':
                        $result = Database::table('peserta')
                                                        ->raw('idKategori='.$cond['id'].' and idJadwal='.$cond['idJadwal'])
                                                        ->orderBy("curent_timestamp","asc")
                                                        ->get();
                        break;
                    case 'hadir_by_id_kategori_jadwal':
                        $result = Database::table("peserta")
                                                    ->raw("idKategori=".$cond['id']." and idJadwal=".$cond['idJadwal']." and peserta.kehadiran='hadir'")
                                                    ->orderBy("curent_timestamp","asc")
                                                    ->get();
                        break;
                    case 'izin_by_id_kategori_jadwal':
                        $result = Database::table("peserta")
                                                    ->raw("idKategori=".$cond['id']." and idJadwal=".$cond['idJadwal']." and peserta.kehadiran='izin'")
                                                    ->orderBy("curent_timestamp","asc")
                                                    ->get();
                        break;
                    case 'filtering' :
                        $result = Database::table('peserta')
                                                ->raw(
                                                    "nama='".$cond['nama']."'".
                                                    " and jenis_kelamin='".$cond['jenis_kelamin']."'".
                                                    " and idKategori='".$cond['idKategori']."'".
                                                    " and idJadwal='".$cond['idJadwal']."'")
                                                ->get();
                        break;
                    case 'countPeserta_by_jadwal':
                        $result = Database::table('peserta')
                                                ->join('jadwal')
                                                ->on('peserta.idJadwal','jadwal.id and jadwal.id='.$cond)
                                                ->fetch([
                                                    'COUNT(peserta.id) as total',
                                                    'jadwal.tanggal',
                                                    'jadwal.id as idJadwal'
                                                    ])
                                                ->get();
                        break;
                    case 'countPeserta_by_kategori':
                        $result = Database::table('peserta')
                                                ->join('kategori')
                                                ->on('peserta.idKategori','kategori.id and kategori.id='.$cond['kategori'])
                                                ->join('jadwal')
                                                ->on('peserta.idJadwal','jadwal.id and jadwal.id='.$cond['jadwal'])
                                                ->fetch([
                                                    'COUNT(peserta.id) as jumlah',
                                                    'kategori.id as idKategori',
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
