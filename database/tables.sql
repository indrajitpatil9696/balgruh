-- STUDENT INFO TABLE
CREATE TABLE `student_table` (
    `id` INT NULL AUTO_INCREMENT PRIMARY KEY,
    `register_no` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `fname` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `mname` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `lname` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `address` TEXT(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `dharm_jaat` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `parents_name` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
    `parents_income` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `niradhar_reason` TEXT (500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `adm_date` DATE NULL ,
    `birth_date` DATE NULL ,
    `order_no` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `adm_source` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `std` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `dis_date` DATE NULL ,
    `photo` VARCHAR(300) nuLL ,
    `sgid` INT not null,
    `contact_nos` TEXT(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `aadhar_no` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
    `status` INT NULL DEFAULT '1'
     CONSTRAINT fk_sgid FOREIGN KEY (sgid)
 REFERENCES student_group(sgid)
 on delete cascade

);
  ALTER TABLE student_table ADD
     CONSTRAINT fk_sgid
        FOREIGN KEY (sgid)
        REFERENCES student_group (sgid)
        ON DELETE CASCADE;



-- STUDENT GROUP TABLE
CREATE TABLE `student_group` (
  `sgid` int(11) NOT NULL,
  `sgname` char(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_group`
--

INSERT INTO `student_group` (`sgid`, `sgname`) VALUES
(1, 'ताब्यात'),
(2, 'गैरहजर'),
(3, 'हजर');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`sgid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_group`
--
ALTER TABLE `student_group`
  MODIFY `sgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;









--
-- Table structure for table `navchaitanya_groups`
--

CREATE TABLE `navchaitanya_groups` (
  `gid` int(11) NOT NULL,
  `gname` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `navchaitanya_groups`
--

INSERT INTO `navchaitanya_groups` (`gid`, `gname`) VALUES
(1, 'ऍडमिन'),
(2, 'काळजीवाहक'),
(3, 'संस्थापक'),
(4, 'संचालक');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `navchaitanya_groups`
--
ALTER TABLE `navchaitanya_groups`
  ADD PRIMARY KEY (`gid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `navchaitanya_groups`
--
ALTER TABLE `navchaitanya_groups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;


-- USER TABLE
CREATE TABLE `user` (
    `id` int AUTO_INCREMENT PRIMARY KEY null,
    `user_name` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT null,
    `password` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT null,
    `gid` int null,
    `status` INT NULL DEFAULT '1'
     CONSTRAINT fk_gid FOREIGN KEY (gid)
 REFERENCES navchaitanya_groups(gid)
  on delete cascade
    )


-- STUDENT MARKS TABLE
CREATE TABLE `student_marks` (
`id` int AUTO_INCREMENT PRIMARY KEY null,
`year` float null,
`marks` float null,
 `total_marks` float null,
  `sid` int null,
  `status` INT NULL DEFAULT '1'
   CONSTRAINT fk_sid FOREIGN KEY (sid)
   REFERENCES student_table(id)
   );

alter  table `student_marks` add
column `std` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT null;

alter  table `student_marks` add
column `result` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT null;
alter  table `student_marks` add
column `per` float null;
--    STUDENT MUDAT VADH
CREATE TABLE `student_mudatvadh` (
`id` int AUTO_INCREMENT PRIMARY KEY null,
`from` DATE null,
`to` DATE null,
  `sid` int null,
  `status` INT NULL DEFAULT '1'
   CONSTRAINT mudat_sid FOREIGN KEY (sid) REFERENCES student_table(id)

   );







-- EMPLOYEE
CREATE TABLE `navchaitanya_new`.`employee_table` (
`eid` INT NULL AUTO_INCREMENT ,
`emp_name` TEXT (300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
`emp_education` TEXT (100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
 `emp_designation` INT NULL ,
  `emp_address` TEXT (500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `emp_contact_no` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ,
   `emp_status` INT NULL DEFAULT '1' ,
   PRIMARY KEY (`eid`),
   CONSTRAINT fk_egid FOREIGN KEY (emp_designation)
 REFERENCES navchaitanya_groups(gid)
 on delete cascade
   ) ENGINE = InnoDB;