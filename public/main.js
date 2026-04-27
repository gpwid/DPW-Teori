document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi AOS (Animate on Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            once: true,
        });
    }

    // --- FITUR BUKA UNDANGAN & MUSIK ---
    const openBtn = document.getElementById('open-invitation');
    const cover = document.getElementById('invitation-cover');
    const bgm = document.getElementById('bgm');

    if (openBtn && cover) {
        openBtn.addEventListener('click', function() {
            // Animasi tutup cover (slide ke atas)
            cover.style.opacity = '0';
            cover.style.transform = 'translateY(-100vh)';
            
            // Hapus overflow-hidden dari body agar bisa di-scroll
            document.body.classList.remove('overflow-hidden');

            // Play background music
            if (bgm) {
                bgm.play().catch(error => {
                    console.log("Autoplay musik dicegah oleh browser", error);
                });
            }

            // Hilangkan cover dari DOM setelah animasi selesai
            setTimeout(() => {
                cover.style.display = 'none';
            }, 1200);
        });
    }

    // --- FITUR HITUNG MUNDUR (COUNTDOWN) ---
    // Karena sekarang kita menggunakan blade, kita bisa meletakkan script 
    // var eventDate = new Date("{{ $settings['hari_acara'] ?? '2026-07-11' }}").getTime(); 
    // di dalam index.blade.php sebelum main.js dimuat.
    
    // Pastikan variabel eventDate sudah didefinisikan di view blade
    if (typeof eventDate !== 'undefined') {
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = eventDate - now;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("days").innerText = "00";
                document.getElementById("hours").innerText = "00";
                document.getElementById("minutes").innerText = "00";
                document.getElementById("seconds").innerText = "00";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days < 10 ? '0' + days : days;
            document.getElementById("hours").innerText = hours < 10 ? '0' + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? '0' + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? '0' + seconds : seconds;
        }, 1000);
    }
});
