<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/') }}assets/img/favicon.png" rel="icon">
  <link href="{{ asset('/') }}assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('/') }}assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                    <p class="text-center small">Masukan Data Yang Diminta Untuk Mendaftar</p>
                  </div>

                  <form action="{{route('admin-register')}}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label class="form-label">Nama</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text icon"><i class="bi bi-card-heading"></i></span>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                        <div class="invalid-feedback">Masukan Name.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text icon"><i class="bi bi-person-bounding-box"></i></span>
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Masukan Username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text icon"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="invalid-feedback">Masukan Password.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label class="form-label">Jabatan</label>
                      <select name="jabatan" id="jabatan" class="form-control">
                          <option value="">-Pilih-</option>
                          <option value="admin">Admin</option>
                          <option value="staff">Staff</option>
                      </select>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Saya Menyetujui Semua</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah Punya Akun? <a href="{{route('administrator')}}">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/') }}assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/chart.js/chart.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('/') }}assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}assets/js/main.js"></script>

</body>

</html>
