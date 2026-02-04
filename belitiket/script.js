function updateHarga() {
    const jumlah = document.getElementById("jumlah").value;
    const hargaPerOrang = 25000;
    const total = jumlah * hargaPerOrang;
    document.getElementById("total-harga").textContent = "Harga Per Orang: Rp " + total.toLocaleString("id-ID");
}

document.addEventListener("DOMContentLoaded", () => {
    updateHarga();
    document.getElementById("jumlah").addEventListener("input", updateHarga);
});

document.addEventListener("DOMContentLoaded", () => {
    // VALIDASI NO HANDPHONE
    const nohpInput = document.getElementById("nohp");
    const nohpError = document.getElementById("nohp-error");

    nohpInput.addEventListener("input", function () {
        const nonDigit = /[^0-9]/g;

        if (nonDigit.test(this.value)) {
            nohpError.style.display = "block";
            this.value = this.value.replace(nonDigit, "");
        } else {
            nohpError.style.display = "none";
        }
    });

    // VALIDASI NAMA
    const namaInput = document.getElementById("nama");
    const namaError = document.getElementById("nama-error");

    namaInput.addEventListener("input", function () {
        const nonLetter = /[^a-zA-Z\s]/g; // hanya huruf dan spasi

        if (nonLetter.test(this.value)) {
            namaError.style.display = "block";
            this.value = this.value.replace(nonLetter, "");
        } else {
            namaError.style.display = "none";
        }
    });
});
