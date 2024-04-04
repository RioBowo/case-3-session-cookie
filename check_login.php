<?php
session_start();

// Ambil nilai email dan password dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Ganti dengan proses otentikasi yang sesuai
if ($email == 'kelompok11@gmail.com' && $password == 'Kelompok11@') {
    // Login berhasil, simpan email dalam session
    $_SESSION['email'] = $email;
    echo "success";
} else {
    // Login gagal, tampilkan modal dengan pesan error
    echo '<div id="errorModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Invalid email or password.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';
}
?>