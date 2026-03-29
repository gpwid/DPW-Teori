document.addEventListener("DOMContentLoaded", () => {
    // 1. Inisialisasi AOS (Animate on Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            once: true, // Animasi hanya berjalan sekali saat di-scroll
            offset: 50, // Muncul sedikit lebih awal
            duration: 800, // Durasi animasi smooth
            easing: 'ease-out-cubic',
        });
    }

    // 2. Logika Countdown Timer
    const targetDate = new Date('July 10, 2026 00:00:00').getTime();
    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    function updateCountdown() {
        const now = new Date().getTime();
        const timeRemaining = targetDate - now;

        if (timeRemaining < 0) {
            clearInterval(countdownInterval);
            if (daysEl && hoursEl && minutesEl && secondsEl) {
                daysEl.innerHTML = "00";
                hoursEl.innerHTML = "00";
                minutesEl.innerHTML = "00";
                secondsEl.innerHTML = "00";
            }
            return;
        }

        const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        if (daysEl && hoursEl && minutesEl && secondsEl) {
            daysEl.innerHTML = days < 10 ? '0' + Math.max(0, days) : days;
            hoursEl.innerHTML = hours < 10 ? '0' + Math.max(0, hours) : hours;
            minutesEl.innerHTML = minutes < 10 ? '0' + Math.max(0, minutes) : minutes;
            secondsEl.innerHTML = seconds < 10 ? '0' + Math.max(0, seconds) : seconds;
        }
    }

    // Update the countdown initially
    updateCountdown();
    // Update the countdown every 1 second
    const countdownInterval = setInterval(updateCountdown, 1000);


    // 3. Logika Guestbook (Buku Tamu)
    const rsvpForm = document.getElementById("guestbook-form");
    const rsvpFormView = document.getElementById("rsvp-form-view");
    const rsvpSuccessView = document.getElementById("rsvp-success-view");
    const guestNameSpan = document.getElementById("guest-name");

    if (rsvpForm) {
        rsvpForm.addEventListener("submit", (e) => {
            e.preventDefault(); // Mencegah form redirect

            // Ambil data nama
            const nameInput = document.getElementById("nama").value.trim();
            
            // Masukkan ke elemen sapaan
            if (guestNameSpan) {
                guestNameSpan.textContent = nameInput ? nameInput : "Tamu Tersayang";
            }

            // Ganti tampilan ke layar sukses
            if (rsvpFormView && rsvpSuccessView) {
                rsvpFormView.classList.add("hidden");
                rsvpSuccessView.classList.remove("hidden");
                rsvpSuccessView.classList.add("flex"); 
            }
        });
    }
});
