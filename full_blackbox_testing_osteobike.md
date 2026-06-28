# Skenario Pengujian Black-Box Keseluruhan Sistem: Osteobike

Dokumen ini berisi rancangan pengujian perangkat lunak (*Black-Box Testing*) secara menyeluruh untuk sistem **Monitoring Osteobike**. Pengujian dibagi menjadi dua peran utama: **Guest (Pengguna Publik)** dan **Admin (Pengguna Terautentikasi)**.

---

## A. Skenario Pengujian: GUEST (Pengguna Publik)
Pengguna publik adalah pengguna yang mengakses sistem tanpa melakukan login terlebih dahulu.

### 1. Halaman Utama (Home - `/`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **GST-01** | Akses Halaman Utama | Buka URL utama website (`/`). | Halaman beranda termuat sempurna (termasuk komponen informasi produk, panduan, dan tim pengembang). | ✅ Sukses |

![Screenshot Halaman Utama]([Masukkan path gambar di sini])

### 2. Fitur Laporan Publik (`/laporan`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **GST-02** | Akses Halaman Laporan | Klik menu Laporan atau akses `/laporan`. | Halaman laporan publik terbuka, menampilkan data riwayat/laporan publik yang diizinkan. | ✅ Sukses |
| **GST-03** | Filter Laporan | Pilih rentang tanggal atau parameter filter, klik "Terapkan/Filter". | Tabel/data laporan memperbarui tampilannya sesuai dengan filter yang dimasukkan. | ✅ Sukses |
| **GST-04** | Download Laporan | Klik tombol "Download/Cetak" laporan. | File dokumen laporan (PDF/Excel) berhasil terunduh dengan data yang sesuai dengan hasil filter. | ✅ Sukses |

![Screenshot Halaman Laporan Publik]([Masukkan path gambar di sini])

### 3. Keamanan Rute Guest
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **GST-05** | Akses Paksa Rute Admin | Paksa akses URL `/dashboard` atau `/pasien` via URL bar tanpa login. | Akses ditolak, pengguna secara otomatis diarahkan ulang (*redirect*) ke halaman Login. | ✅ Sukses |

---

## B. Skenario Pengujian: ALUR AUTENTIKASI (Login & Logout)

### 1. Proses Login Admin (`/login`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **AUTH-01** | Login Berhasil | Masukkan Email dan Password Admin yang valid, klik "Login". | Login sukses, pengguna dialihkan (*redirect*) ke halaman `/dashboard`. | ✅ Sukses |
| **AUTH-02** | Login Gagal (Kredensial Salah) | Masukkan Email valid tetapi Password salah, klik "Login". | Login ditolak, muncul pesan error kredensial salah pada form. | ✅ Sukses |
| **AUTH-03** | Login Gagal (Form Kosong) | Kosongkan form Email dan Password, klik "Login". | Muncul validasi *required* (wajib diisi) pada form. | ✅ Sukses |

![Screenshot Halaman Login]([Masukkan path gambar di sini])

### 2. Proses Logout
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **AUTH-04** | Logout Admin | Klik tombol "Logout" dari dashboard Admin. | Sesi berakhir, pengguna dialihkan ke halaman utama atau halaman login, dan tidak bisa kembali ke halaman admin dengan tombol *Back* browser. | ✅ Sukses |

---

## C. Skenario Pengujian: ADMIN (Terautentikasi)
Pengguna yang telah berhasil melakukan login dan masuk ke area sistem (*Dashboard*).

### 1. Dashboard Admin (`/dashboard`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **ADM-01** | Tampilan Dashboard | Buka halaman dashboard. | Halaman memuat ringkasan data (statistik pasien, ringkasan terapi) dengan benar. | ✅ Sukses |

![Screenshot Dashboard Admin]([Masukkan path gambar di sini])

### 2. Manajemen Data Pasien (`/pasien`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **PAS-01** | Lihat Daftar Pasien | Akses menu "Data Pasien". | Tabel berisi daftar pasien tampil beserta fitur navigasi (pagination) jika data banyak. | ✅ Sukses |
| **PAS-02** | Tambah Pasien Baru | Klik "Tambah", isi form dengan data valid, klik "Simpan". | Data tersimpan, muncul notifikasi sukses, dan pasien baru muncul di tabel. | ✅ Sukses |
| **PAS-03** | Validasi Tambah Pasien | Klik "Simpan" tanpa mengisi form wajib. | Sistem menolak menyimpan, muncul pesan error/validasi di kolom yang wajib diisi. | ✅ Sukses |
| **PAS-04** | Edit Data Pasien | Klik "Edit" pada salah satu pasien, ubah nama, klik "Update". | Data berhasil diperbarui di database dan tabel menampilkan data terbaru. | ✅ Sukses |
| **PAS-05** | Hapus Data Pasien | Klik "Hapus" pada salah satu pasien, konfirmasi penghapusan. | Data pasien hilang dari tabel dan muncul pesan sukses. | ✅ Sukses |

![Screenshot Manajemen Pasien]([Masukkan path gambar di sini])

### 3. Manajemen Data Terapi (`/terapi`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **TRP-01** | Lihat Detail Terapi | Akses menu "Detail Terapi". | Daftar data sesi/jadwal terapi pasien tampil pada tabel. | ✅ Sukses |
| **TRP-02** | Tambah/Edit/Hapus Terapi | Lakukan operasi CRUD (Create, Update, Delete) pada data terapi. | Proses simpan, ubah, dan hapus berjalan lancar (sama dengan skenario pengujian pasien). | ✅ Sukses |

![Screenshot Detail Terapi]([Masukkan path gambar di sini])

### 4. Pengaturan Pengingat Terapi (`/pengingat-terapi`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **RMD-01** | Atur Pengingat Baru | Tambah jadwal pengingat untuk seorang pasien. | Data pengingat berhasil dibuat dan tersimpan di database. | ✅ Sukses |
| **RMD-02** | Ubah/Hapus Pengingat | Lakukan operasi Update/Delete pada data pengingat. | Perubahan/penghapusan berhasil dilakukan. | ✅ Sukses |

![Screenshot Pengingat Terapi]([Masukkan path gambar di sini])

### 5. Laporan Admin (`/laporan-admin`)
| ID | Skenario Pengujian | Langkah Uji | Hasil yang Diharapkan | Status |
|----|--------------------|-------------|-----------------------|--------|
| **LAP-01** | Filter Laporan Admin | Pilih parameter tertentu (misal: tanggal, nama pasien), klik "Filter". | Sistem menampilkan rekapan laporan yang lebih mendalam/lengkap sesuai filter. | ✅ Sukses |
| **LAP-02** | Download Laporan Admin | Klik tombol "Download/Ekspor". | File rekap laporan administratif berhasil diunduh. | ✅ Sukses |

![Screenshot Laporan Admin]([Masukkan path gambar di sini])
