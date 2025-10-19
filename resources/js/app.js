// --- Import external dependencies (if any)
// Anda mungkin perlu meletakkan impor di sini jika Anda menggunakan framework JS,
// tapi untuk vanilla JS ini tidak perlu.

// --- INISIALISASI VARIABEL GLOBAL ---
const song = document.getElementById('weddingSong');
const audioControl = document.getElementById('audioControl');
const audioIcon = document.getElementById('audioIcon');
const loader = document.getElementById('pageLoader');
const startInvitation = document.getElementById('startInvitation');
const progressBar = document.getElementById('progressBar');
const recipientNameElement = document.getElementById('recipientName');
const groomCard = document.getElementById('groom-card');
const brideCard = document.getElementById('bride-card');

let isPlaying = false;
let shouldPlayOnReturn = false;
// --- UTILITY FUNCTIONS (Fungsi Pembantu) ---

// Fungsi untuk mengambil parameter URL
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Fungsi untuk menyalin alamat
window.copyAlamat = function () {
    const alamat = document.getElementById('alamat').textContent;
    navigator.clipboard.writeText(alamat);
    alert('Alamat pengiriman disalin ke clipboard!');
};

// Fungsi untuk membuka Lightbox
window.openLightbox = function (img) {
    const lightbox = document.getElementById('lightboxModal');
    const lightboxImage = document.getElementById('lightboxImage');
    lightboxImage.src = img.src;
    lightbox.classList.add('show');
};

// Fungsi untuk menutup Lightbox
window.closeLightbox = function () {
    const lightbox = document.getElementById('lightboxModal');
    lightbox.classList.remove('show');
    // Hapus kelas zoom jika ada saat ditutup
    document.getElementById('lightboxImage').classList.remove('zoomed');
};

// --- LOGIC UTAMA (Dijalankan setelah DOM dimuat) ---
document.addEventListener('DOMContentLoaded', () => {
    // 1. SCROLL RESTORATION & SCROLL TO TOP
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    // Scroll ke atas segera setelah DOM dimuat (menggantikan window.onload)
    window.scrollTo({
        top: 0,
        behavior: "instant"
    });

    // 2. LOGIC AUDIO VISIBILITY CHANGE
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            // Tab TIDAK aktif (pindah tab)
            if (isPlaying) {
                // Jika lagu sedang diputar, simpan status dan pause
                shouldPlayOnReturn = true;
                song.pause();
                audioIcon.classList.replace('bi-pause-fill', 'bi-play-fill');
            } else {
                // Jika lagu memang sedang pause, tidak perlu melakukan apa-apa
                shouldPlayOnReturn = false;
            }
        } else {
            // Tab KEMBALI aktif
            if (shouldPlayOnReturn) {
                // Cek apakah sebelumnya lagu seharusnya berputar
                song.play()
                    .then(() => {
                        // Update ikon ke pause karena lagu sudah play
                        audioIcon.classList.replace('bi-play-fill', 'bi-pause-fill');
                        isPlaying = true; // Konfirmasi status play
                    })
                    .catch(err => {
                        // Jika autoplay diblokir (jarang terjadi di sini, tapi bagus untuk safety)
                        console.warn('Gagal memutar lagu secara otomatis saat kembali ke tab:', err);
                        // Biarkan tombol di posisi play/pause
                    });
            }
        }
    });

    // 3. LOGIC COUNTDOWN
    const eventDate = new Date("December 20, 2025 08:00:00").getTime();
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days < 10 ? '0' + days : days;
        document.getElementById("hours").innerHTML = hours < 10 ? '0' + hours : hours;
        document.getElementById("minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes;
        document.getElementById("seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds;

        if (distance < 0) {
            clearInterval(countdownInterval);
            const timerElement = document.getElementById("timer");
            if (timerElement) timerElement.innerHTML = "";
            const msgElement = document.getElementById("countdownMessage");
            if (msgElement) msgElement.innerHTML = "🎉 Alhamdulillah, Acara Sedang Berlangsung! 🎉";
        }
    }
    const countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();

    // 4. LOGIC AUDIO CONTROL
    audioControl.addEventListener('click', () => {
        if (isPlaying) {
            song.pause();
            audioIcon.classList.replace('bi-pause-fill', 'bi-play-fill');
        } else {
            song.play();
            audioIcon.classList.replace('bi-play-fill', 'bi-pause-fill');
        }
        isPlaying = !isPlaying;
    });

    // 5. LOGIC FORM KOMENTAR
    document.getElementById('commentForm').addEventListener('submit', async e => {
        e.preventDefault();
        const from = document.getElementById('name').value;
        const text = document.getElementById('message').value;

        // 2. Get the CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Simple validation
        if (!from || !text) {
            alert('Nama dan ucapan/doa wajib diisi.');
            return;
        }

        try {
            const baseUrlElement = document.querySelector('meta[name="app-base-url"]').getAttribute('content');
            const url = baseUrlElement + '/create_comment';
            const response = await axios.post(url, {
                from: from,
                text: text,
                // Include the CSRF token for Laravel security
                _token: csrfToken
            });

            // 4. Handle Success Response (assuming Laravel returns the new comment object)
            const newCommentData = response.data.comment;

            // --- Update the UI (same logic as before, using data from server) ---
            const div = document.createElement('div');
            div.classList.add('border', 'rounded', 'p-3', 'mb-3', 'bg-light');
            div.innerHTML = `
            <strong>${newCommentData.from}</strong>
            <p class="mb-0 mt-1">${newCommentData.text}</p>
            <small class="text-muted d-block text-end">Just now</small>
        `;

            // Prepend the new comment to the list
            commentList.append(div);

            // Reset the form
            e.target.reset();

        } catch (error) {
            console.error("Error submitting comment:", error.response || error);
            alert('Gagal mengirim ucapan. Silakan coba lagi.');
        }
    });

    // 6. LOGIC LIGHTBOX
    const lightboxImage = document.getElementById('lightboxImage');
    if (lightboxImage) {
        lightboxImage.addEventListener('click', (e) => {
            e.stopPropagation();
            lightboxImage.classList.toggle('zoomed');
        });
    }

    // 7. LOGIC LOADER PROGRESS
    let progress = 0;
    const progressInterval = setInterval(() => {
        progress += Math.random() * 25;
        if (progress >= 100) {
            progress = 100;
            clearInterval(progressInterval);
            startInvitation.classList.add('show');
        }
        progressBar.style.width = progress + '%';
    }, 200);

    // 8. LOGIC BUKA UNDANGAN
    startInvitation.addEventListener('click', () => {
        document.body.classList.remove('no-scroll');

        song.play().then(() => {
            isPlaying = true;
            audioControl.style.display = 'flex';
        }).catch(err => console.log('Autoplay blocked:', err));

        loader.classList.add('fade-out');
        setTimeout(() => loader.remove(), 800);
        document.getElementById('firstView').scrollIntoView({
            behavior: 'smooth'
        });
    });

    // 9. LOGIC ANIMASI SCROLL UNTUK COUPLE (Intersection Observer)
    const observerOptions = {
        root: null,
        threshold: 0.2,
    };
    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-show');
                observer.unobserve(entry.target);
            }
        });
    };
    const observer = new IntersectionObserver(observerCallback, observerOptions);

    if (groomCard) {
        observer.observe(groomCard);
    }
    if (brideCard) {
        observer.observe(brideCard);
    }

    // 10. LOGIC NAMA PENERIMA DARI URL
    const defaultRecipient = "Bapak/Ibu/Saudara/i";
    let recipientName = getQueryParam('to');

    if (recipientName) {
        recipientName = recipientName.replace(/\+/g, ' ');
        let fullname = '';
        if (decodeURIComponent(recipientName)) {
            const parts = decodeURIComponent(recipientName).split(' ');
            // Kapitalisasi setiap kata (lebih baik daripada hanya huruf pertama)
            fullname = parts.map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        }
        recipientNameElement.innerHTML = fullname;
    } else {
        recipientNameElement.textContent = defaultRecipient;
    }

    // Sembunyikan jika nama kosong
    const recipientInfo = document.getElementById('recipientInfo');
    if (recipientNameElement && recipientNameElement.textContent.trim() === '' && recipientInfo) {
        recipientInfo.style.display = 'none';
    }
});

// 6. LOGIC LOAD MORE COMMENTS
const loadMoreButton = document.getElementById('loadMoreButton');
const commentList = document.getElementById('commentList');

if (loadMoreButton) {
    loadMoreButton.addEventListener('click', async (e) => {
        e.preventDefault();

        // Disable button and show loading text
        const button = e.currentTarget;
        const originalText = button.textContent;
        button.disabled = true;
        button.textContent = 'Loading...';

        // Get the URL for the next page from the link's href
        const url = button.getAttribute('href');

        try {
            // Fetch the next page of comments
            const response = await axios.get(url);

            // Get the HTML content for the new comments (We assume the server returns a view partial)
            const newCommentsHtml = response.data.html;

            // Append the new comments to the list
            commentList.insertAdjacentHTML('beforeend', newCommentsHtml);

            // Update the button for the next page
            const nextPageUrl = response.data.next_page_url;

            if (nextPageUrl) {
                // If there's another page, update the button's href
                button.setAttribute('href', nextPageUrl);
                button.disabled = false;
                button.textContent = originalText;
            } else {
                // If this was the last page, remove the button
                button.remove();
            }

        } catch (error) {
            console.error("Error loading more comments:", error);
            button.disabled = false;
            button.textContent = originalText;
            alert('Failed to load more comments.');
        }
    });
}
