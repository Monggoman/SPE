-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2022 at 04:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spe_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `act_id` int(10) NOT NULL,
  `fr_fac_id` int(11) NOT NULL,
  `fr_sub` int(4) NOT NULL,
  `act_title` varchar(100) NOT NULL,
  `act_d_date` date NOT NULL,
  `status` enum('No instructions','Instruction ready','','') NOT NULL DEFAULT 'No instructions'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`act_id`, `fr_fac_id`, `fr_sub`, `act_title`, `act_d_date`, `status`) VALUES
(1, 65, 36, 'Math - Shapes', '2022-01-21', 'Instruction ready'),
(3, 65, 39, 'English - Essay', '2022-01-12', 'Instruction ready'),
(5, 65, 36, 'Math - Problem Solving', '2022-01-20', 'Instruction ready'),
(6, 65, 36, 'Math - Geometry', '2022-01-14', 'Instruction ready');

-- --------------------------------------------------------

--
-- Table structure for table `act_history`
--

CREATE TABLE `act_history` (
  `act_his_id` int(10) NOT NULL,
  `fuser_id` int(8) NOT NULL,
  `f_act_id` int(10) NOT NULL,
  `file_name1` text NOT NULL,
  `file_new_name` text NOT NULL,
  `score` int(10) NOT NULL,
  `status1` enum('PENDING','CHECKED','','') NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `act_history`
--

INSERT INTO `act_history` (`act_his_id`, `fuser_id`, `f_act_id`, `file_name1`, `file_new_name`, `score`, `status1`) VALUES
(16, 66, 3, 's4-s6 thesis.docx', '0901221641714845s4-s6 thesis.docx', 100, 'CHECKED'),
(17, 66, 1, 'Thesis-Survey-Q.docx', '1001221641803619Thesis-Survey-Q.docx', 98, 'CHECKED'),
(18, 66, 5, '270355344_874796769854800_2678889349349962890_n.jpg', '1001221641805109270355344_874796769854800_2678889349349962890_n.jpg', 80, 'CHECKED'),
(19, 68, 5, 'Answer.docx', '1001221641839627Answer.docx', 0, 'PENDING'),
(20, 66, 6, 'Answer.docx', '1201221641986985Answer.docx', 0, 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `act_ins`
--

CREATE TABLE `act_ins` (
  `ins_id` int(10) NOT NULL,
  `fact_id` int(10) NOT NULL,
  `ins_title` varchar(2000) NOT NULL,
  `status` enum('Checked','Not Check') NOT NULL DEFAULT 'Not Check'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `act_ins`
--

INSERT INTO `act_ins` (`ins_id`, `fact_id`, `ins_title`, `status`) VALUES
(11, 1, 'Drawing an object using shapes', 'Not Check'),
(12, 3, 'Create an Essay about pandemic', 'Not Check'),
(14, 5, 'Saira went to the stationary shop to buy some pens and pencils.She bought 2 times as many pens as pencils.she spent Rs 52 in all.If a pen costs rs 12 and a pencil,Rs 2,how many pens did Saira buy?\r\nUse Word\r\ngive solution', 'Not Check'),
(15, 6, 'Kailangan makasagot si renzo para sama kapag hindi nakasagot, kung hindi bagsak', 'Not Check');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `ass_id` int(10) NOT NULL,
  `fk_fac_id` int(11) NOT NULL,
  `f_sub` int(4) NOT NULL,
  `ass_name` varchar(100) NOT NULL,
  `ass_due_date` date NOT NULL,
  `Total_q` int(20) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'No question'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`ass_id`, `fk_fac_id`, `f_sub`, `ass_name`, `ass_due_date`, `Total_q`, `status`) VALUES
(23, 65, 36, 'Math - Addition 1', '2022-01-14', 5, 'Question Ready'),
(24, 65, 36, 'Math - Short Quiz 1', '2022-01-14', 10, 'Question Ready'),
(25, 65, 36, 'Math - Long quiz 1', '2022-01-21', 20, 'Question Ready'),
(26, 65, 37, 'Filipino Short Quiz', '2022-01-12', 5, 'Question Ready'),
(27, 65, 39, 'English -Vocabolary', '2022-01-14', 5, 'Question Ready'),
(28, 65, 38, 'Physical Education - Health 1', '2022-01-14', 5, 'Question Ready'),
(29, 65, 40, 'Computer Education - History of Computer', '2022-01-14', 5, 'Question Ready'),
(31, 65, 36, 'Math - Addition 2', '2022-01-14', 5, 'No question'),
(32, 65, 43, 'Sibika Quiz1', '2022-01-14', 5, 'Question Ready');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fac_id` int(5) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `fuser_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fac_id`, `contact_no`, `fuser_id`) VALUES
(1, 908080808, 65),
(5, 0, 80);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `h_id` int(5) NOT NULL,
  `f_user_id` int(8) NOT NULL,
  `f_ass_id` int(10) NOT NULL,
  `score` int(50) NOT NULL,
  `mistakes` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`h_id`, `f_user_id`, `f_ass_id`, `score`, `mistakes`) VALUES
(3, 66, 23, 5, 0),
(8, 66, 24, 8, 2),
(9, 66, 25, 14, 6),
(14, 68, 23, 5, 0),
(15, 68, 24, 10, 0),
(16, 69, 23, 4, 1),
(17, 69, 24, 6, 4),
(18, 66, 26, 4, 1),
(19, 66, 27, 3, 2),
(20, 66, 28, 5, 0),
(21, 66, 29, 2, 3),
(22, 66, 32, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ins_criteria`
--

CREATE TABLE `ins_criteria` (
  `cri_id` int(10) NOT NULL,
  `f_act_ins` int(10) NOT NULL,
  `cri_title` varchar(50) NOT NULL,
  `cri_desc` varchar(100) NOT NULL,
  `cri_value` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ins_criteria`
--

INSERT INTO `ins_criteria` (`cri_id`, `f_act_ins`, `cri_title`, `cri_desc`, `cri_value`) VALUES
(13, 11, 'Creativity', 'it determine how the student apply his idea into activity and use different style to create a unique', 80),
(14, 11, 'Knowledge', 'It determine how much knowledge student has learn about lesson and apply it in activity.', 25),
(15, 11, 'Correctness', 'It determine how the student done the activity inline with instructions.', 25),
(16, 12, 'Creativity', 'it determine how the student apply his idea into activity and use different style to create a unique', 50),
(17, 12, 'Knowledge', 'It determine how much knowledge student has learn about lesson and apply it in activity.', 25),
(18, 12, 'Correctness', 'It determine how the student done the activity inline with instructions.', 25),
(19, 14, 'Technique', 'it determine how the student apply his idea into activity and use different style to create a unique', 50),
(20, 14, 'Knowledge', 'It determine how much knowledge student has learn about lesson and apply it in activity.', 50),
(21, 15, 'Creativity', 'it determine how the student apply his idea into activity and use different style to create a unique', 50),
(22, 15, 'Knowledge', 'It determine how much knowledge student has learn about lesson and apply it in activity.', 60);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(12) NOT NULL,
  `fkuser_id_par` int(8) NOT NULL,
  `Contact_no` bigint(12) NOT NULL,
  `f_stud_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `fkuser_id_par`, `Contact_no`, `f_stud_id`) VALUES
(4, 64, 9087895177, 66),
(5, 70, 0, 0),
(6, 81, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `que_id` int(10) NOT NULL,
  `f_ass_id` int(10) NOT NULL,
  `que_title` varchar(300) NOT NULL,
  `que_no` int(20) NOT NULL,
  `ans_opt` enum('A','B','C','D') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`que_id`, `f_ass_id`, `que_title`, `que_no`, `ans_opt`) VALUES
(117, 23, '1+1=?', 1, 'D'),
(118, 23, '9+7=?', 2, 'D'),
(119, 23, '(17+18)-9=?', 3, 'B'),
(120, 23, 'What is the sum of 30 and 39?', 4, 'A'),
(121, 23, 'Johnny has 5 pesos in his hand then he bought 2 pcs of candies worth 1.5 pesos each how many money has Johnny left?', 5, 'C'),
(122, 24, '140+40 = ?', 1, 'D'),
(123, 24, '100-31 = ?', 2, 'C'),
(124, 24, '5 x 43 = ?', 3, 'C'),
(125, 24, '100 / 5 = ?', 4, 'D'),
(126, 24, '((10+9)-6)x 3 = ?', 5, 'A'),
(127, 24, '((11 x 2) - 6) - ((9 + 9)/3)) = ?', 6, 'B'),
(128, 24, 'Find the sum of 111 + 222 + 333', 7, 'B'),
(129, 24, 'Subtract 457 from 832', 8, 'A'),
(130, 24, '50 times 5 is equal to', 9, 'D'),
(131, 24, '90 ÷ 10', 10, 'B'),
(132, 25, 'Simplify (10+5)-5*2', 1, 'A'),
(133, 25, 'Divide 40 with 20', 2, 'A'),
(134, 25, 'What is the difference of 100 and 30', 3, 'C'),
(135, 25, 'What is total number called from adding two numbers?', 4, 'D'),
(136, 25, 'Simplify (100 x 4)/3', 5, 'C'),
(137, 25, 'What is three fifth of 100?', 6, 'D'),
(138, 25, ' If David’s age is 27 years old in 2011. What was his age in 2003?', 7, 'D'),
(139, 25, 'What is the remainder of 21 divided by 7?', 8, 'C'),
(140, 25, 'What is 7% equal to?', 9, 'B'),
(141, 25, ' I am a number. I have 7 in the ones place. I am less than 80 but greater than 70. What is my number?', 10, 'D'),
(142, 25, 'How many years are there in a decade?', 11, 'B'),
(143, 25, ' How many digits are there in 1000?', 12, 'D'),
(144, 25, 'How much is 90 – 19?', 13, 'A'),
(145, 25, 'What is the smallest three digit number?', 14, 'D'),
(146, 25, 'How much is 190 – 87 + 16?', 15, 'D'),
(147, 25, 'What is 1000 × 1 equal to?', 16, 'B'),
(148, 25, 'How many times 1000 is bigger than 1?', 17, 'C'),
(149, 25, 'How many digits answer we will get when we add 99 and 1?', 18, 'B'),
(150, 25, 'Average of three person’s age is 9 years. Find the sum of there age.', 19, 'D'),
(151, 25, ' How many surfaces are there in a cube?', 20, 'D'),
(152, 26, 'How would you write \"a very nice friend\"?', 1, 'D'),
(153, 26, 'Which one of the following means \"square\":', 2, 'B'),
(154, 26, 'Which one of the following means \"red\":', 3, 'C'),
(155, 26, 'How would you write \"quickly\"?', 4, 'B'),
(156, 26, 'Which one of the following means the number \"six\"?', 5, 'A'),
(157, 27, 'Which of the following words does NOT describe marital status?', 1, 'A'),
(158, 27, 'People have got ten _ on their feet.', 2, 'B'),
(159, 27, 'She’s got long hair and she wears it in a _.', 3, 'D'),
(160, 27, 'Which of the following words is opposite in meaning to the remaining three?', 4, 'B'),
(161, 27, 'Which of the following words is opposite in meaning to the remaining 3?', 5, 'D'),
(162, 28, 'What is a advantage to exercise?', 1, 'D'),
(163, 28, 'Exercise used to improve cardiovascular health?', 2, 'B'),
(164, 28, ' What does BMI measure?', 3, 'C'),
(165, 28, 'Ability to move joint in full range of motion', 4, 'A'),
(166, 28, 'Which is a form of exercise', 5, 'D'),
(167, 29, 'Who invented the Internet?', 1, 'B'),
(168, 29, 'Steve Jobs and Steve Wozniak built their first computer using a wooden box. Their company has grown and is still around today. The name of the company is:', 2, 'C'),
(169, 29, 'This man is known for starting the company Microsoft back in the year 1975. Since then, he has become one of the richest people in the world. What is the name of this person?', 3, 'B'),
(170, 29, 'Which among the following generation computers had expensive operation cost?', 4, 'A'),
(171, 29, 'The number of records contained within a block of data on magnetic tape is defined by the  ', 5, 'C'),
(172, 32, '  Ito ang bilang ng mga pulo sa Pilipinas', 1, 'C'),
(173, 32, 'Ito ay grupo ng mga bulkan kung saan nakapaibabaw ang Pilipinas kaya naman madalas ang lindol dito', 2, 'D'),
(174, 32, 'Makikita rito ang Pilipinas kaya naman madalas itong daanan ng mga bagyo.', 3, 'B'),
(175, 32, 'Ito ay mga biyak sa lupa na kayang magdulot ng lindol sa maraming lugar sa Pilipinas', 4, 'B'),
(176, 32, 'Ito ang bahagi ng Pilipinas na hindi gaanong nakararanas ng lindol dahil hindi ito bahagi ng paggalaw ng Philippine plate', 5, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `q_option`
--

CREATE TABLE `q_option` (
  `option_id` int(10) NOT NULL,
  `qque_id` int(10) NOT NULL,
  `opt_title` varchar(100) NOT NULL,
  `opt_position` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `q_option`
--

INSERT INTO `q_option` (`option_id`, `qque_id`, `opt_title`, `opt_position`) VALUES
(429, 117, '3', 'A'),
(430, 117, '4', 'B'),
(431, 117, 'N', 'C'),
(432, 117, '2', 'D'),
(433, 118, '13', 'A'),
(434, 118, '18', 'B'),
(435, 118, '17', 'C'),
(436, 118, '16', 'D'),
(437, 119, '35', 'A'),
(438, 119, '26', 'B'),
(439, 119, '30', 'C'),
(440, 119, '28', 'D'),
(441, 120, '69', 'A'),
(442, 120, '60', 'B'),
(443, 120, '68', 'C'),
(444, 120, '70', 'D'),
(445, 121, '1.5', 'A'),
(446, 121, '3', 'B'),
(447, 121, '2', 'C'),
(448, 121, '3.5', 'D'),
(449, 122, '120', 'A'),
(450, 122, '150', 'B'),
(451, 122, '170', 'C'),
(452, 122, '180', 'D'),
(453, 123, '79', 'A'),
(454, 123, '89', 'B'),
(455, 123, '69', 'C'),
(456, 123, '59', 'D'),
(457, 124, '210', 'A'),
(458, 124, '205', 'B'),
(459, 124, '215', 'C'),
(460, 124, '220', 'D'),
(461, 125, '60', 'A'),
(462, 125, '70', 'B'),
(463, 125, '80', 'C'),
(464, 125, '50', 'D'),
(465, 126, '39', 'A'),
(466, 126, '50', 'B'),
(467, 126, '25', 'C'),
(468, 126, '40', 'D'),
(469, 127, '11', 'A'),
(470, 127, '10', 'B'),
(471, 127, '12', 'C'),
(472, 127, '13', 'D'),
(473, 128, '700', 'A'),
(474, 128, '666', 'B'),
(475, 128, '500', 'C'),
(476, 128, '777', 'D'),
(477, 129, '375', 'A'),
(478, 129, '424', 'B'),
(479, 129, '394', 'C'),
(480, 129, '209', 'D'),
(481, 130, '2500', 'A'),
(482, 130, '500', 'B'),
(483, 130, '200', 'C'),
(484, 130, 'None of the Above', 'D'),
(485, 131, '8', 'A'),
(486, 131, '9', 'B'),
(487, 131, '7', 'C'),
(488, 131, '6', 'D'),
(489, 132, '5', 'A'),
(490, 132, '10', 'B'),
(491, 132, '20', 'C'),
(492, 132, 'None of the above', 'D'),
(493, 133, '2', 'A'),
(494, 133, '3', 'B'),
(495, 133, '4', 'C'),
(496, 133, '5', 'D'),
(497, 134, '60', 'A'),
(498, 134, '50', 'B'),
(499, 134, '70', 'C'),
(500, 134, '80', 'D'),
(501, 135, 'Product', 'A'),
(502, 135, 'Quotient', 'B'),
(503, 135, 'Difference', 'C'),
(504, 135, 'Sum', 'D'),
(505, 136, '122.222', 'A'),
(506, 136, '144.444', 'B'),
(507, 136, '133.333', 'C'),
(508, 136, '111.111', 'D'),
(509, 137, '3', 'A'),
(510, 137, '5', 'B'),
(511, 137, '20', 'C'),
(512, 137, '60', 'D'),
(513, 138, '17 yrs old', 'A'),
(514, 138, '18 yrs old', 'B'),
(515, 138, '20 yrs old', 'C'),
(516, 138, '19 yrs old', 'D'),
(517, 139, '1', 'A'),
(518, 139, '2', 'B'),
(519, 139, '0', 'C'),
(520, 139, '3', 'D'),
(521, 140, '0.007', 'A'),
(522, 140, '0.07', 'B'),
(523, 140, '0.7', 'C'),
(524, 140, '7', 'D'),
(525, 141, '71', 'A'),
(526, 141, '73', 'B'),
(527, 141, '75', 'C'),
(528, 141, '77', 'D'),
(529, 142, '5', 'A'),
(530, 142, '10', 'B'),
(531, 142, '15', 'C'),
(532, 142, '20', 'D'),
(533, 143, 'One Digit', 'A'),
(534, 143, 'Two Digits', 'B'),
(535, 143, 'Three Digits', 'C'),
(536, 143, 'Four Digits', 'D'),
(537, 144, '71', 'A'),
(538, 144, '109', 'B'),
(539, 144, '89', 'C'),
(540, 144, 'None of the above', 'D'),
(541, 145, '100', 'A'),
(542, 145, '999', 'B'),
(543, 145, '111', 'C'),
(544, 145, '101', 'D'),
(545, 146, '103', 'A'),
(546, 146, '261', 'B'),
(547, 146, '87', 'C'),
(548, 146, '119', 'D'),
(549, 147, '1', 'A'),
(550, 147, '1000', 'B'),
(551, 147, '10000', 'C'),
(552, 147, '100', 'D'),
(553, 148, '1 time', 'A'),
(554, 148, '10 times', 'B'),
(555, 148, '1000 times', 'C'),
(556, 148, '100 times', 'D'),
(557, 149, '1', 'A'),
(558, 149, '3', 'B'),
(559, 149, '100', 'C'),
(560, 149, '98', 'D'),
(561, 150, '18', 'A'),
(562, 150, '21', 'B'),
(563, 150, '24', 'C'),
(564, 150, '27', 'D'),
(565, 151, '3', 'A'),
(566, 151, '4', 'B'),
(567, 151, '7', 'C'),
(568, 151, 'None of the above', 'D'),
(569, 152, 'isang berdeng puno', 'A'),
(570, 152, 'isang matangkad gusali', 'B'),
(571, 152, 'isang napaka-lumang tao', 'C'),
(572, 152, 'isang mabait na kaibigan', 'D'),
(573, 153, 'pabilog', 'A'),
(574, 153, 'parisukat', 'B'),
(575, 153, 'tryanggulo', 'C'),
(576, 153, 'malalim', 'D'),
(577, 154, 'puti', 'A'),
(578, 154, 'asul', 'B'),
(579, 154, 'pula', 'C'),
(580, 154, 'dilaw', 'D'),
(581, 155, 'dahan-dahan', 'A'),
(582, 155, 'mabilis', 'B'),
(583, 155, 'halos', 'C'),
(584, 155, 'sama sama', 'D'),
(585, 156, 'anim', 'A'),
(586, 156, 'lima', 'B'),
(587, 156, 'tatlo', 'C'),
(588, 156, 'isa', 'D'),
(589, 157, 'single', 'A'),
(590, 157, 'lonely', 'B'),
(591, 157, 'divorced', 'C'),
(592, 157, 'married', 'D'),
(593, 158, 'finger', 'A'),
(594, 158, 'toes', 'B'),
(595, 158, 'elbows', 'C'),
(596, 158, 'knees', 'D'),
(597, 159, 'fringe', 'A'),
(598, 159, 'wavy', 'B'),
(599, 159, 'moustache', 'C'),
(600, 159, 'ponytail', 'D'),
(601, 160, 'gorgeous', 'A'),
(602, 160, 'ugly', 'B'),
(603, 160, 'beautiful', 'C'),
(604, 160, 'handsome', 'D'),
(605, 161, 'overweight', 'A'),
(606, 161, 'fat', 'B'),
(607, 161, 'plump', 'C'),
(608, 161, 'skinny', 'D'),
(609, 162, 'Improve quality of life', 'A'),
(610, 162, 'Decrease chronic disease', 'B'),
(611, 162, 'Stress relief', 'C'),
(612, 162, ' All the above', 'D'),
(613, 163, 'Flexibility', 'A'),
(614, 163, 'Aerobics', 'B'),
(615, 163, 'Strength', 'C'),
(616, 163, 'Sport', 'D'),
(617, 164, 'Flexibility', 'A'),
(618, 164, 'Muscle weight', 'B'),
(619, 164, 'Body Mass', 'C'),
(620, 164, 'Strength', 'D'),
(621, 165, 'Flexibility', 'A'),
(622, 165, 'Strength', 'B'),
(623, 165, 'Play', 'C'),
(624, 165, ' Role conflict', 'D'),
(625, 166, 'Walking', 'A'),
(626, 166, 'Swimming', 'B'),
(627, 166, 'Biking', 'C'),
(628, 166, 'All the above', 'D'),
(629, 167, 'Steve Jobs', 'A'),
(630, 167, 'More than one person', 'B'),
(631, 167, 'Al Gore', 'C'),
(632, 167, 'William Shockley', 'D'),
(633, 168, 'Microsoft', 'A'),
(634, 168, 'Linux', 'B'),
(635, 168, 'Apple', 'C'),
(636, 168, 'Windows', 'D'),
(637, 169, ' Steve Jobs', 'A'),
(638, 169, 'Bill Gates', 'B'),
(639, 169, 'Konrad Zuse', 'C'),
(640, 169, 'Charles Babbage', 'D'),
(641, 170, 'First', 'A'),
(642, 170, 'Second', 'B'),
(643, 170, 'Third', 'C'),
(644, 170, 'Fourth', 'D'),
(645, 171, 'Block definition  ', 'A'),
(646, 171, 'Record Contain Clause', 'B'),
(647, 171, 'Blocking Factor', 'C'),
(648, 171, 'Record per Block', 'D'),
(649, 172, '7106', 'A'),
(650, 172, '7632', 'B'),
(651, 172, '7641', 'C'),
(652, 172, '7164', 'D'),
(653, 173, 'Tropikal', 'A'),
(654, 173, 'Typoon Belt', 'B'),
(655, 173, 'Fault', 'C'),
(656, 173, 'Pacific Ring of fire', 'D'),
(657, 174, 'Pacific Ring of Fire', 'A'),
(658, 174, 'Tropikal', 'B'),
(659, 174, 'Typhoon Belt', 'C'),
(660, 174, 'Fault', 'D'),
(661, 175, 'Pacific Ring of Fire', 'A'),
(662, 175, 'Fault', 'B'),
(663, 175, 'Typhoon Belt', 'C'),
(664, 175, 'Austonesyano', 'D'),
(665, 176, 'Palawan', 'A'),
(666, 176, 'Cebu', 'B'),
(667, 176, 'Maynila', 'C'),
(668, 176, 'Davao', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `rec_id` int(8) NOT NULL,
  `fsub_id` int(4) NOT NULL,
  `subj_name` varchar(50) NOT NULL,
  `fstud_id` int(10) DEFAULT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `sec_name` varchar(50) NOT NULL,
  `fac_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`rec_id`, `fsub_id`, `subj_name`, `fstud_id`, `Fname`, `Lname`, `sec_name`, `fac_id`) VALUES
(31, 36, 'Mathematics', 66, 'Patrick James', 'Fetizanan', 'Einstein', 65),
(33, 37, 'Filipino', 66, 'Patrick James', 'Fetizanan', 'Einstein', 65),
(36, 36, 'Mathematics', 68, 'Carlo', 'Castro', 'Socrates', 65),
(37, 37, 'Filipino', 68, 'Carlo', 'Castro', 'Socrates', 65),
(39, 38, 'Physical Education', 66, 'Patrick James', 'Fetizanan', 'Einstein', 65),
(41, 40, 'Computer Education', 69, 'feti', 'Fetizanan', 'Aristotle', 65),
(43, 39, 'English', 68, 'Carlo', 'Castro', 'Socrates', 65),
(44, 40, 'Computer Education', 68, 'Carlo', 'Castro', 'Socrates', 65),
(45, 38, 'Physical Education', 68, 'Carlo', 'Castro', 'Socrates', 65),
(46, 36, 'Mathematics', 69, 'feti', 'Fetizanan', 'Einstein', 65);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(10) NOT NULL,
  `fuser_id` int(10) NOT NULL,
  `sec_name` enum('Einstein','Socrates','Aristotle') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `fuser_id`, `sec_name`) VALUES
(1, 66, 'Einstein'),
(2, 69, 'Einstein');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(10) NOT NULL,
  `fuser_id_stud` int(8) NOT NULL,
  `Age` varchar(4) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Father` varchar(100) NOT NULL,
  `Mother` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `fuser_id_stud`, `Age`, `Gender`, `Father`, `Mother`) VALUES
(3, 66, '22', '', 'Charlito Fetizanan', 'Tita Fetizanan'),
(4, 68, '22', 'Male', '', ''),
(5, 69, '22', 'Male', 'Lito Fetizanan', 'Anden Fetizanan'),
(6, 71, '', '', '', ''),
(7, 72, '', '', '', ''),
(8, 73, '', '', '', ''),
(9, 74, '', '', '', ''),
(10, 75, '', '', '', ''),
(11, 76, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_get_quiz`
--

CREATE TABLE `student_get_quiz` (
  `get_id` int(10) NOT NULL,
  `fuser_id` int(8) NOT NULL,
  `fass_id` int(10) NOT NULL,
  `f_ass_name` varchar(50) NOT NULL,
  `ans_status` enum('Not initiated','Already Answered','','') NOT NULL DEFAULT 'Not initiated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_get_quiz`
--

INSERT INTO `student_get_quiz` (`get_id`, `fuser_id`, `fass_id`, `f_ass_name`, `ans_status`) VALUES
(6, 66, 23, 'Math - Addition 1', 'Already Answered'),
(7, 66, 24, 'Math - Short Quiz 1', 'Already Answered'),
(8, 66, 25, 'Math - Long quiz 1', 'Already Answered'),
(9, 68, 23, 'Math - Addition 1', 'Already Answered'),
(10, 68, 24, 'Math - Short Quiz 1', 'Already Answered'),
(11, 69, 23, 'Math - Addition 1', 'Already Answered'),
(12, 69, 24, 'Math - Short Quiz 1', 'Already Answered'),
(13, 66, 26, 'Filipino Short Quiz', 'Already Answered'),
(14, 66, 27, 'English -Vocabolary', 'Already Answered'),
(15, 66, 28, 'Physical Education - Health 1', 'Already Answered'),
(16, 66, 29, 'Computer Education - History of Computer', 'Already Answered'),
(17, 66, 32, 'Sibika Quiz1', 'Already Answered');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(4) NOT NULL,
  `fk_fac_id` int(5) NOT NULL,
  `sub_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `fk_fac_id`, `sub_name`) VALUES
(36, 65, 'Mathematics'),
(37, 65, 'Filipino'),
(38, 65, 'Physical Education'),
(39, 65, 'English'),
(40, 65, 'Computer Education'),
(43, 65, 'Sibika');

-- --------------------------------------------------------

--
-- Table structure for table `s_get_act`
--

CREATE TABLE `s_get_act` (
  `get_act_id` int(10) NOT NULL,
  `fuser_id` int(8) NOT NULL,
  `fact_id` int(10) NOT NULL,
  `f_act_title` varchar(100) NOT NULL,
  `status` enum('Not Done','Done') NOT NULL DEFAULT 'Not Done'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `s_get_act`
--

INSERT INTO `s_get_act` (`get_act_id`, `fuser_id`, `fact_id`, `f_act_title`, `status`) VALUES
(1, 66, 1, 'Math - Shapes', 'Done'),
(2, 66, 3, 'English - Essay', 'Done'),
(3, 66, 5, 'Math - Problem Solving', 'Done'),
(4, 68, 5, 'Math - Problem Solving', 'Done'),
(5, 66, 6, 'Math - Geometry', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(8) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `user_pass` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_pass`, `user_type`, `user_fname`, `user_mname`, `user_lname`, `user_email`) VALUES
(1, 'admin', '123456789', 'Admin', 'patrick', 'famini', 'fetizanan', 'pjfeti@gmail.com'),
(64, 'Tolits', 'monggoman123', 'Parent', 'Charlito', 'Famini', 'Fetizanan', 'charlito@gmail.com'),
(65, 'Geraldine', 'monggoman123', 'Faculty', 'Geraldine', 'Famini', 'Fetizanan', 'geraldine@gmail.com'),
(66, 'PJ', 'monggoman123', 'Student', 'Patrick James', 'Famini', 'Fetizanan', 'pjfetizanan@gmail.com'),
(68, 'Carlo', 'Carlo123', 'Student', 'Carlo', 'T', 'Castro', 'Carlo@gmail.com'),
(69, 'Feti', 'monggoman123', 'Student', 'feti', 'Famini', 'Fetizanan', 'feti@gmail.com'),
(70, 'Ghie', 'monggoman123', 'Parent', 'Ghie', 'Famini', 'Fetizanan', 'Ghie@gmail.com'),
(71, 'Enzo', 'enzo123', 'Student', 'Enzo', 'C', 'Cruz', 'enzo@gmail.com'),
(72, 'Mathew', 'Mathew123', 'Student', 'Mathew', 'Ordoñez', 'Bella', 'Mathew@gmail.com'),
(73, 'John Paul', 'Dado123', 'Student', 'John Paul', 'C', 'Dado', 'Dado@gmail.com'),
(74, 'Alex', 'Alex123', 'Student', 'Alex', 'F', 'Ferrer', 'Alex@gmail.com'),
(75, 'Wiliam', 'William123', 'Student', 'William', 'V.', 'Fuentes', 'William@gmail.com'),
(76, 'John', 'John123', 'Student', 'John', 'D', 'Doe', 'John@gmail.com'),
(80, 'Faculty', 'fac123', 'Faculty', 'Faculty', 'Faculty', 'Faculty', 'Faculty@gmail.com'),
(81, 'Tita', 'monggoman123', 'Parent', 'Tita', 'Famin', 'Fetizanan', 'Tita@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `act_history`
--
ALTER TABLE `act_history`
  ADD PRIMARY KEY (`act_his_id`),
  ADD KEY `fk_user` (`fuser_id`),
  ADD KEY `fk_act` (`f_act_id`);

--
-- Indexes for table `act_ins`
--
ALTER TABLE `act_ins`
  ADD PRIMARY KEY (`ins_id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `for_fac_id` (`fk_fac_id`),
  ADD KEY `for_sub` (`f_sub`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `test` (`fuser_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `fore_user` (`f_user_id`),
  ADD KEY `fore_ass` (`f_ass_id`);

--
-- Indexes for table `ins_criteria`
--
ALTER TABLE `ins_criteria`
  ADD PRIMARY KEY (`cri_id`),
  ADD KEY `f_act_ins` (`f_act_ins`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `parent_fk` (`fkuser_id_par`);

--
-- Indexes for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`que_id`),
  ADD KEY `fass_fk` (`f_ass_id`);

--
-- Indexes for table `q_option`
--
ALTER TABLE `q_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `qque_id` (`qque_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`),
  ADD KEY `stud_fk` (`fuser_id_stud`);

--
-- Indexes for table `student_get_quiz`
--
ALTER TABLE `student_get_quiz`
  ADD PRIMARY KEY (`get_id`),
  ADD KEY `fo_user` (`fuser_id`),
  ADD KEY `fo_ass` (`fass_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `sub_fk` (`fk_fac_id`);

--
-- Indexes for table `s_get_act`
--
ALTER TABLE `s_get_act`
  ADD PRIMARY KEY (`get_act_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `act_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `act_history`
--
ALTER TABLE `act_history`
  MODIFY `act_his_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `act_ins`
--
ALTER TABLE `act_ins`
  MODIFY `ins_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `ass_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fac_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `h_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ins_criteria`
--
ALTER TABLE `ins_criteria`
  MODIFY `cri_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_question`
--
ALTER TABLE `quiz_question`
  MODIFY `que_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `q_option`
--
ALTER TABLE `q_option`
  MODIFY `option_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `rec_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_get_quiz`
--
ALTER TABLE `student_get_quiz`
  MODIFY `get_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `s_get_act`
--
ALTER TABLE `s_get_act`
  MODIFY `get_act_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `act_history`
--
ALTER TABLE `act_history`
  ADD CONSTRAINT `fk_act` FOREIGN KEY (`f_act_id`) REFERENCES `activity` (`act_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`fuser_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `for_fac_id` FOREIGN KEY (`fk_fac_id`) REFERENCES `faculty` (`fuser_id`),
  ADD CONSTRAINT `for_sub` FOREIGN KEY (`f_sub`) REFERENCES `subject` (`sub_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `test` FOREIGN KEY (`fuser_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fore_ass` FOREIGN KEY (`f_ass_id`) REFERENCES `assessment` (`ass_id`),
  ADD CONSTRAINT `fore_user` FOREIGN KEY (`f_user_id`) REFERENCES `student` (`fuser_id_stud`);

--
-- Constraints for table `ins_criteria`
--
ALTER TABLE `ins_criteria`
  ADD CONSTRAINT `f_act_ins` FOREIGN KEY (`f_act_ins`) REFERENCES `act_ins` (`ins_id`);

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_fk` FOREIGN KEY (`fkuser_id_par`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `fass_fk` FOREIGN KEY (`f_ass_id`) REFERENCES `assessment` (`ass_id`);

--
-- Constraints for table `q_option`
--
ALTER TABLE `q_option`
  ADD CONSTRAINT `qque_id` FOREIGN KEY (`qque_id`) REFERENCES `quiz_question` (`que_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `stud_fk` FOREIGN KEY (`fuser_id_stud`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `student_get_quiz`
--
ALTER TABLE `student_get_quiz`
  ADD CONSTRAINT `fo_ass` FOREIGN KEY (`fass_id`) REFERENCES `assessment` (`ass_id`),
  ADD CONSTRAINT `fo_user` FOREIGN KEY (`fuser_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `sub_fk` FOREIGN KEY (`fk_fac_id`) REFERENCES `faculty` (`fuser_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
