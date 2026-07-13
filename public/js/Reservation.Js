document
.getElementById("bookingForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    const checkin =
    document.getElementById("checkin").value;

    const checkout =
    document.getElementById("checkout").value;

    const guest =
    document.getElementById("guest").value;

    if(checkin === "" || checkout === ""){
        alert("Silakan pilih tanggal terlebih dahulu.");
        return;
    }

    alert(
        "Reservasi berhasil!\n\n" +
        "Check In : " + checkin + "\n" +
        "Check Out : " + checkout + "\n" +
        "Jumlah Tamu : " + guest
    );
});