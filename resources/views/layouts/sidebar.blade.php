<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <style>
        .left-sidebar a {
    text-decoration: none !important;
    }

    
    </style>
 </head>

<aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
        <a  class="text-nowrap logo-img d-flex justify-content-center mx-auto">
        <img src="{{ ('assets/images/logos/pay.png') }}" width="180" alt="" style="margin: 10px 0;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <!-- <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard" style='font-size:24px'></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">COMPONENTS</span>
            </li> -->
            @if(Auth::user()->isAdmin())
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard" style='font-size:24px'></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Manajemen Data</span>
            </li>
            
    <li class="sidebar-item">
        <a class="sidebar-link" href="/pelanggans">
            <i class="fas fa-address-card"></i>
            <span class="hide-menu">Pelanggan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/suppliers">
            <i class="fas fa-edit"></i>
            <span class="hide-menu">Supplier</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/kategoris">
            <i class="fas fa-dolly-flatbed"></i>
            <span class="hide-menu">Kategori</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/produks">
            <i class="fas fa-dumpster"></i>
            <span class="hide-menu">Produk</span>
        </a>
    </li>
    <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Transaksi </span>
            </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/penjualans">
            <i class="fas fa-hand-holding-usd"></i>
            <span class="hide-menu">Penjualan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/laporan-penjualan">
            <i class="bi bi-clipboard2-check-fill"></i>
            <span class="hide-menu">Laporan Penjualan</span>
        </a>
    </li>
@elseif(Auth::user()->isKasir())
<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="/kasir/dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard" style='font-size:24px'></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Manajemen Data</span>
            </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/penjualans">
            <i class="fas fa-hand-holding-usd"></i>
            <span class="hide-menu">Penjualan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/laporan-penjualan">
            <i class="bi bi-clipboard2-check-fill"></i>
            <span class="hide-menu">Laporan Penjualan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="/produks">
            <i class="fas fa-dumpster"></i>
            <span class="hide-menu">Produk</span>
        </a>
    </li>
@endif

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Pengguna</span>
            </li>
           
            <li class="sidebar-item">
              
    @if(Auth::check() && Auth::user()->isAdmin())
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin keluar?')">
            @csrf
            <button type="submit" class="btn btn-danger">Logout Admin</button>
        </form>
    @elseif(Auth::check() && Auth::user()->isKasir()) 
        <form action="{{ route('kasir.logout') }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin keluar?')">
            @csrf
            <button type="submit" class="btn btn-danger">Logout Kasir</button>
        </form>
    @endif
</li>



          </ul>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>