<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class SesiModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('tbpresensi_sesi')
                                    ->join('tbpresensi_jadwal')
                                    ->on('tbpresensi_sesi.idJadwal','tbpresensi_jadwal.id')
                                    ->orderBy('tanggal asc, tbpresensi_sesi.waktu_mulai','asc')
                                    ->fetch(['tbpresensi_sesi.*','tbpresensi_jadwal.tanggal'])
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store(array $request){
            return Database::table('tbpresensi_sesi')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$data=null){
                switch ($request) {
                    case 'get_active':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->join('tbpresensi_jadwal')
                                                        ->on('tbpresensi_sesi.idJadwal','tbpresensi_jadwal.id and tbpresensi_jadwal.status=2 and tbpresensi_sesi.status=2')
                                                        ->orderBy('tbpresensi_jadwal.tanggal asc, tbpresensi_sesi.waktu_mulai','asc')
                                                        ->fetch(['tbpresensi_sesi.*','tbpresensi_jadwal.tanggal'])
                                                        ->get();
                        break;
                    case 'set_active':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->join('tbpresensi_jadwal')
                                                        ->on('tbpresensi_sesi.idJadwal','tbpresensi_jadwal.id and tbpresensi_jadwal.status=2')
                                                        ->orderBy('tbpresensi_jadwal.tanggal asc, waktu_mulai','asc')
                                                        ->fetch(['tbpresensi_sesi.*','tbpresensi_jadwal.tanggal'])
                                                        ->get();
                        break;
                    case 'byId':
                        $result = Database::table('tbpresensi_sesi')
                                                        ->where('id',$data)
                                                        ->orderBy('waktu_mulai','asc')
                                                        ->get();
                        break;
                    case 'get_by_jadwal':
                        $result = Database::table('tbpresensi_sesi')
                                                    ->where('idJadwal',$data)
                                                    ->get();
                        break;
                    case 'auto_sesi':
                        $result = Database::table('tbpresensi_sesi')
                                                    ->join('tbpresensi_jadwal')
                                                    ->on('tbpresensi_sesi.idJadwal',"tbpresensi_jadwal.id and tbpresensi_jadwal.status=2 and tbpresensi_sesi.status=1 and tbpresensi_sesi.auto_active='active'")
                                                    ->orderBy('tbpresensi_jadwal.tanggal asc, waktu_mulai','asc')
                                                    ->fetch(['tbpresensi_sesi.*','tbpresensi_jadwal.tanggal'])
                                                    ->get();
                        break;
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
                    public function update($id, $request){
                        return Database::table('tbpresensi_sesi')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('tbpresensi_sesi')
                                                    ->delete($id);
                        }
}
