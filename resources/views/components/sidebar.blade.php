  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('home') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <li class="nav-heading">Order</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('transaksi.index') }}">
                  <i class="bi bi-cart-plus"></i>
                  Class Order

              </a>
          </li>

          <li class="nav-heading">Data Master</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('instagram.index') }}">
                  <i class="bi bi-instagram"></i>
                  <span>Data Instagram</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pengguna.index') }}">
                  <i class="bi bi-people"></i>
                  <span>Data Member</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pencairan.index') }}">

                  <i class="bi bi-person-check-fill"></i>
                  <span>Afiliasi Member</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pencairan-award.index') }}">

                  <i class="bi bi-trophy"></i>
                  <span>Afiliasi Award</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('kategori-paket.index') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Kategori Paket</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('paket') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Paket Kelas</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('bimbel') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Paket Bimbel</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('tryoutAkbar') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>TryOut Akbar</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('fasilitas.index') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Paket Fasilitas</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('kategori-materi.index') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Kategori Materi</span>
              </a>
          </li>

          <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('paket') }}">
              <i class="bi bi-circle"></i><span>Paket</span>
            </a>
          </li>
        </ul>
      </li> -->
          <li class="nav-heading">Laporan</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('laporan.index') }}">
                  <i class="bi bi-file-richtext"></i>
                  <span>Laporan</span>
              </a>
          </li>

          <li class="nav-heading">Halaman User</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('faq.index') }}">
                  <i class="bi bi-envelope-fill"></i>
                  <span>Faq</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('testimoni.admin.index') }}">
                  <i class="bi bi-chat-left-text"></i>
                  <span>Testimoni</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('artikel.index') }}">
                  <i class="bi bi-chat-left-text"></i>
                  <span>Artikel</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('kontak.index') }}">
                  <i class="bi bi-headphones"></i>
                  <span>Kontak</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('iklan.index') }}">
                  <i class="bi bi-chat-left-text"></i>
                  <span>Iklan</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('youtube.index') }}">
                  <i class="bi bi-youtube"></i>
                  <span>Youtube</span>
              </a>
          </li>

          <li class="nav-heading">Ujian</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('soal') }}">
                  <i class="bi bi-file-richtext"></i>
                  <span>Soal</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('laporan.soal')}}">
                  <i class="bi bi-file-richtext"></i>
                  <span>Laporan Soal</span>
              </a>
          </li>

      </ul>

  </aside><!-- End Sidebar-->