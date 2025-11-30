<?php

include_once 'partials/navbar.php';

?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Pakar Rekomendasi Jurusan UNG</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

      
        .hero-section {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.71), rgba(0, 0, 0, 0.73)), url('assets/img/ung.png');
            background-size: cover;      
            background-position: center; 
            background-repeat: no-repeat;
            background-attachment: fixed; 
        }

        
        .glass-card {
            background: rgba(255, 255, 255, 0.1); 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.63);
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3rem;
        }

        .hero-title {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: 1px;
        }

       
        .btn-modern {
            background: #5c0303ff; 
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px 40px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.4);
            background: #d60000;
            color: #fff;
        }

        
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .modal-header {
            background: #BA0000; 
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-bottom: none;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            background: #f8f9fa;
            border: 1px solid #eee;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #BA0000;
            background: #fff;
        }

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -15px); }
            100% { transform: translate(0, 0px); }
        }
    </style>
</head>
<body>

    <header class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                
                <div class="col-md-10 col-lg-8">
                    <div class="glass-card" data-aos="zoom-in" data-aos-duration="1000">
                        
                        <div class="mb-3 floating-icon">
                            <i class="fas fa-university fa-3x text-white"></i>
                        </div>

                        <h1 class="display-4 text-white mb-3 hero-title" data-aos="fade-up" data-aos-delay="200">
                            Sistem Pakar Penjurusan UNG
                        </h1>
                        
                        <p class="lead text-white mb-5" data-aos="fade-up" data-aos-delay="400">
                            Temukan jurusan kuliah yang paling tepat di Universitas Negeri Gorontalo berdasarkan minat, bakat, dan potensi Anda.
                        </p>
                        
                        <button class="btn btn-modern btn-lg" data-toggle="modal" data-target="#quizModal" data-aos="fade-up" data-aos-delay="600">
                            <i class="fas fa-rocket mr-2"></i> Mulai Konsultasi
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-user-circle mr-2"></i> Data Diri Mahasiswa</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form action="index.php?action=quiz" method="POST">
                        <input type="hidden" name="step" value="1">
                        
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold text-muted">Nama Lengkap</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama" required placeholder="Ketik nama lengkap Anda...">
                            </div>
                        </div>
                        
                        <div class="alert alert-info small border-0 bg-light text-muted mt-3">
                            <i class="fas fa-info-circle mr-1"></i> Sistem akan memberikan pertanyaan dinamis sesuai jawaban Anda.
                        </div>

                        <button type="submit" class="btn btn-block rounded-pill font-weight-bold py-2 mt-4 text-white" style="background: #BA0000; border:none;">
                            Lanjut ke Pertanyaan <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            AOS.init();
        });
    </script>
</body>
</html>