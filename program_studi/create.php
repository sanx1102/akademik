<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Data Program Studi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container py-4">

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <h3 class="fw-bold mb-4">Input Data Program Studi</h3>

                <form action="proses.php" method="post">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Program Studi</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select class="form-select" id="jenjang" name="jenjang" required>
                            <option value="">-- Jenjang --</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="akreditasi" class="form-label">Akreditasi</label>
                        <input type="text" class="form-control" id="akreditasi" name="akreditasi"
                            placeholder="Contoh: A / B / Baik Sekali">
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Opsional...">
                    </div>

                    <div class="d-flex justify-content-between gap-2 mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            Simpan
                        </button>

                        <a href="../index.php?p=data_prodi" class="btn btn-secondary">
                            Lihat List
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>