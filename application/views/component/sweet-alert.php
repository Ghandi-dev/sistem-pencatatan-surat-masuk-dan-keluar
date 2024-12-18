<!-- Confirm Delete -->
<script>
$(document).ready(function() {
    // Menghentikan tautan dari navigasi langsung
    $('.btn-hapus').on('click', function(event) {
        event.preventDefault(); // Mencegah aksi default tautan
        var href = $(this).attr('href'); // Ambil URL dari atribut href
        console.log(href);


        // Menampilkan dialog konfirmasi SweetAlert
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL jika dikonfirmasi
                window.location.href = href;
            }
        });
    });
});
</script>


<!-- ALERT -->
<?php
$alertType = '';
$alertTitle = '';
$alertMessage = '';

if ($this->session->flashdata('success')) {
    $alertType = 'success';
    $alertTitle = 'Good Job!';
    $alertMessage = $this->session->flashdata('success');
} elseif ($this->session->flashdata('warning')) {
    $alertType = 'warning';
    $alertTitle = 'Oops!';
    $alertMessage = $this->session->flashdata('warning');
} elseif ($this->session->flashdata('error')) {
    $alertType = 'error';
    $alertTitle = 'Error!';
    $alertMessage = $this->session->flashdata('error');
}

if ($alertType): ?>
<script>
$(document).ready(function() {
    Swal.fire("<?=$alertTitle;?>", <?=json_encode($alertMessage);?>, "<?=$alertType;?>");
});
</script>
<?php endif;?>