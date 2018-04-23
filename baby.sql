/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : baby

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2016-09-23 14:42:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fb_ads`
-- ----------------------------
DROP TABLE IF EXISTS `fb_ads`;
CREATE TABLE `fb_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin,
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_ads
-- ----------------------------
INSERT INTO `fb_ads` VALUES ('1', 'Adv 1', 0x4C6F72656D20497073756D, 'http://adv1.com', '1414780819-advert-1.jpg');
INSERT INTO `fb_ads` VALUES ('2', 'Adv 2', 0x54657374206164762032, 'http://adv2.com', '1414780928-advert-2.jpg');
INSERT INTO `fb_ads` VALUES ('3', 'Adv 3', 0x54657374206164762033, 'http://adv3.com', '1414780954-advert-3.jpg');
INSERT INTO `fb_ads` VALUES ('4', 'Adv 4', 0x436865636B2074686973206164766572746973656D656E74, 'http://adv4.com', '1414780995-advert-4.jpg');
INSERT INTO `fb_ads` VALUES ('5', 'Baby adv', 0x436865636B207468697320626162792070726F66696C652E, 'http://test.com', '1414781037-avatar-60x60-3.jpg');

-- ----------------------------
-- Table structure for `fb_album`
-- ----------------------------
DROP TABLE IF EXISTS `fb_album`;
CREATE TABLE `fb_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_of_album` date DEFAULT NULL,
  `pic_date` tinyint(4) DEFAULT '0',
  `private` tinyint(4) DEFAULT '0',
  `belong_to_me` tinyint(4) DEFAULT '0',
  `baby_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `date_updated` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL,
  `first_album` tinyint(4) DEFAULT '0' COMMENT '1=first',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `album_ibfk_3` (`baby_id`),
  CONSTRAINT `fb_album_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_album_ibfk_3` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_album
-- ----------------------------
INSERT INTO `fb_album` VALUES ('19', 'My Photos', '2015-02-01', '0', '0', '0', null, '27', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-02-02 07:51:39', '2015-02-02 08:51:39', null, '1');
INSERT INTO `fb_album` VALUES ('20', 'My Photos', '2015-02-01', '0', '0', '0', '14', null, 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C207468652070686F746F7320706F737473206F6E207468652077616C6C206F662074686973206261627920746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-02-02 08:26:02', '2015-02-02 09:26:02', null, '1');
INSERT INTO `fb_album` VALUES ('21', 'post album for lia', '2015-02-01', '0', '0', '0', '14', '27', null, '2015-02-02 09:09:05', '2015-02-02 10:09:05', null, '0');
INSERT INTO `fb_album` VALUES ('22', 'My Photos', '2015-02-07', '0', '0', '0', null, '28', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-02-07 20:37:45', '2015-02-07 21:37:45', null, '1');
INSERT INTO `fb_album` VALUES ('25', 'My Photos', '2015-02-20', '0', '0', '0', null, '31', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-02-21 02:12:37', '2015-02-21 04:12:37', null, '1');
INSERT INTO `fb_album` VALUES ('32', 'album1', '2015-03-01', '0', '0', '0', null, '27', 0x64657363, '2015-03-22 05:12:37', '2015-03-22 07:12:37', null, '0');
INSERT INTO `fb_album` VALUES ('34', 'My Photos', '2015-04-24', '0', '0', '0', null, '33', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-04-25 02:46:17', '2015-04-25 04:46:17', null, '1');
INSERT INTO `fb_album` VALUES ('35', 'My Photos', '2015-04-25', '0', '0', '0', null, '34', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-04-25 21:42:41', '2015-04-25 23:42:41', null, '1');
INSERT INTO `fb_album` VALUES ('36', 'My Photos', '2015-05-11', '0', '0', '0', null, '35', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-05-11 22:01:07', '2015-05-12 00:01:07', null, '1');
INSERT INTO `fb_album` VALUES ('37', 'My Photos', '2015-05-11', '0', '0', '0', '15', null, 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C207468652070686F746F7320706F737473206F6E207468652077616C6C206F662074686973206261627920746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-05-11 22:03:51', '2015-05-12 00:03:51', null, '1');
INSERT INTO `fb_album` VALUES ('38', 'My Photos', '2015-05-14', '0', '0', '0', null, '36', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2015-05-15 01:16:51', '2015-05-15 03:16:51', null, '1');
INSERT INTO `fb_album` VALUES ('39', 'My Photos', '2016-09-16', '0', '0', '0', null, '37', 0x496E207468697320616C62756D2075736572732063616E2066696E6420616C6C2074686569722070686F746F7320746861742069736E27742062656C6F6E67696E6720746F206120737065636966696320616C62756D2E, '2016-09-16 13:19:36', '2016-09-16 15:19:36', null, '1');

-- ----------------------------
-- Table structure for `fb_album_image`
-- ----------------------------
DROP TABLE IF EXISTS `fb_album_image`;
CREATE TABLE `fb_album_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `album_id` int(11) DEFAULT NULL,
  `main_pic` tinyint(4) DEFAULT '0',
  `date_taken` datetime DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `fb_album_image_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `fb_album` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_album_image
-- ----------------------------
INSERT INTO `fb_album_image` VALUES ('27', null, '1422827651-11920.jpeg', null, '19', '1', null, '2015-02-02 09:54:11');
INSERT INTO `fb_album_image` VALUES ('28', null, '1422827651-11920.jpeg', null, '20', '1', null, '2015-02-02 09:54:11');
INSERT INTO `fb_album_image` VALUES ('29', null, '1422827652-58847.jpeg', null, '19', '0', null, '2015-02-02 09:54:12');
INSERT INTO `fb_album_image` VALUES ('30', null, '1422827652-58847.jpeg', null, '20', '0', null, '2015-02-02 09:54:12');
INSERT INTO `fb_album_image` VALUES ('31', null, '1422828546-9814.png', null, '21', '1', null, '2015-02-02 10:09:06');
INSERT INTO `fb_album_image` VALUES ('32', null, '1422828546-9814.png', null, null, '1', null, '2015-02-02 10:09:06');
INSERT INTO `fb_album_image` VALUES ('33', null, '1422828547-82449.jpeg', null, '21', '0', null, '2015-02-02 10:09:07');
INSERT INTO `fb_album_image` VALUES ('34', null, '1422828547-82449.jpeg', null, null, '0', null, '2015-02-02 10:09:07');
INSERT INTO `fb_album_image` VALUES ('35', null, '1422828547-73089.png', null, '21', '0', null, '2015-02-02 10:09:07');
INSERT INTO `fb_album_image` VALUES ('36', null, '1422828547-73089.png', null, null, '0', null, '2015-02-02 10:09:07');
INSERT INTO `fb_album_image` VALUES ('37', null, 'img1.jpg', null, '32', '1', null, '2015-03-22 07:12:38');
INSERT INTO `fb_album_image` VALUES ('38', null, 'img2.jpeg', null, '32', '1', null, '2015-03-22 07:12:38');
INSERT INTO `fb_album_image` VALUES ('39', null, 'img5.png', null, '32', '1', null, '2015-03-22 07:12:38');
INSERT INTO `fb_album_image` VALUES ('40', null, '1429887172-23742.png', null, '19', '1', null, '2015-04-25 01:52:52');
INSERT INTO `fb_album_image` VALUES ('41', null, '1429887172-23742.png', null, '20', '1', null, '2015-04-25 01:52:53');
INSERT INTO `fb_album_image` VALUES ('42', null, '1429887173-19375.jpeg', null, '19', '0', null, '2015-04-25 01:52:53');
INSERT INTO `fb_album_image` VALUES ('43', null, '1429887173-19375.jpeg', null, '20', '0', null, '2015-04-25 01:52:53');
INSERT INTO `fb_album_image` VALUES ('44', null, '1429888104-55749.png', null, '19', '1', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('45', null, '1429888104-55749.png', null, '20', '1', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('46', null, '1429888104-20620.png', null, '19', '0', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('47', null, '1429888104-20620.png', null, '20', '0', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('48', null, '1429888104-40020.png', null, '19', '0', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('49', null, '1429888104-40020.png', null, '20', '0', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('50', null, '1429888104-34310.jpeg', null, '19', '0', null, '2015-04-25 02:08:24');
INSERT INTO `fb_album_image` VALUES ('51', null, '1429888104-34310.jpeg', null, '20', '0', null, '2015-04-25 02:08:24');

-- ----------------------------
-- Table structure for `fb_all_countries`
-- ----------------------------
DROP TABLE IF EXISTS `fb_all_countries`;
CREATE TABLE `fb_all_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `cost_country` int(10) NOT NULL DEFAULT '100',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fb_all_countries
-- ----------------------------
INSERT INTO `fb_all_countries` VALUES ('1', 'US', 'United States', '8', null);
INSERT INTO `fb_all_countries` VALUES ('2', 'CA', 'Canada', '4', null);
INSERT INTO `fb_all_countries` VALUES ('3', 'AF', 'Afghanistan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('4', 'AL', 'Albania', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('5', 'DZ', 'Algeria', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('6', 'DS', 'American Samoa', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('7', 'AD', 'Andorra', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('8', 'AO', 'Angola', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('9', 'AI', 'Anguilla', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('10', 'AQ', 'Antarctica', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('11', 'AG', 'Antigua and/or Barbuda', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('12', 'AR', 'Argentina', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('13', 'AM', 'Armenia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('14', 'AW', 'Aruba', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('15', 'AU', 'Australia', '3', null);
INSERT INTO `fb_all_countries` VALUES ('16', 'AT', 'Austria', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('17', 'AZ', 'Azerbaijan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('18', 'BS', 'Bahamas', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('19', 'BH', 'Bahrain', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('20', 'BD', 'Bangladesh', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('21', 'BB', 'Barbados', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('22', 'BY', 'Belarus', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('23', 'BE', 'Belgium', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('24', 'BZ', 'Belize', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('25', 'BJ', 'Benin', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('26', 'BM', 'Bermuda', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('27', 'BT', 'Bhutan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('28', 'BO', 'Bolivia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('29', 'BA', 'Bosnia and Herzegovina', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('30', 'BW', 'Botswana', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('31', 'BV', 'Bouvet Island', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('32', 'BR', 'Brazil', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('33', 'IO', 'British lndian Ocean Territory', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('34', 'BN', 'Brunei Darussalam', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('35', 'BG', 'Bulgaria', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('36', 'BF', 'Burkina Faso', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('37', 'BI', 'Burundi', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('38', 'KH', 'Cambodia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('39', 'CM', 'Cameroon', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('40', 'CV', 'Cape Verde', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('41', 'KY', 'Cayman Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('42', 'CF', 'Central African Republic', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('43', 'TD', 'Chad', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('44', 'CL', 'Chile', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('45', 'CN', 'China', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('46', 'CX', 'Christmas Island', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('47', 'CC', 'Cocos (Keeling) Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('48', 'CO', 'Colombia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('49', 'KM', 'Comoros', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('50', 'CG', 'Congo', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('51', 'CK', 'Cook Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('52', 'CR', 'Costa Rica', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('53', 'HR', 'Croatia (Hrvatska)', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('54', 'CU', 'Cuba', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('55', 'CY', 'Cyprus', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('56', 'CZ', 'Czech Republic', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('57', 'DK', 'Denmark', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('58', 'DJ', 'Djibouti', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('59', 'DM', 'Dominica', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('60', 'DO', 'Dominican Republic', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('61', 'TP', 'East Timor', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('62', 'EC', 'Ecudaor', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('63', 'EG', 'Egypt', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('64', 'SV', 'El Salvador', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('65', 'GQ', 'Equatorial Guinea', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('66', 'ER', 'Eritrea', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('67', 'EE', 'Estonia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('68', 'ET', 'Ethiopia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('69', 'FK', 'Falkland Islands (Malvinas)', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('70', 'FO', 'Faroe Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('71', 'FJ', 'Fiji', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('72', 'FI', 'Finland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('73', 'FR', 'France', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('74', 'FX', 'France, Metropolitan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('75', 'GF', 'French Guiana', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('76', 'PF', 'French Polynesia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('77', 'TF', 'French Southern Territories', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('78', 'GA', 'Gabon', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('79', 'GM', 'Gambia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('80', 'GE', 'Georgia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('81', 'DE', 'Germany', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('82', 'GH', 'Ghana', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('83', 'GI', 'Gibraltar', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('84', 'GR', 'Greece', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('85', 'GL', 'Greenland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('86', 'GD', 'Grenada', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('87', 'GP', 'Guadeloupe', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('88', 'GU', 'Guam', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('89', 'GT', 'Guatemala', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('90', 'GN', 'Guinea', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('91', 'GW', 'Guinea-Bissau', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('92', 'GY', 'Guyana', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('93', 'HT', 'Haiti', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('94', 'HM', 'Heard and Mc Donald Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('95', 'HN', 'Honduras', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('96', 'HK', 'Hong Kong', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('97', 'HU', 'Hungary', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('98', 'IS', 'Iceland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('99', 'IN', 'India', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('100', 'ID', 'Indonesia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('101', 'IR', 'Iran (Islamic Republic of)', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('102', 'IQ', 'Iraq', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('103', 'IE', 'Ireland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('104', 'IL', 'Israel', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('105', 'IT', 'Italy', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('106', 'CI', 'Ivory Coast', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('107', 'JM', 'Jamaica', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('108', 'JP', 'Japan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('109', 'JO', 'Jordan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('110', 'KZ', 'Kazakhstan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('111', 'KE', 'Kenya', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('112', 'KI', 'Kiribati', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('113', 'KP', 'Korea, Democratic People\'s Republic of', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('114', 'KR', 'Korea, Republic of', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('115', 'KW', 'Kuwait', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('116', 'KG', 'Kyrgyzstan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('117', 'LA', 'Lao People\'s Democratic Republic', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('118', 'LV', 'Latvia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('119', 'LB', 'Lebanon', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('120', 'LS', 'Lesotho', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('121', 'LR', 'Liberia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('122', 'LY', 'Libyan Arab Jamahiriya', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('123', 'LI', 'Liechtenstein', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('124', 'LT', 'Lithuania', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('125', 'LU', 'Luxembourg', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('126', 'MO', 'Macau', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('127', 'MK', 'Macedonia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('128', 'MG', 'Madagascar', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('129', 'MW', 'Malawi', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('130', 'MY', 'Malaysia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('131', 'MV', 'Maldives', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('132', 'ML', 'Mali', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('133', 'MT', 'Malta', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('134', 'MH', 'Marshall Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('135', 'MQ', 'Martinique', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('136', 'MR', 'Mauritania', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('137', 'MU', 'Mauritius', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('138', 'TY', 'Mayotte', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('139', 'MX', 'Mexico', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('140', 'FM', 'Micronesia, Federated States of', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('141', 'MD', 'Moldova, Republic of', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('142', 'MC', 'Monaco', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('143', 'MN', 'Mongolia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('144', 'MS', 'Montserrat', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('145', 'MA', 'Morocco', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('146', 'MZ', 'Mozambique', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('147', 'MM', 'Myanmar', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('148', 'NA', 'Namibia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('149', 'NR', 'Nauru', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('150', 'NP', 'Nepal', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('151', 'NL', 'Netherlands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('152', 'AN', 'Netherlands Antilles', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('153', 'NC', 'New Caledonia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('154', 'NZ', 'New Zealand', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('155', 'NI', 'Nicaragua', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('156', 'NE', 'Niger', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('157', 'NG', 'Nigeria', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('158', 'NU', 'Niue', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('159', 'NF', 'Norfork Island', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('160', 'MP', 'Northern Mariana Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('161', 'NO', 'Norway', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('162', 'OM', 'Oman', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('163', 'PK', 'Pakistan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('164', 'PW', 'Palau', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('165', 'PA', 'Panama', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('166', 'PG', 'Papua New Guinea', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('167', 'PY', 'Paraguay', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('168', 'PE', 'Peru', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('169', 'PH', 'Philippines', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('170', 'PN', 'Pitcairn', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('171', 'PL', 'Poland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('172', 'PT', 'Portugal', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('173', 'PR', 'Puerto Rico', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('174', 'QA', 'Qatar', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('175', 'RE', 'Reunion', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('176', 'RO', 'Romania', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('177', 'RU', 'Russian Federation', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('178', 'RW', 'Rwanda', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('179', 'KN', 'Saint Kitts and Nevis', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('180', 'LC', 'Saint Lucia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('181', 'VC', 'Saint Vincent and the Grenadines', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('182', 'WS', 'Samoa', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('183', 'SM', 'San Marino', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('184', 'ST', 'Sao Tome and Principe', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('185', 'SA', 'Saudi Arabia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('186', 'SN', 'Senegal', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('187', 'SC', 'Seychelles', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('188', 'SL', 'Sierra Leone', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('189', 'SG', 'Singapore', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('190', 'SK', 'Slovakia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('191', 'SI', 'Slovenia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('192', 'SB', 'Solomon Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('193', 'SO', 'Somalia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('194', 'ZA', 'South Africa', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('195', 'GS', 'South Georgia South Sandwich Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('196', 'ES', 'Spain', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('197', 'LK', 'Sri Lanka', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('198', 'SH', 'St. Helena', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('199', 'PM', 'St. Pierre and Miquelon', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('201', 'SR', 'Suriname', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('202', 'SJ', 'Svalbarn and Jan Mayen Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('203', 'SZ', 'Swaziland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('204', 'SE', 'Sweden', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('205', 'CH', 'Switzerland', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('206', 'SY', 'Syrian Arab Republic', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('207', 'TW', 'Taiwan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('208', 'TJ', 'Tajikistan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('209', 'TZ', 'Tanzania, United Republic of', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('210', 'TH', 'Thailand', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('211', 'TG', 'Togo', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('212', 'TK', 'Tokelau', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('213', 'TO', 'Tonga', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('214', 'TT', 'Trinidad and Tobago', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('215', 'TN', 'Tunisia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('216', 'TR', 'Turkey', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('217', 'TM', 'Turkmenistan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('218', 'TC', 'Turks and Caicos Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('219', 'TV', 'Tuvalu', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('220', 'UG', 'Uganda', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('221', 'UA', 'Ukraine', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('222', 'AE', 'United Arab Emirates', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('223', 'GB', 'United Kingdom', '2', null);
INSERT INTO `fb_all_countries` VALUES ('224', 'UM', 'United States minor outlying islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('225', 'UY', 'Uruguay', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('226', 'UZ', 'Uzbekistan', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('227', 'VU', 'Vanuatu', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('228', 'VA', 'Vatican City State', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('229', 'VE', 'Venezuela', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('230', 'VN', 'Vietnam', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('231', 'VG', 'Virigan Islands (British)', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('232', 'VI', 'Virgin Islands (U.S.)', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('233', 'WF', 'Wallis and Futuna Islands', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('234', 'EH', 'Western Sahara', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('235', 'YE', 'Yemen', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('236', 'YU', 'Yugoslavia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('237', 'ZR', 'Zaire', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('238', 'ZM', 'Zambia', '1000', null);
INSERT INTO `fb_all_countries` VALUES ('239', 'ZW', 'Zimbabwe', '1000', null);

-- ----------------------------
-- Table structure for `fb_appointment`
-- ----------------------------
DROP TABLE IF EXISTS `fb_appointment`;
CREATE TABLE `fb_appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `visit_id` int(11) DEFAULT NULL,
  `realized` tinyint(4) DEFAULT '2' COMMENT 'changed from 0',
  `date_of_visit` datetime DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `hospital_id` (`hospital_id`),
  KEY `visit_id` (`visit_id`),
  KEY `baby_id` (`baby_id`),
  CONSTRAINT `fb_appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_appointment_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_appointment_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_appointment_ibfk_4` FOREIGN KEY (`visit_id`) REFERENCES `fb_visit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_appointment_ibfk_5` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_appointment
-- ----------------------------
INSERT INTO `fb_appointment` VALUES ('1', 'tt', '27', '14', '34', null, null, '1', '2015-05-27 13:00:00', '2015-05-09 02:56:44', '2015-05-09 00:57:18');
INSERT INTO `fb_appointment` VALUES ('2', 'as', '27', '14', '31', null, null, '1', '2015-05-22 00:00:00', '2015-05-09 02:57:46', '2015-05-09 01:27:48');

-- ----------------------------
-- Table structure for `fb_baby`
-- ----------------------------
DROP TABLE IF EXISTS `fb_baby`;
CREATE TABLE `fb_baby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT 'creator_id',
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_of_pergacy` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `sun_sign` int(11) DEFAULT NULL,
  `blood_type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `height` decimal(10,0) DEFAULT '50',
  `weight` decimal(10,0) DEFAULT '2',
  `body_mass` decimal(10,2) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'for mobile only',
  `last_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'for mobile only',
  `desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `baby_ibfk_3` (`sun_sign`),
  CONSTRAINT `fb_baby_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_baby_ibfk_3` FOREIGN KEY (`sun_sign`) REFERENCES `fb_sun_sign` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_baby
-- ----------------------------
INSERT INTO `fb_baby` VALUES ('14', '27', 'Lia', '2', '2014-11-08 08:30:00', 'Cairo', '08-30', '/firstpout/media/croppic/croppedimg/croppedImg_1422825830.jpeg', '/firstpout/media/croppic/croppedimg/croppedImg_1422825854.jpeg', null, null, '50', '703', null, '2015-02-02 09:26:02', '2015-02-02 08:34:16', null, null, 'It was a very cold day');
INSERT INTO `fb_baby` VALUES ('15', '27', 'Baby 4', '1', '2011-03-10 09:30:00', 'Mokattam', '8-6', '', '', '2', null, '50', '1', null, '2015-05-12 00:03:51', '2015-05-11 22:03:51', null, null, 'Raining dogs');

-- ----------------------------
-- Table structure for `fb_baby_access_role`
-- ----------------------------
DROP TABLE IF EXISTS `fb_baby_access_role`;
CREATE TABLE `fb_baby_access_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baby_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `baby_access_role_ibfk_2` (`user_id`),
  KEY `baby_access_role_ibfk_1` (`baby_id`),
  CONSTRAINT `fb_baby_access_role_ibfk_1` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_baby_access_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_baby_access_role
-- ----------------------------
INSERT INTO `fb_baby_access_role` VALUES ('1', '14', '28', '1');

-- ----------------------------
-- Table structure for `fb_baby_doctor_hospital`
-- ----------------------------
DROP TABLE IF EXISTS `fb_baby_doctor_hospital`;
CREATE TABLE `fb_baby_doctor_hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baby_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `is_hospital` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `baby_id` (`baby_id`),
  KEY `doctor_id` (`doctor_id`),
  CONSTRAINT `fb_baby_doctor_hospital_ibfk_1` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_baby_doctor_hospital_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_baby_doctor_hospital
-- ----------------------------
INSERT INTO `fb_baby_doctor_hospital` VALUES ('1', '15', '34', '0');
INSERT INTO `fb_baby_doctor_hospital` VALUES ('2', '15', '35', '1');

-- ----------------------------
-- Table structure for `fb_baby_family`
-- ----------------------------
DROP TABLE IF EXISTS `fb_baby_family`;
CREATE TABLE `fb_baby_family` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baby_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `connection_id` (`connection_id`),
  KEY `user_id` (`user_id`),
  KEY `baby_id` (`baby_id`),
  CONSTRAINT `fb_baby_family_ibfk_1` FOREIGN KEY (`connection_id`) REFERENCES `fb_connection` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_baby_family_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_baby_family_ibfk_3` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_baby_family
-- ----------------------------
INSERT INTO `fb_baby_family` VALUES ('2', '14', '27', '1');

-- ----------------------------
-- Table structure for `fb_chat`
-- ----------------------------
DROP TABLE IF EXISTS `fb_chat`;
CREATE TABLE `fb_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `msg` text COLLATE utf8_bin,
  `msg_type` tinyint(4) DEFAULT '0' COMMENT '0=text, 1=upload',
  `seen` tinyint(4) DEFAULT '0' COMMENT '1=seen',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin` tinyint(4) DEFAULT '0' COMMENT 'for admin chat only',
  `fav` tinyint(4) DEFAULT '0' COMMENT 'for admin chat only',
  `imp` tinyint(4) DEFAULT '0' COMMENT 'for admin chat only',
  `show` tinyint(4) DEFAULT '1' COMMENT 'for admin chat only',
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`),
  KEY `to_id` (`to_id`),
  CONSTRAINT `fb_chat_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fb_chat_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_chat
-- ----------------------------
INSERT INTO `fb_chat` VALUES ('4', '27', '28', 0x6869, '0', '0', '2015-04-11 23:59:41', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('5', '27', '28', 0x6C6F6C, '0', '0', '2015-04-26 09:20:47', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('6', '27', '28', 0x313433303030303436302D2D2D6669727374706F7574204150492E646F6378, '1', '0', '2015-04-26 09:21:00', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('7', '27', '28', 0x6869, '0', '0', '2015-05-25 02:14:31', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('8', '27', '28', 0x61686D6564, '0', '0', '2015-07-12 10:15:33', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('9', '27', '28', 0x6869, '0', '0', '2015-10-02 06:50:01', '0', '0', '0', '1');
INSERT INTO `fb_chat` VALUES ('10', '27', '28', 0x61686D65642068616E79, '0', '0', '2016-02-25 00:46:38', '0', '0', '0', '1');

-- ----------------------------
-- Table structure for `fb_comment`
-- ----------------------------
DROP TABLE IF EXISTS `fb_comment`;
CREATE TABLE `fb_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `comment` longtext COLLATE utf8_bin,
  `item_id` int(11) DEFAULT NULL,
  `item_type` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `baby_id` (`baby_id`),
  KEY `comment_ibfk_3` (`item_type`),
  CONSTRAINT `fb_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_comment_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_comment_ibfk_3` FOREIGN KEY (`item_type`) REFERENCES `fb_item_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_comment
-- ----------------------------
INSERT INTO `fb_comment` VALUES ('21', '27', null, 0x6E69636520706963, '40', '7', '2015-02-10 08:16:02', null);
INSERT INTO `fb_comment` VALUES ('22', '27', null, 0x647265616D207465616D205E5E, '5', '6', '2015-02-10 08:16:26', null);
INSERT INTO `fb_comment` VALUES ('23', '27', null, 0x7465737420616C62756D20636F6D6D656E74, '21', '2', '2015-02-10 09:33:02', null);
INSERT INTO `fb_comment` VALUES ('24', '27', null, 0x6D6D0A617364, '21', '2', '2015-02-10 09:34:10', null);
INSERT INTO `fb_comment` VALUES ('25', '27', null, 0x646F6E65, '21', '2', '2015-02-10 09:50:13', null);
INSERT INTO `fb_comment` VALUES ('26', '27', null, 0x616C62756D20696D61676520776F726B696E67, '33', '3', '2015-02-10 09:52:10', null);
INSERT INTO `fb_comment` VALUES ('27', '27', null, 0x746573740A776F726B, '33', '3', '2015-02-10 09:53:40', null);
INSERT INTO `fb_comment` VALUES ('28', '27', null, 0x4C6F766520496D6720636F6D6D656E74, '1', '10', '2015-02-28 02:15:03', null);
INSERT INTO `fb_comment` VALUES ('29', '27', null, 0x57656C6C, '1', '10', '2015-02-28 02:18:44', null);
INSERT INTO `fb_comment` VALUES ('30', '27', null, 0x477238, '1', '10', '2015-02-28 02:19:04', null);
INSERT INTO `fb_comment` VALUES ('31', '27', null, 0x446F6E65, '1', '9', '2015-02-28 02:23:29', null);
INSERT INTO `fb_comment` VALUES ('32', '27', null, 0x6C75636B79, '1', '9', '2015-02-28 02:24:11', null);
INSERT INTO `fb_comment` VALUES ('33', '27', null, 0x6C6F6C, '19', '2', '2015-05-02 21:09:16', null);
INSERT INTO `fb_comment` VALUES ('34', '27', null, 0x6C6F6C, '49', '1', '2015-07-12 10:16:45', null);
INSERT INTO `fb_comment` VALUES ('35', '27', null, 0x736667686A6B66, '50', '1', '2016-02-25 00:43:46', null);
INSERT INTO `fb_comment` VALUES ('36', '27', null, 0x667364666768, '50', '1', '2016-02-25 00:43:55', null);

-- ----------------------------
-- Table structure for `fb_connection`
-- ----------------------------
DROP TABLE IF EXISTS `fb_connection`;
CREATE TABLE `fb_connection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_connection
-- ----------------------------
INSERT INTO `fb_connection` VALUES ('1', 'Father', '1');
INSERT INTO `fb_connection` VALUES ('2', 'Mother', '1');
INSERT INTO `fb_connection` VALUES ('3', 'Wife', '5');
INSERT INTO `fb_connection` VALUES ('4', 'Husband', '5');
INSERT INTO `fb_connection` VALUES ('5', 'Grandma', '3');
INSERT INTO `fb_connection` VALUES ('6', 'Grandpa', '3');
INSERT INTO `fb_connection` VALUES ('7', 'Cousin', '5');
INSERT INTO `fb_connection` VALUES ('8', 'Aunt', '5');
INSERT INTO `fb_connection` VALUES ('9', 'Brother', '2');
INSERT INTO `fb_connection` VALUES ('10', 'Sister', '2');
INSERT INTO `fb_connection` VALUES ('11', 'Uncle', '5');

-- ----------------------------
-- Table structure for `fb_connection_category`
-- ----------------------------
DROP TABLE IF EXISTS `fb_connection_category`;
CREATE TABLE `fb_connection_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_connection_category
-- ----------------------------
INSERT INTO `fb_connection_category` VALUES ('1', 'Parents');
INSERT INTO `fb_connection_category` VALUES ('2', 'Siblings');
INSERT INTO `fb_connection_category` VALUES ('3', 'Grandparents');
INSERT INTO `fb_connection_category` VALUES ('4', 'Godparents');
INSERT INTO `fb_connection_category` VALUES ('5', 'Rest of family');

-- ----------------------------
-- Table structure for `fb_contest`
-- ----------------------------
DROP TABLE IF EXISTS `fb_contest`;
CREATE TABLE `fb_contest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_contest
-- ----------------------------
INSERT INTO `fb_contest` VALUES ('2', 'November Contest', 0x4C6F72656D20697073756D20697320612064756D6D7920646174612E, '1414615249-contest-cover.jpg', '1000', '0', '2014-11-01 00:00:00', '2014-11-30 23:59:00', '2014-10-30 07:40:49', '2014-12-20 00:35:18');
INSERT INTO `fb_contest` VALUES ('3', 'February Contest', 0x54657374, '1418996091-1414615249-contest-cover.jpg', '20000', '1', '2015-02-01 00:00:00', '2015-02-28 23:59:00', '2014-12-20 01:34:51', '2014-12-20 00:34:51');

-- ----------------------------
-- Table structure for `fb_contest_user`
-- ----------------------------
DROP TABLE IF EXISTS `fb_contest_user`;
CREATE TABLE `fb_contest_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `num_of_votes` int(11) DEFAULT '0',
  `num_of_likes` int(11) DEFAULT '0',
  `date_joined` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `winner` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contest_id` (`contest_id`),
  KEY `user_id` (`user_id`),
  KEY `contest_user_ibfk_3` (`baby_id`),
  CONSTRAINT `fb_contest_user_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `fb_contest` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_contest_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_contest_user_ibfk_3` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_contest_user
-- ----------------------------
INSERT INTO `fb_contest_user` VALUES ('1', '27', '14', '3', 0x436865636B2074686973, '0', '0', '2015-02-23 20:12:30', '0');

-- ----------------------------
-- Table structure for `fb_contest_user_image`
-- ----------------------------
DROP TABLE IF EXISTS `fb_contest_user_image`;
CREATE TABLE `fb_contest_user_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `main_pic` tinyint(4) DEFAULT '0',
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `contest_user_id` int(11) DEFAULT NULL,
  `date_taken` datetime DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contest_user_id` (`contest_user_id`),
  CONSTRAINT `fb_contest_user_image_ibfk_1` FOREIGN KEY (`contest_user_id`) REFERENCES `fb_contest_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_contest_user_image
-- ----------------------------
INSERT INTO `fb_contest_user_image` VALUES ('1', '1424679150-download.jpg', '1', null, null, '1', null, '2015-02-23 20:12:30', null);
INSERT INTO `fb_contest_user_image` VALUES ('2', '1424679150-hearts-love-hd-wallpaper.jpg', '0', null, null, '1', null, '2015-02-23 20:12:30', null);
INSERT INTO `fb_contest_user_image` VALUES ('3', '1424679150-user.jpg', '0', null, null, '1', null, '2015-02-23 20:12:30', null);

-- ----------------------------
-- Table structure for `fb_contest_user_like`
-- ----------------------------
DROP TABLE IF EXISTS `fb_contest_user_like`;
CREATE TABLE `fb_contest_user_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contest_user_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_contest_user_like
-- ----------------------------
INSERT INTO `fb_contest_user_like` VALUES ('1', '1', '27');

-- ----------------------------
-- Table structure for `fb_contest_user_vote`
-- ----------------------------
DROP TABLE IF EXISTS `fb_contest_user_vote`;
CREATE TABLE `fb_contest_user_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contest_user_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_contest_user_vote
-- ----------------------------

-- ----------------------------
-- Table structure for `fb_faq`
-- ----------------------------
DROP TABLE IF EXISTS `fb_faq`;
CREATE TABLE `fb_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_bin NOT NULL,
  `answer` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_faq
-- ----------------------------
INSERT INTO `fb_faq` VALUES ('1', 'Question 1', 0x416E737765722031);
INSERT INTO `fb_faq` VALUES ('2', 'Question 2', 0x4C6F72656D20497073756D2069732073696D706C652064756D6D7920646174612E);
INSERT INTO `fb_faq` VALUES ('3', 'Why do I keep getting logged off?', 0x496E2074686520696E74657265737473206F662070726F74656374696E6720796F7572206163636F756E742C20776520646F6E27742073657420636F6F6B6965732E204F6E636520796F7520636C6F736520796F75722062726F777365722077696E646F772C20796F752077696C6C206265206175746F6D61746963616C6C79206C6F67676564206F66662E);

-- ----------------------------
-- Table structure for `fb_favourite`
-- ----------------------------
DROP TABLE IF EXISTS `fb_favourite`;
CREATE TABLE `fb_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `favourite_ibfk_2` (`baby_id`),
  KEY `favourite_ibfk_3` (`item_type`),
  CONSTRAINT `fb_favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_favourite_ibfk_3` FOREIGN KEY (`item_type`) REFERENCES `fb_item_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_favourite_ibfk_4` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_favourite
-- ----------------------------
INSERT INTO `fb_favourite` VALUES ('2', '27', null, '47', '1', '2015-05-25 02:15:03', null);
INSERT INTO `fb_favourite` VALUES ('3', '27', null, '48', '1', '2015-07-12 10:16:39', null);
INSERT INTO `fb_favourite` VALUES ('4', '27', null, '50', '1', '2016-02-25 00:43:31', null);

-- ----------------------------
-- Table structure for `fb_group`
-- ----------------------------
DROP TABLE IF EXISTS `fb_group`;
CREATE TABLE `fb_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `privacy` tinyint(4) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL COMMENT 'creator_id',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `other` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_ibfk_2` (`category`),
  CONSTRAINT `fb_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_group_ibfk_2` FOREIGN KEY (`category`) REFERENCES `fb_group_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_group
-- ----------------------------
INSERT INTO `fb_group` VALUES ('3', 'Pre School Group', '1', null, '/firstpout/media/croppic/croppedimg/croppedImg_1423315944.jpeg', '0', '27', '2015-02-08 01:32:38', '2015-02-23 07:35:39', '');
INSERT INTO `fb_group` VALUES ('4', 'xx Group', null, null, '/firstpout/media/croppic/croppedimg/croppedImg_1423315944.jpeg', '0', '27', '2015-05-27 00:43:49', '2015-05-26 22:43:49', 0x6E6F7468696E67);

-- ----------------------------
-- Table structure for `fb_group_category`
-- ----------------------------
DROP TABLE IF EXISTS `fb_group_category`;
CREATE TABLE `fb_group_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_group_category
-- ----------------------------
INSERT INTO `fb_group_category` VALUES ('1', 'Preschool');
INSERT INTO `fb_group_category` VALUES ('2', 'Kids events');
INSERT INTO `fb_group_category` VALUES ('3', 'Feeding');

-- ----------------------------
-- Table structure for `fb_group_invitee`
-- ----------------------------
DROP TABLE IF EXISTS `fb_group_invitee`;
CREATE TABLE `fb_group_invitee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0=invited, 1=request to join',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_group_invitee
-- ----------------------------
INSERT INTO `fb_group_invitee` VALUES ('1', '3', '28', '0');

-- ----------------------------
-- Table structure for `fb_group_user`
-- ----------------------------
DROP TABLE IF EXISTS `fb_group_user`;
CREATE TABLE `fb_group_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` tinyint(4) DEFAULT '0' COMMENT '0=user, 1=admin',
  `date_joined` datetime DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `connection_id` (`connection_id`),
  CONSTRAINT `fb_group_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_group_user_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `fb_group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_group_user_ibfk_3` FOREIGN KEY (`connection_id`) REFERENCES `fb_connection` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_group_user
-- ----------------------------

-- ----------------------------
-- Table structure for `fb_item_type`
-- ----------------------------
DROP TABLE IF EXISTS `fb_item_type`;
CREATE TABLE `fb_item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_item_type
-- ----------------------------
INSERT INTO `fb_item_type` VALUES ('1', 'post');
INSERT INTO `fb_item_type` VALUES ('2', 'album');
INSERT INTO `fb_item_type` VALUES ('3', 'albumImage');
INSERT INTO `fb_item_type` VALUES ('4', 'user');
INSERT INTO `fb_item_type` VALUES ('5', 'baby');
INSERT INTO `fb_item_type` VALUES ('6', 'postMedia');
INSERT INTO `fb_item_type` VALUES ('7', 'postImage');
INSERT INTO `fb_item_type` VALUES ('8', 'contest');
INSERT INTO `fb_item_type` VALUES ('9', 'contestUser');
INSERT INTO `fb_item_type` VALUES ('10', 'contestUserImage');

-- ----------------------------
-- Table structure for `fb_like`
-- ----------------------------
DROP TABLE IF EXISTS `fb_like`;
CREATE TABLE `fb_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_type` int(11) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `like_ibfk_2` (`baby_id`),
  KEY `like_ibfk_3` (`item_type`),
  CONSTRAINT `fb_like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_like_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_like_ibfk_3` FOREIGN KEY (`item_type`) REFERENCES `fb_item_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_like
-- ----------------------------
INSERT INTO `fb_like` VALUES ('5', '27', null, '6', null, '2015-02-10 07:43:20', null);
INSERT INTO `fb_like` VALUES ('7', '27', null, '6', '6', '2015-02-10 07:47:03', null);
INSERT INTO `fb_like` VALUES ('9', '27', null, '40', '7', '2015-02-10 07:51:03', null);
INSERT INTO `fb_like` VALUES ('10', '27', null, '5', '6', '2015-02-10 08:16:31', null);
INSERT INTO `fb_like` VALUES ('12', '27', null, '21', '2', '2015-02-10 09:32:40', null);
INSERT INTO `fb_like` VALUES ('13', '27', null, '33', '3', '2015-02-10 09:52:19', null);
INSERT INTO `fb_like` VALUES ('14', '27', null, '1', '10', '2015-02-28 02:14:49', null);
INSERT INTO `fb_like` VALUES ('23', '27', null, '1', '9', '2015-02-28 02:23:18', null);
INSERT INTO `fb_like` VALUES ('24', '27', null, '40', '1', '2015-03-02 09:15:59', null);
INSERT INTO `fb_like` VALUES ('25', '27', null, '13', '6', '2015-05-25 02:14:09', null);
INSERT INTO `fb_like` VALUES ('27', '27', null, '14', '6', '2015-07-12 10:16:13', null);
INSERT INTO `fb_like` VALUES ('28', '27', null, '50', '1', '2016-02-25 00:43:36', null);

-- ----------------------------
-- Table structure for `fb_notification`
-- ----------------------------
DROP TABLE IF EXISTS `fb_notification`;
CREATE TABLE `fb_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notifier_id` int(11) DEFAULT NULL,
  `msg` text COLLATE utf8_bin,
  `baby_id` int(11) DEFAULT NULL,
  `row_id` int(11) DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `seen` tinyint(4) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL,
  `row_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `notifier_id` (`notifier_id`),
  KEY `baby_id` (`baby_id`),
  CONSTRAINT `fb_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_notification_ibfk_2` FOREIGN KEY (`notifier_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_notification_ibfk_3` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_notification
-- ----------------------------
INSERT INTO `fb_notification` VALUES ('1', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B656420746865203C6120687265663D222F6669727374706F75742F686F6D652F76696577496D6167653F69643D3133266D6F64653D506F73744D656469612220636C6173733D2266616E6379626F78223E706F73743C2F613E20796F75206164646564206F6E204C696127732070726F66696C652E, null, '25', 'like', '1', '2015-05-25 02:14:09', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('2', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B65642061203C6120687265663D222F6669727374706F75742F686F6D652F76696577496D6167653F69643D3133266D6F64653D506F73744D656469612220636C6173733D2266616E6379626F78223E706F73743C2F613E20796F75206C696B65642E, null, '25', 'like', '1', '2015-05-25 02:14:09', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('3', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B65642061203C6120687265663D222F6669727374706F75742F686F6D652F76696577496D6167653F69643D3133266D6F64653D506F73744D656469612220636C6173733D2266616E6379626F78223E706F73743C2F613E20796F7520666F6C6C6F7765642E, null, '25', 'like', '1', '2015-05-25 02:14:10', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('4', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E2068617320666F6C6C6F77656420746865203C6120687265663D222F6669727374706F75742F6261627950726F66696C652F696E6465782F31342361727469636C652D3437223E706F73743C2F613E20796F75206164646564206F6E204C696127732074696D656C696E652E, null, '1', 'like', '1', '2015-05-25 02:14:59', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('5', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E2068617320666F6C6C6F77656420746865203C6120687265663D222F6669727374706F75742F6261627950726F66696C652F696E6465782F31342361727469636C652D3437223E706F73743C2F613E20796F75206164646564206F6E204C696127732074696D656C696E652E, null, '2', 'like', '1', '2015-05-25 02:15:03', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('6', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B656420746865203C6120687265663D222F6669727374706F75742F67726F7570732F696E6465782F332361727469636C652D3530223E706F73743C2F613E20796F75206164646564206F6E2067726F75702022507265205363686F6F6C2047726F7570222E, null, '26', 'like', '1', '2015-05-27 00:20:12', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('7', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B65642061203C6120687265663D222F6669727374706F75742F67726F7570732F696E6465782F332361727469636C652D3530223E706F73743C2F613E20796F75206C696B65642E, null, '26', 'like', '1', '2015-05-27 00:20:12', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('8', '27', '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E20686173206C696B65642061203C6120687265663D222F6669727374706F75742F67726F7570732F696E6465782F332361727469636C652D3530223E706F73743C2F613E20796F7520666F6C6C6F7765642E, null, '26', 'like', '1', '2015-05-27 00:20:12', null, '0000-00-00 00:00:00');
INSERT INTO `fb_notification` VALUES ('9', null, '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E2068617320616464656420766973697420283C6120687265663D222F6669727374706F75742F6261627950726F66696C652F7669736974732F3134223E766973697420313C2F613E2920746F203C6120687265663D222F6669727374706F75742F6261627950726F66696C652F696E6465782F3134223E4C69613C2F613E2070726F66696C652E, '14', '2', 'visit', '0', '2015-05-27 02:50:11', null, '1970-01-01 00:00:00');
INSERT INTO `fb_notification` VALUES ('10', null, '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E2068617320616464656420766973697420283C6120687265663D222F6669727374706F75742F6261627950726F66696C652F7669736974732F3134223E766973697420313C2F613E2920746F203C6120687265663D222F6669727374706F75742F6261627950726F66696C652F696E6465782F3134223E4C69613C2F613E2070726F66696C652E, '14', '4', 'visit', '0', '2015-05-27 02:55:14', null, '1970-01-01 00:00:00');
INSERT INTO `fb_notification` VALUES ('11', null, '27', 0x3C6120687265663D222F6669727374706F75742F7573657250726F66696C652F696E6465782F3237223E41686D65642048616E793C2F613E2068617320616464656420766973697420283C6120687265663D222F6669727374706F75742F6261627950726F66696C652F7669736974732F3134223E766973697420313C2F613E2920746F203C6120687265663D222F6669727374706F75742F6261627950726F66696C652F696E6465782F3134223E4C69613C2F613E2070726F66696C652E, '14', '5', 'visit', '0', '2015-05-27 02:56:02', null, '2015-05-27 08:00:00');

-- ----------------------------
-- Table structure for `fb_pages`
-- ----------------------------
DROP TABLE IF EXISTS `fb_pages`;
CREATE TABLE `fb_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `intro` longtext COLLATE utf8_bin,
  `details` longtext COLLATE utf8_bin,
  `publish` tinyint(4) DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_pages
-- ----------------------------

-- ----------------------------
-- Table structure for `fb_post`
-- ----------------------------
DROP TABLE IF EXISTS `fb_post`;
CREATE TABLE `fb_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `content` longtext COLLATE utf8_bin,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image_date_taken` datetime DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `video` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `baby_id` (`baby_id`),
  KEY `post_ibfk_3` (`group_id`),
  CONSTRAINT `fb_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_post_ibfk_2` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_post_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `fb_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_post
-- ----------------------------
INSERT INTO `fb_post` VALUES ('40', '27', '14', null, 0x4C69612070696374757265, 'img-1422826993-croppedImg_1415184832.jpeg', '0000-00-00 00:00:00', null, '2015-02-02 08:43:13', '2015-02-02 09:43:13', null, null, '0');
INSERT INTO `fb_post` VALUES ('44', '27', '14', null, 0x4C69612773205069637475726573, '', '0000-00-00 00:00:00', null, '2015-02-02 08:54:11', '2015-02-02 09:54:11', null, null, '0');
INSERT INTO `fb_post` VALUES ('45', '27', '14', null, 0x6E6F7468696E6720746F20736179, '', '0000-00-00 00:00:00', null, '2015-02-02 09:09:05', '2015-02-02 10:09:05', null, null, '21');
INSERT INTO `fb_post` VALUES ('46', '27', null, 'album1', 0x64657363, null, null, null, '2015-03-22 05:12:38', '2015-03-22 07:12:38', null, null, '32');
INSERT INTO `fb_post` VALUES ('47', '27', '14', null, 0x617364617364, '', '0000-00-00 00:00:00', null, '2015-04-24 23:52:52', '2015-04-25 01:52:52', null, null, '0');
INSERT INTO `fb_post` VALUES ('48', '27', '14', null, 0x6E6577, 'img-1429887707-1425390166-IMG_20150126_200128.png', '0000-00-00 00:00:00', null, '2015-04-25 00:01:47', '2015-04-25 02:01:47', null, null, '0');
INSERT INTO `fb_post` VALUES ('49', '27', '14', null, 0x617364, '', '0000-00-00 00:00:00', null, '2015-04-25 00:08:24', '2015-04-25 02:08:24', null, null, '0');
INSERT INTO `fb_post` VALUES ('50', '27', null, null, 0x746573742067726F757020706F73742066726F6D20696E646578, '', '0000-00-00 00:00:00', null, '2015-04-25 08:55:57', '2015-04-25 10:55:57', null, '3', '0');

-- ----------------------------
-- Table structure for `fb_post_media`
-- ----------------------------
DROP TABLE IF EXISTS `fb_post_media`;
CREATE TABLE `fb_post_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `media` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `fb_post_media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `fb_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_post_media
-- ----------------------------
INSERT INTO `fb_post_media` VALUES ('3', '44', '1422827651-11920.jpeg');
INSERT INTO `fb_post_media` VALUES ('4', '44', '1422827652-58847.jpeg');
INSERT INTO `fb_post_media` VALUES ('5', '45', '1422828546-9814.png');
INSERT INTO `fb_post_media` VALUES ('6', '45', '1422828547-82449.jpeg');
INSERT INTO `fb_post_media` VALUES ('7', '45', '1422828547-73089.png');
INSERT INTO `fb_post_media` VALUES ('8', '46', 'img1.jpg');
INSERT INTO `fb_post_media` VALUES ('9', '46', 'img2.jpeg');
INSERT INTO `fb_post_media` VALUES ('10', '46', 'img5.png');
INSERT INTO `fb_post_media` VALUES ('11', '47', '1429887172-23742.png');
INSERT INTO `fb_post_media` VALUES ('12', '47', '1429887173-19375.jpeg');
INSERT INTO `fb_post_media` VALUES ('13', '49', '1429888104-55749.png');
INSERT INTO `fb_post_media` VALUES ('14', '49', '1429888104-20620.png');
INSERT INTO `fb_post_media` VALUES ('15', '49', '1429888104-40020.png');
INSERT INTO `fb_post_media` VALUES ('16', '49', '1429888104-34310.jpeg');

-- ----------------------------
-- Table structure for `fb_product`
-- ----------------------------
DROP TABLE IF EXISTS `fb_product`;
CREATE TABLE `fb_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sell_donate` tinyint(4) DEFAULT '0' COMMENT '0=sell',
  `price` decimal(10,2) DEFAULT '0.00',
  `date_of_product` date DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `use_msg_only` tinyint(4) DEFAULT '0' COMMENT '0=no',
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comunicator` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `comunicator2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `approved` tinyint(4) DEFAULT '1' COMMENT '1=yes',
  `sold` tinyint(4) DEFAULT '0' COMMENT '0=no',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_sold` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `item_ibfk_2` (`category_id`),
  CONSTRAINT `fb_product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fb_product_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `fb_product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_product
-- ----------------------------
INSERT INTO `fb_product` VALUES ('1', 'Product test', '27', '1', '0', '500.00', '2015-03-28', 'Cairo', 'Ahmed Hany', 'ad!@jdj.com', '0', '4446', null, null, 0x54657374, '1', '0', '2015-03-29 00:49:27', '2015-03-28 22:49:27', 'product-test', null);

-- ----------------------------
-- Table structure for `fb_product_category`
-- ----------------------------
DROP TABLE IF EXISTS `fb_product_category`;
CREATE TABLE `fb_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_product_category
-- ----------------------------
INSERT INTO `fb_product_category` VALUES ('1', 'Category 1');
INSERT INTO `fb_product_category` VALUES ('2', 'Category 2');

-- ----------------------------
-- Table structure for `fb_product_image`
-- ----------------------------
DROP TABLE IF EXISTS `fb_product_image`;
CREATE TABLE `fb_product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `main_image` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fb_product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `fb_product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_product_image
-- ----------------------------
INSERT INTO `fb_product_image` VALUES ('1', '1', '1427550567-Screenshot 2015-03-26 20.54.58.png', '1');
INSERT INTO `fb_product_image` VALUES ('2', '1', '1427550568-Screenshot 2015-03-26 21.00.30.png', '0');
INSERT INTO `fb_product_image` VALUES ('3', '1', '1427550568-Screenshot 2015-03-26 21.02.21.png', '0');

-- ----------------------------
-- Table structure for `fb_settings`
-- ----------------------------
DROP TABLE IF EXISTS `fb_settings`;
CREATE TABLE `fb_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `config_value` text COLLATE utf8_bin,
  `autoload` tinyint(4) DEFAULT NULL,
  `config_key` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `product_expiration_period` decimal(10,0) DEFAULT NULL,
  `android_app_link` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `ios_app_link` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `default_profile_pic` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `default_banner_image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_settings
-- ----------------------------
INSERT INTO `fb_settings` VALUES ('1', 'test@test.com', '8368-logo1.png', '', '0', '', '1', 'http://play.google.com', 'http://ios.apple.com', '3477-download.jpg', '6352-noBanner.jpg');

-- ----------------------------
-- Table structure for `fb_sun_sign`
-- ----------------------------
DROP TABLE IF EXISTS `fb_sun_sign`;
CREATE TABLE `fb_sun_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_sun_sign
-- ----------------------------
INSERT INTO `fb_sun_sign` VALUES ('1', 'Capricorn', '1.png');
INSERT INTO `fb_sun_sign` VALUES ('2', 'Aquarius', '2.png');
INSERT INTO `fb_sun_sign` VALUES ('3', 'Pisces', '3.png');
INSERT INTO `fb_sun_sign` VALUES ('4', 'Aries', '4.png');
INSERT INTO `fb_sun_sign` VALUES ('5', 'Taurus', '5.png');
INSERT INTO `fb_sun_sign` VALUES ('6', 'Gemini', '6.png');
INSERT INTO `fb_sun_sign` VALUES ('7', 'Cancer', '7.png');
INSERT INTO `fb_sun_sign` VALUES ('8', 'Leo', '8.png');
INSERT INTO `fb_sun_sign` VALUES ('9', 'Virgo', '9.png');
INSERT INTO `fb_sun_sign` VALUES ('10', 'Libra', '10.png');
INSERT INTO `fb_sun_sign` VALUES ('11', 'Scorpio', '11.png');
INSERT INTO `fb_sun_sign` VALUES ('12', 'Sagittarius', '12.png');

-- ----------------------------
-- Table structure for `fb_user`
-- ----------------------------
DROP TABLE IF EXISTS `fb_user`;
CREATE TABLE `fb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `date_of_birth` date DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `groups_id` int(11) DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT '1',
  `pass_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `social_provider` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `social_identifier` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `can_reset` tinyint(4) DEFAULT '0',
  `chat_status` tinyint(4) DEFAULT '0' COMMENT '0=available, 1=busy, 2=offline',
  `fb_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `tw_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dummy` tinyint(4) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `connection_id` (`connection_id`),
  CONSTRAINT `fb_user_ibfk_2` FOREIGN KEY (`connection_id`) REFERENCES `fb_connection` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_user
-- ----------------------------
INSERT INTO `fb_user` VALUES ('1', 'ahmedhany', '$2y$10$5byxa3yPe9TVv9Wm5LeY6OxiJuLf5qFpUkd33.WIXZ0QMI5OdLt/i', 'admin', null, null, '/firstpout/media/croppic/croppedimg/croppedImg_13539.jpeg', null, '', null, '', '', '', '1', null, '6', '2016-09-16 13:23:16', '2014-12-22 10:08:06', '1', null, null, null, null, null, '0', '2', null, null, null, '0', null);
INSERT INTO `fb_user` VALUES ('27', 'ahmed.hany.fawzy@hotmail.com', '$2y$10$6o/g/uZXDNGR91C1noEdBuUdOV52pH05FuqQsBM1GIYNgQSPXhIMW', 'Ahmed Hany', '1', '/firstpout/media/croppic/croppedimg/croppedImg_1422823948.jpeg', null, null, '', '1990-11-07', 'Manchester', '135 Bolton st.', '12345', '223', '01278616269', '1', '2016-09-15 01:12:12', '2015-03-01 08:52:06', '1', '1422823899412', 'Ahmed', 'Hany', null, null, '0', '0', '10204175728890575', '', '455', '1', null);
INSERT INTO `fb_user` VALUES ('28', 'ahmed_zaki1@cis.asu.edu.eg', '$2y$10$3SzB5/uizhi2spxYPNHA4OWvWUuZxnG6lZQ3SR.J4eVCMGOx3bUxy', 'Ahmed Hany', '1', 'http://graph.facebook.com/10204175728890575/picture?type=large', null, null, null, '1990-11-07', null, null, null, null, null, '1', '2015-07-12 08:32:21', '2015-05-02 03:29:05', '1', null, 'Ahmed', 'Hany', 'facebook', '10204175728890575', '0', '0', '10204175728890575', null, null, '0', null);
INSERT INTO `fb_user` VALUES ('31', 'mohab_ali@gmail.com', null, 'Mohab Ali', null, '/firstpout/media/croppic/croppedimg/croppedImg_1424448714.jpeg', null, null, 0x4E6F7468696E67, '0000-00-00', 'Alexandria', '139 mandara st.', '', null, '', '2', '2015-02-21 02:12:37', '2015-02-21 04:12:37', '1', null, '', '', null, null, '0', '0', null, null, null, '0', null);
INSERT INTO `fb_user` VALUES ('33', null, '$2y$10$2X8Iw1IFyPnmAd5Qjxyazu40Y8J2YS7TBmps4F3MLaN95NGFdptEm', 'gedo', '1', '/firstpout/media/croppic/croppedimg/croppedImg_1429897571.png', null, '6', null, null, 'asd', 'zxc', null, '1', null, null, '2015-04-25 02:46:16', '2015-04-25 04:46:16', '1', null, null, null, null, null, '0', '0', null, null, null, '1', '27');
INSERT INTO `fb_user` VALUES ('34', '', null, 'hadeer naser', null, 'http://localhost/firstpout/img/doctor.png', null, null, '', '0000-00-00', '', '', '', null, '', '2', '2015-04-25 21:42:41', '2015-04-25 23:42:41', '1', null, '', '', null, null, '0', '0', null, null, null, '0', null);
INSERT INTO `fb_user` VALUES ('35', '', '$2y$10$Brv7.1FQHOfZc8g.juOULer4aH9iQKRpBatZIrtIMILxUsYSXeYBO', 'hos', null, 'http://localhost/firstpout/img/hospital.png', null, null, 0x6E6F7468696E67, '0000-00-00', 'ci', 'add', '', null, '01223', '3', '2015-05-11 22:01:07', '2015-05-12 00:01:07', '1', null, '', '', null, null, '0', '0', null, null, null, '0', null);
INSERT INTO `fb_user` VALUES ('36', 'ahany4444@gmail.com', '$2y$10$WKo/QJP28BvMoYLsGRCdqe9wlmCazaps2lUjZQ9pfb8YgSZV041LO', 'ahmed hany', '1', 'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=180', null, null, null, null, null, null, null, null, null, '1', '2015-05-15 01:17:55', '2015-05-15 03:16:50', '1', null, 'ahmed', 'hany', 'google', '114457543103466558541', '0', '0', null, '114457543103466558541', null, '0', null);
INSERT INTO `fb_user` VALUES ('37', 'admin@admin.com', '$2y$10$ejkM1sQaR7TgGecZUqkMJOBDhDaWxxD4O0UznfHmAcKPxpGoGNAq.', 'SuperAdmin', '1', '', null, '1', '', '0000-00-00', '', '', '', null, '', '6', '2016-09-16 13:19:36', '2016-09-16 15:19:36', '1', null, '', '', null, null, '0', '0', null, null, null, '0', null);

-- ----------------------------
-- Table structure for `fb_user_friend`
-- ----------------------------
DROP TABLE IF EXISTS `fb_user_friend`;
CREATE TABLE `fb_user_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `approved` tinyint(4) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `connection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `friend_id` (`friend_id`),
  KEY `connection_id` (`connection_id`),
  CONSTRAINT `fb_user_friend_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_user_friend_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_user_friend_ibfk_3` FOREIGN KEY (`connection_id`) REFERENCES `fb_connection` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_user_friend
-- ----------------------------
INSERT INTO `fb_user_friend` VALUES ('2', '27', '28', '1', '2015-04-11 23:39:40', null);

-- ----------------------------
-- Table structure for `fb_user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `fb_user_groups`;
CREATE TABLE `fb_user_groups` (
  `id` int(11) NOT NULL,
  `group_title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_user_groups
-- ----------------------------
INSERT INTO `fb_user_groups` VALUES ('1', 'Normal User');
INSERT INTO `fb_user_groups` VALUES ('6', 'Admin');
INSERT INTO `fb_user_groups` VALUES ('2', 'Doctor');
INSERT INTO `fb_user_groups` VALUES ('3', 'Hospital');

-- ----------------------------
-- Table structure for `fb_user_relationship`
-- ----------------------------
DROP TABLE IF EXISTS `fb_user_relationship`;
CREATE TABLE `fb_user_relationship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `me_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `connection_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `connection_id` (`connection_id`),
  KEY `me_id` (`me_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fb_user_relationship_ibfk_1` FOREIGN KEY (`connection_id`) REFERENCES `fb_connection` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_user_relationship_ibfk_2` FOREIGN KEY (`me_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_user_relationship_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_user_relationship
-- ----------------------------

-- ----------------------------
-- Table structure for `fb_vaccine`
-- ----------------------------
DROP TABLE IF EXISTS `fb_vaccine`;
CREATE TABLE `fb_vaccine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_of_vaccine` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `visit_id` int(11) DEFAULT NULL,
  `desc` longtext COLLATE utf8_bin,
  `next_vaccine_id` int(11) DEFAULT NULL,
  `realized` tinyint(4) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(4) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `next_vaccine_id` (`next_vaccine_id`),
  KEY `visit_id` (`visit_id`),
  KEY `baby_id` (`baby_id`) USING BTREE,
  CONSTRAINT `fb_vaccine_ibfk_2` FOREIGN KEY (`next_vaccine_id`) REFERENCES `fb_vaccine` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_vaccine_ibfk_3` FOREIGN KEY (`visit_id`) REFERENCES `fb_visit` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_vaccine_ibfk_4` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_vaccine_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_vaccine
-- ----------------------------
INSERT INTO `fb_vaccine` VALUES ('1', 'BCG ', 'At Birth\r\n', null, 0x50726F746563747320616761696E737420547562657263756C6F7369730D0A, '2', '0', null, null, '2014-12-15 19:21:24', null, '99');
INSERT INTO `fb_vaccine` VALUES ('2', 'OPV 0', '6 weeks\r\n', null, 0x4F72616C20706F6C696F2076616363696E650D0A, '3', '0', null, null, '2014-12-15 19:22:17', null, '99');
INSERT INTO `fb_vaccine` VALUES ('3', 'Hep-B 1', '6 weeks\r\n', null, 0x41646D696E6973746572206D6F6E6F76616C656E7420486570422076616363696E6520746F20616C6C206E6577626F726E730D0A, '4', '0', null, null, '2014-12-15 19:22:18', null, '99');
INSERT INTO `fb_vaccine` VALUES ('4', 'DTwP 1', '6 weeks\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65730D0A, '5', '0', null, null, '2014-12-15 19:22:19', null, '99');
INSERT INTO `fb_vaccine` VALUES ('5', 'DTaP 1', '6 weeks\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65730D0A, '6', '0', null, null, '2014-12-15 19:22:20', null, '99');
INSERT INTO `fb_vaccine` VALUES ('6', 'IPV 1', '6 weeks\r\n', null, 0x506F6C696F2056616363696E650D0A, '7', '0', null, null, '2014-12-15 19:22:21', null, '99');
INSERT INTO `fb_vaccine` VALUES ('7', 'Hep-B 2', '6 weeks\r\n', null, 0x41646D696E6973746572206D6F6E6F76616C656E7420486570422076616363696E6520746F20616C6C206E6577626F726E730D0A, '8', '0', null, null, '2014-12-15 19:22:24', null, '99');
INSERT INTO `fb_vaccine` VALUES ('8', 'Hib 1', '6 weeks\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '9', '0', null, null, '2014-12-15 19:22:24', null, '99');
INSERT INTO `fb_vaccine` VALUES ('9', 'Rotavirus 1', '6 weeks\r\n', null, 0x526F7461766972757320697320746865206D6F737420636F6D6D6F6E206361757365206F66207365766572652067617374726F656E7465726974697320696E20696E66616E747320616E6420796F756E67206368696C6472656E2C2063617573696E672061726F756E642068616C66206F6620616C6C20686F73706974616C69736564206361736573206F662067617374726F656E7465726974697320696E206368696C6472656E206C657373207468616E2035207965617273206F66206167652E204368696C6472656E2063616E20626520696E6665637465642077697468206120726F74617669727573207365766572616C2074696D657320647572696E67207468656972206C697665732E0D0A, '10', '0', null, null, '2014-12-15 19:22:25', null, '99');
INSERT INTO `fb_vaccine` VALUES ('10', 'PCV 1', '6 weeks\r\n', null, 0x546869732076616363696E652070726F746563747320616761696E737420706E65756D6F636F6363616C202870726F6E6F756E636564206E65772D6D27434F434B4C2920696E66656374696F6E732C207768696368206D6F73746C7920737472696B65206368696C6472656E20756E64657220616765203520616E642063616E206C65616420746F20736F6D65206F662074686520776F727374206368696C64686F6F642064697365617365732E204974206973207265636F6D6D656E64656420666F7220616C6C206368696C6472656E20796F756E676572207468616E2035207965617273206F6C642C20616C6C206164756C7473203635207965617273206F72206F6C6465722C20616E642070656F706C652036207965617273206F72206F6C6465722077697468206365727461696E207269736B20666163746F72732E0D0A, '11', '0', null, null, '2014-12-15 19:22:25', null, '99');
INSERT INTO `fb_vaccine` VALUES ('11', 'DTwp 2', '10 weeks\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65730D0A, '12', '0', null, null, '2014-12-15 19:22:26', null, '99');
INSERT INTO `fb_vaccine` VALUES ('12', 'DTaP2', '10 weeks\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65732E4D6F737420696E66616E747320616E64206368696C6472656E20796F756E676572207468616E20736576656E207965617273206F66206167652073686F756C642072656365697665204454615020626567696E6E696E672061742074776F206D6F6E746873206F66206167652E0D0A, '13', '0', null, null, '2014-12-15 19:22:27', null, '99');
INSERT INTO `fb_vaccine` VALUES ('13', 'IPV 2', '10 weeks\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '14', '0', null, null, '2014-12-15 19:22:27', null, '99');
INSERT INTO `fb_vaccine` VALUES ('14', 'Hiib 2', '10 weeks\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '15', '0', null, null, '2014-12-15 19:22:28', null, '99');
INSERT INTO `fb_vaccine` VALUES ('15', 'Rotavirus 2', '10 weeks\r\n', null, 0x526F7461766972757320697320746865206D6F737420636F6D6D6F6E206361757365206F66207365766572652067617374726F656E7465726974697320696E20696E66616E747320616E6420796F756E67206368696C6472656E2C2063617573696E672061726F756E642068616C66206F6620616C6C20686F73706974616C69736564206361736573206F662067617374726F656E7465726974697320696E206368696C6472656E206C657373207468616E2035207965617273206F66206167652E204368696C6472656E2063616E20626520696E6665637465642077697468206120726F74617669727573207365766572616C2074696D657320647572696E67207468656972206C697665732E0D0A, '16', '0', null, null, '2014-12-15 19:22:28', null, '99');
INSERT INTO `fb_vaccine` VALUES ('16', 'PCV 2', '10 weeks\r\n', null, 0x546869732076616363696E652070726F746563747320616761696E737420706E65756D6F636F6363616C202870726F6E6F756E636564206E65772D6D27434F434B4C2920696E66656374696F6E732C207768696368206D6F73746C7920737472696B65206368696C6472656E20756E64657220616765203520616E642063616E206C65616420746F20736F6D65206F662074686520776F727374206368696C64686F6F642064697365617365732E204974206973207265636F6D6D656E64656420666F7220616C6C206368696C6472656E20796F756E676572207468616E2035207965617273206F6C642C20616C6C206164756C7473203635207965617273206F72206F6C6465722C20616E642070656F706C652036207965617273206F72206F6C6465722077697468206365727461696E207269736B20666163746F72732E0D0A, '17', '0', null, null, '2014-12-15 19:22:29', null, '99');
INSERT INTO `fb_vaccine` VALUES ('17', 'DtwP 3', '14 weeks\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65732E4D6F737420696E66616E747320616E64206368696C6472656E20796F756E676572207468616E20736576656E207965617273206F66206167652073686F756C642072656365697665204454615020626567696E6E696E672061742074776F206D6F6E746873206F66206167652E0D0A, '18', '0', null, null, '2014-12-15 19:22:29', null, '99');
INSERT INTO `fb_vaccine` VALUES ('18', 'DtapP3', '14 weeks\r\n', null, 0x4D6F737420696E66616E747320616E64206368696C6472656E20796F756E676572207468616E20736576656E207965617273206F66206167652073686F756C642072656365697665204454615020626567696E6E696E672061742074776F206D6F6E746873206F66206167652E0D0A, '19', '0', null, null, '2014-12-15 19:22:30', null, '99');
INSERT INTO `fb_vaccine` VALUES ('19', 'IPV3', '14 weeks\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '20', '0', null, null, '2014-12-15 19:22:30', null, '99');
INSERT INTO `fb_vaccine` VALUES ('20', 'Hib 3', '14 weeks\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '21', '0', null, null, '2014-12-15 19:22:31', null, '99');
INSERT INTO `fb_vaccine` VALUES ('21', 'Rotavirus 3', '14 weeks\r\n', null, 0x526F7461766972757320697320746865206D6F737420636F6D6D6F6E206361757365206F66207365766572652067617374726F656E7465726974697320696E20696E66616E747320616E6420796F756E67206368696C6472656E2C2063617573696E672061726F756E642068616C66206F6620616C6C20686F73706974616C69736564206361736573206F662067617374726F656E7465726974697320696E206368696C6472656E206C657373207468616E2035207965617273206F66206167652E204368696C6472656E2063616E20626520696E6665637465642077697468206120726F74617669727573207365766572616C2074696D657320647572696E67207468656972206C697665732E0D0A, '22', '0', null, null, '2014-12-15 19:22:32', null, '99');
INSERT INTO `fb_vaccine` VALUES ('22', 'PCV 3', '14 weeks\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '23', '0', null, null, '2014-12-15 19:22:32', null, '99');
INSERT INTO `fb_vaccine` VALUES ('23', 'OPV 1', '6 months\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '24', '0', null, null, '2014-12-15 19:22:33', null, '99');
INSERT INTO `fb_vaccine` VALUES ('24', 'Hep-B 3', '6 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '25', '0', null, null, '2014-12-15 19:22:33', null, '99');
INSERT INTO `fb_vaccine` VALUES ('25', 'OPV 2', '9 months\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '26', '0', null, null, '2014-12-15 19:22:34', null, '99');
INSERT INTO `fb_vaccine` VALUES ('26', 'Measles', '9 months\r\n', null, 0x546865206E657720636F6D62696E6174696F6E204D4D52562076616363696E652070726F746563747320616761696E737420666F757220636F6D6D6F6E206368696C64686F6F6420696C6C6E657373657320696E20612073696E676C652076616363696E652E20546865736520696C6C6E65737365732063616E206C65616420746F20736572696F757320636F6D706C69636174696F6E73207375636820617320656E63657068616C697469732028627261696E20696E666C616D6D6174696F6E292C206D656E696E67697469732028696E66656374696F6E206F6620746865207469737375657320737572726F756E64696E672074686520627261696E292C20636F6E67656E6974616C20727562656C6C612073796E64726F6D65202863616E20636175736520736576657265206D616C666F726D6174696F6E7320696E2062616269657320626F726E20746F206D6F746865727320696E666563746564207769746820727562656C6C6120647572696E6720707265676E616E63792920616E642062616374657269616C20736B696E20696E66656374696F6E73200D0A, '27', '0', null, null, '2014-12-15 19:22:34', null, '99');
INSERT INTO `fb_vaccine` VALUES ('27', 'Hep-A 1', '12 months\r\n', null, 0x4865706174697469732041206973206120766972616C2064697365617365206F6620746865206C69766572207468617420697320636F6E74726163746564207468726F75676820636F6E7461637420776974682C206F72207377616C6C6F77696E67206F662068756D616E20666563616C2077617374652C2067656E6572616C6C79207468726F75676820656174696E67206F72206472696E6B696E6720636F6E74616D696E6174656420666F6F6420616E642F6F722077617465722E0D0A, '28', '0', null, null, '2014-12-15 19:22:35', null, '99');
INSERT INTO `fb_vaccine` VALUES ('28', '*JE 1', '12 months\r\n', null, 0x4A6170616E65736520656E63657068616C6974697320284A45292069732061206D6F73717569746F2D626F726E6520646973656173652064756520746F20612076697275732073696D696C617220746F207468652076697275732074686174206361757365732079656C6C6F772066657665722E0D0A, '29', '0', null, null, '2014-12-15 19:22:36', null, '99');
INSERT INTO `fb_vaccine` VALUES ('29', '**JE 2', '13 months\r\n', null, 0x4A6170616E65736520656E63657068616C6974697320284A45292069732061206D6F73717569746F2D626F726E6520646973656173652064756520746F20612076697275732073696D696C617220746F207468652076697275732074686174206361757365732079656C6C6F772066657665722E0D0A, '30', '0', null, null, '2014-12-15 19:22:36', null, '99');
INSERT INTO `fb_vaccine` VALUES ('30', 'MMR 1', '15 months\r\n', null, 0x546865206E657720636F6D62696E6174696F6E204D4D52562076616363696E652070726F746563747320616761696E737420666F757220636F6D6D6F6E206368696C64686F6F6420696C6C6E657373657320696E20612073696E676C652076616363696E652E20546865736520696C6C6E65737365732063616E206C65616420746F20736572696F757320636F6D706C69636174696F6E73207375636820617320656E63657068616C697469732028627261696E20696E666C616D6D6174696F6E292C206D656E696E67697469732028696E66656374696F6E206F6620746865207469737375657320737572726F756E64696E672074686520627261696E292C20636F6E67656E6974616C20727562656C6C612073796E64726F6D65202863616E20636175736520736576657265206D616C666F726D6174696F6E7320696E2062616269657320626F726E20746F206D6F746865727320696E666563746564207769746820727562656C6C6120647572696E6720707265676E616E63792920616E642062616374657269616C20736B696E20696E66656374696F6E73200D0A, '31', '0', null, null, '2014-12-15 19:22:37', null, '99');
INSERT INTO `fb_vaccine` VALUES ('31', 'Varicella 1', '15 months\r\n', null, 0x54686520626573742077617920746F2070726F7465637420616761696E737420636869636B656E706F782069732062792067657474696E672074686520636869636B656E706F782028616C736F2063616C6C6564207661726963656C6C61292073686F742E20446F63746F7273207265636F6D6D656E64207468617420616C6C206368696C6472656E2077686F2068617665206E657665722068616420636869636B656E706F7820676574207468652073686F742E0D0A, '32', '0', null, null, '2014-12-15 19:22:38', null, '99');
INSERT INTO `fb_vaccine` VALUES ('32', 'PCV booster', '15 months\r\n', null, 0x206973207265636F6D6D656E64656420666F7220616C6C206368696C6472656E20796F756E676572207468616E2035207965617273206F6C642C20616C6C206164756C7473203635207965617273206F72206F6C6465722C20616E642070656F706C652036207965617273206F72206F6C6465722077697468206365727461696E207269736B20666163746F72732E0D0A, '33', '0', null, null, '2014-12-15 19:22:39', null, '99');
INSERT INTO `fb_vaccine` VALUES ('33', 'DTwP B1', '16 months - 18 months\r\n', null, 0x446970687468657269612C20746574616E75732026207065727475737369732076616363696E65730D0A, '34', '0', null, null, '2014-12-15 19:22:40', null, '99');
INSERT INTO `fb_vaccine` VALUES ('34', 'DTaP B1', '16 months - 18 months\r\n', null, 0x4D6F737420696E66616E747320616E64206368696C6472656E20796F756E676572207468616E20736576656E207965617273206F66206167652073686F756C642072656365697665204454615020626567696E6E696E672061742074776F206D6F6E746873206F66206167652E0D0A, '35', '0', null, null, '2014-12-15 19:22:40', null, '99');
INSERT INTO `fb_vaccine` VALUES ('35', 'IPV B1', '16 months - 18 months\r\n', null, 0x506F6C696F2069732063617573656420627920696E74657374696E616C20766972757365732074686174207370726561642066726F6D20706572736F6E20746F20706572736F6E20696E2073746F6F6C20616E642073616C6976612E204D6F73742070656F706C6520696E666563746564207769746820706F6C696F2028617070726F78696D6174656C7920393525292073686F77206E6F2073796D70746F6D732E200D0A, '36', '0', null, null, '2014-12-15 19:22:41', null, '99');
INSERT INTO `fb_vaccine` VALUES ('36', 'Hib B1', '16 months - 18 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '37', '0', null, null, '2014-12-15 19:22:42', null, '99');
INSERT INTO `fb_vaccine` VALUES ('37', 'Hep-A 2', '18 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469730D0A, '38', '0', null, null, '2014-12-15 19:22:42', null, '99');
INSERT INTO `fb_vaccine` VALUES ('38', 'Typhoid 1', '2 years\r\n', null, 0x547970686F6964206665766572206973206120736572696F7573206469736561736520636175736564206279207468652062616374657269756D2063616C6C65642053616C6D6F6E656C6C6120656E746572696361207365726F747970652054797068692028532E205479706869292E0D0A, '39', '0', null, null, '2014-12-15 19:22:43', null, '99');
INSERT INTO `fb_vaccine` VALUES ('39', '***JE B', '2 years\r\n', null, 0x4A6170616E65736520656E63657068616C6974697320284A45292069732061206D6F73717569746F2D626F726E6520646973656173652064756520746F20612076697275732073696D696C617220746F207468652076697275732074686174206361757365732079656C6C6F772066657665722E0D0A, '40', '0', null, null, '2014-12-15 19:22:44', null, '99');
INSERT INTO `fb_vaccine` VALUES ('40', 'DTwP B2/DTaP B2', '4.1/2 years- 5 years\r\n', null, 0x4D6F737420696E66616E747320616E64206368696C6472656E20796F756E676572207468616E20736576656E207965617273206F66206167652073686F756C642072656365697665204454615020626567696E6E696E672061742074776F206D6F6E746873206F66206167652E0D0A, '41', '0', null, null, '2014-12-15 19:22:44', null, '99');
INSERT INTO `fb_vaccine` VALUES ('41', 'OPV 3', '4.1/2 years- 5 years\r\n', null, 0x4173207065722074686520696D6D756E69736174696F6E207363686564756C65206F7076332076616363696E652073686F756C6420626520676976656E2061742039206D6F6E74687320616C6F6E672077697468206D656173656C6573202E204173207765207368696674656420746F2061206E657720706C61636520776520636F6E73756C74656420616E6F74686572207061656465617472696369616E20616E642068652073616964206F6E6C79206D656173656C65732076616363696E6520746F20626520676976656E2061742039206D6F6E7468730D0A, '42', '0', null, null, '2014-12-15 19:22:45', null, '99');
INSERT INTO `fb_vaccine` VALUES ('42', 'MMR 2', '4.1/2 years- 5 years\r\n', null, 0x4D4D522069732061207361666520616E642065666665637469766520636F6D62696E65642076616363696E6520746861742070726F746563747320616761696E737420746872656520736570617261746520696C6C6E6573736573202D206D6561736C65732C206D756D707320616E6420727562656C6C6120284765726D616E206D6561736C657329202D20696E20612073696E676C6520696E6A656374696F6E2E205468652066756C6C20636F75727365206F66204D4D522076616363696E6174696F6E2072657175697265732074776F20646F7365732E0D0A, '43', '0', null, null, '2014-12-15 19:22:46', null, '99');
INSERT INTO `fb_vaccine` VALUES ('43', 'Varicella 2', '4.1/2 years- 5 years\r\n', null, 0x54686520626573742077617920746F2070726F7465637420616761696E737420636869636B656E706F782069732062792067657474696E672074686520636869636B656E706F782028616C736F2063616C6C6564207661726963656C6C61292073686F742E20446F63746F7273207265636F6D6D656E64207468617420616C6C206368696C6472656E2077686F2068617665206E657665722068616420636869636B656E706F7820676574207468652073686F742E0D0A, '44', '0', null, null, '2014-12-15 19:22:47', null, '99');
INSERT INTO `fb_vaccine` VALUES ('44', 'Typhoid 2', '4.1/2 years- 5 years\r\n', null, 0x547970686F6964206665766572206973206120736572696F7573206469736561736520636175736564206279207468652062616374657269756D2063616C6C65642053616C6D6F6E656C6C6120656E746572696361207365726F747970652054797068692028532E205479706869292E0D0A, '45', '0', null, null, '2014-12-15 19:22:47', null, '99');
INSERT INTO `fb_vaccine` VALUES ('45', 'Tdap/Td', '10 years - 12 Years \r\n', null, 0x546461702076616363696E652070726F746563747320616761696E737420746574616E75732C20646970687468657269612C20616E6420706572747573736973202877686F6F70696E6720636F756768292E205465656E7320616E64206164756C74732073686F756C642067657420546461702076616363696E650D0A, '46', '0', null, null, '2014-12-15 19:22:48', null, '99');
INSERT INTO `fb_vaccine` VALUES ('46', 'HPV (only for girls)', '10 years - 12 Years \r\n', null, 0x546F2070726F7465637420616761696E737420436572766963616C2063616E636572206361757365642062792068756D616E20706170696C6C6F6D6176697275732E, null, '0', null, null, '2014-12-15 19:22:49', null, '99');
INSERT INTO `fb_vaccine` VALUES ('47', 'Hepatitis B1 (HepB)', 'Birth\r\n', null, 0x41646D696E6973746572206D6F6E6F76616C656E7420486570422076616363696E6520746F20616C6C206E6577626F726E73206265666F726520686F73706974616C206469736368617267650D0A, '48', '0', null, null, '2014-12-15 19:27:20', null, '1');
INSERT INTO `fb_vaccine` VALUES ('48', 'Hepatitis B1 (HepB)', '1 month - 2 months\r\n', null, 0x41646D696E6973746572206D6F6E6F76616C656E7420486570422076616363696E6520746F20616C6C206E6577626F726E73206265666F726520686F73706974616C206469736368617267650D0A, '49', '0', null, null, '2014-12-15 19:35:50', null, '1');
INSERT INTO `fb_vaccine` VALUES ('49', 'Rotavirus2 (RV) RV1 (2-dose series); RV5 (3-dose series)', '2 months\r\n', null, 0x526F746176697275730D0A, '50', '0', null, null, '2014-12-15 19:35:50', null, '1');
INSERT INTO `fb_vaccine` VALUES ('50', 'Haemophilus influenzae type b5 (Hib)', '2 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469732E20486962206973207472616E736D69747465642066726F6D20706572736F6E20746F20706572736F6E207468726F756768206D756375732064726F706C6574732074686174206172652073707265616420627920636F756768696E67206F7220736E65657A696E670D0A, '51', '0', null, null, '2014-12-15 19:35:51', null, '1');
INSERT INTO `fb_vaccine` VALUES ('51', 'Diphtheria, tetanus, & acellular pertussis3 (DTaP: <7 yrs)', '2 months\r\n', null, 0x446970687468657269612C20746574616E75732C20616E6420706572747573736973206172652074687265652062616374657269616C206469736561736573207468617420617265206F6674656E2076616363696E6174656420616761696E7374207769746820612073696E676C652073686F742E0D0A, '52', '0', null, null, '2014-12-15 19:35:51', null, '1');
INSERT INTO `fb_vaccine` VALUES ('52', 'Pneumococcal conjugate6 (PCV13)', '2 months\r\n', null, 0x506E65756D6F636F6363616C20636F6E6A75676174652076616363696E65202863616C6C6564205043563133206F7220507265766E617220313329206973207265636F6D6D656E64656420746F2070726F7465637420696E66616E747320616E6420746F64646C6572732C20616E6420736F6D65206F6C646572206368696C6472656E20616E64206164756C74732077697468206365727461696E206865616C746820636F6E646974696F6E732C2066726F6D20706E65756D6F636F6363616C20646973656173652E, '53', '0', null, null, '2014-12-15 19:35:51', null, '1');
INSERT INTO `fb_vaccine` VALUES ('53', 'Inactivated poliovirus7 (IPV) (<18 yrs)', '2 months\r\n', null, 0x496E61637469766174656420506F6C696F2056616363696E652028495056292063616E2070726576656E7420706F6C696F0D0A, '54', '0', null, null, '2014-12-15 19:35:52', null, '1');
INSERT INTO `fb_vaccine` VALUES ('54', 'Diphtheria, tetanus, & acellular pertussis3 (DTaP: <7 yrs)', '4 months\r\n', null, 0x446970687468657269612C20746574616E75732C20616E6420706572747573736973206172652074687265652062616374657269616C206469736561736573207468617420617265206F6674656E2076616363696E6174656420616761696E7374207769746820612073696E676C652073686F742E, '55', '0', null, null, '2014-12-15 19:35:53', null, '1');
INSERT INTO `fb_vaccine` VALUES ('55', 'Rotavirus2 (RV) RV1 (2-dose series); RV5 (3-dose series)', '4 months\r\n', null, 0x526F746176697275730D0A, '56', '0', null, null, '2014-12-15 19:35:53', null, '1');
INSERT INTO `fb_vaccine` VALUES ('56', 'Haemophilus influenzae type b5 (Hib)', '4 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469732E20486962206973207472616E736D69747465642066726F6D20706572736F6E20746F20706572736F6E207468726F756768206D756375732064726F706C6574732074686174206172652073707265616420627920636F756768696E67206F7220736E65657A696E67, '57', '0', null, null, '2014-12-15 19:35:54', null, '1');
INSERT INTO `fb_vaccine` VALUES ('57', 'Pneumococcal conjugate6 (PCV13)', '4 months\r\n', null, 0x506E65756D6F636F6363616C20636F6E6A75676174652076616363696E65202863616C6C6564205043563133206F7220507265766E617220313329206973207265636F6D6D656E64656420746F2070726F7465637420696E66616E747320616E6420746F64646C6572732C20616E6420736F6D65206F6C646572206368696C6472656E20616E64206164756C74732077697468206365727461696E206865616C746820636F6E646974696F6E732C2066726F6D20706E65756D6F636F6363616C20646973656173652E, '58', '0', null, null, '2014-12-15 19:35:54', null, '1');
INSERT INTO `fb_vaccine` VALUES ('58', 'Inactivated poliovirus7 (IPV) (<18 yrs)', '4 months\r\n', null, 0x496E61637469766174656420506F6C696F2056616363696E652028495056292063616E2070726576656E7420706F6C696F, '59', '0', null, null, '2014-12-15 19:35:55', null, '1');
INSERT INTO `fb_vaccine` VALUES ('59', 'Rotavirus2 (RV) RV1 (2-dose series); RV5 (3-dose series)', '6 months\r\n', null, 0x526F74617669727573, '60', '0', null, null, '2014-12-15 19:35:55', null, '1');
INSERT INTO `fb_vaccine` VALUES ('60', 'Haemophilus influenzae type b5 (Hib)', '6 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A61652074797065206220284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469732E20486962206973207472616E736D69747465642066726F6D20706572736F6E20746F20706572736F6E207468726F756768206D756375732064726F706C6574732074686174206172652073707265616420627920636F756768696E67206F7220736E65657A696E67, '61', '0', null, null, '2014-12-15 19:35:55', null, '1');
INSERT INTO `fb_vaccine` VALUES ('61', 'Diphtheria, tetanus, & acellular pertussis3 (DTaP: <7 yrs)', '6 months\r\n', null, 0x446970687468657269612C20746574616E75732C20616E6420706572747573736973206172652074687265652062616374657269616C206469736561736573207468617420617265206F6674656E2076616363696E6174656420616761696E7374207769746820612073696E676C652073686F742E0D0A, '62', '0', null, null, '2014-12-15 19:35:56', null, '1');
INSERT INTO `fb_vaccine` VALUES ('62', 'Pneumococcal conjugate6 (PCV13)', '6 months\r\n', null, 0x506E65756D6F636F6363616C20636F6E6A75676174652076616363696E65202863616C6C6564205043563133206F7220507265766E617220313329206973207265636F6D6D656E64656420746F2070726F7465637420696E66616E747320616E6420746F64646C6572732C20616E6420736F6D65206F6C646572206368696C6472656E20616E64206164756C74732077697468206365727461696E206865616C746820636F6E646974696F6E732C2066726F6D20706E65756D6F636F6363616C20646973656173652E0D0A, '63', '0', null, null, '2014-12-15 19:35:56', null, '1');
INSERT INTO `fb_vaccine` VALUES ('63', 'Pneumococcal conjugate6 (PCV13)', '12 months -15 months\r\n', null, 0x506E65756D6F636F6363616C20636F6E6A75676174652076616363696E65202863616C6C6564205043563133206F7220507265766E617220313329206973207265636F6D6D656E64656420746F2070726F7465637420696E66616E747320616E6420746F64646C6572732C20616E6420736F6D65206F6C646572206368696C6472656E20616E64206164756C74732077697468206365727461696E206865616C746820636F6E646974696F6E732C2066726F6D20706E65756D6F636F6363616C20646973656173652E0D0A, '64', '0', null, null, '2014-12-15 19:35:57', null, '1');
INSERT INTO `fb_vaccine` VALUES ('64', 'Haemophilus influenzae type b5 (Hib)', '12 months -15 months\r\n', null, 0x4861656D6F7068696C757320696E666C75656E7A616520747970652062284869622920697320612062616374657269756D20746861742063616E20696E6665637420746865206F75746572206C696E696E67206F662074686520627261696E2063617573696E67206D656E696E67697469732E20486962206973207472616E736D69747465642066726F6D20706572736F6E20746F20706572736F6E207468726F756768206D756375732064726F706C6574732074686174206172652073707265616420627920636F756768696E67206F7220736E65657A696E67, '65', '0', null, null, '2014-12-15 19:35:57', null, '1');
INSERT INTO `fb_vaccine` VALUES ('65', 'Measles, mumps, rubella9 (MMR)', '12 months -15 months\r\n', null, 0x4D6561736C65732C206D756D70732C20616E6420727562656C6C612061726520736572696F75732064697365617365732E204265666F72652076616363696E657320746865792077657265207665727920636F6D6D6F6E2C20657370656369616C6C7920616D6F6E67206368696C6472656E2E0D0A, '66', '0', null, null, '2014-12-15 19:35:58', null, '1');
INSERT INTO `fb_vaccine` VALUES ('66', 'Varicella10 (VAR)', '12 months -15 months\r\n', null, 0x5641524956415820697320616C736F206B6E6F776E206173205661726963656C6C612056697275732056616363696E65204C6976652E2049742069732061206C6976652076697275732076616363696E65207468617420697320676976656E20617320612073686F742E2049740D0A6973206D65616E7420746F2068656C702070726576656E7420636869636B656E706F782E20436869636B656E706F7820697320736F6D6574696D65732063616C6C6564207661726963656C6C61, '67', '0', null, null, '2014-12-15 19:35:58', null, '1');
INSERT INTO `fb_vaccine` VALUES ('67', 'Hepatitis A11 (HepA)', '12 months -23 months\r\n', null, 0x536572696F7573206C6576657220646973656173, '68', '0', null, null, '2014-12-15 19:35:59', null, '1');
INSERT INTO `fb_vaccine` VALUES ('68', 'Diphtheria, tetanus, & acellular pertussis3 (DTaP: <7 yrs)', '15 months -18 months\r\n', null, 0x446970687468657269612C20746574616E75732C20616E6420706572747573736973206172652074687265652062616374657269616C206469736561736573207468617420617265206F6674656E2076616363696E6174656420616761696E7374207769746820612073696E676C652073686F742E, '69', '0', null, null, '2014-12-15 19:35:59', null, '1');
INSERT INTO `fb_vaccine` VALUES ('69', 'Inactivated poliovirus7 (IPV) (<18 yrs)', '6 months-18 months\r\n', null, 0x496E61637469766174656420506F6C696F2056616363696E652028495056292063616E2070726576656E7420706F6C696F, '70', '0', null, null, '2014-12-15 19:36:00', null, '1');
INSERT INTO `fb_vaccine` VALUES ('70', 'Hepatitis B1 (HepB)', '6 months-18 months\r\n', null, 0x41646D696E6973746572206D6F6E6F76616C656E7420486570422076616363696E6520746F20616C6C206E6577626F726E73206265666F726520686F73706974616C20646973636861726765, '71', '0', null, null, '2014-12-15 19:36:00', null, '1');
INSERT INTO `fb_vaccine` VALUES ('71', 'Influenza8 (IIV; LAIV) 2 ', '6 months-18 months\r\n', null, null, '72', '0', null, null, '2014-12-15 19:36:01', null, '1');
INSERT INTO `fb_vaccine` VALUES ('72', 'Diphtheria, tetanus, & acellular pertussis3 (DTaP: <7 yrs)', '4 years-6 years\r\n', null, 0x446970687468657269612C20746574616E75732C20616E6420706572747573736973206172652074687265652062616374657269616C206469736561736573207468617420617265206F6674656E2076616363696E6174656420616761696E7374207769746820612073696E676C652073686F742E, '73', '0', null, null, '2014-12-15 19:36:01', null, '1');
INSERT INTO `fb_vaccine` VALUES ('73', 'Influenza8 (IIV; LAIV) 2 \r\n', '2 years -18 years\r\n', null, 0x54726976616C656E7420696E61637469766174656420696E666C75656E7A612076697275732076616363696E6520285449562920616E64206C69766520617474656E75617465642074726976616C656E7420696E666C75656E7A612076697275732076616363696E6520284C414956292E, '74', '0', null, null, '2014-12-15 19:36:02', null, '1');
INSERT INTO `fb_vaccine` VALUES ('74', 'Inactivated poliovirus7 (IPV) (<18 yrs)', '4 years-6 years\r\n', null, 0x496E61637469766174656420506F6C696F2056616363696E652028495056292063616E2070726576656E7420706F6C696F, '75', '0', null, null, '2014-12-15 19:36:02', null, '1');
INSERT INTO `fb_vaccine` VALUES ('75', 'Measles, mumps, rubella9 (MMR)', '4 years-6 years\r\n', null, 0x4D6561736C65732C206D756D70732C20616E6420727562656C6C612061726520736572696F75732064697365617365732E204265666F72652076616363696E657320746865792077657265207665727920636F6D6D6F6E2C20657370656369616C6C7920616D6F6E67206368696C6472656E2E, '76', '0', null, null, '2014-12-15 19:36:03', null, '1');
INSERT INTO `fb_vaccine` VALUES ('76', 'Varicella10 (VAR)\r\n', '4 years-6 years\r\n', null, 0x5641524956415820697320616C736F206B6E6F776E206173205661726963656C6C612056697275732056616363696E65204C6976652E2049742069732061206C6976652076697275732076616363696E65207468617420697320676976656E20617320612073686F742E2049740D0A6973206D65616E7420746F2068656C702070726576656E7420636869636B656E706F782E20436869636B656E706F7820697320736F6D6574696D65732063616C6C6564207661726963656C6C612E, '77', '0', null, null, '2014-12-15 19:36:03', null, '1');
INSERT INTO `fb_vaccine` VALUES ('77', 'Human papillomavirus1 2 (HPV2: females only; HPV4: males and females)', '11 years -12 years (Tdap)\r\n', null, 0x412051756164726976616C656E742048756D616E20506170696C6C6F6D6176697275732028547970657320362C2031312C2031362C20313829207265636F6D62696E616E742076616363696E652028485056342920776173206C6963656E73656420666F722075736520696E2066656D616C65732062792074686520466F6F6420616E6420447275672041646D696E697374726174696F6E20696E203230303620616E64206120626976616C656E742076616363696E65202854797065732031362026203138292028485056322920696E20323030392E20496E20323030392C20485056342077617320616C736F206C6963656E73656420666F72207468652070726576656E74696F6E206F6620776172747320696E206D616C657320616E642C20696E20323031302C20666F72207468652070726576656E74696F6E206F6620616E616C2063616E6365727320696E20626F7468206D616C657320616E642066656D616C65732E, '78', '0', null, null, '2014-12-15 19:36:05', null, '1');
INSERT INTO `fb_vaccine` VALUES ('78', 'Meningococcal1 3 (Hib-MenCY > 6 weeks; MenACWY-D >9 mos; MenACWY-CRM ≥ 2 mos)', '11 years -12 years (Tdap)\r\n', null, 0x4D656E696E676F636F6363616C20636F6E6A75676174652076616363696E65732E20284D696E696D756D206167653A2036207765656B7320666F72204869622D4D656E4359205B4D656E4869627269785D2C2039206D6F6E74687320666F72204D656E414357592D44205B4D656E61637472615D2C2032206D6F6E74687320666F72204D656E414357592D43524D205B4D656E76656F5D29, '79', '0', null, null, '2014-12-15 19:36:06', null, '1');
INSERT INTO `fb_vaccine` VALUES ('79', 'Tetanus, diphtheria, & acellular pertussis4 (Tdap: >7 yrs)', '11 years -12 years (Tdap)\r\n', null, 0x546574616E757320616E64206469706874686572696120746F786F69647320616E64206163656C6C756C617220706572747573736973202854646170292076616363696E652E20284D696E696D756D206167653A20313020796561727320666F7220426F6F73747269782C20313120796561727320666F722041646163656C29, '80', '0', null, null, '2014-12-15 19:36:06', null, '1');
INSERT INTO `fb_vaccine` VALUES ('80', 'Tetanus, diphtheria, & acellular pertussis4 (Tdap: >7 yrs)', '16 years -18 years Booster\r\n', null, 0x546574616E757320616E64206469706874686572696120746F786F69647320616E64206163656C6C756C617220706572747573736973202854646170292076616363696E652E20284D696E696D756D206167653A20313020796561727320666F7220426F6F73747269782C20313120796561727320666F722041646163656C29, null, '0', null, null, '2014-12-15 19:36:07', null, '1');
INSERT INTO `fb_vaccine` VALUES ('81', 'BCG', 'at birth\r\n', null, 0x547562657263756C6F736973, '82', '0', null, null, '2014-12-15 21:24:04', null, '223');
INSERT INTO `fb_vaccine` VALUES ('82', 'Hep B', '1 months -2 months - 12 months\r\n', null, 0x4865706174697469732042, '83', '0', null, null, '2014-12-15 21:24:39', null, '223');
INSERT INTO `fb_vaccine` VALUES ('83', 'DTaP/IPV/Hib (Pediacel)', '2 months\r\n', null, 0x446970687468657269612C20746574616E75732C20706572747573736973202877686F6F70696E6720636F756768292C20706F6C696F20616E64204861656D6F7068696C757320696E666C75656E7A616520747970652062202848696229, '84', '0', null, null, '2014-12-15 21:25:03', null, '223');
INSERT INTO `fb_vaccine` VALUES ('84', 'PCV (Prevenar 13)', '2 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '85', '0', null, null, '2014-12-15 21:25:53', null, '223');
INSERT INTO `fb_vaccine` VALUES ('85', 'Rotavirus (Rotarix)', '2 months\r\n', null, 0x526F74617669727573, '86', '0', null, null, '2014-12-15 21:25:54', null, '223');
INSERT INTO `fb_vaccine` VALUES ('86', 'DTaP/IPV/Hib (Pediacel)', '3 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '87', '0', null, null, '2014-12-15 21:25:54', null, '223');
INSERT INTO `fb_vaccine` VALUES ('87', 'Men C (NeisVac-C or Menjugate)', '3 months\r\n', null, 0x4D656E696E676F636F6363616C2067726F75702043206469736561736520284D656E4329, '88', '0', null, null, '2014-12-15 21:25:55', null, '223');
INSERT INTO `fb_vaccine` VALUES ('88', 'Rotavirus (Rotarix)', '3 months\r\n', null, 0x526F74617669727573, '89', '0', null, null, '2014-12-15 21:25:56', null, '223');
INSERT INTO `fb_vaccine` VALUES ('89', 'DTaP/IPV/Hib (Pediacel)', '4 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '90', '0', null, null, '2014-12-15 21:25:57', null, '223');
INSERT INTO `fb_vaccine` VALUES ('90', 'PCV (Prevenar 13) ', '4 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '91', '0', null, null, '2014-12-15 21:25:58', null, '223');
INSERT INTO `fb_vaccine` VALUES ('91', 'Inactivated flu vaccine (annual)', '6 months -2 years\r\n', null, 0x496E666C75656E7A6134, '92', '0', null, null, '2014-12-15 21:25:59', null, '223');
INSERT INTO `fb_vaccine` VALUES ('92', 'Hib/MenC (Menitorix)', '12months-13months\r\n', null, 0x4869622F4D656E43, '93', '0', null, null, '2014-12-15 21:26:00', null, '223');
INSERT INTO `fb_vaccine` VALUES ('93', 'PCV (Prevenar 13)', '12months-13months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '94', '0', null, null, '2014-12-15 21:26:01', null, '223');
INSERT INTO `fb_vaccine` VALUES ('94', 'MMR (Priorix or MMR VaxPRO)2', '12months-13months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C6120284765726D616E206D6561736C657329, '95', '0', null, null, '2014-12-15 21:26:07', null, '223');
INSERT INTO `fb_vaccine` VALUES ('95', 'Flu nasal spray (Fluenz) (annual) (if Fluenz unsuitable, use inactivated flu vaccine)', '2 years-3 years\r\n', null, 0x496E666C75656E7A6134202866726F6D2053657074656D62657229, '96', '0', null, null, '2014-12-15 21:26:08', null, '223');
INSERT INTO `fb_vaccine` VALUES ('96', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '2 years -65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '97', '0', null, null, '2014-12-15 21:26:09', null, '223');
INSERT INTO `fb_vaccine` VALUES ('97', 'dTaP/IPV (Repevax) or DTaP/IPV (Infanrix-IPV)2', '3 years 4months\r\n', null, 0x446970687468657269612C20746574616E75732C2070657274757373697320616E6420706F6C696F, '98', '0', null, null, '2014-12-15 21:26:10', null, '223');
INSERT INTO `fb_vaccine` VALUES ('98', 'MMR (Priorix or MMR VaxPRO) (check first dose has been given)2', '3 years 4months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C61, '99', '0', null, null, '2014-12-15 21:26:11', null, '223');
INSERT INTO `fb_vaccine` VALUES ('99', 'HPV (Gardasil)(Only for girls)', '12 years-13 years(only for girls)\r\n', null, 0x436572766963616C2063616E636572206361757365642062792068756D616E20706170696C6C6F6D61766972757320747970657320313620616E642031382028616E642067656E6974616C20776172747320636175736564206279207479706573203620616E6420313129, '100', '0', null, null, '2014-12-15 21:26:13', null, '223');
INSERT INTO `fb_vaccine` VALUES ('100', 'Td/IPV (Revaxis), and check MMR status', '14 years\r\n', null, 0x546574616E75732C206469706874686572696120616E6420706F6C696F, '101', '0', null, null, '2014-12-15 21:26:14', null, '223');
INSERT INTO `fb_vaccine` VALUES ('101', 'MenC (Meningitec, Menjugate or NeisVac-C)2 6', '14 years\r\n', null, 0x4D656E4335, '102', '0', null, null, '2014-12-15 21:26:15', null, '223');
INSERT INTO `fb_vaccine` VALUES ('102', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '103', '0', null, null, '2014-12-15 21:26:16', null, '223');
INSERT INTO `fb_vaccine` VALUES ('103', 'Flu injection (annual)', '65 years\r\n', null, 0x496E666C75656E7A613420, '104', '0', null, null, '2014-12-15 21:26:18', null, '223');
INSERT INTO `fb_vaccine` VALUES ('104', 'Shingles (Zostavax)', '70 years\r\n', null, 0x5368696E676C6573202866726F6D2053657074656D62657229, null, '0', null, null, '2014-12-15 21:26:19', null, '223');
INSERT INTO `fb_vaccine` VALUES ('131', 'BCG', 'at birth\r\n', null, 0x547562657263756C6F736973, '82', '1', '27', '14', '2014-12-15 21:24:04', '2015-02-21 22:11:51', '223');
INSERT INTO `fb_vaccine` VALUES ('132', 'Hep B', '1 months -2 months - 12 months\r\n', null, 0x4865706174697469732042, '83', '1', '27', '14', '2014-12-15 21:24:39', '2015-02-21 22:15:01', '223');
INSERT INTO `fb_vaccine` VALUES ('133', 'DTaP/IPV/Hib (Pediacel)', '2 months\r\n', null, 0x446970687468657269612C20746574616E75732C20706572747573736973202877686F6F70696E6720636F756768292C20706F6C696F20616E64204861656D6F7068696C757320696E666C75656E7A616520747970652062202848696229, '84', '1', '27', '14', '2014-12-15 21:25:03', '2015-02-21 22:15:07', '223');
INSERT INTO `fb_vaccine` VALUES ('134', 'PCV (Prevenar 13)', '2 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '85', '1', '27', '14', '2014-12-15 21:25:53', '2015-02-21 22:15:49', '223');
INSERT INTO `fb_vaccine` VALUES ('135', 'Rotavirus (Rotarix)', '2 months\r\n', null, 0x526F74617669727573, '86', '1', '27', '14', '2014-12-15 21:25:54', '2015-02-21 22:16:19', '223');
INSERT INTO `fb_vaccine` VALUES ('136', 'DTaP/IPV/Hib (Pediacel)', '3 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '87', '1', '27', '14', '2014-12-15 21:25:54', '2015-02-21 22:16:22', '223');
INSERT INTO `fb_vaccine` VALUES ('137', 'Men C (NeisVac-C or Menjugate)', '3 months\r\n', null, 0x4D656E696E676F636F6363616C2067726F75702043206469736561736520284D656E4329, '88', '1', '27', '14', '2014-12-15 21:25:55', '2015-04-04 07:54:42', '223');
INSERT INTO `fb_vaccine` VALUES ('138', 'Rotavirus (Rotarix)', '3 months\r\n', null, 0x526F74617669727573, '89', '1', '27', '14', '2014-12-15 21:25:56', '2015-04-25 23:16:24', '223');
INSERT INTO `fb_vaccine` VALUES ('139', 'DTaP/IPV/Hib (Pediacel)', '4 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '90', '0', '27', '14', '2014-12-15 21:25:57', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('140', 'PCV (Prevenar 13) ', '4 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '91', '0', '27', '14', '2014-12-15 21:25:58', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('141', 'Inactivated flu vaccine (annual)', '6 months -2 years\r\n', null, 0x496E666C75656E7A6134, '92', '0', '27', '14', '2014-12-15 21:25:59', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('142', 'Hib/MenC (Menitorix)', '12months-13months\r\n', null, 0x4869622F4D656E43, '93', '0', '27', '14', '2014-12-15 21:26:00', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('143', 'PCV (Prevenar 13)', '12months-13months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '94', '0', '27', '14', '2014-12-15 21:26:01', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('144', 'MMR (Priorix or MMR VaxPRO)2', '12months-13months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C6120284765726D616E206D6561736C657329, '95', '0', '27', '14', '2014-12-15 21:26:07', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('145', 'Flu nasal spray (Fluenz) (annual) (if Fluenz unsuitable, use inactivated flu vaccine)', '2 years-3 years\r\n', null, 0x496E666C75656E7A6134202866726F6D2053657074656D62657229, '96', '0', '27', '14', '2014-12-15 21:26:08', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('146', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '2 years -65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '97', '0', '27', '14', '2014-12-15 21:26:09', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('147', 'dTaP/IPV (Repevax) or DTaP/IPV (Infanrix-IPV)2', '3 years 4months\r\n', null, 0x446970687468657269612C20746574616E75732C2070657274757373697320616E6420706F6C696F, '98', '0', '27', '14', '2014-12-15 21:26:10', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('148', 'MMR (Priorix or MMR VaxPRO) (check first dose has been given)2', '3 years 4months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C61, '99', '0', '27', '14', '2014-12-15 21:26:11', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('149', 'HPV (Gardasil)(Only for girls)', '12 years-13 years(only for girls)\r\n', null, 0x436572766963616C2063616E636572206361757365642062792068756D616E20706170696C6C6F6D61766972757320747970657320313620616E642031382028616E642067656E6974616C20776172747320636175736564206279207479706573203620616E6420313129, '100', '0', '27', '14', '2014-12-15 21:26:13', '2015-02-02 08:26:04', '223');
INSERT INTO `fb_vaccine` VALUES ('150', 'Td/IPV (Revaxis), and check MMR status', '14 years\r\n', null, 0x546574616E75732C206469706874686572696120616E6420706F6C696F, '101', '0', '27', '14', '2014-12-15 21:26:14', '2015-02-02 08:26:05', '223');
INSERT INTO `fb_vaccine` VALUES ('151', 'MenC (Meningitec, Menjugate or NeisVac-C)2 6', '14 years\r\n', null, 0x4D656E4335, '102', '0', '27', '14', '2014-12-15 21:26:15', '2015-02-02 08:26:05', '223');
INSERT INTO `fb_vaccine` VALUES ('152', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '103', '0', '27', '14', '2014-12-15 21:26:16', '2015-02-02 08:26:05', '223');
INSERT INTO `fb_vaccine` VALUES ('153', 'Flu injection (annual)', '65 years\r\n', null, 0x496E666C75656E7A613420, '104', '0', '27', '14', '2014-12-15 21:26:18', '2015-02-02 08:26:05', '223');
INSERT INTO `fb_vaccine` VALUES ('154', 'Shingles (Zostavax)', '70 years\r\n', null, 0x5368696E676C6573202866726F6D2053657074656D62657229, null, '0', '27', '14', '2014-12-15 21:26:19', '2015-02-02 08:26:05', '223');
INSERT INTO `fb_vaccine` VALUES ('155', 'BCG', 'at birth\r\n', null, 0x547562657263756C6F736973, '82', '0', '27', '15', '2014-12-15 21:24:04', '2015-05-11 22:03:52', '223');
INSERT INTO `fb_vaccine` VALUES ('156', 'Hep B', '1 months -2 months - 12 months\r\n', null, 0x4865706174697469732042, '83', '0', '27', '15', '2014-12-15 21:24:39', '2015-05-11 22:03:52', '223');
INSERT INTO `fb_vaccine` VALUES ('157', 'DTaP/IPV/Hib (Pediacel)', '2 months\r\n', null, 0x446970687468657269612C20746574616E75732C20706572747573736973202877686F6F70696E6720636F756768292C20706F6C696F20616E64204861656D6F7068696C757320696E666C75656E7A616520747970652062202848696229, '84', '0', '27', '15', '2014-12-15 21:25:03', '2015-05-11 22:03:52', '223');
INSERT INTO `fb_vaccine` VALUES ('158', 'PCV (Prevenar 13)', '2 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '85', '0', '27', '15', '2014-12-15 21:25:53', '2015-05-11 22:03:52', '223');
INSERT INTO `fb_vaccine` VALUES ('159', 'Rotavirus (Rotarix)', '2 months\r\n', null, 0x526F74617669727573, '86', '0', '27', '15', '2014-12-15 21:25:54', '2015-05-11 22:03:52', '223');
INSERT INTO `fb_vaccine` VALUES ('160', 'DTaP/IPV/Hib (Pediacel)', '3 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '87', '0', '27', '15', '2014-12-15 21:25:54', '2015-05-11 22:03:53', '223');
INSERT INTO `fb_vaccine` VALUES ('161', 'Men C (NeisVac-C or Menjugate)', '3 months\r\n', null, 0x4D656E696E676F636F6363616C2067726F75702043206469736561736520284D656E4329, '88', '0', '27', '15', '2014-12-15 21:25:55', '2015-05-11 22:03:53', '223');
INSERT INTO `fb_vaccine` VALUES ('162', 'Rotavirus (Rotarix)', '3 months\r\n', null, 0x526F74617669727573, '89', '0', '27', '15', '2014-12-15 21:25:56', '2015-05-11 22:03:53', '223');
INSERT INTO `fb_vaccine` VALUES ('163', 'DTaP/IPV/Hib (Pediacel)', '4 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '90', '0', '27', '15', '2014-12-15 21:25:57', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('164', 'PCV (Prevenar 13) ', '4 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '91', '0', '27', '15', '2014-12-15 21:25:58', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('165', 'Inactivated flu vaccine (annual)', '6 months -2 years\r\n', null, 0x496E666C75656E7A6134, '92', '0', '27', '15', '2014-12-15 21:25:59', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('166', 'Hib/MenC (Menitorix)', '12months-13months\r\n', null, 0x4869622F4D656E43, '93', '0', '27', '15', '2014-12-15 21:26:00', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('167', 'PCV (Prevenar 13)', '12months-13months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '94', '0', '27', '15', '2014-12-15 21:26:01', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('168', 'MMR (Priorix or MMR VaxPRO)2', '12months-13months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C6120284765726D616E206D6561736C657329, '95', '0', '27', '15', '2014-12-15 21:26:07', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('169', 'Flu nasal spray (Fluenz) (annual) (if Fluenz unsuitable, use inactivated flu vaccine)', '2 years-3 years\r\n', null, 0x496E666C75656E7A6134202866726F6D2053657074656D62657229, '96', '0', '27', '15', '2014-12-15 21:26:08', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('170', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '2 years -65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '97', '0', '27', '15', '2014-12-15 21:26:09', '2015-05-11 22:03:54', '223');
INSERT INTO `fb_vaccine` VALUES ('171', 'dTaP/IPV (Repevax) or DTaP/IPV (Infanrix-IPV)2', '3 years 4months\r\n', null, 0x446970687468657269612C20746574616E75732C2070657274757373697320616E6420706F6C696F, '98', '0', '27', '15', '2014-12-15 21:26:10', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('172', 'MMR (Priorix or MMR VaxPRO) (check first dose has been given)2', '3 years 4months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C61, '99', '0', '27', '15', '2014-12-15 21:26:11', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('173', 'HPV (Gardasil)(Only for girls)', '12 years-13 years(only for girls)\r\n', null, 0x436572766963616C2063616E636572206361757365642062792068756D616E20706170696C6C6F6D61766972757320747970657320313620616E642031382028616E642067656E6974616C20776172747320636175736564206279207479706573203620616E6420313129, '100', '0', '27', '15', '2014-12-15 21:26:13', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('174', 'Td/IPV (Revaxis), and check MMR status', '14 years\r\n', null, 0x546574616E75732C206469706874686572696120616E6420706F6C696F, '101', '0', '27', '15', '2014-12-15 21:26:14', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('175', 'MenC (Meningitec, Menjugate or NeisVac-C)2 6', '14 years\r\n', null, 0x4D656E4335, '102', '0', '27', '15', '2014-12-15 21:26:15', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('176', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '103', '0', '27', '15', '2014-12-15 21:26:16', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('177', 'Flu injection (annual)', '65 years\r\n', null, 0x496E666C75656E7A613420, '104', '0', '27', '15', '2014-12-15 21:26:18', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('178', 'Shingles (Zostavax)', '70 years\r\n', null, 0x5368696E676C6573202866726F6D2053657074656D62657229, null, '0', '27', '15', '2014-12-15 21:26:19', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('179', 'BCG', 'at birth\r\n', null, 0x547562657263756C6F736973, '82', '1', '27', '15', '2014-12-15 21:24:04', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('180', 'Hep B', '1 months -2 months - 12 months\r\n', null, 0x4865706174697469732042, '83', '1', '27', '15', '2014-12-15 21:24:39', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('181', 'DTaP/IPV/Hib (Pediacel)', '2 months\r\n', null, 0x446970687468657269612C20746574616E75732C20706572747573736973202877686F6F70696E6720636F756768292C20706F6C696F20616E64204861656D6F7068696C757320696E666C75656E7A616520747970652062202848696229, '84', '1', '27', '15', '2014-12-15 21:25:03', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('182', 'PCV (Prevenar 13)', '2 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '85', '1', '27', '15', '2014-12-15 21:25:53', '2015-05-11 22:03:56', '223');
INSERT INTO `fb_vaccine` VALUES ('183', 'Rotavirus (Rotarix)', '2 months\r\n', null, 0x526F74617669727573, '86', '1', '27', '15', '2014-12-15 21:25:54', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('184', 'DTaP/IPV/Hib (Pediacel)', '3 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '87', '1', '27', '15', '2014-12-15 21:25:54', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('185', 'Men C (NeisVac-C or Menjugate)', '3 months\r\n', null, 0x4D656E696E676F636F6363616C2067726F75702043206469736561736520284D656E4329, '88', '1', '27', '15', '2014-12-15 21:25:55', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('186', 'Rotavirus (Rotarix)', '3 months\r\n', null, 0x526F74617669727573, '89', '1', '27', '15', '2014-12-15 21:25:56', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('187', 'DTaP/IPV/Hib (Pediacel)', '4 months\r\n', null, 0x446970687468657269612C20746574616E75732C207065727475737369732C20706F6C696F20616E6420486962, '90', '0', '27', '15', '2014-12-15 21:25:57', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('188', 'PCV (Prevenar 13) ', '4 months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '91', '0', '27', '15', '2014-12-15 21:25:58', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('189', 'Inactivated flu vaccine (annual)', '6 months -2 years\r\n', null, 0x496E666C75656E7A6134, '92', '0', '27', '15', '2014-12-15 21:25:59', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('190', 'Hib/MenC (Menitorix)', '12months-13months\r\n', null, 0x4869622F4D656E43, '93', '0', '27', '15', '2014-12-15 21:26:00', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('191', 'PCV (Prevenar 13)', '12months-13months\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '94', '0', '27', '15', '2014-12-15 21:26:01', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('192', 'MMR (Priorix or MMR VaxPRO)2', '12months-13months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C6120284765726D616E206D6561736C657329, '95', '0', '27', '15', '2014-12-15 21:26:07', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('193', 'Flu nasal spray (Fluenz) (annual) (if Fluenz unsuitable, use inactivated flu vaccine)', '2 years-3 years\r\n', null, 0x496E666C75656E7A6134202866726F6D2053657074656D62657229, '96', '0', '27', '15', '2014-12-15 21:26:08', '2015-05-11 22:03:57', '223');
INSERT INTO `fb_vaccine` VALUES ('194', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '2 years -65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '97', '0', '27', '15', '2014-12-15 21:26:09', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('195', 'dTaP/IPV (Repevax) or DTaP/IPV (Infanrix-IPV)2', '3 years 4months\r\n', null, 0x446970687468657269612C20746574616E75732C2070657274757373697320616E6420706F6C696F, '98', '0', '27', '15', '2014-12-15 21:26:10', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('196', 'MMR (Priorix or MMR VaxPRO) (check first dose has been given)2', '3 years 4months\r\n', null, 0x4D6561736C65732C206D756D707320616E6420727562656C6C61, '99', '0', '27', '15', '2014-12-15 21:26:11', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('197', 'HPV (Gardasil)(Only for girls)', '12 years-13 years(only for girls)\r\n', null, 0x436572766963616C2063616E636572206361757365642062792068756D616E20706170696C6C6F6D61766972757320747970657320313620616E642031382028616E642067656E6974616C20776172747320636175736564206279207479706573203620616E6420313129, '100', '0', '27', '15', '2014-12-15 21:26:13', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('198', 'Td/IPV (Revaxis), and check MMR status', '14 years\r\n', null, 0x546574616E75732C206469706874686572696120616E6420706F6C696F, '101', '0', '27', '15', '2014-12-15 21:26:14', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('199', 'MenC (Meningitec, Menjugate or NeisVac-C)2 6', '14 years\r\n', null, 0x4D656E4335, '102', '0', '27', '15', '2014-12-15 21:26:15', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('200', 'PPV Pneumococcal polysaccharide vaccine (Pneumovax II)', '65 years\r\n', null, 0x506E65756D6F636F6363616C2064697365617365, '103', '0', '27', '15', '2014-12-15 21:26:16', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('201', 'Flu injection (annual)', '65 years\r\n', null, 0x496E666C75656E7A613420, '104', '0', '27', '15', '2014-12-15 21:26:18', '2015-05-11 22:03:58', '223');
INSERT INTO `fb_vaccine` VALUES ('202', 'Shingles (Zostavax)', '70 years\r\n', null, 0x5368696E676C6573202866726F6D2053657074656D62657229, null, '0', '27', '15', '2014-12-15 21:26:19', '2015-05-11 22:03:58', '223');

-- ----------------------------
-- Table structure for `fb_visit`
-- ----------------------------
DROP TABLE IF EXISTS `fb_visit`;
CREATE TABLE `fb_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `baby_id` int(11) DEFAULT NULL,
  `date_of_visit` datetime DEFAULT NULL,
  `diagonise` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `medication` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `desage` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `frequency` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bage_on` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `prescription` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `next_medication` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `note` longtext COLLATE utf8_bin,
  `realized` tinyint(4) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` timestamp NULL DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `baby_id` (`baby_id`),
  CONSTRAINT `fb_visit_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_visit_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `fb_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fb_visit_ibfk_3` FOREIGN KEY (`baby_id`) REFERENCES `fb_baby` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of fb_visit
-- ----------------------------
INSERT INTO `fb_visit` VALUES ('1', 'test', '27', '14', '2015-04-27 08:00:00', '', '', '', '', '', '34', '1429972896-pre-doctor.png', null, 0x74657374, null, '2015-04-26 01:41:36', '2015-04-25 23:41:36', null);
INSERT INTO `fb_visit` VALUES ('2', 'visit 1', '27', '14', '1970-01-01 00:00:00', 'diagonise', 'medication', 'desage', 'frequency', 'bage_on', null, '18854455454-img.jpg', null, 0x6E6F7465, '1', '2015-05-27 02:50:10', '2015-05-27 00:50:10', null);
INSERT INTO `fb_visit` VALUES ('4', 'visit 1', '27', '14', '1970-01-01 00:00:00', 'diagonise', 'medication', 'desage', 'frequency', 'bage_on', '34', '18854455454-img.jpg', null, 0x6E6F7465, '1', '2015-05-27 02:55:13', '2015-05-27 00:55:13', null);
INSERT INTO `fb_visit` VALUES ('5', 'visit 1', '27', '14', '2015-05-27 08:00:00', 'diagonise', 'medication', 'desage', 'frequency', 'bage_on', '34', '18854455454-img.jpg', null, 0x6E6F7465, '1', '2015-05-27 02:56:02', '2015-05-27 00:56:02', null);

-- ----------------------------
-- Table structure for `frei_banned_users`
-- ----------------------------
DROP TABLE IF EXISTS `frei_banned_users`;
CREATE TABLE `frei_banned_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_banned_users
-- ----------------------------

-- ----------------------------
-- Table structure for `frei_chat`
-- ----------------------------
DROP TABLE IF EXISTS `frei_chat`;
CREATE TABLE `frei_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `from_name` varchar(30) NOT NULL,
  `to` int(11) NOT NULL,
  `to_name` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `time` double(15,4) NOT NULL,
  `GMT_time` bigint(20) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0',
  `room_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_chat
-- ----------------------------
INSERT INTO `frei_chat` VALUES ('1', '20', 'Ahmed Hany', '21', 'Armand Haward', 'hello', '2014-10-30 22:35:41', '1', '14147085410.0563', '1414701341005', '0', '-1');
INSERT INTO `frei_chat` VALUES ('2', '21', 'Armand Haward', '20', 'Ahmed Hany', 'Hello bro', '2014-10-30 22:35:56', '1', '14147085560.7335', '1414701356718', '0', '-1');
INSERT INTO `frei_chat` VALUES ('3', '21', 'Armand Haward', '20', 'Ahmed Hany', 'how r u?', '2014-10-30 22:36:34', '1', '14147085940.3807', '1414701394361', '0', '-1');
INSERT INTO `frei_chat` VALUES ('4', '20', 'Ahmed Hany', '21', 'Armand Haward', 'fine thanks and what about you?', '2014-10-30 22:36:46', '1', '14147086060.5229', '1414701406494', '0', '-1');
INSERT INTO `frei_chat` VALUES ('5', '21', 'Armand Haward', '20', 'Ahmed Hany', 'well', '2014-10-30 22:37:01', '1', '14147086210.9092', '1414701421895', '0', '-1');
INSERT INTO `frei_chat` VALUES ('6', '20', 'Ahmed Hany', '21', 'Armand Haward', 'here?', '2014-10-30 22:38:52', '1', '14147087320.4205', '1414701532399', '0', '-1');
INSERT INTO `frei_chat` VALUES ('7', '20', 'Ahmed Hany', '21', 'Armand Haward', 'lol', '2014-10-30 22:39:56', '1', '14147087960.3035', '1414701596285', '0', '-1');
INSERT INTO `frei_chat` VALUES ('8', '20', 'Ahmed Hany', '21', 'Armand Haward', '!', '2014-10-30 22:40:20', '1', '14147088200.7455', '1414701620729', '0', '-1');
INSERT INTO `frei_chat` VALUES ('9', '20', 'Ahmed Hany', '21', 'Armand Haward', '?!', '2014-10-30 22:42:20', '1', '14147089400.9644', '1414701740944', '0', '-1');
INSERT INTO `frei_chat` VALUES ('10', '21', 'Armand Haward', '20', 'Ahmed Hany', 'ok', '2014-10-30 22:53:34', '1', '14147096140.3303', '1414702414312', '0', '-1');
INSERT INTO `frei_chat` VALUES ('11', '20', 'Ahmed Hany', '21', 'Armand Haward', 'ty', '2014-10-30 22:53:53', '1', '14147096330.5941', '1414702433569', '0', '-1');
INSERT INTO `frei_chat` VALUES ('12', '21', 'Armand Haward', '20', 'Ahmed Hany', '<img id=\"smile__20\" src=\"http://localhost/baby/freichat/client/themes/smileys/smile54593.gif\" alt=\"smile\" />', '2014-10-31 01:08:51', '1', '14147177310.6284', '1414710531611', '0', '-1');
INSERT INTO `frei_chat` VALUES ('13', '20', 'Ahmed Hany', '21', 'Armand Haward', 'lo', '2014-10-31 13:45:44', '1', '14147631440.4796', '1414755944458', '0', '-1');
INSERT INTO `frei_chat` VALUES ('14', '21', 'Armand Haward', '20', 'Ahmed Hany', 'aaka', '2014-10-31 14:02:12', '1', '14147641320.2176', '1414756932202', '0', '-1');

-- ----------------------------
-- Table structure for `frei_config`
-- ----------------------------
DROP TABLE IF EXISTS `frei_config`;
CREATE TABLE `frei_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) DEFAULT 'NULL',
  `cat` varchar(20) DEFAULT 'NULL',
  `subcat` varchar(20) DEFAULT 'NULL',
  `val` varchar(500) DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_config
-- ----------------------------
INSERT INTO `frei_config` VALUES ('1', 'PATH', 'NULL', 'NULL', 'freichat/');
INSERT INTO `frei_config` VALUES ('2', 'show_name', 'NULL', 'NULL', 'user');
INSERT INTO `frei_config` VALUES ('3', 'displayname', 'NULL', 'NULL', 'username');
INSERT INTO `frei_config` VALUES ('4', 'chatspeed', 'NULL', 'NULL', '5000');
INSERT INTO `frei_config` VALUES ('5', 'fxval', 'NULL', 'NULL', 'true');
INSERT INTO `frei_config` VALUES ('6', 'draggable', 'NULL', 'NULL', 'disable');
INSERT INTO `frei_config` VALUES ('7', 'conflict', 'NULL', 'NULL', '');
INSERT INTO `frei_config` VALUES ('8', 'msgSendSpeed', 'NULL', 'NULL', '1000');
INSERT INTO `frei_config` VALUES ('9', 'show_avatar', 'NULL', 'NULL', 'block');
INSERT INTO `frei_config` VALUES ('10', 'debug', 'NULL', 'NULL', 'false');
INSERT INTO `frei_config` VALUES ('11', 'freichat_theme', 'NULL', 'NULL', 'basic');
INSERT INTO `frei_config` VALUES ('12', 'lang', 'NULL', 'NULL', 'english');
INSERT INTO `frei_config` VALUES ('13', 'load', 'NULL', 'NULL', 'show');
INSERT INTO `frei_config` VALUES ('14', 'time', 'NULL', 'NULL', '7');
INSERT INTO `frei_config` VALUES ('15', 'JSdebug', 'NULL', 'NULL', 'false');
INSERT INTO `frei_config` VALUES ('16', 'busy_timeOut', 'NULL', 'NULL', '500');
INSERT INTO `frei_config` VALUES ('17', 'offline_timeOut', 'NULL', 'NULL', '1000');
INSERT INTO `frei_config` VALUES ('18', 'cache', 'NULL', 'NULL', 'enabled');
INSERT INTO `frei_config` VALUES ('19', 'GZIP_handler', 'NULL', 'NULL', 'ON');
INSERT INTO `frei_config` VALUES ('20', 'plugins', 'file_sender', 'show', 'true');
INSERT INTO `frei_config` VALUES ('21', 'plugins', 'file_sender', 'file_size', '2000');
INSERT INTO `frei_config` VALUES ('22', 'plugins', 'file_sender', 'expiry', '300');
INSERT INTO `frei_config` VALUES ('23', 'plugins', 'file_sender', 'valid_exts', 'jpeg,jpg,png,gif,zip');
INSERT INTO `frei_config` VALUES ('24', 'plugins', 'send_conv', 'show', 'true');
INSERT INTO `frei_config` VALUES ('25', 'plugins', 'send_conv', 'mailtype', 'smtp');
INSERT INTO `frei_config` VALUES ('26', 'plugins', 'send_conv', 'smtp_server', 'smtp.gmail.com');
INSERT INTO `frei_config` VALUES ('27', 'plugins', 'send_conv', 'smtp_port', '465');
INSERT INTO `frei_config` VALUES ('28', 'plugins', 'send_conv', 'smtp_protocol', 'ssl');
INSERT INTO `frei_config` VALUES ('29', 'plugins', 'send_conv', 'from_address', 'you@domain.com');
INSERT INTO `frei_config` VALUES ('30', 'plugins', 'send_conv', 'from_name', 'FreiChat');
INSERT INTO `frei_config` VALUES ('31', 'playsound', 'NULL', 'NULL', 'true');
INSERT INTO `frei_config` VALUES ('32', 'ACL', 'filesend', 'user', 'allow');
INSERT INTO `frei_config` VALUES ('33', 'ACL', 'filesend', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('34', 'ACL', 'chatroom', 'user', 'noallow');
INSERT INTO `frei_config` VALUES ('35', 'ACL', 'chatroom', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('36', 'ACL', 'mail', 'user', 'noallow');
INSERT INTO `frei_config` VALUES ('37', 'ACL', 'mail', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('38', 'ACL', 'save', 'user', 'noallow');
INSERT INTO `frei_config` VALUES ('39', 'ACL', 'save', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('40', 'ACL', 'smiley', 'user', 'allow');
INSERT INTO `frei_config` VALUES ('41', 'ACL', 'smiley', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('42', 'polling', 'NULL', 'NULL', 'disabled');
INSERT INTO `frei_config` VALUES ('43', 'polling_time', 'NULL', 'NULL', '30');
INSERT INTO `frei_config` VALUES ('44', 'link_profile', 'NULL', 'NULL', 'disabled');
INSERT INTO `frei_config` VALUES ('46', 'sef_link_profile', 'NULL', 'NULL', 'disabled');
INSERT INTO `frei_config` VALUES ('47', 'plugins', 'chatroom', 'location', 'left');
INSERT INTO `frei_config` VALUES ('48', 'plugins', 'chatroom', 'autoclose', 'true');
INSERT INTO `frei_config` VALUES ('49', 'content_height', 'NULL', 'NULL', '200px');
INSERT INTO `frei_config` VALUES ('50', 'chatbox_status', 'NULL', 'NULL', 'false');
INSERT INTO `frei_config` VALUES ('51', 'BOOT', 'NULL', 'NULL', 'yes');
INSERT INTO `frei_config` VALUES ('52', 'exit_for_guests', 'NULL', 'NULL', 'yes');
INSERT INTO `frei_config` VALUES ('53', 'plugins', 'chatroom', 'offset', '50px');
INSERT INTO `frei_config` VALUES ('54', 'plugins', 'chatroom', 'label_offset', '0.8%');
INSERT INTO `frei_config` VALUES ('55', 'addedoptions_visibility', 'NULL', 'NULL', 'HIDDEN');
INSERT INTO `frei_config` VALUES ('56', 'ug_ids', 'NULL', 'NULL', '');
INSERT INTO `frei_config` VALUES ('57', 'ACL', 'chat', 'user', 'allow');
INSERT INTO `frei_config` VALUES ('58', 'ACL', 'chat', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('59', 'plugins', 'chatroom', 'override_positions', 'yes');
INSERT INTO `frei_config` VALUES ('60', 'ACL', 'video', 'user', 'noallow');
INSERT INTO `frei_config` VALUES ('61', 'ACL', 'video', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('62', 'ACL', 'chatroom_crt', 'user', 'noallow');
INSERT INTO `frei_config` VALUES ('63', 'ACL', 'chatroom_crt', 'guest', 'noallow');
INSERT INTO `frei_config` VALUES ('64', 'plugins', 'chatroom', 'chatroom_expiry', '3600');
INSERT INTO `frei_config` VALUES ('65', 'chat_time_shown_always', 'NULL', 'NULL', 'yes');
INSERT INTO `frei_config` VALUES ('66', 'allow_guest_name_change', 'NULL', 'NULL', 'yes');

-- ----------------------------
-- Table structure for `frei_rooms`
-- ----------------------------
DROP TABLE IF EXISTS `frei_rooms`;
CREATE TABLE `frei_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_author` varchar(100) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `room_type` tinyint(4) NOT NULL,
  `room_password` varchar(100) NOT NULL,
  `room_created` int(11) NOT NULL,
  `room_last_active` int(11) NOT NULL,
  `room_order` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_name` (`room_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_rooms
-- ----------------------------
INSERT INTO `frei_rooms` VALUES ('1', 'admin', 'Fun Talk', '0', '', '1373557250', '1373557250', '1');
INSERT INTO `frei_rooms` VALUES ('2', 'admin', 'Crazy chat', '0', '', '1373557260', '1373557260', '5');
INSERT INTO `frei_rooms` VALUES ('3', 'admin', 'Think out loud', '0', '', '1373557872', '1373557872', '2');
INSERT INTO `frei_rooms` VALUES ('4', 'admin', 'Talk to me ', '0', '', '1373558017', '1373558017', '3');
INSERT INTO `frei_rooms` VALUES ('5', 'admin', 'Talk innovative', '0', '', '1373558039', '1373799404', '4');

-- ----------------------------
-- Table structure for `frei_session`
-- ----------------------------
DROP TABLE IF EXISTS `frei_session`;
CREATE TABLE `frei_session` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `time` int(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `permanent_id` int(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_mesg` varchar(100) NOT NULL,
  `guest` tinyint(3) NOT NULL,
  `in_room` int(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permanent_id` (`permanent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_session
-- ----------------------------
INSERT INTO `frei_session` VALUES ('14', 'Ahmed Hany', '1414765046', '20', '1415212317', '0', 'I am available', '0', '-1');
INSERT INTO `frei_session` VALUES ('12', 'Ahmed Hany', '1414762504', '20', '1414930547', '1', 'I am available', '0', '-1');
INSERT INTO `frei_session` VALUES ('13', 'Armand Haward', '1414765137', '21', '1414915981', '0', 'I am available', '0', '-1');

-- ----------------------------
-- Table structure for `frei_smileys`
-- ----------------------------
DROP TABLE IF EXISTS `frei_smileys`;
CREATE TABLE `frei_smileys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(10) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_smileys
-- ----------------------------
INSERT INTO `frei_smileys` VALUES ('1', ':S', 'worried55231.gif');
INSERT INTO `frei_smileys` VALUES ('2', '(wasntme)', 'itwasntme55198.gif');
INSERT INTO `frei_smileys` VALUES ('3', 'x(', 'angry55174.gif');
INSERT INTO `frei_smileys` VALUES ('4', '(doh)', 'doh55146.gif');
INSERT INTO `frei_smileys` VALUES ('5', '|-()', 'yawn55117.gif');
INSERT INTO `frei_smileys` VALUES ('6', ']:)', 'evilgrin55088.gif');
INSERT INTO `frei_smileys` VALUES ('7', '|(', 'dull55062.gif');
INSERT INTO `frei_smileys` VALUES ('8', '|-)', 'sleepy55036.gif');
INSERT INTO `frei_smileys` VALUES ('9', '(blush)', 'blush54981.gif');
INSERT INTO `frei_smileys` VALUES ('10', ':P', 'tongueout54953.gif');
INSERT INTO `frei_smileys` VALUES ('11', '(:|', 'sweat54888.gif');
INSERT INTO `frei_smileys` VALUES ('12', ';(', 'crying54854.gif');
INSERT INTO `frei_smileys` VALUES ('13', ':)', 'smile54593.gif');
INSERT INTO `frei_smileys` VALUES ('14', ':(', 'sad54749.gif');
INSERT INTO `frei_smileys` VALUES ('15', ':D', 'bigsmile54781.gif');
INSERT INTO `frei_smileys` VALUES ('16', '8)', 'cool54801.gif');
INSERT INTO `frei_smileys` VALUES ('17', ':o', 'wink54827.gif');
INSERT INTO `frei_smileys` VALUES ('18', '(mm)', 'mmm55255.gif');
INSERT INTO `frei_smileys` VALUES ('19', ':x', 'lipssealed55304.gif');

-- ----------------------------
-- Table structure for `frei_video_session`
-- ----------------------------
DROP TABLE IF EXISTS `frei_video_session`;
CREATE TABLE `frei_video_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL COMMENT 'unique room id',
  `from_id` int(11) NOT NULL,
  `msg_type` varchar(10) NOT NULL,
  `msg_label` int(2) NOT NULL,
  `msg_data` varchar(3000) NOT NULL,
  `msg_time` decimal(15,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of frei_video_session
-- ----------------------------

-- ----------------------------
-- Table structure for `frei_webrtc`
-- ----------------------------
DROP TABLE IF EXISTS `frei_webrtc`;
CREATE TABLE `frei_webrtc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frm_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `participants_id` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of frei_webrtc
-- ----------------------------
