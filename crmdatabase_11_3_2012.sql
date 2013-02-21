--
-- MySQL 5.1.41
-- Sun, 11 Mar 2012 10:28:07 +0000
--

CREATE TABLE `agent` (
   `agent_ID` int(11) not null auto_increment,
   `ag_fName` varchar(50) not null,
   `ag_lName` varchar(50) not null,
   `ag_password` varchar(50) not null,
   `ag_levelAccess` varchar(5) not null,
   `ag_logAttempts` int(5) not null,
   `contact_id` int(20) not null,
   PRIMARY KEY (`agent_ID`),
   KEY `FKIndex1` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=17;

INSERT INTO `agent` (`agent_ID`, `ag_fName`, `ag_lName`, `ag_password`, `ag_levelAccess`, `ag_logAttempts`, `contact_id`) VALUES 
('1', 'david', 'Sparrius', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '1', '0', '25'),
('2', 'Robert', 'Sparrius', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '2', '3', '10'),
('6', 'Tommy', 'Wijaya', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '1', '1', '18'),
('7', 'Sonia', 'Sonia', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '2', '1', '17'),
('10', 'Liam', 'Handasyde', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '1', '0', '30'),
('11', 'duc', 'duc', '71fa71543ddf5321cd0ebb61eea7c890073b43fd:2b', '2', '0', '32'),
('16', 'Admin', 'admin', 'ca9caf8f81cd71b62ec6b75c4789d0dbee3b7279:37', '1', '0', '0');

CREATE TABLE `agent_has_candidate` (
   `agent_candidate_id` int(11) not null auto_increment,
   `agent_id` int(11) not null default '0',
   `candidate_id` varchar(20) not null,
   PRIMARY KEY (`agent_candidate_id`),
   KEY `candidate_id` (`candidate_id`),
   KEY `agent_id` (`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=14;

INSERT INTO `agent_has_candidate` (`agent_candidate_id`, `agent_id`, `candidate_id`) VALUES 
('1', '1', '20101007023801000001'),
('2', '1', '20101121144037000013'),
('3', '2', '20101121225000000015'),
('4', '11', '20101007024001000002'),
('5', '11', '20101103153030000005'),
('6', '11', '20101118035137000008'),
('7', '11', '20101121141950000012'),
('8', '11', '20101121144618000014'),
('13', '11', '20110516140200000021');

CREATE TABLE `candidate` (
   `candidate_ID` varchar(20) not null,
   `can_fName` varchar(50) not null,
   `can_lName` varchar(50) not null,
   `email` varchar(50),
   `can_nextCont` date,
   `can_yearIniCont` date,
   `can_scoring` varchar(50),
   `can_relStatus` varchar(50),
   `can_rate` double(15,2),
   `can_typeRate` varchar(10),
   `can_sellRate` double(15,2),
   `can_typeSellRate` varchar(10) not null,
   `can_buyRate` double(15,2),
   `can_typeBuyRate` varchar(50) not null,
   `can_currEng` varchar(50),
   `can_note` text,
   `status_id` varchar(5) not null,
   `contact_id` int(20) not null auto_increment,
   PRIMARY KEY (`candidate_ID`),
   KEY `FKIndex1` (`status_id`),
   KEY `FKIndex2` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=50;

INSERT INTO `candidate` (`candidate_ID`, `can_fName`, `can_lName`, `email`, `can_nextCont`, `can_yearIniCont`, `can_scoring`, `can_relStatus`, `can_rate`, `can_typeRate`, `can_sellRate`, `can_typeSellRate`, `can_buyRate`, `can_typeBuyRate`, `can_currEng`, `can_note`, `status_id`, `contact_id`) VALUES 
('20101007023801000001', 'Rachel', 'Smith', '', '2010-12-10', '2010-12-10', '1', 'Average', '85.00', 'per HR', '850.00', 'per DAY', '110000.00', 'per ANNUM', 'Contract', '', '2a', '3'),
('20101007024001000002', 'Emma', 'Kandisky', '', '2010-10-10', '2010-12-10', '10', 'Excellent', '86.00', 'per Hour', '860.00', 'per Annual', '210000.00', 'per Day', '1', 'She is pretty and smart', '2b', '4'),
('20101103153030000005', 'Tommy', 'Saputra', '', '2010-11-06', '2010-11-15', '4', 'Very Good', '100.00', 'per Hour', '80.00', 'per Hour', '120.00', 'per Hour', '0', ' (By : duc, 29/2/2011, 14:31) (By : duc, 29/2/2011, 14:32)', '1a', '8'),
('20101118035137000008', 'Ken', 'Chapman', '', '2010-11-20', '2010-11-18', '3', 'Excellent', '100.00', 'per Hour', '110.00', 'per Hour', '120.00', 'per Hour', '0', 'Excellent candidate for Database development (By : David, 22/10/2010, 1:56)', '2b', '12'),
('20101121141950000012', 'Carlos', 'Munoz', '', '2010-11-02', '2010-11-18', '6', 'Very Good', '70.00', 'per Hour', '70.00', 'per Hour', '70.00', 'per Hour', '1', 'submitted for interview in sun.ltd (By : David, 22/10/2010, 1:19)', '2d', '27'),
('20101121144037000013', 'Steven', 'Wu', '', '2010-11-01', '2010-11-01', '10', 'Excellent', '100.00', 'per Hour', '100.00', 'per Hour', '100.00', 'per Hour', '0', 'Experience in SAP for 8 Years (By : David, 22/10/2010, 1:40)', '2b', '28'),
('20101121144618000014', 'Liam', 'Handasyde', '', '2010-11-01', '2010-11-02', '3', 'Very Good', '80.00', 'per Hour', '80.00', 'per Hour', '80.00', 'per Hour', '0', 'Good Comunication skill, experience in design (By : David, 22/10/2010, 1:46)', '2b', '29'),
('20101121225000000015', 'Michael', 'Redding', '', '2010-11-08', '2010-11-08', '6', 'Very Good', '100.00', 'per Hour', '100.00', 'per Hour', '100.00', 'per Hour', '1', ' (By : David, 22/10/2010, 9:49)', '1a', '31'),
('20110516140200000021', 'Miley', 'Curus', '', '2011-05-16', '2011-05-16', '1', 'Excellent', '123.00', 'per Hour', '12.00', 'per Hour', '123.00', 'per Hour', '2', ' (By : duc, 16/4/2011, 23:01)', '2e', '49');

CREATE TABLE `client` (
   `client_ID` int(11) not null auto_increment,
   `cl_fName` varchar(50) not null,
   `cl_lName` varchar(50) not null,
   `cl_Company` varchar(100) not null,
   `contact_id` int(20) not null,
   PRIMARY KEY (`client_ID`),
   KEY `FKIndex1` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `client` (`client_ID`, `cl_fName`, `cl_lName`, `cl_Company`, `contact_id`) VALUES 
('1', 'Elena', 'Manni', 'Client', '5'),
('2', 'Timmoa', 'Hobarta', 'itomSquare', '3'),
('6', 'Sonia', 'Schiavon', 'Sonia Corp', '15');

CREATE TABLE `client_has_candidate` (
   `client_id` int(11) not null default '0',
   `candidate_id` varchar(20) not null,
   PRIMARY KEY (`client_id`,`candidate_id`),
   KEY `candidate_id` (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- [Table `client_has_candidate` is empty]

CREATE TABLE `contact_details` (
   `contact_ID` int(20) not null auto_increment,
   `cont_streetNo` varchar(10),
   `cont_street` varchar(50),
   `cont_city` varchar(50),
   `cont_zip` int(4),
   `cont_state` varchar(5),
   `cont_country` varchar(20),
   `cont_mobile` varchar(20),
   `cont_homePhone` varchar(50),
   `cont_companyName` varchar(50),
   `cont_workPhone` varchar(20),
   `cont_workFax` varchar(50),
   `cont_otherCompany` varchar(100),
   PRIMARY KEY (`contact_ID`),
   KEY `cont_state` (`cont_state`),
   KEY `cont_state_2` (`cont_state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=50;

INSERT INTO `contact_details` (`contact_ID`, `cont_streetNo`, `cont_street`, `cont_city`, `cont_zip`, `cont_state`, `cont_country`, `cont_mobile`, `cont_homePhone`, `cont_companyName`, `cont_workPhone`, `cont_workFax`, `cont_otherCompany`) VALUES 
('1', '103', 'Lancaster', 'ashburton', '3000', 'VIC', 'Melbourne', '0892820912', '0392123456', '', '', '', ''),
('2', '104', 'St', 'Gelong', '3001', 'VIC', 'Melbourne', '0449889876', '0397777777', '', '', '', ''),
('3', '8', 'St Elisabeth Rd', 'Brunswick', '3060', 'VIC', 'Melbourne', '0449881234', '0395483543', 'Infracom', '0395475487', '0378787876', ''),
('4', '24', 'St Luise st', 'Hawthon', '3045', 'VIC', 'Melbourne', '0449785102', '039963822', '039672636', '039637421', '039688762', ''),
('5', '69', 'St', 'Northcote', '3060', 'VIC', 'Melbourne', '0449785490', '0392983954', '', '', '', ''),
('6', '36', 'Catalina', 'Ashbutron', '3147', 'VIC', 'Australia', '0425080899', '98989090', 'Valbury', '0425080899', '0425080899', ''),
('7', '36', 'Catalina Ave', 'Ashburton', '3147', 'VIC', 'Australia', '0425080899', '0425080899', 'Vendor', '0425080899', '0425080899', ''),
('8', '36', 'Catalina', 'Ashwood', '3147', 'VIC', 'Australia', '0524080899', '0249344019', 'Itomsquare', '122141', '323151', ''),
('9', '12', 'asd', 'asd', '1234', 'VIC', 'asd', '123', '123', 'asd', '123', '123', ''),
('10', '21', 'zsxfd', '12sad', '1234', 'VIC', 'asdasd', '1235123', '125123', '123', '123', '123', ''),
('11', '23', 'Ash', 'asdh', '4123', 'VIC', 'skdhj', '1251235', '12365128', '2125', '1235', '1231', ''),
('12', '113', ' Emsworth Street', ' WYNNUM  ', '4178', 'QLD', 'Australia', '0412222578', '0388626363', 'champ', '080808', '080808', ''),
('13', '31', 'Cobart', 'Ohio', '41000', 'VIC', 'Australia', '898989', '898989', 'Milestone', '', '', ''),
('14', '12', 'Lancaster', 'Ashwood', '3147', 'VIC', 'Australia', '0409828912', '0298987675', 'Milestone', '', '', ''),
('15', '12', 'Grant', 'Clifton', '3000', 'VIC', 'Australia', '0425080899', '0425070799', '', '', '', ''),
('16', '36', 'Gratt street', 'Clifton Hill', '3211', 'VIC', 'Australia', '040808999', '01892822', 'Milestone', '', '', ''),
('17', '36', 'Gantt Street', 'Ashburton', '2134', 'VIC', 'Australia', '028980189', '19820839', 'Milestone', '', '', ''),
('18', '23', 'Gantt', 'Clifton', '3146', 'VIC', 'Australia', '0425080899', '0425080899', '', '', '', ''),
('19', '23D', 'Gantt', 'Clifton Hill', '3146', 'VIC', 'Australia', '0425080899', '0425080899', 'Milestone', '', '', ''),
('20', '34', 'Lancaster', 'Ashwood', '3147', 'VIC', 'Australia', '0425080899', '0425080899', '', '', '', ''),
('21', '2', 'Lancaster', 'Ashwood', '3147', 'VIC', 'Australia', '0425080899', '0425080899', '', '', '', ''),
('22', '2312', 'Lancaster', 'Ashwood', '3147', 'VIC', 'Australia', '0425080899', '0425080899', '', '', '', ''),
('23', '23dd', 'Lancaster', 'Ashwooddd', '3147', 'VIC', 'Australiadd', '0425080899', '0425080899', '', '', '', ''),
('24', '356', 'Grant St', 'Clifton Hill', '3068', 'VIC', 'Australia', '0422098878', '0249344019', 'Student', '0422098878', '0422098878', ''),
('25', '16', 'Fortuna St', 'Clayton', '3006', 'VIC', 'Australia', '0421539238', '0210539288', 'Datacom', '044950474', '0437983111', ''),
('26', '8', 'Lily Street', 'Pascoe vale', '3456', 'VIC', 'Australia', '0405676780', '0231978978', 'magnolia', '0405676780', '0405676780', ''),
('27', '1264', 'Victoria Place Circle', 'Melbourne', '3000', 'VIC', 'Australia', '0407242744', '0395314282', 'Marriot Vacation Club', '0407242744', '0407242744', ''),
('28', '8', 'Toorak Rd', 'Hawthorn', '3008', 'VIC', 'Australia', '0426987876', '0201253542', 'valbury', '0426987876', '0426987876', ''),
('29', '405', 'Warrigal Road', 'Ashburton', '4038', 'VIC', 'Australia', '0409823001', '0202893892', 'lightspace.ltd', '0409823001', '0409823001', ''),
('30', '26', 'Lancaster', 'Ashwood', '3147', 'VIC', 'Australia', '0498080902', '0202909898', 'Milestone', '', '', ''),
('31', '16', 'Dumaresq Parade', 'Metford', '2323', 'NSW', 'Australia', '0425080899', '0249344019', 'milestone', '0425080899', '0425080899', ''),
('41', 'huh', 'uihihuh', 'hi', '1233', 'TAS', 'Australia', '123213', '988787', 'sfasdf', '139321', '890808', 'dfdosafjoi'),
('42', '2', 'waverly', 'mel', '3100', 'ACT', 'Australia', '0419231232', '98123232', 'isync', '0413232323', '2312312', ''),
('43', '12', 'Flinder st', 'Melbourne', '3100', 'NSW', 'Australia', '0412931231', '97123123', 'isncsyp', '0412319232', '123123', ''),
('45', 'ko', 'ko', 'ko', '1232', 'ACT', 'Australia', '123123', '123123312', 'jijiii', '2313233', '12322', ''),
('46', '12', 'Malainga st', 'Melbourne', '3900', 'NSW', 'Australia', '041230928', '9123213', 'Skyline', '041293282', '3123123', ''),
('47', '32', 'Walinton Rd', 'Melbourne', '3200', 'QLD', 'Australia', '041232198', '9712322', 'Lakiss', '041232938', '1229323', ''),
('48', '57', 'Marvet Rd', 'Melbourne', '5100', 'NSW', 'Australia', '041328327', '97223234', 'Entertainment PC', '041328327', '4324324', ''),
('49', '22', 'Modialoc St', 'Melbourne', '3200', 'VIC', 'Australia', '041293283', '97421233', 'Jet Studio', '041239248', '3414214', '');

CREATE TABLE `help_system` (
   `hs_fieldID` varchar(50) not null,
   `hs_msg` varchar(300),
   PRIMARY KEY (`hs_fieldID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `help_system` (`hs_fieldID`, `hs_msg`) VALUES 
('Address', 'Candidate\'s'),
('Agent / Consultant', 'Milestone Search employee who is responsible for managing Candidates and Clients.'),
('Availability / Next Contact', 'Scheduled data for next contact with the candidate'),
('Best match', 'Number of searching criteria founded.'),
('blueSky ', 'Company name of Liam Handasyde, Tommy Wijaya, Sonia Schiavon'),
('Business Phone/FAX', 'Working phone number of the candidate?'),
('Buy Rate', 'The cost of headhunting / poaching Candidate from one employee to another.'),
('Candidate', 'A \"Candidate\" is an individual who is seeking employment'),
('Category / Skill Set', 'Candidates set of qualifications and/or area of expertise and experience.'),
('City', 'City where the candidate is available to work'),
('Client', 'A \"Client\" is an entity who employs \"Candidates\"'),
('Company', 'Candidate current company working at and candidates\'s placement company'),
('Consultant / Agent', 'Milestone Search employee who is responsible for managing Candidates and Clients.'),
('Current Engagement', 'Type of job placement: Perm: Permenent working period;\nContract: work placement period is based on the duraction of the project;\nFixed Term: work placement period is based on a fixed dates; \n'),
('Customer Relationship Management', 'The required database that \"Milestone Search\" has commissioned blueSky to build up.'),
('Customer Relationship Management System (CRMS)', 'The required application that \"Milestone Search\" has commissioned blueSky to produce.'),
('dehtd', '<p>bdmf,j</p>'),
('dfdfsdfdfd', 'dfsdfdf'),
('Email', 'Candidate\'s mails '),
('Engagement Type', 'Type of work placement, (full time, contractor, casual) define by the candidate'),
('Hit count', 'Percentage of matching criteria'),
('Initial Contact', 'Year of the first contact with the candidate'),
('ISYS', 'ISYS is a file reader that extracts text from comprehensive library of file and email formats'),
('Job Title', 'Job Title of the candidate'),
('Milestone Search', 'blueSky\'s client company name'),
('Name', 'Name of the candidate'),
('Next Contact / Availability', 'Scheduled data for next contact with the candidate'),
('Rate', 'Rate that the candidate is requesting'),
('Scoring', 'Feedback from the client about the candidate (1.2 Excellent, 1.5 Good, 2 Average, 3 Below Average)'),
('Sell Rate', 'Percentuange of candidates wage rappresented by the Dollar value. '),
('Skill Set / Category', 'Candidates set of qualifications and/or area of expertise and experience.'),
('State', 'State where the candidate is available or working such as VIC, NSW, etc.  '),
('Status', 'Candidates code which identify the current working situation. '),
('Web Page', 'Candidate\'s Web Page'),
('Work Flow Action (WFA)', 'Automated task with a set duration that an Agent assigns to a Candidate to aid in the processing of Candidates and Clients'),
('Year', 'Year of candidate sent his/her resume.');

CREATE TABLE `job_title` (
   `job_ID` int(11) not null auto_increment,
   `job_shortDescr` varchar(20) not null,
   `job_longDescr` varchar(50) not null,
   PRIMARY KEY (`job_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=32;

INSERT INTO `job_title` (`job_ID`, `job_shortDescr`, `job_longDescr`) VALUES 
('1', 'Developer', 'Java and php developer'),
('2', 'Analyst', 'Business role and procedures developing'),
('3', 'Web Developer', 'Developing Website (Application)'),
('4', 'Telemarketing', 'Accept Phone Order via Phone'),
('6', 'Telecomunication', 'Able To Speak with Alot Of people'),
('12', 'Accounting', 'MYOB entry'),
('13', 'Administrator', 'Office Administator'),
('14', 'Administrator', 'Office Administrator'),
('15', 'Mechanical', 'Mechanical'),
('16', 'Job', 'Job'),
('17', 'Database Anaylist', 'Develop, Maintance database using mysql, MsSQL'),
('18', 'Developer', 'Database Developer'),
('19', 'Java Developer', 'Java web developer with JavaEE platform'),
('20', 'Software Engineer', 'Software Engineer Specified in .Net'),
('21', 'Project Manager', 'Manage IT Project SAP Base Application'),
('22', 'Web Developer', 'Web Developer for Flash, CSS, Javascript'),
('23', 'Data Analyst', 'Analyse data flow and data progress'),
('24', 'Java', 'Java Programmer'),
('25', 'SA', 'Systems Analyst'),
('26', 'VB.Net', 'VB application'),
('27', 'it', 'it'),
('28', 'ko', 'ko'),
('29', 'Accountant', 'Tax Invoice'),
('30', 'Help Desk', 'IT Help Desk'),
('31', 'System Analist', 'Business Analist');

CREATE TABLE `job_title_has_candidate` (
   `job_candidate_id` int(11) not null auto_increment,
   `job_id` int(11) not null default '0',
   `candidate_id` varchar(20) not null,
   PRIMARY KEY (`job_candidate_id`),
   KEY `job_id` (`job_id`,`candidate_id`),
   KEY `candidate_id` (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=13;

INSERT INTO `job_title_has_candidate` (`job_candidate_id`, `job_id`, `candidate_id`) VALUES 
('1', '14', '20101103153030000005'),
('2', '20', '20101121141950000012'),
('3', '21', '20101121144037000013'),
('4', '22', '20101121144618000014'),
('5', '23', '20101118035137000008'),
('6', '24', '20101121225000000015'),
('12', '31', '20110516140200000021');

CREATE TABLE `multi_email` (
   `email_ID` varchar(100) not null,
   `candidate_id` varchar(20) not null,
   `em_timestamp` timestamp not null default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
   `primary_email` tinyint(1) not null,
   PRIMARY KEY (`email_ID`),
   KEY `candidate_id` (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `multi_email` (`email_ID`, `candidate_id`, `em_timestamp`, `primary_email`) VALUES 
('chavo5235@gmail.com', '20101121141950000012', '2011-04-13 06:01:27', '1'),
('isync1@email.com', '20101007023801000001', '2011-05-23 14:04:37', '1'),
('isync@email.com', '20110516140200000021', '2011-05-23 14:04:49', '1'),
('junekang@yahoo.com', '20101121144037000013', '2011-05-12 07:40:51', '1'),
('n_mduc@yahoo.com', '20101103153030000005', '2011-04-13 16:38:56', '1'),
('sun-beam@email.com', '20101121144618000014', '2011-04-13 06:04:46', '1'),
('sunlight@email.com', '20101121225000000015', '2011-05-12 07:40:51', '1'),
('telstra@yahoo.com', '20101118035137000008', '2011-05-12 07:40:51', '1');

CREATE TABLE `personal_details` (
   `contact_ID` int(20) not null auto_increment,
   `cont_email` varchar(50) not null,
   `cont_mobile` varchar(20) not null,
   `cont_streetNo` varchar(10) not null,
   `cont_street` varchar(50) not null,
   `cont_city` varchar(50) not null,
   `cont_state` varchar(5) not null,
   `cont_country` varchar(20) not null,
   `cont_zip` int(4) not null,
   `cont_phone` varchar(20) not null,
   PRIMARY KEY (`contact_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=38;

INSERT INTO `personal_details` (`contact_ID`, `cont_email`, `cont_mobile`, `cont_streetNo`, `cont_street`, `cont_city`, `cont_state`, `cont_country`, `cont_zip`, `cont_phone`) VALUES 
('3', 'june@naver.com', '123', '', '', '', 'NT', '', '0', '321'),
('5', 'elena@yahoo.com', '123123', '3', 'my', 'you', 'SA', '', '0', ''),
('6', 'duc@gmail.com', '', '', '', '', '', '', '0', ''),
('10', 'may@daum.com', '333', 'w', 'w', 'w', 'VIC', 'w', '0', ''),
('11', 'm@m.com', '', '', '', '', '', '', '0', ''),
('12', 'may@daum.com', '12345678', '1', '1', '1', 'VIC', '1', '1', ''),
('15', 'AA@AA.com', '111', '1', '1', '1', 'HOB', '1', '1', '222'),
('17', 'sun@ibm.com', '10', '3', '3', '3', 'QLD', 'Aus', '3333', '30'),
('18', 'aaa1@han.net', '', '', '', '', '', '', '0', ''),
('19', 'aaa1@han.com', '', '', '', '', '', '', '0', ''),
('23', '', '123', '', '', '', '', '', '0', ''),
('24', '', '1', '', '', '', '', '', '0', ''),
('25', 'aaa1@han.net', '', '', '', '', '', '', '0', ''),
('26', '', '1', '', '', '', '', '', '0', ''),
('29', 'asd@ya.ocm', '3232', '', '', '', '', '', '0', ''),
('30', 'dsf@UD.com', '2343', '', '', '', '', '', '0', ''),
('31', '1das@yah.com', '23434', '', '', '', '', '', '0', ''),
('33', 'kkkkk@gka.com', '4344334', 'sdf', 'asdf', 'asdf', 'NSW', 'asdf', '33', '222'),
('36', '', '5567', '', '', '', '', '', '0', ''),
('37', 'admin@yahoo.com', '0125124214', '', '', '', '', '', '0', '');

CREATE TABLE `skill_set` (
   `skill_ID` int(11) not null auto_increment,
   `skill_shortDescr` varchar(20) not null,
   `skill_longDescr` varchar(50) not null,
   PRIMARY KEY (`skill_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=35334;

INSERT INTO `skill_set` (`skill_ID`, `skill_shortDescr`, `skill_longDescr`) VALUES 
('1', 'Office', 'Microsoft Office'),
('2', 'Programming language', 'java'),
('3', 'Programming language', 'Visual Basic'),
('4', 'Programming language', 'ASP'),
('7', 'Tele, Comunication', 'Speaking, influencer'),
('12', 'Accounting', 'Bussiness'),
('13', 'Mechanical', 'Mechanical'),
('15', 'Analise database', 'MySQL, MsSQL, Access'),
('16', 'Java, SQL, PL/SQL, S', 'Java, SQL, PL/SQL, Seam, JSF, Spring, Hibernate, L'),
('28164', 'IT Project Managemen', '.net Java OpenJPA Hibernate'),
('35324', 'Office Administrator', 'Microsoft Office'),
('35325', 'SAP, Java, SQL', 'SAP Programmer with java platform'),
('35326', 'Web application', 'Flash Animation, CSS3, Javascript'),
('35327', 'Database', 'Access, Oracle'),
('35328', 'Java', 'Java Programmer'),
('35329', 'web', 'php'),
('35330', 'ko', 'ko'),
('35331', 'C  ', 'Game Develop'),
('35332', 'Adobe Photoshop CS5', 'IT Support and Help Desk'),
('35333', 'MS Project, SAP', 'MS Project 2010 and SAP');

CREATE TABLE `skill_set_has_candidate` (
   `skill_candidate_id` int(11) not null auto_increment,
   `skill_id` int(11) not null default '0',
   `candidate_id` varchar(20) not null,
   PRIMARY KEY (`skill_candidate_id`),
   KEY `candidate_id` (`candidate_id`),
   KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;

INSERT INTO `skill_set_has_candidate` (`skill_candidate_id`, `skill_id`, `candidate_id`) VALUES 
('1', '3', '20101007023801000001'),
('2', '3', '20101007024001000002'),
('3', '16', '20101121141950000012'),
('4', '35324', '20101103153030000005'),
('5', '35325', '20101121144037000013'),
('6', '35326', '20101121144618000014'),
('7', '35327', '20101118035137000008'),
('8', '35328', '20101121225000000015'),
('14', '35333', '20110516140200000021');

CREATE TABLE `state` (
   `state_code` varchar(5) not null,
   `state_name` varchar(30) not null,
   PRIMARY KEY (`state_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `state` (`state_code`, `state_name`) VALUES 
('ACT', 'Australian Capital Territory'),
('NSW', 'New South Wales'),
('NT', 'Northern Territory'),
('QLD', 'Queensland'),
('SA', 'South Australia'),
('TAS', 'Tasmania'),
('VIC', 'Victoria'),
('WA', 'Western Australia');

CREATE TABLE `status` (
   `status_ID` varchar(5) not null,
   `st_shortDescr` varchar(50) not null,
   `st_longDescr` varchar(50) not null,
   PRIMARY KEY (`status_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `status` (`status_ID`, `st_shortDescr`, `st_longDescr`) VALUES 
('1a', 'Continue Prospecting', 'Client - Continue Prospecting'),
('1b', 'Requirement Indentified', 'Client - Requirement Indentified'),
('2a', 'Continue Prospecting', 'Candidate - Continue Prospecting'),
('2b', 'Seeking Perm', 'Candidate - Seeking Perm'),
('2c', 'Seeking Contract', 'Candidate - Seeking Contract'),
('2d', 'Submitted for interview', 'Candidate - Submitted for interview'),
('2e', 'Interview confimed', 'Candidate - Interview confimed'),
('2f', 'Placed by Milestone', 'Candidate - Placed by Milestone');

CREATE TABLE `wfa` (
   `WFA_ID` int(6) not null auto_increment,
   `Title` varchar(50) not null,
   `Description` varchar(150) not null,
   PRIMARY KEY (`WFA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `wfa` (`WFA_ID`, `Title`, `Description`) VALUES 
('1', 'Low rate candidate', 'This is used for candidate who have less opportunities '),
('2', 'High rate candidate', 'This is used for the best candidate with high quality and have attractive skill sets'),
('3', 'Old candidate', 'This is used for very old candidates'),
('4', 'New candidate', 'This is used for new candidates'),
('5', 'New candidate seeking employment', 'New candidate seeking employment');

CREATE TABLE `wfa_assignment` (
   `candidate_ID` varchar(20) not null,
   `wfa_ID` int(6) not null,
   `timestamp` datetime not null,
   `status_complete` varchar(10) not null,
   `next_contact_date` date,
   `agent_ID` int(11),
   PRIMARY KEY (`candidate_ID`,`wfa_ID`,`timestamp`),
   KEY `candidate_ID` (`candidate_ID`,`wfa_ID`),
   KEY `wfa_ID` (`wfa_ID`),
   KEY `agent_ID` (`agent_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `wfa_assignment` (`candidate_ID`, `wfa_ID`, `timestamp`, `status_complete`, `next_contact_date`, `agent_ID`) VALUES 
('20101007023801000001', '1', '2011-03-10 00:00:00', 'Active', '2011-03-15', '0'),
('20101007024001000002', '2', '2011-03-16 00:00:00', 'Active', '2011-03-18', '0'),
('20101103153030000005', '3', '2011-03-20 00:00:00', 'Inactive', '2011-03-22', '0'),
('20101103153030000005', '5', '2010-11-15 00:00:00', 'Active', '', ''),
('20101118035137000008', '1', '2010-11-18 00:00:00', 'Active', '', ''),
('20101118035137000008', '4', '2011-03-17 00:00:00', 'Active', '2011-03-21', '0'),
('20101121141950000012', '2', '2011-03-31 00:00:00', 'Active', '0000-00-00', '0'),
('20101121144037000013', '4', '2011-03-31 00:00:00', 'Active', '0000-00-00', '0'),
('20101121144618000014', '5', '2011-04-03 00:00:00', 'Inactive', '0000-00-00', '0'),
('20101121225000000015', '1', '2011-03-29 00:00:00', 'Active', '0000-00-00', '0'),
('20110516140200000021', '1', '2011-05-16 00:00:00', 'Active', '', ''),
('20110516140200000021', '2', '2011-05-16 00:00:00', 'Inactive', '', ''),
('20110516140200000021', '3', '2011-05-16 00:00:00', 'Inactive', '', ''),
('20110516140200000021', '4', '2011-05-16 00:00:00', 'Inactive', '', '');

CREATE TABLE `wfa_has_template` (
   `wfa_has_template_id` int(11) not null auto_increment,
   `wfa_id` int(6) not null,
   `wfa_template_ID` int(5) not null,
   `email_day` int(5) not null,
   PRIMARY KEY (`wfa_has_template_id`),
   KEY `wfa_id` (`wfa_id`,`wfa_template_ID`),
   KEY `wfa_template_ID` (`wfa_template_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=17;

INSERT INTO `wfa_has_template` (`wfa_has_template_id`, `wfa_id`, `wfa_template_ID`, `email_day`) VALUES 
('1', '1', '1', '10'),
('2', '1', '2', '1'),
('4', '1', '4', '8'),
('5', '2', '2', '5'),
('6', '2', '13', '0'),
('7', '3', '9', '0'),
('8', '3', '2', '12'),
('9', '3', '3', '7'),
('10', '3', '4', '10'),
('11', '4', '10', '0'),
('12', '4', '2', '8'),
('13', '5', '8', '0'),
('14', '5', '12', '5'),
('15', '1', '5', '0'),
('16', '5', '9', '12');

CREATE TABLE `wfa_template` (
   `wfa_template_ID` int(5) not null auto_increment,
   `subject` varchar(50) not null,
   `content` text not null,
   PRIMARY KEY (`wfa_template_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=14;

INSERT INTO `wfa_template` (`wfa_template_ID`, `subject`, `content`) VALUES 
('1', 'Well come to Milestone Agent', 'Dear candidate!\r\n\r\nWell come to Milestone job search.\r\n\r\nWe will try out best to bring the good jobs with a satisfied income.\r\n\r\nYour sincery\r\n\r\nMilestone\r\n'),
('2', 'Remind email', 'Hello candidate!\r\n\r\nWe send this email to let you know that your resume have proceeded.\r\n\r\nHopefully, you will get a very interest position.\r\n\r\nRegards!\r\n\r\nMilestone\r\n'),
('3', 'Regret email', 'Hello candidate!\r\n\r\nYour skill sets are quite very interesting.Unfortunately, there is no suitable position for your applications.\r\n\r\nWe have continued keeping your information until a suitable position will be posted.\r\n\r\nRegards!\r\n\r\nMilestone\r\n'),
('4', 'Congratulation', '<p>Hello candidate!  Congratulation!&nbsp;We send this email to thank for using our services.  Wish that you will happy with a new job.  Regards!  Milestone</p>'),
('5', 'Three month follow up email', '<p><span>(FirstName),</span></p>\r\n<p><span>Hope life is treating you very well.</span></p>\r\n<p><span>(FirstName), it&rsquo;s been some time since we last spoke and I was keen to see how it was all going. I think from memory you indicated that you were on contract and I was curious how that was all going? Is there anything I can do for you at all? </span></p>\r\n<p><span>Looking forward to your feedback.</span></p>\r\n<p><span><br /></span></p>\r\n<p>Best Regards,</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Raman Richards</strong></p>\r\n<p><strong>B.A.(SOCIOLOGY)</strong></p>\r\n<p>IT Infrastructure Specialist - Senior Consultant</p>\r\n<p>Milestone Search Pty Ltd <br /> Level 6<br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889 <span style=\"text-decoration: underline;\"><br /> </span><a title=\"http://www.evergreenit.com.au/\" href=\"blocked::http:/www.evergreenit.com.au/\">http://www.milestonesearch.com.au</a>&nbsp;<br /> <br /></p>\r\n<p><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p><br /> t&amp;cs.... <br /> Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd. <br /> &nbsp;<br /> You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('6', '9 days after representation(2)', '<p>(FirstName),&nbsp;</p>\r\n<p>I&rsquo;m still waiting for feedback from my client about securing something further for you however at this stage I still haven&rsquo;t heard back from them.&nbsp;</p>\r\n<p>There is no doubt that your skills and experience are ideal for this role so the question in my mind is are they still serious about engaging someone of your ability for this role.&nbsp;</p>\r\n<p>As soon as I can get some feedback I&rsquo;ll be straight on the phone to you.&nbsp;</p>\r\n<p>As I indicated, you&rsquo;re an ideal candidate and I am keen to get some traction on this for your behalf.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Thanks and speak soon.&nbsp;</p>\r\n<p>Best Regards,</p>\r\n<p>&nbsp;</p>\r\n<p><strong>David Sparrius</strong></p>\r\n<p><strong>B.A.(Psychology)</strong></p>\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"399\" valign=\"top\">\r\n<p>Principal Consultant</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n<td width=\"399\" valign=\"top\">\r\n<p>&nbsp;</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 1060 Hay St<br /> West Perth WA 6872 <br /> Phone (08) 9480 0409 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('8', 'Email to clients - milestone search', '<p>Hello (FirstName),</p>\r\n<p>&nbsp;</p>\r\n<p>The difference between Milestone Search and the other IT recruitment agencies in Australia is that we take a pro-active approach in the way that we recruit. A majority of agencies will simply put an advertisement on one of the many job boards and wait for a response. Studies have shown that these candidates that apply to our competitors advertisements are normally in the bottom 10% in their field in relation to capability, to put it simply, if you are the best at what you do, you should always be employed. This is where Milestone Search is different, we understand that the our clients want the best candidates for the positions they are looking to fill, so therefore Milestone Search will approach your competitors, find the best person for the position and after extensively qualifying that candidate we will then represent them to you.</p>\r\n<p>&nbsp;</p>\r\n<p>(FirstName), what this means that you will not be seeing the same caliber of candidates that you would normally expect to see from other recruitment agencies. You will be exposed to a percentage of the marketplace that you would not normally see, simply because our competitors do not look there. You will see quality candidates, who will be eager to work for your organization that will fulfill your recruitment needs. Furthermore, these candidates will be of a higher level of capability in comparison to the ones you normally deal with. I\'d encourage you to look at our on-line video for more information about how we do this ;</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://www.milestonesearch.com.au/solutions/\">http://www.milestonesearch.com.au/solutions/</a></p>\r\n<p>&nbsp;</p>\r\n<p>(FirstName), as a specialist IT recruiter, I have been dealing with clients that are similar to your organization such as CSC, IBM, EDS and many others. Due to our model and our specialization, I pride myself on constantly delivering a higher caliber of candidates that have been successful in the roles they have been put into, hence the reason why I have been able to work time and time again with the same organizations. Once being approved to work your vacancies, I will dedicate 100% of my time not only to finding you the best candidate but also in qualifying the role with that candidates so that I don&rsquo;t waste your time. Being in the position you have I understand that you must be under pressure and that you want the time that you dedicate to recruitment to be as effective as possible.</p>\r\n<p>&nbsp;</p>\r\n<p>(FirstName), I believe that actions speak louder than words, I hope that you will give myself the opportunity to work with you and prove to you that we are able to deliver a higher quality group of candidates than our competitors which will make your life easier.&nbsp; (FirstName), once you see the results that Milestone Search delivers you will see that benefit of using our organization to fulfill your recruitment needs and you will continue to use us your number 1 recruitment source.</p>\r\n<p><br /> <strong>David Sparrius</strong> <br /> Principal Consultant</p>\r\n<p><a href=\"http://www.milestonesearch.com.au\">http://www.milestonesearch.com.au</a></p>\r\n<p>Level 6<br /> 140&nbsp;Queen St, Melbourne <br /> Phone : (03) 9670 6682 <br /> &nbsp;&nbsp;&nbsp; Fax : (03) 9670 6889&nbsp;</p>\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('9', '2 week follow up on contractor', '<p>Hi (FirstName),</p>\r\n<p>I was keen to touch base with you to determine how things were tracking and more specifically understand if everything is tracking ok?</p>\r\n<p>Is there anything I can do for you from my end?</p>\r\n<p>Thanks and looking forward to your feedback.</p>\r\n<p>&nbsp;</p>\r\n<p>Best Regards,</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Raman Richards</strong></p>\r\n<p><strong>B.A.(SOCIOLOGY)</strong></p>\r\n<p>IT Infrastructure Specialist - Senior Consultant</p>\r\n<p>Milestone Search Pty Ltd <br /> Level 6<br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889 <span style=\"text-decoration: underline;\"><br /> </span><a title=\"http://www.evergreenit.com.au/\" href=\"blocked::http:/www.evergreenit.com.au/\">http://www.milestonesearch.com.au</a></p>\r\n&nbsp;\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('10', '1 month - touch base', '<p>(FirstName),</p>\r\n<p>&nbsp;</p>\r\n<p>As promised, I am keeping you in mind for any opportunities I can identify that I feel you may be suitable for.</p>\r\n<p>&nbsp;</p>\r\n<p>I&rsquo;ve spoken to a couple of potential clients about your skills and experience, however at this stage, secured nothing formal yet.</p>\r\n<p>&nbsp;</p>\r\n<p>There is one potential opportunity I have in mind for you which I feel may be very suitable and I am very keen to run it past you, however, I am still waiting for confirmation from my client to confirm that they are ready to move forward. I&rsquo;ll let you know how it tracks moving forward.</p>\r\n<p>&nbsp;</p>\r\n<p>From your end, how are you finding the market place? Has your situation changed at all or are you still open to other opportunities?</p>\r\n<p>&nbsp;</p>\r\n<p>Have a great day and speak soon.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><br /> Best Regards,</p>\r\n<p>&nbsp;</p>\r\n<p><strong>David Sparrius</strong></p>\r\n<p><strong>B.A.(Psychology)</strong></p>\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"399\" valign=\"top\">\r\n<p>Principal Consultant</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n<td width=\"399\" valign=\"top\">\r\n<p>&nbsp;</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 1060 Hay St<br /> West Perth WA 6872 <br /> Phone (08) 9480 0409 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style=\"text-decoration: underline;\"><br /> </span><a title=\"http://www.evergreenit.com.au/\" href=\"blocked::http:/www.evergreenit.com.au/\">http://www.milestonesearch.com.au</a>&nbsp;<br /> &nbsp;@milestonesearch (twitter)</p>\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('11', '7 week email', '<p>Hi (FirstName),</p>\r\n<p>&nbsp;</p>\r\n<p>When I spoke with you previously, I indicated that there was a potential opportunity which I felt you may be ideal for and was waiting for my client to confirm it. I just wanted to drop you a note to let you know that they have just told me that they have put the position on hold due to budget constraints. However, having said that, I still believe that you are a fantastic candidate and would be keen to stay in touch with you to help you identify any other roles.</p>\r\n<p>&nbsp;</p>\r\n<p>How are things tracking from your end? Have you managed to secure any other interviews?</p>\r\n<p>&nbsp;</p>\r\n<p>As I said, I&rsquo;m hoping to get some traction for you shortly and will be in touch as soon as I have identified something more concrete.</p>\r\n<p>&nbsp;</p>\r\n<p>Thanks and looking forward to speaking with you soon.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><br /> Best Regards,</p>\r\n<p>&nbsp;</p>\r\n<p><strong>David Sparrius</strong></p>\r\n<p><strong>B.A.(Psychology)</strong></p>\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"399\" valign=\"top\">\r\n<p>Principal Consultant</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n<td width=\"399\" valign=\"top\">\r\n<p>&nbsp;</p>\r\n<p>Milestone Search Pty Ltd <br /> Level   3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <br /> 1060 Hay St<br /> West Perth WA 6872 <br /> Phone (08) 9480 0409 <br /> Fax (03) 9670 6889</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style=\"text-decoration: underline;\"><br /> </span><a title=\"http://www.evergreenit.com.au/\" href=\"blocked::http:/www.evergreenit.com.au/\">http://www.milestonesearch.com.au</a>&nbsp;<br /> &nbsp;@milestonesearch (twitter)</p>\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('12', 'Stay in touch - perm', '<p>Hi (FirstName),</p>\r\n<p>&nbsp;</p>\r\n<p>Just thought I&rsquo;d drop you a line to see how it was all going for you? Since we spoke, I have had a good look around and have a couple of potential opportunities in the pipe-line but at this stage nothing is confirmed.</p>\r\n<p>&nbsp;</p>\r\n<p>The employment market place at the moment seems to be unprecedented by anything I have experienced thus far and I was wondering how you were finding it?</p>\r\n<p>&nbsp;</p>\r\n<p>How are you traveling and how are you finding the market generally speaking ? Have you managed to secure any interviews yet and should I keep looking for you? Also, are your salary expectations still the same or have you thought further about it at all?</p>\r\n<p>&nbsp;</p>\r\n<p>Take care and speak with you soon.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>David Sparrius</strong> <br /> Principal Consultant</p>\r\n<p>http://www.milestonesearch.com.au</p>\r\n<p>Level 6<br /> 140&nbsp;Queen St, Melbourne <br /> Phone : (03) 9670 6682 <br /> &nbsp;&nbsp;&nbsp; Fax : (03) 9670 6889&nbsp;</p>\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>'),
('13', 'Submitting to client', '<p>(FirstName),</p>\r\n<p>&nbsp;</p>\r\n<p>Thanks very much for the time you made available to me today to discuss this outstanding opportunity.</p>\r\n<p>&nbsp;</p>\r\n<p>I feel confident that you are a brilliant candidate and I believe that you&rsquo;ll find this opportunity to be exciting, interesting and challenging.</p>\r\n<p>&nbsp;</p>\r\n<p>As I indicated, I will be putting your details forward to (&ldquo;&nbsp; &ldquo;) as a matter of priority. I feel that you are a great match and anticipate some feedback from them in relation to organizing an interview for you shortly.</p>\r\n<p>&nbsp;</p>\r\n<p>In the meantime, I require an e-mail giving me your authority to present you so that we can help secure this opportunity for you.</p>\r\n<p>&nbsp;</p>\r\n<p>As such, could you please send me an e-mail which states;</p>\r\n<p><strong><em>&ldquo;I give Milestone Search exclusive rights to represent my candidature to () for a period of 90 days in accordance with Milestones terms and conditions&rdquo;</em></strong></p>\r\n<p>&nbsp;</p>\r\n<p>As discussed, Milestone Search is a leading executive and IT recruitment firm that deal with only the very best corporate in the Asia Pacific Region. We have 15+ consultants in the Melbourne Office and have strong relationships with many organizations based on delivering the very best people in the market place.</p>\r\n<p>&nbsp;</p>\r\n<p>One thing I should mention is that Milestone Search WILL NOT submit a candidates details to a client without ;</p>\r\n<p>&nbsp;</p>\r\n<p>&gt;&gt; Identifying that budget has been approved.</p>\r\n<p>&gt;&gt; Identifying that the role has been correctly scoped.</p>\r\n<p>&gt;&gt; Identifying where, with who, and when the vacancy was identified.</p>\r\n<p>&gt;&gt; Ensuring the client is ready to interview, ready to hire, and ready to make a decision quickly.</p>\r\n<p>&nbsp;</p>\r\n<p>We see our candidates and clients as both essential to our business model and seek to deliver the very best level of service to both at all times.</p>\r\n<p>&nbsp;</p>\r\n<p>If you would like to review our business, please have a look at our website, which is <a href=\"http://www.milestonesearch.com.au\">http://www.milestonesearch.com.au</a></p>\r\n<p>&nbsp;</p>\r\n<p>A note of warning&hellip;..</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; There are some unethical agencies who are currently contacting candidates seeking to identify exclusively who and where these candidates have been presented so that they can build a lead list. They may ask you, &ldquo;Who have you had your resume presented to&rdquo;, or, &ldquo;So that I don&rsquo;t represent you to the same client twice, I need to know who your details have been presented to.&rdquo; It is important that you understand that this is asked to <strong>identify </strong>which clients have vacancies. These agencies will then seek to identify an alternative candidate and make the placement. This could possibly cost you a great job opportunity and as such I&rsquo;d encourage you to remain tight lipped about it.</p>\r\n<p>&nbsp;</p>\r\n<p>I am convinced you&rsquo;re a great candidate and look forward to working with you to try and secure this engagement for you.</p>\r\n<p>&nbsp;</p>\r\n<p>In the mean time, if you happen to have any questions, or if there is anything further that you require from me, please do not hesitate to ask.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Best Regards,</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p>Nick Teplin</p>\r\n<p><strong>IT Recruitment Specialist</strong></p>\r\n<p>Milestone Search<br /> Level 6<br /> 140 Queen Street <br /> Melbourne Vic 3000 <br /> Phone (03) 9670 6682 <br /> Fax (03) 9670 6889 <br /> http://www.milestonesearch.com.au</p>\r\n<p>@milestonesearch (twitter)</p>\r\n<p><br /><img title=\"Milestone Logo\" src=\"../images/milestone_logo.jpg\" alt=\"Milestone Logo\" width=\"220\" height=\"147\" /></p>\r\n<p>&nbsp;</p>\r\n<p><br />t&amp;cs....&nbsp;<br />Please note that by using any information in this document, you agree to be bound by the standard terms and conditions of Milestone Search, Pty, Ltd.&nbsp;<br />&nbsp;<br />You agree not to employ or arrange employment for any candidate(s)supplied in this document without first entering into a contractual agreement with Milestone Search Pty Ltd. You further agree not to divulge any information contained in this document to any person(s) or entities without the express permission of Milestone Search Pty Ltd.</p>');

CREATE TABLE `wfa_template_for_candidate` (
   `wfa_temp_can_id` int(11) not null auto_increment,
   `wfa_template_ID` int(5) not null,
   `wfa_id` int(5) not null,
   `candidate_ID` varchar(20) not null,
   `date_sent` date,
   `comment` text,
   `enduration` date,
   `sent_status` tinyint(1) not null,
   PRIMARY KEY (`wfa_temp_can_id`),
   KEY `candidate_ID` (`candidate_ID`),
   KEY `wfa_id` (`wfa_id`),
   KEY `wfa_template_ID` (`wfa_template_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=42;

INSERT INTO `wfa_template_for_candidate` (`wfa_temp_can_id`, `wfa_template_ID`, `wfa_id`, `candidate_ID`, `date_sent`, `comment`, `enduration`, `sent_status`) VALUES 
('1', '2', '2', '20101121141950000012', '2011-06-20', '', '2011-03-31', '1'),
('2', '3', '2', '20101121141950000012', '2011-06-20', '', '2011-04-05', '1'),
('5', '1', '4', '20101121144037000013', '', '', '2011-03-31', '0'),
('6', '2', '4', '20101121144037000013', '', '', '2011-04-08', '0'),
('9', '1', '1', '20101121225000000015', '', '', '2011-03-29', '0'),
('10', '2', '1', '20101121225000000015', '', '', '2011-03-31', '0'),
('11', '3', '1', '20101121225000000015', '', '', '2011-04-01', '0'),
('12', '1', '1', '20101007023801000001', '', '', '2011-03-11', '0'),
('13', '2', '1', '20101007023801000001', '', '', '2011-03-13', '0'),
('14', '3', '1', '20101007023801000001', '', '', '2011-03-14', '0'),
('15', '3', '2', '20101007024001000002', '', '', '2011-03-16', '0'),
('16', '2', '2', '20101007024001000002', '', '', '2011-03-21', '0'),
('17', '1', '3', '20101103153030000005', '', '', '2011-03-20', '0'),
('18', '2', '3', '20101103153030000005', '', '', '2011-04-07', '0'),
('19', '4', '3', '20101103153030000005', '', '', '2011-04-27', '0'),
('20', '1', '4', '20101118035137000008', '2011-06-20', '', '2011-03-17', '1'),
('21', '2', '4', '20101118035137000008', '2011-06-20', '', '2011-03-25', '1'),
('29', '2', '2', '20110516140200000021', '', '', '2011-05-21', '0'),
('30', '3', '2', '20110516140200000021', '', '', '2011-05-16', '0'),
('31', '1', '1', '20110516140200000021', '2011-06-20', '', '2011-05-26', '1'),
('32', '2', '1', '20110516140200000021', '2011-06-01', '', '2011-05-17', '1'),
('33', '4', '1', '20110516140200000021', '2011-06-01', '', '2011-05-24', '1'),
('34', '5', '1', '20110516140200000021', '2011-06-01', '', '2011-05-16', '1'),
('35', '1', '1', '20101118035137000008', '2011-06-20', '', '2010-11-28', '1'),
('36', '2', '1', '20101118035137000008', '2011-06-20', '', '2010-11-19', '1'),
('37', '4', '1', '20101118035137000008', '2011-06-20', '', '2010-11-26', '1'),
('38', '5', '1', '20101118035137000008', '2011-06-20', '', '2010-11-18', '1'),
('39', '8', '5', '20101103153030000005', '2011-06-20', '', '2010-11-15', '1'),
('40', '9', '5', '20101103153030000005', '', '', '2010-11-27', '0'),
('41', '12', '5', '20101103153030000005', '2011-06-20', '', '2010-11-20', '1');