      <footer class="app-footer">
        <div class="float-end d-none d-sm-inline">Versi 1.0</div>
        <strong>
          Copyright &copy; <?= date('Y') ?>&nbsp; <a href="#" class="text-decoration-none">SATUPINTU | disnakerinkompak</a>.
        </strong>
        All rights reserved.
      </footer>
    </div>
    <!--end::App Wrapper-->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>

    <!-- Memanggil script spesifik untuk halaman ini jika ada -->
    <?= $extra_scripts ?? '' ?>
</body>
</html>