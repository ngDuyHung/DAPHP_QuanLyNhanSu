-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2025 lúc 09:03 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_thuchanh_php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `date`, `check_in`, `check_out`) VALUES
(21, 38, '2025-12-08', '13:33:40', '13:33:49'),
(23, 100, '2025-12-22', '08:00:00', '17:05:00'),
(25, 102, '2025-12-22', '08:15:00', '17:30:00'),
(26, 103, '2025-12-22', '08:00:00', '17:00:00'),
(27, 104, '2025-12-22', '08:45:00', '17:00:00'),
(30, 107, '2025-12-22', '08:00:00', '17:00:00'),
(33, 110, '2025-12-22', '08:00:00', '17:00:00'),
(34, 111, '2025-12-22', '08:20:00', '17:05:00'),
(35, 112, '2025-12-22', '08:00:00', '17:00:00'),
(37, 114, '2025-12-22', '08:00:00', '17:00:00'),
(39, 116, '2025-12-22', '08:00:00', '17:00:00'),
(42, 119, '2025-12-22', '08:00:00', '17:00:00'),
(43, 100, '2025-12-21', '08:00:00', '17:00:00'),
(44, 101, '2025-12-21', '08:00:00', '17:00:00'),
(45, 102, '2025-12-21', '08:10:00', '17:00:00'),
(46, 106, '2025-12-21', '08:00:00', '17:00:00'),
(47, 112, '2025-12-21', '08:00:00', '17:00:00'),
(48, 38, '2025-12-23', '00:30:26', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin4256@gmail.com|127.0.0.1', 'i:1;', 1765717963),
('laravel-cache-admin4256@gmail.com|127.0.0.1:timer', 'i:1765717963;', 1765717963),
('laravel-cache-admin4856@gmail.com|127.0.0.1', 'i:1;', 1765779541),
('laravel-cache-admin4856@gmail.com|127.0.0.1:timer', 'i:1765779541;', 1765779541),
('laravel-cache-duyhung@gmail.com|127.0.0.1', 'i:1;', 1766401982),
('laravel-cache-duyhung@gmail.com|127.0.0.1:timer', 'i:1766401982;', 1766401982);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contracts`
--

CREATE TABLE `contracts` (
  `contract_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `contract_type` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `note` text DEFAULT NULL,
  `status` enum('pending','active','expired') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contracts`
--

INSERT INTO `contracts` (`contract_id`, `employee_id`, `contract_type`, `start_date`, `end_date`, `basic_salary`, `note`, `status`) VALUES
(19, 52, 'Hợp đồng xác định thời hạn', '2025-12-18', '2025-12-23', 3000000.00, 'd', 'pending'),
(20, 53, 'Hợp đồng xác định thời hạn', '2025-12-11', '2025-12-24', 15000000.00, 'c', 'active'),
(21, 100, 'Hợp đồng xác định thời hạn', '2023-01-15', '2025-01-15', 10000000.00, NULL, 'active'),
(22, 101, 'Hợp đồng không xác định thời hạn', '2023-02-10', NULL, 12000000.00, NULL, 'active'),
(23, 102, 'Hợp đồng không xác định thời hạn', '2020-05-20', NULL, 18000000.00, NULL, 'active'),
(24, 103, 'Hợp đồng thử việc', '2024-01-05', '2024-03-05', 8000000.00, NULL, 'expired'),
(25, 104, 'Hợp đồng xác định thời hạn', '2022-11-01', '2024-11-01', 15000000.00, NULL, 'active'),
(26, 105, 'Hợp đồng xác định thời hạn', '2023-03-15', '2026-03-15', 14000000.00, NULL, 'active'),
(27, 106, 'Hợp đồng không xác định thời hạn', '2021-06-12', NULL, 25000000.00, NULL, 'active'),
(28, 107, 'Hợp đồng xác định thời hạn', '2021-08-01', '2024-08-01', 16000000.00, NULL, 'active'),
(29, 108, 'Hợp đồng thử việc', '2024-02-01', '2024-04-01', 7000000.00, NULL, 'active'),
(30, 109, 'Hợp đồng xác định thời hạn', '2022-04-15', '2025-04-15', 13000000.00, NULL, 'active'),
(31, 110, 'Hợp đồng thử việc', '2024-03-01', '2024-05-01', 5000000.00, NULL, 'pending'),
(32, 111, 'Hợp đồng xác định thời hạn', '2023-09-20', '2024-09-20', 9000000.00, NULL, 'active'),
(33, 112, 'Hợp đồng xác định thời hạn', '2023-07-01', '2025-07-01', 13500000.00, NULL, 'active'),
(34, 113, 'Hợp đồng thử việc', '2024-05-01', '2024-07-01', 7500000.00, NULL, 'active'),
(35, 114, 'Hợp đồng xác định thời hạn', '2022-12-01', '2025-12-01', 11000000.00, NULL, 'active'),
(36, 115, 'Hợp đồng xác định thời hạn', '2023-05-20', '2026-05-20', 12500000.00, NULL, 'active'),
(37, 116, 'Hợp đồng không xác định thời hạn', '2021-10-10', NULL, 15500000.00, NULL, 'active'),
(38, 117, 'Hợp đồng thử việc', '2024-06-01', '2024-08-01', 8000000.00, NULL, 'active'),
(39, 118, 'Hợp đồng không xác định thời hạn', '2021-01-20', NULL, 19000000.00, NULL, 'active'),
(40, 119, 'Hợp đồng thử việc', '2024-07-01', '2024-09-01', 7000000.00, NULL, 'pending'),
(41, 38, 'Hợp đồng xác định thời hạn', '2025-12-24', '2026-01-01', 15000000.00, 'd', 'active');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `manager_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `departments`
--

INSERT INTO `departments` (`department_id`, `name`, `manager_id`) VALUES
(11, 'Phòng Nhân sự', 38),
(12, 'Phòng Kế toán', 52),
(13, 'Phòng Kỹ thuật', 53),
(14, 'Phòng Kinh doanh', 100),
(15, 'Phòng Marketing', 102),
(16, 'Phòng IT', 108);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `img_link` text DEFAULT NULL,
  `gender` enum('M','F') NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`employee_id`, `full_name`, `img_link`, `gender`, `dob`, `email`, `phone`, `address`, `department_id`, `hire_date`, `position`, `user_id`) VALUES
(38, 'Nguyễn Duy Hùng', 'employees/1765110572_meo-cam-bong-hoa-tren-tay-manh-me-len-23-09-00-15.jpg', 'M', '2004-10-23', 'duyhung@gmail.com', '0987667849', '34 tên lửa', 16, '2025-12-07', 'CTO', 1),
(52, 'Nguyễn Văn A', 'employees/1765858572_maxresdefault.jpg', 'M', '1990-12-04', 'nguyenvana@example.com', '0901234567', '123 Lê Lợi, Q1, TP.HCM', NULL, '2022-12-08', 'Nhân viên', 4),
(53, 'Trần Thị B', NULL, 'F', '1992-08-20', 'tranthib@example.com', '0912345678', '456 Nguyễn Huệ, Q1, TP.HCM', 12, '2021-12-03', 'Kế toán', 5),
(100, 'Nguyễn Văn An', NULL, 'M', '1995-05-10', 'an.nv@example.com', '0912000100', 'Hà Nội', 11, '2023-01-15', 'Nhân viên nhân sự', 100),
(101, 'Lê Thị Bình', NULL, 'F', '1996-08-20', 'binh.lt@example.com', '0912000101', 'Hải Phòng', 11, '2023-02-10', 'Chuyên viên đào tạo', 101),
(102, 'Trần Văn Cường', NULL, 'M', '1990-12-01', 'cuong.tv@example.com', '0912000102', 'Đà Nẵng', 12, '2020-05-20', 'Kế toán tổng hợp', 102),
(103, 'Phạm Minh Đức', NULL, 'M', '1998-03-15', 'duc.pm@example.com', '0912000103', 'TP HCM', NULL, '2024-01-05', 'Nhân viên kế toán', 103),
(104, 'Vũ Thu thảo', NULL, 'F', '1997-07-22', 'thao.vt@example.com', '0912000104', 'Cần Thơ', 13, '2022-11-01', 'Kỹ sư hệ thống', 104),
(105, 'Hoàng Gia Huy', NULL, 'M', '1994-09-30', 'huy.hg@example.com', '0912000105', 'Bình Dương', 13, '2023-03-15', 'Lập trình viên Backend', 105),
(106, 'Phan Thanh Hà', NULL, 'F', '1993-11-11', 'ha.pt@example.com', '0912000106', 'Đồng Nai', 14, '2021-06-12', 'Trưởng phòng Kinh doanh', 106),
(107, 'Đặng Văn Hùng', NULL, 'M', '1992-04-05', 'hung.dv@example.com', '0912000107', 'Long An', 14, '2021-08-01', 'Giám sát bán hàng', 107),
(108, 'Bùi Thị Lan', NULL, 'F', '1999-01-25', 'lan.bt@example.com', '0912000108', 'Bắc Ninh', 15, '2024-02-01', 'Chuyên viên Marketing', 108),
(109, 'Lý Hải Nam', NULL, 'M', '1991-06-18', 'nam.lh@example.com', '0912000109', 'Thái Nguyên', 15, '2022-04-15', 'Thiết kế đồ họa', 109),
(110, 'Trịnh Kim Oanh', NULL, 'F', '2000-02-29', 'oanh.tk@example.com', '0912000110', 'Quảng Ninh', 16, '2024-03-01', 'Thực tập sinh IT', 110),
(111, 'Đỗ Minh Quân', NULL, 'M', '1995-10-10', 'quan.dm@example.com', '0912000111', 'Nghệ An', 16, '2023-09-20', 'Nhân viên Helpdesk', 111),
(112, 'Ngô Chí Sơn', NULL, 'M', '1996-12-25', 'son.nc@example.com', '0912000112', 'Thanh Hóa', 13, '2023-07-01', 'Lập trình viên Frontend', 112),
(113, 'Dương Mỹ Tâm', NULL, 'F', '1998-05-05', 'tam.dm@example.com', '0912000113', 'Huế', 11, '2024-05-01', 'Nhân viên tuyển dụng', 113),
(114, 'Lâm Vĩnh Khang', NULL, 'M', '1994-04-14', 'khang.lv@example.com', '0912000114', 'Tiền Giang', 14, '2022-12-01', 'Nhân viên thị trường', 114),
(115, 'Đào Thanh Trúc', NULL, 'F', '1997-01-01', 'truc.dt@example.com', '0912000115', 'Sóc Trăng', 15, '2023-05-20', 'Quản lý mạng xã hội', 115),
(116, 'Vương Tuấn Kiệt', NULL, 'M', '1993-02-28', 'kiet.vt@example.com', '0912000116', 'Tây Ninh', 12, '2021-10-10', 'Kế toán thuế', 116),
(117, 'Tiêu Thục Anh', NULL, 'F', '1999-09-09', 'anh.tt@example.com', '0912000117', 'Vĩnh Long', 13, '2024-06-01', 'Tester', 117),
(118, 'Mạc Văn Khoa', NULL, 'M', '1992-08-08', 'khoa.mv@example.com', '0912000118', 'Hải Dương', 14, '2021-01-20', 'Trưởng nhóm kinh doanh', 118),
(119, 'Kiều Minh Tuấn', NULL, 'M', '2000-03-03', 'tuan.km@example.com', '0912000119', 'Phú Thọ', 16, '2024-07-01', 'Nhân viên phần cứng', 119);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leaves`
--

CREATE TABLE `leaves` (
  `leave_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `leave_type` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `leaves`
--

INSERT INTO `leaves` (`leave_id`, `employee_id`, `leave_type`, `start_date`, `end_date`, `status`) VALUES
(38, 38, 'Nghỉ ốm', '2025-12-07', '2025-12-07', 'pending'),
(40, 38, 'Nghỉ không lương', '2025-12-08', '2025-12-17', 'rejected'),
(41, 38, 'Nghỉ không lương', '2025-12-08', '2025-12-17', 'pending'),
(42, 38, 'Nghỉ hiếu', '2025-12-11', '2025-12-18', 'approved'),
(43, 100, 'Nghỉ phép năm', '2025-12-01', '2025-12-02', 'approved'),
(44, 102, 'Nghỉ phép năm', '2025-12-05', '2025-12-05', 'approved'),
(45, 104, 'Nghỉ ốm', '2025-12-10', '2025-12-12', 'approved'),
(46, 105, 'Nghỉ phép năm', '2025-12-20', '2025-12-20', 'pending'),
(47, 106, 'Nghỉ cưới', '2025-12-15', '2025-12-17', 'approved'),
(48, 108, 'Nghỉ phép năm', '2025-12-22', '2025-12-22', 'rejected'),
(49, 109, 'Nghỉ phép năm', '2025-11-20', '2025-11-21', 'approved'),
(50, 111, 'Nghỉ ốm', '2025-12-01', '2025-12-01', 'approved'),
(51, 112, 'Nghỉ phép năm', '2025-12-24', '2025-12-25', 'pending'),
(52, 114, 'Nghỉ phép năm', '2025-12-15', '2025-12-15', 'approved'),
(53, 115, 'Nghỉ phép năm', '2025-12-10', '2025-12-11', 'approved'),
(54, 117, 'Nghỉ phép năm', '2025-12-05', '2025-12-05', 'approved'),
(55, 118, 'Nghỉ phép năm', '2025-12-28', '2025-12-30', 'pending'),
(56, 100, 'Nghỉ ốm', '2025-11-15', '2025-11-15', 'approved'),
(57, 101, 'Nghỉ phép năm', '2025-12-12', '2025-12-12', 'approved'),
(58, 103, 'Nghỉ phép năm', '2025-12-08', '2025-12-08', 'approved'),
(59, 107, 'Nghỉ phép năm', '2025-12-02', '2025-12-02', 'approved'),
(60, 110, 'Nghỉ phép năm', '2025-12-18', '2025-12-18', 'pending'),
(61, 113, 'Nghỉ ốm', '2025-12-14', '2025-12-14', 'approved'),
(62, 116, 'Nghỉ phép năm', '2025-12-11', '2025-12-11', 'approved'),
(63, 119, 'Nghỉ phép năm', '2025-12-25', '2025-12-25', 'pending'),
(64, 102, 'Nghỉ phép năm', '2025-11-01', '2025-11-03', 'approved'),
(65, 105, 'Nghỉ phép năm', '2025-11-10', '2025-11-10', 'approved'),
(66, 106, 'Nghỉ phép năm', '2025-11-15', '2025-11-15', 'approved'),
(67, 107, 'Nghỉ ốm', '2025-11-25', '2025-11-26', 'approved');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('duyhung456@gmail.com', '$2y$12$5dVlFKrktUk.qSFuKkfGh.5jPk8i1q6ligNhkk7ahJcGenpkQjzHO', '2025-12-06 10:45:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rewards_discipline`
--

CREATE TABLE `rewards_discipline` (
  `record_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `type` enum('reward','discipline') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_recorded` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rewards_discipline`
--

INSERT INTO `rewards_discipline` (`record_id`, `employee_id`, `type`, `title`, `description`, `amount`, `date_recorded`) VALUES
(13, 38, 'discipline', 'báo cáo trễ', 'abxizxxx', 140000.00, '2025-12-07'),
(14, 38, 'reward', 'rte', 'ret', 200000.00, '2025-12-07'),
(15, 38, 'reward', 'sad', 'sad', 0.00, '2025-12-07'),
(16, 100, 'reward', 'Hoàn thành tốt nhiệm vụ', 'Khen thưởng tháng 12', 500000.00, '2025-12-22'),
(17, 102, 'reward', 'Sáng kiến kỹ thuật', 'Cải tiến quy trình kế toán', 2000000.00, '2025-12-10'),
(18, 104, 'discipline', 'Đi muộn nhiều lần', 'Vi phạm nội quy tháng 12', 200000.00, '2025-12-15'),
(19, 106, 'reward', 'Vượt KPI quý', 'Doanh số vượt 20%', 5000000.00, '2025-12-20'),
(20, 107, 'reward', 'Nhân viên tích cực', 'Hỗ trợ đồng nghiệp nhiệt tình', 300000.00, '2025-12-18'),
(21, 111, 'discipline', 'Báo cáo trễ', 'Không nộp báo cáo tuần 2', 100000.00, '2025-12-14'),
(22, 112, 'reward', 'Code chất lượng', 'Không phát sinh lỗi nghiêm trọng', 1000000.00, '2025-12-22'),
(23, 114, 'reward', 'Tiếp cận khách hàng mới', 'Ký được hợp đồng lớn', 3000000.00, '2025-12-15'),
(24, 116, 'reward', 'Kế toán chính xác', 'Quyết toán thuế không lỗi', 1500000.00, '2025-12-20'),
(25, 118, 'reward', 'Lãnh đạo nhóm tốt', 'Nhóm đạt KPI tháng', 2500000.00, '2025-12-25'),
(26, 101, 'reward', 'Tổ chức đào tạo tốt', 'Buổi trainning đạt điểm cao', 500000.00, '2025-12-12'),
(27, 103, 'discipline', 'Vi phạm giờ giấc', 'Về sớm không xin phép', 150000.00, '2025-12-10'),
(28, 105, 'reward', 'Fix bug nhanh', 'Xử lý lỗi server trong đêm', 1200000.00, '2025-12-05'),
(29, 108, 'reward', 'Chiến dịch Marketing hiệu quả', 'Reach vượt mong đợi', 3000000.00, '2025-11-28'),
(30, 109, 'discipline', 'Sai sót thiết kế', 'In ấn sai màu sắc', 300000.00, '2025-11-15'),
(31, 113, 'reward', 'Tuyển dụng đủ số lượng', 'Cung cấp nhân sự đúng hạn', 800000.00, '2025-11-20'),
(32, 115, 'reward', 'Quản lý Fanpage tốt', 'Tương tác tăng 50%', 1000000.00, '2025-11-30'),
(33, 117, 'reward', 'Tìm được lỗi logic', 'Giúp team tránh lỗi lớn', 700000.00, '2025-12-02'),
(34, 119, 'discipline', 'Bảo trì chậm', 'Khách hàng phàn nàn', 200000.00, '2025-12-04'),
(35, 100, 'reward', 'Tham gia hội thao', 'Giải nhất bóng đá', 300000.00, '2025-11-10'),
(36, 102, 'reward', 'Làm thêm giờ tích cực', 'Hỗ trợ quyết toán năm', 2000000.00, '2025-11-25'),
(37, 106, 'reward', 'Thưởng thâm niên', 'Gắn bó 3 năm', 3000000.00, '2025-06-01'),
(38, 107, 'discipline', 'Thiếu trung thực', 'Báo cáo sai doanh số', 1000000.00, '2025-11-05'),
(39, 112, 'reward', 'Đề xuất tech stack mới', 'Tăng hiệu suất 30%', 1500000.00, '2025-11-12'),
(40, 118, 'reward', 'Nỗ lực quý', 'Phát triển thị trường miền Tây', 4000000.00, '2025-10-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL CHECK (`month` between 1 and 12),
  `year` int(11) DEFAULT NULL,
  `work_day` double DEFAULT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `allowance` decimal(10,2) DEFAULT 0.00,
  `bonus` decimal(10,2) DEFAULT 0.00,
  `deduction` decimal(10,2) DEFAULT 0.00,
  `total_salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `salary`
--

INSERT INTO `salary` (`salary_id`, `employee_id`, `month`, `year`, `work_day`, `basic_salary`, `allowance`, `bonus`, `deduction`, `total_salary`) VALUES
(68, 38, 12, 2025, 10, 3000000.00, 100000.00, 200000.00, 10000.00, 3290000.00),
(69, 38, 12, 2025, 11, 2000000.00, 0.00, 0.00, 0.00, 2000000.00),
(70, 53, 12, 2025, 0, 15000000.00, 0.00, 0.00, 0.00, 0.00),
(71, 100, 12, 2025, 2, 10000000.00, 0.00, 500000.00, 0.00, 1269230.77),
(72, 101, 12, 2025, 1, 12000000.00, 0.00, 500000.00, 0.00, 961538.46),
(73, 102, 12, 2025, 2, 18000000.00, 0.00, 2000000.00, 0.00, 3384615.38),
(74, 104, 12, 2025, 1, 15000000.00, 0.00, 0.00, 200000.00, 376923.08),
(75, 105, 12, 2025, 0, 14000000.00, 0.00, 1200000.00, 0.00, 1200000.00),
(76, 106, 12, 2025, 1, 25000000.00, 0.00, 5000000.00, 0.00, 5961538.46),
(77, 107, 12, 2025, 1, 16000000.00, 0.00, 300000.00, 0.00, 915384.62),
(78, 108, 12, 2025, 0, 7000000.00, 0.00, 0.00, 0.00, 0.00),
(79, 109, 12, 2025, 0, 13000000.00, 0.00, 0.00, 0.00, 0.00),
(80, 111, 12, 2025, 1, 9000000.00, 0.00, 0.00, 100000.00, 246153.85),
(81, 112, 12, 2025, 2, 13500000.00, 0.00, 1000000.00, 0.00, 2038461.54),
(82, 113, 12, 2025, 0, 7500000.00, 0.00, 0.00, 0.00, 0.00),
(83, 114, 12, 2025, 1, 11000000.00, 0.00, 3000000.00, 0.00, 3423076.92),
(84, 115, 12, 2025, 0, 12500000.00, 0.00, 0.00, 0.00, 0.00),
(85, 116, 12, 2025, 1, 15500000.00, 0.00, 1500000.00, 0.00, 2096153.85),
(86, 117, 12, 2025, 0, 8000000.00, 0.00, 700000.00, 0.00, 700000.00),
(87, 118, 12, 2025, 0, 19000000.00, 0.00, 2500000.00, 0.00, 2500000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vNRIeM6jJh8ulYlD9A3NLMKcsWndMIx4B7NOkHWq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNG95YU1XUGFrdERSWkYzaWZ1dU1uTDRtWTMwa3dxejlxZkpHb0JTZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYWxhcnkiO3M6NToicm91dGUiO3M6MTI6InNhbGFyeS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY2NDA5NzkyO319', 1766427247);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','hr','employee') NOT NULL DEFAULT 'employee',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'duyhung', 'admin', 'admin456@gmail.com', NULL, '$2y$12$v9n.sVuyTbXYd3JIutL1YeEYM5kFsLS1czwBL8S8o6jAP2CMDBQTC', NULL, '2025-12-06 10:08:27', '2025-12-06 10:08:27'),
(4, 'Nguyễn Văn A', 'employee', 'nguyenvana@example.com', NULL, '$2y$12$8KBKsEgnvmc.h7dm4gG5Y.ELrdSMcys/4uRyYOJGTmO0zd/5.MhM.', NULL, '2025-12-07 05:39:36', '2025-12-07 05:39:36'),
(5, 'Trần Thị B', 'employee', 'tranthib@example.com', NULL, '$2y$12$acdTDo0MUakG8vQ28mUobeaOz1B2L4aINnHxl.O.Nth0.bAt.6fTy', NULL, '2025-12-07 05:41:16', '2025-12-07 05:41:16'),
(6, 'testrole456', 'admin', 'testrole456@gmail.com', NULL, '$2y$12$GyFOk0TkHzeq3D/IqLziy.awlhAlf.Nf3g2KN2KJt7pJ3Hcx7S6YC', NULL, '2025-12-07 07:00:28', '2025-12-07 07:00:28'),
(7, 'testtttt', 'admin', 'admin456tttt@gmail.com', NULL, '$2y$12$KBt7xs4YpHJsUt48y1XkauUEbHrb3NZwmLhBvr0OG.fuEHMLU5URC', NULL, '2025-12-14 10:50:40', '2025-12-14 10:50:40'),
(8, 'testre', 'employee', 'testre@gmail.com', NULL, '$2y$12$PL5RJRxZrZcXgPI/8Or9mO1jVuU3PgyElFnAcJxe18zF0Bz1EUUCC', NULL, '2025-12-22 12:52:33', '2025-12-22 12:52:33'),
(100, 'Nguyễn Văn An', 'employee', 'an.nv@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(101, 'Lê Thị Bình', 'employee', 'binh.lt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(102, 'Trần Văn Cường', 'hr', 'cuong.tv@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(103, 'Phạm Minh Đức', 'employee', 'duc.pm@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(104, 'Vũ Thu thảo', 'employee', 'thao.vt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(105, 'Hoàng Gia Huy', 'employee', 'huy.hg@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(106, 'Phan Thanh Hà', 'employee', 'ha.pt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(107, 'Đặng Văn Hùng', 'employee', 'hung.dv@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(108, 'Bùi Thị Lan', 'employee', 'lan.bt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(109, 'Lý Hải Nam', 'employee', 'nam.lh@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(110, 'Trịnh Kim Oanh', 'employee', 'oanh.tk@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(111, 'Đỗ Minh Quân', 'employee', 'quan.dm@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(112, 'Ngô Chí Sơn', 'employee', 'son.nc@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(113, 'Dương Mỹ Tâm', 'employee', 'tam.dm@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(114, 'Lâm Vĩnh Khang', 'employee', 'khang.lv@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(115, 'Đào Thanh Trúc', 'employee', 'truc.dt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(116, 'Vương Tuấn Kiệt', 'employee', 'kiet.vt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(117, 'Tiêu Thục Anh', 'employee', 'anh.tt@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(118, 'Mạc Văn Khoa', 'employee', 'khoa.mv@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07'),
(119, 'Kiều Minh Tuấn', 'employee', 'tuan.km@example.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2025-12-22 16:43:07', '2025-12-22 16:43:07');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_manager` (`manager_id`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `rewards_discipline`
--
ALTER TABLE `rewards_discipline`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Chỉ mục cho bảng `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `rewards_discipline`
--
ALTER TABLE `rewards_discipline`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `fk_manager` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Các ràng buộc cho bảng `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `rewards_discipline`
--
ALTER TABLE `rewards_discipline`
  ADD CONSTRAINT `rewards_discipline_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
