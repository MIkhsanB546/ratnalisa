<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--begin::Primary Meta Tags-->
  <meta name="title" content="Ratnalisa Laboratorium Klinik dan Patologi Anatomi" />
  <meta name="author" content="Kel 6" />
  <meta
    name="description"
    content="Ratnalisa Laboratorium Klinik dan Patologi Anatomi" />
  <meta
    name="keywords"
    content="Klinik, Laboratorium, Patologi Anatomi, Ratnalisa, Pemeriksaan, Kesehatan" />
  <!--end::Primary Meta Tags-->

  <!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <!--end::Accessibility Meta Tags-->

  <title>@yield('title', 'Dashboard') | Admin Ratnalisa</title>

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    crossorigin="anonymous">
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->

  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->

  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <!--end::Required Plugin(AdminLTE)-->

  @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="login-logo">
      <a href="../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="../index3.html" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" />
            <div class="input-group-text">
              <span class="bi bi-envelope"></span>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" />
            <div class="input-group-text">
              <span class="bi bi-lock-fill"></span>
            </div>
          </div>
          <!--begin::Row-->
          <div class="row">
            <!-- <div class="col-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
              </div>
            </div> -->
            <!-- /.col -->
            <div class="col-4">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Sign In</button>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!--end::Row-->
        </form>


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!--begin::Script-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

      // Disable OverlayScrollbars on mobile devices to prevent touch interference
      const isMobile = window.innerWidth <= 992;

      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure--><!--begin::Color Mode Toggle (#6010)-->
  <script>
    (() => {
      'use strict';

      const STORAGE_KEY = 'lte-theme';

      const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
      const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

      const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

      const getPreferredTheme = () => {
        const stored = getStoredTheme();
        if (stored) return stored;
        return prefersDark() ? 'dark' : 'light';
      };

      const setTheme = (theme) => {
        const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
        document.documentElement.setAttribute('data-bs-theme', resolved);
      };

      setTheme(getPreferredTheme());

      const showActiveTheme = (theme) => {
        // Highlight the active dropdown option
        document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
          el.classList.remove('active');
          el.setAttribute('aria-pressed', 'false');
          const check = el.querySelector('.bi-check-lg');
          if (check) check.classList.add('d-none');
        });
        const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
        if (active) {
          active.classList.add('active');
          active.setAttribute('aria-pressed', 'true');
          const check = active.querySelector('.bi-check-lg');
          if (check) check.classList.remove('d-none');
        }
        // Sync the topbar trigger icon
        document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
          icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
        });
      };

      globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        const stored = getStoredTheme();
        if (!stored || stored === 'auto') setTheme(getPreferredTheme());
      });

      document.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme());
        document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
          toggle.addEventListener('click', () => {
            const theme = toggle.getAttribute('data-bs-theme-value');
            setStoredTheme(theme);
            setTheme(theme);
            showActiveTheme(theme);
          });
        });
      });
    })();
  </script>
  <!--end::Color Mode Toggle-->
  @stack('scripts')
  <!--end::Script-->
</body>
<!--end::Body-->

</html>