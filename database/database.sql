--
-- Dumping data for table `employee_general_info`
--

INSERT INTO `employee_general_info` (`id`, `first_name`, `last_name`, `email`, `password`, `email_verified_at`, `remember_token`, `phone`, `address`, `pin`, `dob`, `status`, `profile_image`, `is_superadmin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dialmenow', '', 'superadmin@dialmenow.com', '$2y$10$uZDwEdgAzi3wD4n8oBYfruvBmZJqVV7sSasFRZzlz5Wkqs0EyqiDe', NULL, NULL, '82337341', NULL, NULL, '2022-03-18', '1', 'employee_images/3me7j6mobOCi39JuXdhjy2BmrpIWfv6l7Cjs2tSH.png', '1', NULL, '2022-03-29 12:30:52', NULL);

--
-- Dumping data for table `master_roles`
--

INSERT INTO `master_roles` (`id`, `name`, `guard_name`,`is_fixed`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web','1', '2020-03-10 11:40:47', '2020-03-10 11:40:47'),
(2, 'Admin', 'web','0', '2020-03-10 12:39:23', '2020-03-10 12:39:23'),
(3, 'Project Manager', 'web','1', '2020-03-12 12:11:50', '2020-03-12 12:11:50'),
(4, 'Operational Supervisor', 'web','1', '2020-03-12 12:12:07', '2020-03-12 12:12:07');

--
-- Dumping data for table `master_modules`
--

INSERT INTO `master_modules` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Employee', 'manage employee ', '2021-08-16 10:41:17', NULL),
(2, 'Master Roles', 'Manage Roles', '2021-09-03 10:41:17', NULL);


--
-- Dumping data for table `setting_company`
--

INSERT INTO `setting_company` (`id`, `company_name`, `company_logo`, `email_logo`, `report_logo`, `address`, `email`, `phone`, `website`, `currency`, `favi_icon`, `hostname`, `username`, `port`, `password`, `no_reply_mail`, `director_name`, `reg_no`, `company_service`, `quotation_code`, `show_sales_price`, `emergency_number`, `created_at`, `updated_at`) VALUES
(1, 'Dialmenow', '20220329071818-.png', '20210826124527.png', 'logo_white.png', '45 Kallang Pudding Road, Alpha Building #10-10,Singapore 349317', 'admin@test.com', '1234567890', 'https://flyingfreely.orbitnapp.com/', '$', '20220328101913.png', 'smtp.gmail.com', 'noreply@mtoag.com', '587', 'T:DH6*.ddA!S=%(-', 'mtoagcrm@mtoag.com', 'A Abilesh', '123', 'Building Cleaning Services, Landscaping, Maintenance', 'VJR-Q', NULL, '911', '2021-08-30 22:53:53', '2022-03-31 09:18:08');

COMMIT;
