        <footer
        	class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
        	<p class="text-muted mb-1 mb-md-0">Copyright © 2023 <a href="//github.com/ziaulkamal">Ziaul Kamal</a></p>
        	</p>
        </footer>

        </div>
        </div>
        <script src="<?= base_url ('public/') ?>assets/vendors/core/core.js"> </script>
        <script src="<?= base_url ('public/') ?>assets/vendors/feather-icons/feather.min.js"> </script>
        <script src="<?= base_url ('public/') ?>assets/js/template.js"> </script>
        <script src="<?= base_url ('public/') ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="<?= base_url ('public/') ?>assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
        <script src="<?= base_url ('public/') ?>assets/vendors/sweetalert2/sweetalert2.min.js"></script>
        <script src="<?= base_url ('public/') ?>assets/vendors/prismjs/prism.js"></script>
        <script src="<?= base_url ('public/') ?>assets/vendors/clipboard/clipboard.min.js"></script>
        <script src="<?= base_url ('public/') ?>assets/js/data-table.js"></script>
        <script src="<?= base_url ('public/') ?>assets/extra/jspdf.min.js"></script>
        <script src="<?= base_url ('public/') ?>assets/extra/html2canvas.min.js"></script>
 
        <script>
                function hanyaAngka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                        return false;
                return true;
                }
        </script>
        <?php if (isset($rupiah)) { ?>
        <script src="<?= base_url ('public/') ?>assets/extra/jquery-3.6.3.min.js"></script>
        <script src="<?= base_url ('public/') ?>assets/extra/jquery.mask.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});

            })
        </script>
        <?php }

        ?>
        </body>

        </html>
