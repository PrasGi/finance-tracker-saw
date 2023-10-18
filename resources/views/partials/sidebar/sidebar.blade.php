<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'dashboard' ? 'active' : '' }} collapsed"
                href="{{ route('dashboard') }}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">datas</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'alternatif.index' ? 'active' : '' }} collapsed"
                href="{{ route('alternatif.index') }}">
                <i class="bi bi-arrow-90deg-right"></i>
                <span>Alternatif</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'kriteria.index' ? 'active' : '' }} collapsed"
                href="{{ route('kriteria.index') }}">
                <i class="bi bi-arrow-90deg-right"></i>
                <span>Kriteria</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'bobot.index' ? 'active' : '' }} collapsed"
                href="{{ route('bobot.index') }}">
                <i class="bi bi-arrow-90deg-right"></i>
                <span>Bobot</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'result.index' ? 'active' : '' }} collapsed"
                href="{{ route('result.index') }}">
                <i class="bi bi-arrow-90deg-right"></i>
                <span>Result</span>
            </a>
        </li>

        <li class="nav-heading">view</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'view.matrixKeputusan' ? 'active' : '' }} collapsed"
                href="{{ route('view.matrixKeputusan') }}">
                <i class="bi bi-eye"></i>
                <span>Matrix Keputusan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'view.maximumValue' ? 'active' : '' }} collapsed"
                href="{{ route('view.maximumValue') }}">
                <i class="bi bi-eye"></i>
                <span>Maximal Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'view.normalisasi' ? 'active' : '' }} collapsed"
                href="{{ route('view.normalisasi') }}">
                <i class="bi bi-eye"></i>
                <span>Normalisasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'view.prarangking' ? 'active' : '' }} collapsed"
                href="{{ route('view.prarangking') }}">
                <i class="bi bi-eye"></i>
                <span>Pra Rangking</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::route()->getName() == 'view.rangking' ? 'active' : '' }} collapsed"
                href="{{ route('view.rangking') }}">
                <i class="bi bi-eye"></i>
                <span>Rangking</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
