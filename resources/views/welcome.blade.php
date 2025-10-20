<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan Yustan & Tanti</title>
    <meta name="app-base-url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @vite(['resources/js/app.js', 'resources/scss/app.scss', 'resources/css/common.css'])
</head>

<body class="no-scroll">
    <div id="pageLoader">
        <div class="loader-content-box">
            <div id="loaderText">
                Menyiapkan Undangan...
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <div class="text-center mt-4 mb-3" id="recipientInfo">
                <p class="mb-0 fw-light text-dark" style="font-size: 1rem;">Dear :</p>
                <h4 id="recipientName" class="fw-bold" style="color: #4e342e;">Tamu Undangan</h4>
            </div>

            <button class="btn-gold" id="startInvitation">💌 Buka Undangan</button>
        </div>
    </div>

    <section class="hero text-center" id="firstView">
        <img src="{{ asset('image/avatar2.jpg') }}" onclick="openLightbox(this)" alt="Yustan & Tanti">
        <div id="nameText">
            Yustan ❤️ Tanti
            <p class="mt-3">20 Desember 2025</p>
        </div>

        <audio id="weddingSong" loop>

            <source src="{{ asset('audio/song.mp3') }}" type="audio/mpeg">

        </audio>
    </section>

    <section class="section text-center" id="quranQuote">
        <div class="container">
            <h1 class="arabic-text mb-4">
                وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُمْ مِنْ أَنْفُسِكُمْ أَزْوَاجًا لِتَسْكُنُوا إِلَيْهَا وَجَعَلَ
                بَيْنَكُمْ مَوَدَّةً وَرَحْمَةً إِنَّ فِي ذَلِكَ لَآيَاتٍ لِقَوْمٍ يَتَفَكَّرُونَ
            </h1>
            <p class="quote-translation fst-italic mx-auto" style="max-width: 600px;">
                "Dan Di Antara Tanda-Tanda (Kebesaran)-Nya Ialah Dia Menciptakan Pasangan-Pasangan Untukmu Dari Jenismu
                Sendiri, Agar Kamu Cenderung Dan Merasa Tenteram Kepadanya, Dan Dia Menjadikan Di Antaramu Rasa Kasih
                Dan Sayang. Sesungguhnya Pada Yang Demikian Itu Benar-Benar Terdapat Tanda-Tanda (Kebesaran Allah) Bagi
                Kaum Yang Berpikir."
            </p>
            <p class="text-muted mt-3">(Q.S Ar-Rum :21)</p>
        </div>
    </section>

    <section class="section text-center bg-light" id="couple">
        <h2 class="section-title">Mempelai</h2>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 mb-4 animate-start" id="groom-card">
                    <div class="p-3">
                        <img src="{{ asset('image/y2_f.png') }}" alt="Mempelai Pria" class="img-thumbnail"
                            onclick="openLightbox(this)">
                        <h4 class="fw-bold">Yustanto Kusuma Bawono</h4>
                        <p>Putra dari Bapak Sigit & Ibu Ike</p>
                    </div>
                </div>

                <div class="col-md-1 mb-4">
                    <i class="bi bi-heart-fill text-danger" style="font-size: 3rem;"></i>
                </div>

                <div class="col-md-4 mb-4 animate-start" id="bride-card">
                    <div class="p-3">
                        <img src="{{ asset('image/t2.png') }}" alt="Mempelai Wanita" class="img-thumbnail"
                            onclick="openLightbox(this)">
                        <h4 class="fw-bold">Sri Istanti</h4>
                        <p>Putri dari Bapak Sukarno & Almh. Ibu Sarwini</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section text-center bg-white" id="countdown">
        <div class="container">
            <h2 class="section-title">Hitung Mundur</h2>
            <p class="lead mb-4">Menuju Hari Bahagia Kami</p>
            <div id="timer" class="d-flex justify-content-center flex-wrap">
                <div class="countdown-item">
                    <h3 id="days">00</h3>
                    <p>Hari</p>
                </div>
                <div class="countdown-item">
                    <h3 id="hours">00</h3>
                    <p>Jam</p>
                </div>
                <div class="countdown-item">
                    <h3 id="minutes">00</h3>
                    <p>Menit</p>
                </div>
                <div class="countdown-item">
                    <h3 id="seconds">00</h3>
                    <p>Detik</p>
                </div>
            </div>
            <p id="countdownMessage" class="mt-4 lead fw-bold text-success"></p>
        </div>
    </section>

    <section class="section bg-white text-center" id="acara">
        <div class="container">
            <h2 class="section-title">Tempat & Waktu Acara</h2>
            <p class="mb-5">Dengan memohon rahmat dan ridho Allah SWT,
                <br>kami bermaksud menyelenggarakan
                pernikahan kami
                pada:
            </p>

            <div class="row justify-content-center">
                <div class="col-md-5 mb-4">
                    <div class="border rounded p-4 h-100 shadow-sm bg-light">
                        <i class="bi bi-flower2 text-danger fs-1 mb-3"></i>
                        <h4 class="fw-bold text-brown">Akad Nikah</h4>
                        <p class="mb-1"><i class="bi bi-calendar-heart"></i> Sabtu, 20
                            Desember 2025</p>
                        <p class="mb-1"><i class="bi bi-clock"></i> Pukul 08.00 WIB - 09.00 WIB
                        </p>
                        <p class="mb-3"><i class="bi bi-geo-alt"></i> Kediaman Mempelai
                            Wanita<br>Jl. Beluk, Cungkrungan, Beluk, Kec. Bayat, Kabupaten Klaten, Jawa Tengah 57462</p>
                        <a href="https://www.google.com/maps/place/By+Tan/@-7.7797222,110.6462875,21z/data=!4m6!3m5!1s0x2e7a47000cd1bf81:0x4d032ed509d68019!8m2!3d-7.7797929!4d110.6462526!16s%2Fg%2F11yh3cq_3p?entry=ttu&g_ep=EgoyMDI1MTAxNC4wIKXMDSoASAFQAw%3D%3D"
                            target="_blank" class="btn btn-gold">
                            <i class="bi bi-map"></i> Lihat Lokasi
                        </a>
                    </div>
                </div>

                <div class="col-md-5 mb-4">
                    <div class="border rounded p-4 h-100 shadow-sm bg-light">
                        <i class="bi bi-balloon-heart text-danger fs-1 mb-3"></i>
                        <h4 class="fw-bold text-brown">Resepsi Pernikahan</h4>
                        <p class="mb-1"><i class="bi bi-calendar-heart"></i> Sabtu, 20
                            Desember 2025</p>
                        <p class="mb-1"><i class="bi bi-clock"></i> Pukul 10.00 WIB - Sampai selesai</p>
                        <p class="mb-3"><i class="bi bi-geo-alt"></i> Jl. Beluk, Cungkrungan, Beluk, Kec. Bayat,
                            Kabupaten Klaten, Jawa Tengah 57462</p>
                        <a href="https://www.google.com/maps/place/By+Tan/@-7.7797222,110.6462875,21z/data=!4m6!3m5!1s0x2e7a47000cd1bf81:0x4d032ed509d68019!8m2!3d-7.7797929!4d110.6462526!16s%2Fg%2F11yh3cq_3p?entry=ttu&g_ep=EgoyMDI1MTAxNC4wIKXMDSoASAFQAw%3D%3D"
                            target="_blank" class="btn btn-gold">
                            <i class="bi bi-map"></i> Lihat Lokasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section batik-bg" id="memories">
        <div class="container text-center text-light">
            <h2 class="section-title text-light mb-4">Kenangan Kami</h2>

            <div class="row g-3 justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <img src="{{ asset('image/avatar1.jpg') }}" alt="Memory 1" class="memory-img rounded shadow-sm"
                        onclick="openLightbox(this)">
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <img src="{{ asset('image/avatar2.jpg') }}" alt="Memory 2" class="memory-img rounded shadow-sm"
                        onclick="openLightbox(this)">
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <img src="{{ asset('image/avatar4.jpg') }}" alt="Memory 3" class="memory-img rounded shadow-sm"
                        onclick="openLightbox(this)">
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <img src="{{ asset('image/avatar3.jpg') }}" alt="Memory 4" class="memory-img rounded shadow-sm"
                        onclick="openLightbox(this)">
                </div>
            </div>
        </div>

        <div id="lightboxModal" class="lightbox" onclick="closeLightbox()">
            <img id="lightboxImage" class="lightbox-content rounded">
        </div>
    </section>


    <section class="section bg-light text-center" id="gift">
        <div class="container">
            <h2 class="section-title">Kirim Hadiah</h2>
            <p class="mb-5">
                Doa Restu Anda merupakan karunia yang sangat berarti bagi kami.
                <br>Namun jika memberi adalah ungkapan tanda
                kasih Anda, Anda dapat memberi kado secara cashless.
            </p>

            <div class="row justify-content-center">
                <div class="col-md-5 mb-4">
                    <div class="gift-card mx-auto h-100">
                        <h5 class="fw-bold mb-3"><i class="bi bi-house-heart"></i> Kirim
                            Hadiah ke Alamat</h5>
                        <p>
                            Anda juga dapat mengirimkan hadiah secara langsung ke alamat
                            kami:
                        </p>
                        <p class="fw-bold" id="alamat">
                            Jl. Beluk, Cungkrungan, Beluk, Kec. Bayat, Kabupaten Klaten, Jawa Tengah 57462
                        </p>
                        <button class="btn btn-gold mb-2" onclick="copyAlamat()">
                            <i class="bi bi-clipboard-check"></i> Salin Alamat
                        </button><br>
                        <a href="https://www.google.com/maps?q=-8.204163,111.092561" target="_blank"
                            class="btn btn-outline-secondary">
                            <i class="bi bi-geo-alt"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white" id="comments">
        <div class="container">
            <h2 class="section-title text-center">Ucapan & Doa</h2>

            <form id="commentForm" action="{{ route('public.createComment') }}" class="mb-4">
                @csrf
                <input type="text" class="form-control mb-2" id="name" placeholder="Nama" required>
                <textarea class="form-control mb-2" id="message" placeholder="Ucapan dan Doa" rows="3" required></textarea>
                <button type="submit" class="btn btn-gold">Kirim</button>
            </form>

            <div id="commentList">
                @foreach ($comments as $comment)
                    @include('partials.comment_item', ['comment' => $comment])
                @endforeach
            </div>

            {{-- Load More Section (Initial link from the first page) --}}
            @if ($comments->hasMorePages())
                <div class="text-center mt-4" id="loadMoreContainer">
                    <a href="{{ $comments->nextPageUrl() }}" class="btn btn-outline-secondary" id="loadMoreButton"
                        data-page="{{ $comments->currentPage() + 1 }}">
                        Load More Comments
                    </a>
                </div>
            @endif

        </div>
    </section>

    <section class="section bg-light text-center py-5" id="closing">
        <div class="container">
            <p class="mb-4">
                Merupakan sebuah kehormatan dan kebahagiaan bagi kami jika Bapak/Ibu /Saudara/i berkenan hadir dan
                memberikan doa restu bagi kami.
            </p>

            <p class="h3 fw-bold mb-1" style="font-family: 'Great Vibes', cursive; color: #b88a44;">
                Terima kasih
            </p>
            <p class="h3 fw-bold mb-1" style="font-family: 'Great Vibes', cursive; color: #b88a44;">
                Yustan & Tanti
            </p>
            <p class="mt-4">
                Wassalamualaikum Wr Wb
            </p>
        </div>
    </section>

    <div class="audio-control" id="audioControl" style="display: none;">
        <i class="bi bi-pause-fill fs-4" id="audioIcon"></i>
    </div>

    <footer class="text-center py-4 bg-white mt-4">
        <p class="mb-0">Dengan penuh cinta, <strong>Yustan & Tanti</strong> ❤️</p>
    </footer>
</body>


</html>
