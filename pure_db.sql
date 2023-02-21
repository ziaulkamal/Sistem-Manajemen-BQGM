-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Feb 2023 pada 11.59
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bqgm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
--

CREATE TABLE `administrator` (
  `id_admin` int(11) NOT NULL,
  `namaLengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `gambarProfil` text NOT NULL,
  `levelAkses` varchar(50) NOT NULL,
  `lastLogin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id_admin`, `namaLengkap`, `username`, `password`, `gambarProfil`, `levelAkses`, `lastLogin`) VALUES
(1, 'ziaul kamal', 'ziadev', 'dc83d5b7d9771468aab821a264b890ac', 'e55f10a3afc14adfd3f8269e1f24ad64.jpg', 'manajer', '2023-02-20'),
(4, 'salman syarif', 'salman', '97502267ac1b12468f69c14dd70196e9', '', 'manajer', '2023-02-14'),
(5, 'asmaul husnas', 'husna', '5c7a6c0cd1d3aa794391470f66cf7cb3', '7068c5cfef66cf21a36d6e62def5dad7.png', 'operasional', '2023-02-20'),
(6, 'hasan', 'hasan', 'f690d3b8d4b51c1f189d886b7bab26b7', '', 'pembiayaan', '2023-02-20'),
(7, 'inggar', 'inggar', '456ae8193256af6e14146af99d8d35bb', '', 'teller', '2023-02-20'),
(8, 'anjasman', 'anjasman', 'ee8f584c1d3f471659dac36d26d0f0de', '', 'ao', '2023-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_detail`
--

CREATE TABLE `anggota_detail` (
  `anggota_id` varchar(30) NOT NULL,
  `rekening` varchar(30) NOT NULL,
  `penghasilan` double NOT NULL,
  `jumlahTanggungan` tinyint(4) NOT NULL,
  `namaIbu` varchar(100) NOT NULL,
  `namaPasangan` varchar(100) NOT NULL,
  `nikPasangan` varchar(30) NOT NULL,
  `tlPasangan` varchar(50) NOT NULL,
  `tglPasangan` date NOT NULL,
  `noHpPasangan` varchar(16) NOT NULL,
  `tanggalDaftar` date NOT NULL,
  `imgKtp_anggota` text NOT NULL,
  `imgKtp_pasangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_anggota`
--

CREATE TABLE `bq_anggota` (
  `id_anggota` varchar(30) NOT NULL,
  `namaAnggota` varchar(100) NOT NULL,
  `alamatKtp` text NOT NULL,
  `alamatSekarang` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tempatLahir` varchar(100) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `masaKtp` varchar(30) NOT NULL,
  `jenisKelamin` varchar(20) NOT NULL,
  `statusKawin` tinyint(4) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `statusAnggota` tinyint(4) NOT NULL,
  `lastUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_dokumen`
--

CREATE TABLE `bq_dokumen` (
  `id_dokumen` varchar(100) NOT NULL,
  `anggota_id` varchar(30) NOT NULL,
  `jenisDokumen` varchar(30) NOT NULL,
  `nomorSurat` varchar(50) NOT NULL,
  `statusKepemilikan` tinyint(4) NOT NULL,
  `namaPemilik` varchar(100) NOT NULL,
  `alamatJaminan` text NOT NULL,
  `lokasi` text NOT NULL,
  `luasJaminan` varchar(50) NOT NULL,
  `luasSawah_lain` varchar(30) NOT NULL,
  `luasSawah_gadai` varchar(30) NOT NULL,
  `kelolaSawah` varchar(10) NOT NULL,
  `luasKelola` varchar(50) NOT NULL,
  `foto1` text NOT NULL,
  `foto2` text NOT NULL,
  `foto3` text NOT NULL,
  `faktaData` varchar(10) NOT NULL,
  `tglSurvey` date NOT NULL,
  `lastUpdate_d` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_master`
--

CREATE TABLE `bq_master` (
  `id_master` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `nilai` double NOT NULL,
  `lastUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bq_master`
--

INSERT INTO `bq_master` (`id_master`, `nama`, `deskripsi`, `nilai`, `lastUpdate`) VALUES
(12, 'kas', 'pengaturan untuk posisi nilai kas', 24000, '2023-02-01'),
(14, 'bunga', 'pengaturan untuk set bagi hasil', 0.2, '2023-02-07'),
(15, 'zakat', 'pengaturan untuk ketetapan nilai zaka', 1080, '2023-02-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_pinjaman`
--

CREATE TABLE `bq_pinjaman` (
  `id_pinjaman` varchar(30) NOT NULL,
  `dokumen_id` varchar(50) NOT NULL,
  `anggota_id` varchar(30) NOT NULL,
  `rekening_id` varchar(30) NOT NULL,
  `tglPrediksi` date NOT NULL,
  `penghasilan6Bulan` double NOT NULL,
  `pengeluaran6Bulan` double NOT NULL,
  `angsuranLain6Bulan` double NOT NULL,
  `biayaOperasional` double NOT NULL,
  `plafon` double NOT NULL,
  `hargaGabah` double NOT NULL,
  `proyeksiPanen` double NOT NULL,
  `bunga` double NOT NULL,
  `tenor` tinyint(4) NOT NULL,
  `di` float NOT NULL,
  `idir` float NOT NULL,
  `approvalManajer` tinyint(4) NOT NULL,
  `lastUpdate_p` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_rekening`
--

CREATE TABLE `bq_rekening` (
  `id_rekening` varchar(30) NOT NULL,
  `anggota_id` varchar(30) NOT NULL,
  `s_pokok` double NOT NULL,
  `s_wajib` double NOT NULL,
  `s_sukarela` double NOT NULL,
  `status_pinjaman` tinyint(4) NOT NULL,
  `lastUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_surat`
--

CREATE TABLE `bq_surat` (
  `id_surat` int(11) NOT NULL,
  `no_surat` int(11) NOT NULL,
  `pinjaman_id` varchar(50) NOT NULL,
  `lastUpdate_s` date NOT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bq_transaksi`
--

CREATE TABLE `bq_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `serialNumber` varchar(50) NOT NULL,
  `nilaiTransaksi` double NOT NULL,
  `keterangan` text NOT NULL,
  `is_operasional` decimal(10,0) NOT NULL,
  `is_angsuran` decimal(10,0) NOT NULL,
  `is_simpanan` decimal(10,0) NOT NULL,
  `is_pinjaman` decimal(10,0) NOT NULL,
  `is_anggota` varchar(30) NOT NULL,
  `kodeRelasi` varchar(30) NOT NULL,
  `printInvoice` double NOT NULL,
  `lastUpdate_t` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bq_transaksi`
--

INSERT INTO `bq_transaksi` (`id_transaksi`, `type`, `serialNumber`, `nilaiTransaksi`, `keterangan`, `is_operasional`, `is_angsuran`, `is_simpanan`, `is_pinjaman`, `is_anggota`, `kodeRelasi`, `printInvoice`, `lastUpdate_t`) VALUES
(152, 'simpok', 'SIMPOK-1676885451', 24000, 'Setoran Simpanan Pokok dari ziaul kamal senilai Rp. 24,000', '0', '0', '1', '0', 'GM-20236880859', 'teller', 0, '2023-02-20'),
(153, 'tsimpok', 'TSIMPOK-1676885465', 24000, 'Penarikan Simpanan Pokok dari ziaul kamal senilai Rp. 24,000', '0', '0', '1', '0', 'GM-20236880859', 'operasional', 0, '2023-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen_detail`
--

CREATE TABLE `dokumen_detail` (
  `dokumen_id` varchar(50) NOT NULL,
  `sikap` tinyint(4) NOT NULL,
  `polaHidup` tinyint(4) NOT NULL,
  `kemudahanInformasi` tinyint(4) NOT NULL,
  `namaKeuchik` varchar(50) NOT NULL,
  `hpKeuchik` varchar(30) NOT NULL,
  `namaKeujrun` varchar(50) NOT NULL,
  `hpKeujrun` varchar(30) NOT NULL,
  `namaTetangga` varchar(50) NOT NULL,
  `hpTetangga` varchar(30) NOT NULL,
  `penggunaanPinjaman` tinyint(4) NOT NULL,
  `statusKelayakan` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ks_karyawan`
--

CREATE TABLE `ks_karyawan` (
  `serial` varchar(30) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `nilaiPinjaman` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sisaPinjaman` double NOT NULL,
  `lastUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman_detail`
--

CREATE TABLE `pinjaman_detail` (
  `pinjaman_id` varchar(30) NOT NULL,
  `pokokRahn` double NOT NULL,
  `pokokMudharabah` double NOT NULL,
  `sisaTenor` tinyint(4) NOT NULL,
  `pokokAngsuran` double NOT NULL,
  `bagiHasil` double NOT NULL,
  `angsuranPertama` varchar(15) NOT NULL,
  `angsuranKedua` varchar(15) NOT NULL,
  `angsuranKetiga` varchar(15) NOT NULL,
  `angsuranKeempat` varchar(15) NOT NULL,
  `angsuranKelima` varchar(15) NOT NULL,
  `statusPinjaman` varchar(30) NOT NULL,
  `aoBertugas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `anggota_detail`
--
ALTER TABLE `anggota_detail`
  ADD UNIQUE KEY `anggota_id` (`anggota_id`);

--
-- Indeks untuk tabel `bq_anggota`
--
ALTER TABLE `bq_anggota`
  ADD UNIQUE KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `bq_dokumen`
--
ALTER TABLE `bq_dokumen`
  ADD UNIQUE KEY `id_dokumen` (`id_dokumen`);

--
-- Indeks untuk tabel `bq_master`
--
ALTER TABLE `bq_master`
  ADD PRIMARY KEY (`id_master`);

--
-- Indeks untuk tabel `bq_pinjaman`
--
ALTER TABLE `bq_pinjaman`
  ADD UNIQUE KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indeks untuk tabel `bq_rekening`
--
ALTER TABLE `bq_rekening`
  ADD UNIQUE KEY `id_rekening` (`id_rekening`);

--
-- Indeks untuk tabel `bq_surat`
--
ALTER TABLE `bq_surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `bq_transaksi`
--
ALTER TABLE `bq_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `serialNumber` (`serialNumber`);

--
-- Indeks untuk tabel `dokumen_detail`
--
ALTER TABLE `dokumen_detail`
  ADD UNIQUE KEY `dokumen_id` (`dokumen_id`);

--
-- Indeks untuk tabel `ks_karyawan`
--
ALTER TABLE `ks_karyawan`
  ADD UNIQUE KEY `serial` (`serial`);

--
-- Indeks untuk tabel `pinjaman_detail`
--
ALTER TABLE `pinjaman_detail`
  ADD UNIQUE KEY `pinjaman_id` (`pinjaman_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `bq_master`
--
ALTER TABLE `bq_master`
  MODIFY `id_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `bq_surat`
--
ALTER TABLE `bq_surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `bq_transaksi`
--
ALTER TABLE `bq_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
