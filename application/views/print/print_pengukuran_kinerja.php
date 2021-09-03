<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> <?= $title2; ?></title>
    <!-- Favicon -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

</head>

<body>
    <div class="container my-5">

        <style type="text/css">
            @page {
                size: portrait;
            }

            /* body{
                font-family: arial, sans-serif;
            } */

            .tg {
                border-collapse: collapse;
                border-spacing: 0;
            }

            .tg td {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                /* font-family: Arial, sans-serif; */
                font-size: 14px;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg th {
                border-color: black;
                border-style: solid;
                border-width: 1px;
                /* font-family: Arial, sans-serif; */
                font-size: 14px;
                font-weight: normal;
                overflow: hidden;
                padding: 10px 5px;
                word-break: normal;
            }

            .tg .tg-1wig {
                font-weight: bold;
                text-align: center;
                vertical-align: top;
            }

            .txt-left {
                /* font-weight: bold; */
                text-align: left;
                vertical-align: top;
            }

            .txt-right {
                /* font-weight: bold; */
                text-align: right;
                vertical-align: top;
            }
            .txt-center {
                /* font-weight: bold; */
                text-align: center;
                vertical-align: top;
            }
        </style>
        <!-- Tanggal Bahasa indonesia -->
        <?php
        function tgl_indo($tanggal)
        {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
        ?>

        <br>
        <strong>
            <p class="text-center">PENGUKURAN KINERJA<br>
                TRIWULAN <?= $data_triwulan; ?>
        </strong></p>
        <br><br>


        <?php
        $id_user = $data_user['id_user_details'];
        $id_tahun = $data_tahun['tahun_id'];

        $queryUser = "SELECT * FROM user_details
                        JOIN bidang ON bidang.id_bidang = user_details.id_bidang
                        JOIN jabatan ON jabatan.id_jabatan = user_details.id_jabatan
                        WHERE user_details.id_user_details = $id_user";
        $User = $this->db->query($queryUser)->result_array();
        ?>
        <?php foreach ($User as $row) : ?>
            <p><strong>Nama Perangkat Daerah : RS. Jiwa Prof. HB. Saanin Padang<br>
                    Nama Pegawai : <?= $row['nama_pegawai']; ?><br>
                    Sub Bidang / Sub Bagian : <?= $row['nama_bidang']; ?><br>
                    Nama Jabatan : <?= $row['nama_jabatan']; ?><br>
                <?php endforeach; ?>
                Tahun : <?= $data_tahun['nama_tahun']; ?></strong></p>

            <!-- Tabel Perjanjian Kinerja -->
            <div class="row">
                <div class="col-12">
                    <table class="tg">
                        <thead>
                            <tr>
                                <th class="tg-1wig" style="width: 10%;">No</th>
                                <th class="tg-1wig" style="width: 30%;">SASARAN STRATEGIS</th>
                                <th class="tg-1wig" style="width: 30%;">INDIKATOR KINERJA</th>
                                <th class="tg-1wig" style="width: 10%;">TARGET</th>
                                <th class="tg-1wig" style="width: 10%;">REALISASI</th>
                                <th class="tg-1wig" style="width: 10%;">PENCAPAIAN (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id_user = $data_user['id_user_details'];
                            $id_tahun = $data_tahun['tahun_id'];
                            $no = 1;

                            if ($data_triwulan == 'I') {
                                $querySasaran = $this->db->query("SELECT perjanjian_kinerja.id_sasaran, sasaran.nama_sasaran, (COUNT(sasaran.id_sasaran)) AS row_sasaran 
                                    FROM perjanjian_kinerja 
                                    JOIN sasaran ON sasaran.id_sasaran = perjanjian_kinerja.id_sasaran 
                                    LEFT JOIN triwulan_1 ON triwulan_1.id_perjanjian1 = perjanjian_kinerja.id_perjanjian_kinerja 
                                    WHERE perjanjian_kinerja.tahun_id = $id_tahun 
                                    AND perjanjian_kinerja.id_user_detail = $id_user 
                                    GROUP BY sasaran.id_sasaran");

                                foreach ($querySasaran->result() as $sasaran) {
                                    echo '<tr>
                                        <td class="txt-left" rowspan="' . $sasaran->row_sasaran . '">' . $no++ . '</td>
                                        <td class="txt-left" rowspan="' . $sasaran->row_sasaran . '">' . $sasaran->nama_sasaran . '</td>';


                                    $sasaran1 = $sasaran->id_sasaran;
                                    $queryIndikator = $this->db->query("SELECT * FROM perjanjian_kinerja 
                                        JOIN indikator ON indikator.id_indikator = perjanjian_kinerja.id_indikator
                                        LEFT JOIN triwulan_1 ON triwulan_1.id_perjanjian1 = perjanjian_kinerja.id_perjanjian_kinerja 
                                        WHERE perjanjian_kinerja.id_sasaran = $sasaran1");

                                    foreach ($queryIndikator->result() as $indikator) {
                                        echo '
                                        <td>' . $indikator->nama_indikator . '</td>
                                        <td>' . $indikator->target . '</td>
                                        <td>' . $indikator->realisasi1 . '</td>
                                        <td>' . $indikator->pencapaian1 . '</td></tr>';
                                    }
                                }
                            } elseif ($data_triwulan == 'II') {
                                $querySasaran = $this->db->query("SELECT perjanjian_kinerja.id_sasaran, sasaran.nama_sasaran, (COUNT(sasaran.id_sasaran)) AS row_sasaran 
                                    FROM perjanjian_kinerja 
                                    JOIN sasaran ON sasaran.id_sasaran = perjanjian_kinerja.id_sasaran 
                                    LEFT JOIN triwulan_2 ON triwulan_2.id_perjanjian2 = perjanjian_kinerja.id_perjanjian_kinerja 
                                    WHERE perjanjian_kinerja.tahun_id = $id_tahun 
                                    AND perjanjian_kinerja.id_user_detail = $id_user 
                                    GROUP BY sasaran.id_sasaran");

                                foreach ($querySasaran->result() as $sasaran) {
                                    echo '<tr>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $no++ . '</td>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $sasaran->nama_sasaran . '</td>';


                                    $sasaran1 = $sasaran->id_sasaran;
                                    $queryIndikator = $this->db->query("SELECT * FROM perjanjian_kinerja 
                                        JOIN indikator ON indikator.id_indikator = perjanjian_kinerja.id_indikator
                                        LEFT JOIN triwulan_2 ON triwulan_2.id_perjanjian2 = perjanjian_kinerja.id_perjanjian_kinerja 
                                        WHERE perjanjian_kinerja.id_sasaran = $sasaran1");

                                    foreach ($queryIndikator->result() as $indikator) {
                                        echo '
                                <td>' . $indikator->nama_indikator . '</td>
                                <td>' . $indikator->target . '</td>
                                <td>' . $indikator->realisasi2 . '</td>
                                <td>' . $indikator->pencapaian2 . '</td></tr>';
                                    }
                                }
                            } elseif ($data_triwulan == 'III') {
                                $querySasaran = $this->db->query("SELECT perjanjian_kinerja.id_sasaran, sasaran.nama_sasaran, (COUNT(sasaran.id_sasaran)) AS row_sasaran 
                                    FROM perjanjian_kinerja 
                                    JOIN sasaran ON sasaran.id_sasaran = perjanjian_kinerja.id_sasaran 
                                    LEFT JOIN triwulan_3 ON triwulan_3.id_perjanjian3 = perjanjian_kinerja.id_perjanjian_kinerja 
                                    WHERE perjanjian_kinerja.tahun_id = $id_tahun 
                                    AND perjanjian_kinerja.id_user_detail = $id_user 
                                    GROUP BY sasaran.id_sasaran");

                                foreach ($querySasaran->result() as $sasaran) {
                                    echo '<tr>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $no++ . '</td>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $sasaran->nama_sasaran . '</td>';


                                    $sasaran1 = $sasaran->id_sasaran;
                                    $queryIndikator = $this->db->query("SELECT * FROM perjanjian_kinerja 
                                        JOIN indikator ON indikator.id_indikator = perjanjian_kinerja.id_indikator
                                        LEFT JOIN triwulan_3 ON triwulan_3.id_perjanjian3 = perjanjian_kinerja.id_perjanjian_kinerja 
                                        WHERE perjanjian_kinerja.id_sasaran = $sasaran1");

                                    foreach ($queryIndikator->result() as $indikator) {
                                        echo '
                                <td>' . $indikator->nama_indikator . '</td>
                                <td>' . $indikator->target . '</td>
                                <td>' . $indikator->realisasi3 . '</td>
                                <td>' . $indikator->pencapaian3 . '</td></tr>';
                                    }
                                }
                            } elseif ($data_triwulan == 'IV') {
                                $querySasaran = $this->db->query("SELECT perjanjian_kinerja.id_sasaran, sasaran.nama_sasaran, (COUNT(sasaran.id_sasaran)) AS row_sasaran 
                                    FROM perjanjian_kinerja 
                                    JOIN sasaran ON sasaran.id_sasaran = perjanjian_kinerja.id_sasaran 
                                    LEFT JOIN triwulan_4 ON triwulan_4.id_perjanjian4 = perjanjian_kinerja.id_perjanjian_kinerja 
                                    WHERE perjanjian_kinerja.tahun_id = $id_tahun 
                                    AND perjanjian_kinerja.id_user_detail = $id_user 
                                    GROUP BY sasaran.id_sasaran");

                                foreach ($querySasaran->result() as $sasaran) {
                                    echo '<tr>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $no++ . '</td>
                                <td rowspan="' . $sasaran->row_sasaran . '">' . $sasaran->nama_sasaran . '</td>';


                                    $sasaran1 = $sasaran->id_sasaran;
                                    $queryIndikator = $this->db->query("SELECT * FROM perjanjian_kinerja 
                                        JOIN indikator ON indikator.id_indikator = perjanjian_kinerja.id_indikator
                                        LEFT JOIN triwulan_4 ON triwulan_4.id_perjanjian4 = perjanjian_kinerja.id_perjanjian_kinerja 
                                        WHERE perjanjian_kinerja.id_sasaran = $sasaran1");

                                    foreach ($queryIndikator->result() as $indikator) {
                                        echo '
                                <td>' . $indikator->nama_indikator . '</td>
                                <td>' . $indikator->target . '</td>
                                <td>' . $indikator->realisasi4 . '</td>
                                <td>' . $indikator->pencapaian4 . '</td></tr>';
                                    }
                                }
                            }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>

            <!-- Tabel Kegiatan & Anggaran -->
            <?php
            $id_user = $data_user['id_user_details'];
            $cekUser = "SELECT * FROM user_details 
                        WHERE id_user_details = $id_user
                        AND input_anggaran = 2";
            $User = $this->db->query($cekUser)->row_array();
            ?>
            <?php if ($User) : ?>
                <div class="row">
                    <div class="col-12">
                        <table class="tg">
                            <thead>
                                <tr>
                                    <th class="tg-1wig" style="width: 10%;">No</th>
                                    <th class="tg-1wig" style="width: 30%;">PROGRAM</th>
                                    <th class="tg-1wig" style="width: 30%;">KEGIATAN</th>
                                    <th class="tg-1wig" style="width: 10%;">ANGGARAN</th>
                                    <th class="tg-1wig" style="width: 10%;">KETERANGAN</th>
                                    <th class="tg-1wig" style="width: 5%;">REALISASI (Rp.)</th>
                                    <th class="tg-1wig" style="width: 5%;">PENCAPAIAN (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_user = $data_user['id_user_details'];
                                $id_tahun = $data_tahun['tahun_id'];
                                $no = 1;

                                if ($data_triwulan == 'I') {
                                    $queryProgram = $this->db->query("SELECT program_kegiatan.id_program, program.nama_program, 
                                            (COUNT(program.id_program)) AS row_program,
                                            (SUM(program_kegiatan.anggaran_program)) AS total_anggaran 
                                            
                                            FROM program_kegiatan 
                                            JOIN program ON program.id_program = program_kegiatan.id_program 
                                            LEFT JOIN kegiatan_triwulan_1 ON kegiatan_triwulan_1.id_kegiatan1 = program_kegiatan.id_program_kegiatan 
                                            WHERE program_kegiatan.tahun_id = $id_tahun 
                                            AND program_kegiatan.id_user_detail = $id_user 
                                            GROUP BY program.id_program");

                                    foreach ($queryProgram->result() as $program) {
                                        echo '<tr>
                                            <td class="txt-left" rowspan="' . $program->row_program . '">' . $no++ . '</td>
                                            <td class="txt-left" rowspan="' . $program->row_program . '"><b>' . $program->nama_program . '</b><br> Total : Rp.' . number_format($program->total_anggaran) . '</td>';


                                        $program1 = $program->id_program;
                                        $queryKegiatan = $this->db->query("SELECT * FROM program_kegiatan 
                                        JOIN kegiatan ON kegiatan.id_kegiatan = program_kegiatan.id_kegiatan
                                        JOIN program ON program.id_program = program_kegiatan.id_program
                                        LEFT JOIN kegiatan_triwulan_1 ON kegiatan_triwulan_1.id_kegiatan1 = program_kegiatan.id_program_kegiatan 
                                        WHERE program_kegiatan.id_program = $program1");

                                        foreach ($queryKegiatan->result() as $kegiatan) {
                                            echo '
                                                <td class="txt-left">' . $kegiatan->nama_kegiatan . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->anggaran_program) . '</td>
                                                <td class="txt-center">' . $kegiatan->keterangan_program . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->realisasi1) . '</td>
                                                <td class="txt-right">' . $kegiatan->pencapaian1 . '</td></tr>';
                                        }
                                    }
                                } elseif ($data_triwulan == 'II') {
                                    $queryProgram = $this->db->query("SELECT program_kegiatan.id_program, program.nama_program, 
                                            (COUNT(program.id_program)) AS row_program,
                                            (SUM(program_kegiatan.anggaran_program)) AS total_anggaran 
                                            
                                            FROM program_kegiatan 
                                            JOIN program ON program.id_program = program_kegiatan.id_program 
                                            LEFT JOIN kegiatan_triwulan_2 ON kegiatan_triwulan_2.id_kegiatan2 = program_kegiatan.id_program_kegiatan 
                                            WHERE program_kegiatan.tahun_id = $id_tahun 
                                            AND program_kegiatan.id_user_detail = $id_user 
                                            GROUP BY program.id_program");

                                    foreach ($queryProgram->result() as $program) {
                                        echo '<tr>
                                            <td class="txt-left" rowspan="' . $program->row_program . '">' . $no++ . '</td>
                                            <td class="txt-left" rowspan="' . $program->row_program . '"><b>' . $program->nama_program . '</b><br> Total : Rp.' . number_format($program->total_anggaran) . '</td>';


                                        $program1 = $program->id_program;
                                        $queryKegiatan = $this->db->query("SELECT * FROM program_kegiatan 
                                        JOIN kegiatan ON kegiatan.id_kegiatan = program_kegiatan.id_kegiatan
                                        JOIN program ON program.id_program = program_kegiatan.id_program
                                        LEFT JOIN kegiatan_triwulan_2 ON kegiatan_triwulan_2.id_kegiatan2 = program_kegiatan.id_program_kegiatan 
                                        WHERE program_kegiatan.id_program = $program1");

                                        foreach ($queryKegiatan->result() as $kegiatan) {
                                            echo '
                                                <td class="txt-left">' . $kegiatan->nama_kegiatan . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->anggaran_program) . '</td>
                                                <td class="txt-center">' . $kegiatan->keterangan_program . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->realisasi2) . '</td>
                                                <td class="txt-right">' . $kegiatan->pencapaian2 . '</td></tr>';
                                        }
                                    }
                                } elseif ($data_triwulan == 'III') {
                                    $queryProgram = $this->db->query("SELECT program_kegiatan.id_program, program.nama_program, 
                                            (COUNT(program.id_program)) AS row_program,
                                            (SUM(program_kegiatan.anggaran_program)) AS total_anggaran 
                                            
                                            FROM program_kegiatan 
                                            JOIN program ON program.id_program = program_kegiatan.id_program 
                                            LEFT JOIN kegiatan_triwulan_3 ON kegiatan_triwulan_3.id_kegiatan3 = program_kegiatan.id_program_kegiatan 
                                            WHERE program_kegiatan.tahun_id = $id_tahun 
                                            AND program_kegiatan.id_user_detail = $id_user 
                                            GROUP BY program.id_program");

                                    foreach ($queryProgram->result() as $program) {
                                        echo '<tr>
                                            <td class="txt-left" rowspan="' . $program->row_program . '">' . $no++ . '</td>
                                            <td class="txt-left" rowspan="' . $program->row_program . '"><b>' . $program->nama_program . '</b><br> Total : Rp.' . number_format($program->total_anggaran) . '</td>';


                                        $program1 = $program->id_program;
                                        $queryKegiatan = $this->db->query("SELECT * FROM program_kegiatan 
                                        JOIN kegiatan ON kegiatan.id_kegiatan = program_kegiatan.id_kegiatan
                                        JOIN program ON program.id_program = program_kegiatan.id_program
                                        LEFT JOIN kegiatan_triwulan_3 ON kegiatan_triwulan_3.id_kegiatan3 = program_kegiatan.id_program_kegiatan 
                                        WHERE program_kegiatan.id_program = $program1");

                                        foreach ($queryKegiatan->result() as $kegiatan) {
                                            echo '
                                                <td class="txt-left">' . $kegiatan->nama_kegiatan . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->anggaran_program) . '</td>
                                                <td class="txt-center">' . $kegiatan->keterangan_program . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->realisasi3) . '</td>
                                                <td class="txt-right">' . $kegiatan->pencapaian3 . '</td></tr>';
                                        }
                                    }
                                } elseif ($data_triwulan == 'IV') {
                                    $queryProgram = $this->db->query("SELECT program_kegiatan.id_program, program.nama_program, 
                                            (COUNT(program.id_program)) AS row_program,
                                            (SUM(program_kegiatan.anggaran_program)) AS total_anggaran 
                                            
                                            FROM program_kegiatan 
                                            JOIN program ON program.id_program = program_kegiatan.id_program 
                                            LEFT JOIN kegiatan_triwulan_4 ON kegiatan_triwulan_4.id_kegiatan4 = program_kegiatan.id_program_kegiatan 
                                            WHERE program_kegiatan.tahun_id = $id_tahun 
                                            AND program_kegiatan.id_user_detail = $id_user 
                                            GROUP BY program.id_program");

                                    foreach ($queryProgram->result() as $program) {
                                        echo '<tr>
                                            <td class="txt-left" rowspan="' . $program->row_program . '">' . $no++ . '</td>
                                            <td class="txt-left" rowspan="' . $program->row_program . '"><b>' . $program->nama_program . '</b><br> Total : Rp.' . number_format($program->total_anggaran) . '</td>';


                                        $program1 = $program->id_program;
                                        $queryKegiatan = $this->db->query("SELECT * FROM program_kegiatan 
                                        JOIN kegiatan ON kegiatan.id_kegiatan = program_kegiatan.id_kegiatan
                                        JOIN program ON program.id_program = program_kegiatan.id_program
                                        LEFT JOIN kegiatan_triwulan_4 ON kegiatan_triwulan_4.id_kegiatan4 = program_kegiatan.id_program_kegiatan 
                                        WHERE program_kegiatan.id_program = $program1");

                                        foreach ($queryKegiatan->result() as $kegiatan) {
                                            echo '
                                                <td class="txt-left">' . $kegiatan->nama_kegiatan . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->anggaran_program) . '</td>
                                                <td class="txt-center">' . $kegiatan->keterangan_program . '</td>
                                                <td class="txt-right">' . number_format($kegiatan->realisasi4) . '</td>
                                                <td class="txt-right">' . $kegiatan->pencapaian4 . '</td></tr>';
                                        }
                                    }
                                }
                                ?>
                                </tr>
                            </tbody>
                            <tfoot>
                                <?php
                                $queryTotalAnggaran = $this->db->query("SELECT
                                (SUM(program_kegiatan.anggaran_program)) AS grand_total_anggaran 
                                
                                FROM program_kegiatan 
                                WHERE program_kegiatan.tahun_id = $id_tahun 
                                AND program_kegiatan.id_user_detail = $id_user 
                                GROUP BY program_kegiatan.tahun_id");

                                foreach ($queryTotalAnggaran->result() as $row) {
                                    echo ' <tr>';
                                    echo '<th colspan="2" class="text-center"><b>TOTAL ANGGARAN</b></th>';
                                    echo '<th colspan="5" class="text-center"><b>Rp. ' . number_format($row->grand_total_anggaran) . '</b></th>';
                                }
                                ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php endif; ?>



            <br>
            <div class="row">
                <div class="col-6">
                    <div class="float-left">
                        <?php
                        $id_jabatan = $data_atasan['id_jabatan'];
                        $queryJabatan = "SELECT * FROM jabatan 
                                WHERE id_jabatan = $id_jabatan";
                        $Jabatan = $this->db->query($queryJabatan)->result_array();
                        ?>
                        <div class="text-center text-muted">Atasan langsung</div>
                        <?php foreach ($Jabatan as $row) : ?>
                            <div class="text-center"><?= $row['nama_jabatan']; ?></div>
                        <?php endforeach; ?>
                        <br>
                        <br>
                        <br>
                        <div class="text-center"><u><strong><?= $data_atasan['nama_pegawai']; ?></strong></u></div>
                        <div class="text-center">NIP. <?= $data_atasan['nip']; ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-right">
                        <div class="text-center">Padang, <?= $tanggal_cetak; ?> </div>
                        <?php foreach ($Jabatan as $row) : ?>
                            <div class="text-center"><?= $row['nama_jabatan']; ?></div>
                        <?php endforeach; ?>
                        <br>
                        <br>
                        <br>
                        <div class="text-center"><u><strong><?= $data_user['nama_pegawai']; ?></strong></u></div>
                        <div class="text-center">NIP. <?= $data_user['nip']; ?></div>
                    </div>
                </div>
            </div>
    </div>
</body>

</html>
<script>
    window.print();
</script>