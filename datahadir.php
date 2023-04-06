<!DOCTYPE html>
<html>

<head>
    <title>Data Hadir</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Tambahkan link JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Data Kehadiran TI.20.A2</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">NIM</th>
                    <th class="text-center">Pertemuan 1</th>
                    <th class="text-center">Pertemuan 2</th>
                    <th class="text-center">Pertemuan 3</th>
                    <th class="text-center">Pertemuan 4</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //ambil data dari api
                $data = file_get_contents('https://api.steinhq.com/v1/storages/642110d4eced9b09e9c62384/20A2');

                //ubah data json menjadi data array
                $data = json_decode($data, true);

                //hitung jumlah data
                $total_data = count($data);

                //atur jumlah data per halaman
                $data_per_halaman = 10;

                //hitung jumlah halaman
                $total_halaman = ceil($total_data / $data_per_halaman);

                //atur halaman saat ini
                $halaman_sekarang = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

                //atur indeks awal data
                $indeks_awal = ($halaman_sekarang - 1) * $data_per_halaman;

                //ambil data untuk halaman saat ini
                $data_halaman = array_slice($data, $indeks_awal, $data_per_halaman);

                //looping untuk menampilkan data dalam tabel
                $no = $indeks_awal + 1;
                foreach ($data_halaman as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['NO'] . "</td>";
                    echo "<td>" . $item['Nama'] . "</td>";
                    echo "<td>" . $item['NIM'] . "</td>";
                    echo "<td>" . $item['1'] . "</td>";
                    echo "<td>" . $item['2'] . "</td>";
                    echo "<td>" . $item['3'] . "</td>";
                    echo "<td>" . $item['4'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Tampilkan tombol navigasi halaman -->
        <nav>
            <ul class="pagination">
                <?php if ($halaman_sekarang > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?php echo $halaman_sekarang - 1; ?>">Previous</a>
                    </li>
                <?php } ?>

                <?php for ($i = 1; $i <= $total_halaman; $i++) { ?>
                    <li class="page-item <?php if ($i == $halaman_sekarang) echo 'active'; ?>">
                        <a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>

                <?php if ($halaman_sekarang < $total_halaman) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?php echo $halaman_sekarang + 1; ?>">Next</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</body>

</html>