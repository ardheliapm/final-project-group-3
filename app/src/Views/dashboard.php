<?php include __DIR__ . '/partials/navbar.php'; ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<div class="container-fluid page-body-wrapper">
    <?php include __DIR__ . '/partials/sidebar-student.php'; ?>
    <div class="main-panel" id="mainPanel" style="margin-left: 235px;">
        <div class="content-wrapper">
            <div class="row pt-5">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h1 class="font-weight-bold">Selamat Datang di PrestaC</h1>
                            <p class="text-muted">Pantau dan kelola prestasi Anda melalui dashboard yang mudah digunakan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Submission Form Menu Box -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card gradient-box">
                        <div class="card-body">
                            <h4 class="card-title" style="color: white;">Tambah Prestasi</h4>
                            <p class="card-description" style="color: white;">
                                Klik disini untuk menambah prestasi baru
                            </p>
                            <a href="/dashboard/achievement/form" class="btn btn-primary btn-lg btn-block">
                                <i class="ti-plus mr-2"></i>
                                Tambah Baru
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Kotak Menu Riwayat Prestasi -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="color: white;">Riwayat Prestasi</h4>
                            <p class="card-description" style="color: white;">
                                Lihat riwayat prestasi Anda
                            </p>
                            <a href="/dashboard/achievement/history" class="btn btn-info btn-lg btn-block">
                                <i class="ti-list mr-2"></i>
                                Lihat Riwayat
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info Menu Box -->
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="color: white;">Buku Panduan Prestasi</h4>
                            <p class="card-description" style="color: white;">
                                Baca kebijakan dan informasi dibawah!
                            </p>
                            <a href="/dashboard/info" class="btn btn-info btn-lg btn-block">
                                <i class="ti-book mr-2"></i>
                                Baca Buku Panduan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Top 10 Achievement Section -->
            <div class="row mt-4">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body-top">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title">10 Prestasi Terhebat Kamu!</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;" class="text-center">No</th>
                                                    <th style="width: 25%;" class="text-center">Nama</th>
                                                    <th style="width: 20%;" class="text-center">Kejuaraan Kompetisi</th>
                                                    <th style="width: 20%;" class="text-center">Tingkat Kompetisi</th>
                                                    <th style="width: 15%;" class="text-center">Total Poin</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($topAchievements)) {
                                                    $no = 1;
                                                    foreach ($topAchievements as $achievement) {
                                                ?>
                                                        <tr>
                                                            <td class="text-center"><?= $no++ ?></td>
                                                            <td class="text-center"><?= htmlspecialchars($achievement['CompetitionTitle']) ?></td>
                                                            <td class="text-center"><?= htmlspecialchars($achievement['CompetitionRankName']) ?></td>
                                                            <td class="text-center"><?= htmlspecialchars($achievement['CompetitionLevelName']) ?></td>
                                                            <td class="text-center"><?= number_format($achievement['CompetitionPoints'], 2, ',', '.') ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">Belum ada data prestasi</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body-top">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title">Status Data Prestasi</h4>
                            </div>
                            <div class="row">
                                <canvas id="pieChart">
                                    
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require __DIR__ . '/partials/footer-page.php'; ?>
    </div>
</div>

<script>
    document.getElementById('tahun').addEventListener('change', updateTopAchievements);

    function updateTopAchievements() {
        const tahun = document.getElementById('tahun').value;

        // Redirect or Ajax call
        window.location.href = `/dashboard?tahun=${tahun}`;
    }
</script>
<style>
    .gradient-box {
        background: linear-gradient(to right, #8490f0, #87b7fd);
        color: white;
        border-radius: 10px;
    }

    .card-body {
        padding: 1.25rem;
        background: linear-gradient(to right, #8490f0, #87b7fd);
        border-radius: 10px;
    }

    .card-body-top {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
<script src="../../public/assets/vendors/chart.js/Chart.min.js"></script>
<script src="../../public/assets/js/chart.js"></script>