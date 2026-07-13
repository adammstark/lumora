<section class="contact" id="contact">

    <div class="contact-title">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu Anda 24/7</p>
    </div>

    <div class="contact-container">

        <!-- LEFT -->

        <div class="contact-info">

            <div class="info-box">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div class="info-text">
                    <h3>Alamat</h3>
                    <p>
                        Jl. Sudirman No.123 <br>
                        Jakarta Pusat, DKI Jakarta 10220
                    </p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon">
                    <i class="fas fa-phone"></i>
                </div>

                <div class="info-text">
                    <h3>Telepon</h3>
                    <p>+62 21 1234 5678</p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="info-text">
                    <h3>Email</h3>
                    <p>info@lumorahotel.com</p>
                </div>
            </div>

            <div class="info-box">
                <div class="info-icon">
                    <i class="fas fa-clock"></i>
                </div>

                <div class="info-text">
                    <h3>Jam Operasional</h3>
                    <p>
                        Check-in : 14.00 <br>
                        Check-out : 12.00
                    </p>
                </div>
            </div>

        </div>

        <!-- RIGHT -->

        <div class="contact-form">

            <h2>Kirim Pesan</h2>

            <form method="POST" action="{{ route('contact.store') }}">
    @csrf

                <input
                    type="text"
                    name="name"
                    placeholder="Nama"
                    required
                >

                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    required
                >

                <textarea
                    name="message"
                    placeholder="Pesan"
                    required
                ></textarea>

                <button type="submit" name="submit_contact">
                    Kirim Pesan
                </button>

            </form>

        </div>

    </div>

</section>