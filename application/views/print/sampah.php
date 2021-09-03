 <?php
                $id_user = $data_user['id_user_details'];
                $id_tahun = $data_tahun['tahun_id'];
                $id_triwulan = $data_triwulan;
                if ($id_triwulan == 1) {
                    $queryTriwulan = "SELECT * FROM perjanjian_kinerja
                        JOIN triwulan_1 ON triwulan_1.id_perjanjian1 = perjanjian_kinerja.id_perjanjian_kinerja
                        WHERE perjanjian_kinerja.id_user_details = $id_user AND perjanjian_kinerja.tahin_id = $id_tahun ";
                    $Triwulan1 = $this->db->query($queryTriwulan)->result_array();
                }













                $querySasaran = $this->db->query("SELECT perjanjian_kinerja.id_sasaran, sasaran.nama_sasaran, (COUNT(sasaran.id_sasaran)) AS row_sasaran 
                                    FROM perjanjian_kinerja 
                                    JOIN sasaran ON sasaran.id_sasaran = perjanjian_kinerja.id_sasaran 
                                    WHERE perjanjian_kinerja.tahun_id = $tahun 
                                    AND perjanjian_kinerja.id_user_detail = $user 
                                    GROUP BY sasaran.id_sasaran");

                            foreach ($querySasaran->result() as $sasaran) {
                                echo '<tr>
                            <td rowspan="' . $sasaran->row_sasaran . '">' . $no++ . '</td>
                            <td rowspan="' . $sasaran->row_sasaran . '">' . $sasaran->nama_sasaran . '</td>';


                                $sasaran1 = $sasaran->id_sasaran;
                                $queryIndikator = $this->db->query("SELECT * FROM perjanjian_kinerja 
                                        JOIN indikator ON indikator.id_indikator = perjanjian_kinerja.id_indikator 
                                        WHERE perjanjian_kinerja.id_sasaran = $sasaran1");

                                foreach ($queryIndikator->result() as $indikator) {
                                    echo '
                        <td>' . $indikator->nama_indikator . '</td>
                        <td>' . $indikator->target . '</td></tr>';
                                }
                            }
                ?>





