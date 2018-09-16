-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 08:18 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `nama_pemilik` varchar(250) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`, `nama_pemilik`, `no_rekening`, `gambar`) VALUES
(1, 'BCA', 'Irvan', 'xxxxxxxxxxxxxxxx', 'aa9d3ec4243250956a314578ff477f1b.png'),
(2, 'Mandiri', 'Irvan', 'xxxxxxxxxxxxxxxx', 'ef548aea6b56db9a723f9c7ac91d46da.png'),
(3, 'BRI', 'Irvan', 'xxxxxxxxxxxxxxxx', '778473b7e82f9e47ba2c284eb60a6dfb.png'),
(4, 'Mandiri Syariah', 'Irvan', 'xxxxxxxxxxxxxxxx', 'b8a5a05025b265f80b85ec7f2494e367.png'),
(6, 'BNI', 'Irvan', 'xxxxxxxxxxxxxxxx', 'fcf19066a6ccf09398c0dcd8ecb32538.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id_brand` int(11) NOT NULL,
  `nama_brand` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id_brand`, `nama_brand`) VALUES
(1, 'Brand Satu'),
(2, 'Brand Dua'),
(3, 'Brand Tiga'),
(4, 'Brand Empat'),
(5, 'Brand Lima'),
(6, 'Brand Enam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carabelanja`
--

CREATE TABLE `tbl_carabelanja` (
  `id_carabelanja` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_carabelanja`
--

INSERT INTO `tbl_carabelanja` (`id_carabelanja`, `judul`, `deskripsi`) VALUES
(1, 'Cara Belanja Online di IMC Online Shop', '<li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br>" &gt;Berikut petunjuk pembelian secara Online melalui website kami :<div></div><ol><li>Lihat gamnbar barang yang akan Anda beli lihat juga detail produknya</li><li>Klik tombol "Beli" pada barang yang akan anda beli<br></li><li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br></ol>" &gt;<li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxxx A/n : Irvan</div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan</div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan</div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br>BANK BNI<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br>" &gt;Berikut petunjuk pembelian secara Online melalui website kami :<div></div><ol><li>Lihat gamnbar barang yang akan Anda beli lihat juga detail produknya</li><li>Klik tombol "Beli" pada barang yang akan anda beli<br></li><li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br></ol>" &gt;<li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>5555555555 A/n : ADRIANO</div><div>BANK BCA<br>44455555555 A/n : ADRIANO</div><div>BANK MANDIRI<br>345235235 A/n : ADRIANO</div><div>BANK MANDIRI SYARIAH<br>235235235 A/n : ADRIANO</div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br>" &gt;Berikut petunjuk pembelian secara Online melalui website kami :<div></div><ol><li>Lihat gamnbar barang yang akan Anda beli lihat juga detail produknya</li><li>Klik tombol "Beli" pada barang yang akan anda beli<br></li><li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>5555555555 A/n : ADRIANO</div><div>BANK BCA<br>44455555555 A/n : ADRIANO</div><div>BANK MANDIRI<br>345235235 A/n : ADRIANO</div><div>BANK MANDIRI SYARIAH<br>235235235 A/n : ADRIANO</div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br></ol>" &gt;<li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxxx A/n : Irvan</div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan</div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan</div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br>BANK BNI<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br>" &gt;Berikut petunjuk pembelian secara Online melalui website kami :<div></div><ol><li>Lihat gamnbar barang yang akan Anda beli lihat juga detail produknya</li><li>Klik tombol "Beli" pada barang yang akan anda beli<br></li><li>Pada tabel anda masukan quantity barang yang akan Anda beli.</li><li>Setelah mengubah quantity jangan lupa untuk klik tombol "refresh"(untuk menampilkan kalkulasi harga)</li><li>Tidak ada minimal belanja anda boleh belanja berapapun.</li><li>Untuk kembali memilih barang lainnya atau melanjutkan berbelanja silahkan klik tombol "lanjut berbelanja" dan cari produk lainnya.</li><li>Jika sudah selesai membeli silahkan klik tombol "selesai berbelanja"</li><li>Bia anda belum login silahkan login terlebih dahulu. Dengan cara mengisi form yang sudah tersedia. Jika belum menjadi member silahkan mendaftar dahulu dengan cara yang mudah mengklik tombol "registrasi member".</li><li>Selanjutnya silahkan mengisi data lengkap pada form yang sudah tersedia</li><li>Sebelum anda selesai periksa dahulu data yang anda isi kebenarnnya atau barangkali ada yang lupa dikosongkan.</li><li>Tunggu paling lambat 1x24 jam kami akan menkonfirmsi kiriman anda melalui email atau Hp yang anda cantumkan sebelumnya."</li><li>Anda akan menerima balasan melalui email atau Hp Anda tentang kalkulasi harga disertai jasa pengirmiannnya.</li><li>Jika Anda setuju silhkan kirim sejumlah uang yang kami konfimasikan. Berikut rekining Bank yang kami sediakan :</li><div>BANK BRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK BCA<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI<br>xxxxxxxxx A/n : Irvan<br></div><div>BANK MANDIRI SYARIAH<br>xxxxxxxxx A/n : Irvan<br></div><li>Setelah melakukan transfer ke bank silahkan anda lakukan konfirmasi ke email kami atau hotline kami di 08656455677776.</li><li>Pengiriman barang akan kami proses secepatnya dan Anda akan enerima nomer resi yang akan kami infokan melali alamt email atau No Hp Anda.</li><li>Jika Anda menemui kesulitan silahkan hubungi Costumer service kami.</li>Terimakasih Atas kepercayaan Anda. Semoga tetap menjadi pelanggan kami...<br><br><br><br><br><br></ol>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE `tbl_galeri` (
  `id_galeri` int(11) NOT NULL,
  `nama_galeri` varchar(200) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `kategorigaleri_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id_galeri`, `nama_galeri`, `gambar`, `kategorigaleri_id`) VALUES
(1, 'Jersea Motor', 'dec10698e402e54bbb65e199d1612127.gif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hubungikami`
--

CREATE TABLE `tbl_hubungikami` (
  `id_hubungikami` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` bigint(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hubungikami`
--

INSERT INTO `tbl_hubungikami` (`id_hubungikami`, `nama`, `email`, `hp`, `alamat`, `pesan`, `tanggal`, `status`) VALUES
(7, 'manaf', 'irvanperssi12@gmail.com', 256347487, 'wegwrhqewh', 'qwhqw', '2018-02-20', 1),
(8, 'egsddhs', '2352362@gmail.com', 236237, '26326', 'tidak sesuai', '2018-07-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hubungi_kami_kirim`
--

CREATE TABLE `tbl_hubungi_kami_kirim` (
  `id_hubungi_kami_kirim` int(11) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi_hubungi_kami_kirim` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hubungi_kami_kirim`
--

INSERT INTO `tbl_hubungi_kami_kirim` (`id_hubungi_kami_kirim`, `kepada`, `judul`, `isi_hubungi_kami_kirim`) VALUES
(3, 'roziqin_iqin@yahoo.com', 'Balasan', 'Balasan Untuk roziqin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jasapengiriman`
--

CREATE TABLE `tbl_jasapengiriman` (
  `id_jasapengiriman` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jasapengiriman`
--

INSERT INTO `tbl_jasapengiriman` (`id_jasapengiriman`, `nama`, `gambar`) VALUES
(1, 'JNE', '9161e6bd8ac2a57a7c9450bf84dee661.png'),
(2, 'TIKI', 'e6cb91a9459bc8af1f9685f947e1ffef.png'),
(3, 'ESL Express', 'cd1d63e790e558c44d0f538b51a72830.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Sarung Tangan'),
(3, 'Motorcros'),
(4, 'Kacamata'),
(5, 'Jersey'),
(6, 'Helm'),
(7, 'Dewasa'),
(8, 'Celana'),
(9, 'Anak-anak');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategorigaleri`
--

CREATE TABLE `tbl_kategorigaleri` (
  `id_kategorigaleri` int(11) NOT NULL,
  `nama_kategorigaleri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategorigaleri`
--

INSERT INTO `tbl_kategorigaleri` (`id_kategorigaleri`, `nama_kategorigaleri`) VALUES
(1, 'Album Pertama'),
(2, 'Album Kedua');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id_kontak` int(11) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`id_kontak`, `alamat`, `phone`, `email`) VALUES
(1, 'Sukabumi', 85795774343, 'irvanperssi12@gmail.com@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kota`
--

INSERT INTO `tbl_kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Purworejo'),
(2, 'Rembang'),
(3, 'Sleman'),
(4, 'Bantul'),
(5, 'Magelang'),
(6, 'Klaten'),
(7, 'Malang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logo`
--

CREATE TABLE `tbl_logo` (
  `id_logo` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logo`
--

INSERT INTO `tbl_logo` (`id_logo`, `gambar`) VALUES
(1, 'b702baabc48948bfbc529e7e242e8946.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nota`
--

CREATE TABLE `tbl_nota` (
  `id_nota` int(5) NOT NULL,
  `nomor` varchar(55) NOT NULL,
  `penerimanota` varchar(50) NOT NULL,
  `namateknisi` varchar(50) NOT NULL,
  `namapegawai` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `totalbiaya` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `isservice` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nota`
--

INSERT INTO `tbl_nota` (`id_nota`, `nomor`, `penerimanota`, `namateknisi`, `namapegawai`, `tanggal`, `totalbiaya`, `keterangan`, `isservice`) VALUES
(1, '0', 'iu', 'iub', 'iub', '0000-00-00', 0, 'iub', 0),
(2, '98', 'iuo', 'oiu', 'oiu', '0000-00-00', 0, 'oiu', 1),
(3, '987', '987', '987', '987', '0000-00-00', 987, '987', 1),
(4, '0', '0', '0', '0', '0000-00-00', 0, '0', 1),
(5, '0', 'oiu', 'oiu', 'oiu', '0000-00-00', 0, 'oiu', 1),
(6, '90', 'oi', '0', 'oi', '0000-00-00', 0, '0', 0),
(7, '0', 'oi', '0', 'oi', '0000-00-00', 0, '0', 0),
(8, '0', 'beli', '0', 'beli', '0000-00-00', 0, '0', 0),
(9, '0', 'beli', '0', 'beli', '0000-00-00', 0, '0', 0),
(10, '0', 'sc', 'sc', 'sc', '0000-00-00', 0, 'sc', 1),
(11, '0', 'sc', 'sc', 'sc', '0000-00-00', 0, 'sc', 1),
(12, '11', 'oiu', 'oiu', 'oi', '0000-00-00', 0, 'uo', 1),
(13, '918', '89', '0', '98', '0000-00-00', 98, '0', 0),
(14, '0918Serv13', 'oij', 'oij', 'oij', '0000-00-00', 0, 'j', 1),
(15, '0918Serv14', ',,', 'll', 'l', '2018-09-05', 0, 'll', 1),
(16, '0918Serv15', ',,', ',,', ',,', '2018-12-31', 0, ',,', 1),
(17, '0918Prod16', 'lm', '0', 'lm', '2018-09-05', 0, '0', 0),
(18, '0918Serv17', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1),
(19, '0918Serv18', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1),
(20, '0918Serv18', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1),
(21, '0918Serv18', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1),
(22, '0918Serv18', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1),
(23, '0918Serv22', 'in', 'iun', 'iun', '2018-09-14', 0, 'oij', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notadata`
--

CREATE TABLE `tbl_notadata` (
  `id_notadata` int(5) NOT NULL,
  `id_nota` int(5) NOT NULL,
  `namaprodukjasa` varchar(50) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notadata`
--

INSERT INTO `tbl_notadata` (`id_notadata`, `id_nota`, `namaprodukjasa`, `qty`, `harga`, `jumlah`) VALUES
(1, 21, 'iun', 8, 9, 72),
(2, 22, 'iun', 8, 9, 72),
(3, 22, 'jbkj', 9, 9, 909),
(4, 22, 'jbkjb', 7, 8, 908),
(5, 22, 'mnm', 7, 8, 98),
(6, 23, 'iun', 8, 9, 72);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peg_service`
--

CREATE TABLE `tbl_peg_service` (
  `id_peg_service` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `tlpn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_peg_service`
--

INSERT INTO `tbl_peg_service` (`id_peg_service`, `nama`, `alamat`, `tlpn`) VALUES
(1, 'candrra', 'asdfgas', '9078654'),
(2, 'yadas', 'asdasdasd.', '09876'),
(3, 'afasf', 'asfasf', '25234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` bigint(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga`, `stok`, `deskripsi`, `gambar`, `kategori_id`, `brand_id`) VALUES
(10, 'IMC00001', 'Hardisk 500GB', 800, 5, 'Garansi 1 Bulan', '51b7f042024c54f1722d6c6ca8bcfb4a.jpg', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sambutan`
--

CREATE TABLE `tbl_sambutan` (
  `id_sambutan` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sambutan`
--

INSERT INTO `tbl_sambutan` (`id_sambutan`, `judul`, `deskripsi`) VALUES
(1, 'Kami Hadir Untuk Anda', 'isi sambutan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seo`
--

CREATE TABLE `tbl_seo` (
  `id_seo` int(11) NOT NULL,
  `tittle` varchar(50) NOT NULL,
  `keyword` varchar(500) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seo`
--

INSERT INTO `tbl_seo` (`id_seo`, `tittle`, `keyword`, `description`) VALUES
(1, 'IMC Online Shop', 'IMC&nbsp; Shop, Shop Mx', 'IMC&nbsp; shop adalah website resmi toko online shop');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `id_service` int(10) NOT NULL,
  `kode_service` varchar(10) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `id_peg_service` int(10) NOT NULL,
  `pelanggan` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id_slider` int(11) NOT NULL,
  `tittle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id_slider`, `tittle`, `description`, `gambar`, `status`) VALUES
(7, '1', 'Garansi 1 tahun', 'efafda68b22c3f8450b209c110453148.jpg', 1),
(8, '2', 'Garansi 1 Bulan', 'b85c5e08e67b2bfabcc93329956c6a0b.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sosial_media`
--

CREATE TABLE `tbl_sosial_media` (
  `id_sosial_media` int(11) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `gp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sosial_media`
--

INSERT INTO `tbl_sosial_media` (`id_sosial_media`, `tw`, `fb`, `gp`) VALUES
(1, 'http://twitter.com', 'http://facebook.com', 'http://gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tentangkami`
--

CREATE TABLE `tbl_tentangkami` (
  `id_tentangkami` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tentangkami`
--

INSERT INTO `tbl_tentangkami` (`id_tentangkami`, `judul`, `deskripsi`) VALUES
(1, 'IMC Online Shop | Kami Hadir Untuk Anda', 'IMC Online Shop adalah toko yang menyediakan segala perlengkapan motocross dari anak-anak sampai dewasa. kami juga bisa menerima pesanan jersey sesuai dengan keinginan user.<br>Salam Owner<br>Irvan<br><br>"');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE `tbl_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `kode_transaksi` bigint(15) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`id_transaksi_detail`, `kode_transaksi`, `kode_produk`, `nama_produk`, `harga`, `jumlah`) VALUES
(1, 20140907001, 'AMX00007', 'Easy Polo Black Edition', '16000', 2),
(2, 20140907001, 'AMX00002', 'Easy Polo Black Edition', '56000', 1),
(3, 20140907002, 'AMX00007', 'Easy Polo Black Edition', '16000', 1),
(4, 20140907003, 'AMX00002', 'Easy Polo Black Edition', '56000', 2),
(5, 20140909001, 'AMX00007', 'Easy Polo Black Edition', '16000', 1),
(6, 20140909001, 'AMX00005', 'Easy Polo Black Edition', '36000', 1),
(7, 20141007001, 'AMX00007', 'Easy Polo Black Edition', '16000', 2),
(8, 20141007002, 'AMX00006', 'Easy Polo Black Edition', '26000', 1),
(9, 20141007002, 'AMX00003', 'Easy Polo Black Edition', '56000', 3),
(10, 20141007002, 'AMX00004', 'Easy Polo Black Edition', '56000', 1),
(11, 20180105001, 'AMX00004', 'Easy Polo Black Edition', '56000', 1),
(12, 20180105001, 'AMX00005', 'Easy Polo Black Edition', '36000', 1),
(13, 20180105002, 'AMX00002', 'Easy Polo Black Edition', '56000', 1),
(14, 20180109001, 'IMC00002', 'dhdfhadfh', '89000000', 1),
(15, 20180110001, 'IMC00002', 'dhdfhadfh', '89000000', 1),
(16, 20180110001, 'IMC00001', 'muslimah', '850000', 2),
(17, 20180201001, 'IMC00002', 'dhdfhadfh', '89000000', 1),
(18, 20180521001, 'IMC00002', 'MONITOR ACER 19inc', '800', 1),
(19, 20180528001, 'IMC00001', 'Hardisk 500GB', '800', 1),
(20, 20180602001, 'IMC00002', 'MONITOR ACER 19inc', '800', 1),
(21, 20180730001, 'IMC00002', 'MONITOR ACER 19inc', '800', 1),
(22, 20180816001, 'IMC00001', 'Hardisk 500GB', '800', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_header`
--

CREATE TABLE `tbl_transaksi_header` (
  `id_transaksi_header` int(11) NOT NULL,
  `kode_transaksi` bigint(15) NOT NULL,
  `penerima` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `propinsi` varchar(20) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `jasapengiriman_id` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_header`
--

INSERT INTO `tbl_transaksi_header` (`id_transaksi_header`, `kode_transaksi`, `penerima`, `email`, `alamat`, `no_telepon`, `propinsi`, `kota`, `kode_pos`, `bank_id`, `jasapengiriman_id`, `status`) VALUES
(1, 20140907001, 'Muhammad Roziqin', 'roziqin_iqin@yahoo.com', 'rembang', '085648105447', 'Jawa Tengah', 'Rembang', 59216, 4, 3, 1),
(2, 20140907002, 'Muhammad Roziqin', 'roziqin_iqin@yahoo.com', 'rembang', '085648105447', 'Jawa Tengah', 'Rembang', 59216, 4, 3, 1),
(3, 20140907003, 'Muhammad Roziqin', 'roziqin_iqin@yahoo.com', 'rembang', '085648105447', 'Jawa Tengah', 'Rembang', 59216, 4, 3, 1),
(4, 20140909001, 'Redi', 'rediapri@gmail.com', 'Ponorogo', '085233639940', 'jawa timur', 'Ponorogo', 63451, 1, 3, 1),
(5, 20141007001, 'nicco', 'niccokathienk@gmail.com', 'Purworejo', '082242299013', 'Jawa Tengah', 'purworejo', 54111, 4, 3, 1),
(6, 20141007002, 'Bahpong', 'bahpong_@yahoo.com', 'Magelang', '0878675757', 'Jawa tengah', 'Magelang', 89087, 3, 2, 1),
(7, 20180105001, 'radit', 'asgasgha', 'asgashga', '43748548', 'xczbzzb', 'zbnznn', 2352, 4, 1, 1),
(8, 20180105002, 'Egi', 'egisibalakacadut', 'genteng', '0857xxxxx', 'Jawa Barat', 'Sukabumi', 43161, 1, 1, 1),
(9, 20180109001, 'hasgjfas', 'sadgasg', 'sagas', '24563262', 'adsgas', 'dghsdjfsj', 3463463, 6, 1, 1),
(10, 20180110001, 'dfhadha', 'hjadhahgaeh', 'ahadhadf', '3467458734834', 'vbmvxxf', 'fjfsjfsj', 4747568, 6, 2, 1),
(11, 20180201001, 'dsklhgklsdsdgsd', 'xdgdsgs', 'sgsdghsdh', 'sdghsdh', 'dghdfh', 'dghd', 3525624, 6, 2, 1),
(12, 20180521001, 'ghjfvf', 'dfvdf', 'fdvd', '235325', 'gsdgv', 'dgfds', 4235, 6, 3, 0),
(13, 20180528001, 'dfgd', 'meemaesya10@gmail.com', 'dfhdfsh', '34626', 'Jawabarat', 'Kota Sukabumi', 43144, 6, 3, 0),
(14, 20180602001, 'dlgjlke', 'dshdshs', 'dsfhds', '36346d', 'fhds', 'dfh', 6969, 6, 3, 0),
(15, 20180728001, 'nvlksd', 'lkdfjda', 'kldjflkad', 'l;kgl;sd', 'mksgmgkl;x', 'lcmvlbks', 326, 6, 1, 1),
(16, 20180730001, 'ijal', 'zvgzbsgb', 'fnbhdhdsf', '45756854', 'xhdshds', 'dfjdf', 34634, 1, 1, 1),
(17, 20180816001, 'sjlvkas', 'sjvoiajsg', 'pojjpdgosjkblp;sd', '8t0er80269', 'lkjgblkad;jlf', 'jksdhdvakj', 8, 6, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `hak_akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `email`, `phone`, `hak_akses`) VALUES
(1, 'Admin Irvan', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'adminadriano@gmail.com', 85648263456, 'admin'),
(2, 'Intan', 'intan', 'b1098cab9c2db3eb9f576eb66c33449c', 'intan@gmail.com', 15364747, 'pegawai'),
(3, 'Admin MedSI', 'medina', '6a973a1cb0703afd0a7e65e4c14ea17a', 'MedSI@gmail.com', 813, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `tbl_carabelanja`
--
ALTER TABLE `tbl_carabelanja`
  ADD PRIMARY KEY (`id_carabelanja`);

--
-- Indexes for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `tbl_hubungikami`
--
ALTER TABLE `tbl_hubungikami`
  ADD PRIMARY KEY (`id_hubungikami`);

--
-- Indexes for table `tbl_hubungi_kami_kirim`
--
ALTER TABLE `tbl_hubungi_kami_kirim`
  ADD PRIMARY KEY (`id_hubungi_kami_kirim`);

--
-- Indexes for table `tbl_jasapengiriman`
--
ALTER TABLE `tbl_jasapengiriman`
  ADD PRIMARY KEY (`id_jasapengiriman`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategorigaleri`
--
ALTER TABLE `tbl_kategorigaleri`
  ADD PRIMARY KEY (`id_kategorigaleri`);

--
-- Indexes for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  ADD PRIMARY KEY (`id_logo`);

--
-- Indexes for table `tbl_nota`
--
ALTER TABLE `tbl_nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `tbl_notadata`
--
ALTER TABLE `tbl_notadata`
  ADD PRIMARY KEY (`id_notadata`);

--
-- Indexes for table `tbl_peg_service`
--
ALTER TABLE `tbl_peg_service`
  ADD PRIMARY KEY (`id_peg_service`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_sambutan`
--
ALTER TABLE `tbl_sambutan`
  ADD PRIMARY KEY (`id_sambutan`);

--
-- Indexes for table `tbl_seo`
--
ALTER TABLE `tbl_seo`
  ADD PRIMARY KEY (`id_seo`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `tbl_sosial_media`
--
ALTER TABLE `tbl_sosial_media`
  ADD PRIMARY KEY (`id_sosial_media`);

--
-- Indexes for table `tbl_tentangkami`
--
ALTER TABLE `tbl_tentangkami`
  ADD PRIMARY KEY (`id_tentangkami`);

--
-- Indexes for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `tbl_transaksi_header`
--
ALTER TABLE `tbl_transaksi_header`
  ADD PRIMARY KEY (`id_transaksi_header`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_carabelanja`
--
ALTER TABLE `tbl_carabelanja`
  MODIFY `id_carabelanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_hubungikami`
--
ALTER TABLE `tbl_hubungikami`
  MODIFY `id_hubungikami` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_hubungi_kami_kirim`
--
ALTER TABLE `tbl_hubungi_kami_kirim`
  MODIFY `id_hubungi_kami_kirim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_jasapengiriman`
--
ALTER TABLE `tbl_jasapengiriman`
  MODIFY `id_jasapengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_kategorigaleri`
--
ALTER TABLE `tbl_kategorigaleri`
  MODIFY `id_kategorigaleri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_nota`
--
ALTER TABLE `tbl_nota`
  MODIFY `id_nota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_notadata`
--
ALTER TABLE `tbl_notadata`
  MODIFY `id_notadata` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_peg_service`
--
ALTER TABLE `tbl_peg_service`
  MODIFY `id_peg_service` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_sambutan`
--
ALTER TABLE `tbl_sambutan`
  MODIFY `id_sambutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_seo`
--
ALTER TABLE `tbl_seo`
  MODIFY `id_seo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `id_service` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_sosial_media`
--
ALTER TABLE `tbl_sosial_media`
  MODIFY `id_sosial_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_tentangkami`
--
ALTER TABLE `tbl_tentangkami`
  MODIFY `id_tentangkami` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_transaksi_header`
--
ALTER TABLE `tbl_transaksi_header`
  MODIFY `id_transaksi_header` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
