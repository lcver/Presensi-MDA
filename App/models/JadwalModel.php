<?php

/**
 * 
 * 
 * call controller
 */
use App\Core\Controller;

class JadwalModel extends Controller
{
    /**
     * 
     * create view resource data
     */
    public function create(){
        return Database::table('tbpresensi_jadwal')
                                    ->orderBy('tanggal','asc')
                                    ->get();
    }
        /**
         * 
         * stored new resourece data
         */
        public function store($request){
            return Database::table('tbpresensi_jadwal')->insert($request);
        }
            /**
             * 
             * display the specified resource data
             */
            public function show($request,$cond=null){
                switch ($request) {
                    case 'get_last_id':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->orderBy('id','desc limit 1')
                                                        ->fetch(['id'])
                                                        ->get();
                        break;
                    case 'get_inactive_jadwal':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->where('status',1)
                                                        ->get();
                        break;
                    case 'get_active_jadwal':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->where('status',2)
                                                        ->get();
                        break;
                    case 'get_all_by_jadwal':
                        $result = Database::table('tbpresensi_jadwal')
                                                        ->join('tbpresensi_peserta')
                                                        ->on('tbpresensi_jadwal.id','tbpresensi_peserta.idJadwal and tbpresensi_jadwal.id ='.$cond)
                                                        ->fetch(['tanggal'])
                                                        ->get();
                        break;
                    case 'get_by_id' :
                        $result = Database::table('tbpresensi_jadwal')
                                                    ->where('id',$cond['id'])
                                                    ->get();
                        break;
                    case 'get_three_last' :
                        $result = Database::table('tbpresensi_jadwal')
                                                    ->orderBy('id','desc limit 3')
                                                    ->get();
                        break;
                    default:
                        # code...
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
                    public function update($id,$request){
                        return Database::table('tbpresensi_jadwal')
                                                    ->where('id',$id)
                                                    ->update($request);
                    }
                        /**
                         * 
                         * remove specified resource data
                         */
                        public function destroy($id){
                            return Database::table('tbpresensi_jadwal')->delete($id);
                        }
}
