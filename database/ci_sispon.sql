/*
 Navicat Premium Data Transfer

 Source Server         : connect
 Source Server Type    : MySQL
 Source Server Version : 100135
 Source Host           : 127.0.0.1:3306
 Source Schema         : ci_inventori

 Target Server Type    : MySQL
 Target Server Version : 100135
 File Encoding         : 65001

 Date: 07/04/2019 23:48:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_komunitas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_komunitas`;
CREATE TABLE `tbl_komunitas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_komunitas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_berdiri_komunitas` date NULL DEFAULT NULL,
  `jumlah_anggota_komunitas` int(11) NULL DEFAULT NULL,
  `ketua_komunitas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_komunitas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `email_komunitas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tlp_komunitas` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_komunitas
-- ----------------------------
INSERT INTO `tbl_komunitas` VALUES (1, 'Sedulur Heppiii Dawuhan', '2017-09-01', 10, 'Gagas', 'Dawuhan', 'gagasagusbahtiar@gmail.com', '085721868539');

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT 0,
  `menu_role_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES (1, 'Jabatan', 'jabatan/show_jabatan', 'fa fa-cubes', 5, 1);
INSERT INTO `tbl_menu` VALUES (4, 'Pengguna', 'pengguna/show_pengguna', 'fa fa-user-plus', 5, 1);
INSERT INTO `tbl_menu` VALUES (5, 'Sistem', '#', 'fa fa-cog', 0, 1);
INSERT INTO `tbl_menu` VALUES (6, 'Menu', 'menu/show_menu', 'fa fa-sitemap', 5, 1);
INSERT INTO `tbl_menu` VALUES (9, 'Permohonan', 'permohonan/show_permohonan', 'fa fa-file-pdf-o', 0, 1);
INSERT INTO `tbl_menu` VALUES (10, 'Permohonan', 'permohonan/show_permohonan', 'fa fa-file-pdf-o', 0, 2);
INSERT INTO `tbl_menu` VALUES (11, 'List Komunitas', 'organisasi/show_organisasi', 'fa fa-users', 0, 1);

-- ----------------------------
-- Table structure for tbl_permohonan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_permohonan`;
CREATE TABLE `tbl_permohonan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengajuan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_pengajuan` date NULL DEFAULT NULL,
  `judul_pengajuan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `komunitas_id` int(11) NULL DEFAULT NULL,
  `file_proposal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_pengajuan` char(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_permohonan
-- ----------------------------
INSERT INTO `tbl_permohonan` VALUES (2, 'SISP/PERMOHONAN/2019/04/07/001', '2019-04-07', 'proposal kegiatan pasar ramadhan heppiii desa Dawuhan Tahun 2019', 1, 'file_1554634619.pdf', '02');

-- ----------------------------
-- Table structure for tbl_pesan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pesan`;
CREATE TABLE `tbl_pesan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `subjek` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pesan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_roles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_roles
-- ----------------------------
INSERT INTO `tbl_roles` VALUES (1, 'admin');
INSERT INTO `tbl_roles` VALUES (2, 'komunitas');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `_komunitas` int(11) NULL DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 0, 'gagas', 'pahlitamanata@gmail.com', '$2y$10$RMfFW13Je9dpK7oGIKAjpuY46bdCi1Ppb5cdPRGO0Y/07fL9oFDgO');
INSERT INTO `users` VALUES (3, 2, 1, 'Rohman', 'gagasagusbahtiar@gmail.com', '$2y$10$N0ajaglw0TjqUmt57liNmuNxttzO3p7CWmxAdECQAlnBvve60FN/m');

SET FOREIGN_KEY_CHECKS = 1;
