-- =====================================================
-- Credit Union Market Profile Database Schema
-- =====================================================
-- This schema stores data from the CU Market Profile 2025 form
-- with a foreign key relationship to a federation account
-- =====================================================

-- Drop tables if they exist (in reverse order of dependencies)
DROP TABLE IF EXISTS cu_board_members;
DROP TABLE IF EXISTS cu_regulator;
DROP TABLE IF EXISTS cu_federation_manpower;
DROP TABLE IF EXISTS cu_business_operations;
DROP TABLE IF EXISTS cu_financial_performance;
DROP TABLE IF EXISTS cu_membership_info;
DROP TABLE IF EXISTS cu_federation_info;
DROP TABLE IF EXISTS cu_movement_manpower;
DROP TABLE IF EXISTS cu_financial_structure;
DROP TABLE IF EXISTS cu_assets;
DROP TABLE IF EXISTS cu_individual_members;
DROP TABLE IF EXISTS cu_memberships;
DROP TABLE IF EXISTS cu_country_profile;
DROP TABLE IF EXISTS cu_market_profile;

-- =====================================================
-- Main Market Profile Table (Parent table for all profile data)
-- =====================================================
CREATE TABLE cu_market_profile (
                                   profile_id INT AUTO_INCREMENT PRIMARY KEY,
                                   federation_id INT NOT NULL,
                                   organization_name VARCHAR(255) NOT NULL,
                                   address TEXT,
                                   telephone VARCHAR(50),
                                   fax VARCHAR(50),
                                   email VARCHAR(255),
                                   website VARCHAR(255),
                                   submission_date DATE,
                                   respondent_name VARCHAR(255),
                                   response_date DATE,
                                   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                   FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                   INDEX idx_federation (federation_id),
                                   INDEX idx_submission_date (submission_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Country Profile Table
-- =====================================================
CREATE TABLE cu_country_profile (
                                    country_profile_id INT AUTO_INCREMENT PRIMARY KEY,
                                    profile_id INT NOT NULL,
                                    federation_id INT NOT NULL,
                                    population_2024 BIGINT NULL DEFAULT 0,
                                    gdp_usd VARCHAR(100),
                                    gdp_per_capita_usd DECIMAL(15,2),
                                    local_currency VARCHAR(100),
                                    exchange_rate_dec_2024 DECIMAL(15,4),
                                    cu_penetration VARCHAR(100),
                                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                    FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                    FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                    INDEX idx_profile (profile_id),
                                    INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Section A: Credit Union Movement Level
-- =====================================================

-- 1) Credit Unions and Memberships
CREATE TABLE cu_memberships (
                                membership_id INT AUTO_INCREMENT PRIMARY KEY,
                                profile_id INT NOT NULL,
                                federation_id INT NOT NULL,

    -- Urban CUs
                                urban_cu INT DEFAULT 0,
                                urban_members INT DEFAULT 0,
                                urban_lt300 INT DEFAULT 0,
                                urban_301_1000 INT DEFAULT 0,
                                urban_1001_3000 INT DEFAULT 0,
                                urban_3001_5000 INT DEFAULT 0,
                                urban_gt5000 INT DEFAULT 0,

    -- Rural CUs
                                rural_cu INT DEFAULT 0,
                                rural_members INT DEFAULT 0,
                                rural_lt300 INT DEFAULT 0,
                                rural_301_1000 INT DEFAULT 0,
                                rural_1001_3000 INT DEFAULT 0,
                                rural_3001_5000 INT DEFAULT 0,
                                rural_gt5000 INT DEFAULT 0,

    -- Total CUs
                                total_cu INT DEFAULT 0,
                                total_members INT DEFAULT 0,
                                total_lt300 INT DEFAULT 0,
                                total_301_1000 INT DEFAULT 0,
                                total_1001_3000 INT DEFAULT 0,
                                total_3001_5000 INT DEFAULT 0,
                                total_gt5000 INT DEFAULT 0,

    -- Microfinance
                                cus_microfinance INT DEFAULT 0,

                                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                INDEX idx_profile (profile_id),
                                INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3) Individual Members: Based on Area, Age, and Sex
CREATE TABLE cu_individual_members (
                                       individual_members_id INT AUTO_INCREMENT PRIMARY KEY,
                                       profile_id INT NOT NULL,
                                       federation_id INT NOT NULL,

    -- Urban Members
                                       urban_ind_members INT DEFAULT 0,
                                       urban_male INT DEFAULT 0,
                                       urban_female INT DEFAULT 0,
                                       urban_age_lt20 INT DEFAULT 0,
                                       urban_age_20_40 INT DEFAULT 0,
                                       urban_age_40_60 INT DEFAULT 0,
                                       urban_age_gt60 INT DEFAULT 0,

    -- Rural Members
                                       rural_ind_members INT DEFAULT 0,
                                       rural_male INT DEFAULT 0,
                                       rural_female INT DEFAULT 0,
                                       rural_age_lt20 INT DEFAULT 0,
                                       rural_age_20_40 INT DEFAULT 0,
                                       rural_age_40_60 INT DEFAULT 0,
                                       rural_age_gt60 INT DEFAULT 0,

    -- Total Members
                                       total_ind_members INT DEFAULT 0,
                                       total_male INT DEFAULT 0,
                                       total_female INT DEFAULT 0,
                                       total_age_lt20 INT DEFAULT 0,
                                       total_age_20_40 INT DEFAULT 0,
                                       total_age_40_60 INT DEFAULT 0,
                                       total_age_gt60 INT DEFAULT 0,

                                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                       FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                       FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                       INDEX idx_profile (profile_id),
                                       INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) Assets of the CU Movement
CREATE TABLE cu_assets (
                           assets_id INT AUTO_INCREMENT PRIMARY KEY,
                           profile_id INT NOT NULL,
                           federation_id INT NOT NULL,

    -- Urban Assets
                           urban_total_assets DECIMAL(20,2) DEFAULT 0,
                           urban_assets_lt100k INT DEFAULT 0,
                           urban_assets_100k_500k INT DEFAULT 0,
                           urban_assets_500k_1m INT DEFAULT 0,
                           urban_assets_gt1m INT DEFAULT 0,

    -- Rural Assets
                           rural_total_assets DECIMAL(20,2) DEFAULT 0,
                           rural_assets_lt100k INT DEFAULT 0,
                           rural_assets_100k_500k INT DEFAULT 0,
                           rural_assets_500k_1m INT DEFAULT 0,
                           rural_assets_gt1m INT DEFAULT 0,

    -- Total Assets
                           total_assets DECIMAL(20,2) DEFAULT 0,
                           total_assets_lt100k INT DEFAULT 0,
                           total_assets_100k_500k INT DEFAULT 0,
                           total_assets_500k_1m INT DEFAULT 0,
                           total_assets_gt1m INT DEFAULT 0,

                           created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                           updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                           FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                           FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                           INDEX idx_profile (profile_id),
                           INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5) Financial Structure of the Movement
CREATE TABLE cu_financial_structure (
                                        financial_structure_id INT AUTO_INCREMENT PRIMARY KEY,
                                        profile_id INT NOT NULL,
                                        federation_id INT NOT NULL,

    -- Share
                                        share_amount DECIMAL(20,2) DEFAULT 0,
                                        share_male DECIMAL(20,2) DEFAULT 0,
                                        share_female DECIMAL(20,2) DEFAULT 0,
                                        share_youth DECIMAL(20,2) DEFAULT 0,
                                        share_non_members DECIMAL(20,2) DEFAULT 0,

    -- Savings/Other Deposits
                                        savings_amount DECIMAL(20,2) DEFAULT 0,
                                        savings_male DECIMAL(20,2) DEFAULT 0,
                                        savings_female DECIMAL(20,2) DEFAULT 0,
                                        savings_youth DECIMAL(20,2) DEFAULT 0,
                                        savings_non_members DECIMAL(20,2) DEFAULT 0,

    -- Delinquency Loan
                                        delinquency_amount DECIMAL(20,2) DEFAULT 0,
                                        delinquency_male DECIMAL(20,2) DEFAULT 0,
                                        delinquency_female DECIMAL(20,2) DEFAULT 0,
                                        delinquency_youth DECIMAL(20,2) DEFAULT 0,
                                        delinquency_non_members DECIMAL(20,2) DEFAULT 0,

    -- Loan Outstanding
                                        loan_outstanding_amount DECIMAL(20,2) DEFAULT 0,
                                        loan_outstanding_male DECIMAL(20,2) DEFAULT 0,
                                        loan_outstanding_female DECIMAL(20,2) DEFAULT 0,
                                        loan_outstanding_youth DECIMAL(20,2) DEFAULT 0,
                                        loan_outstanding_non_members DECIMAL(20,2) DEFAULT 0,

    -- Total Loan Granted
                                        total_loan_granted_amount DECIMAL(20,2) DEFAULT 0,
                                        total_loan_granted_male DECIMAL(20,2) DEFAULT 0,
                                        total_loan_granted_female DECIMAL(20,2) DEFAULT 0,
                                        total_loan_granted_youth DECIMAL(20,2) DEFAULT 0,
                                        total_loan_granted_non_members DECIMAL(20,2) DEFAULT 0,

    -- Total Reserved
                                        total_reserved_amount DECIMAL(20,2) DEFAULT 0,
                                        total_reserved_male DECIMAL(20,2) DEFAULT 0,
                                        total_reserved_female DECIMAL(20,2) DEFAULT 0,
                                        total_reserved_youth DECIMAL(20,2) DEFAULT 0,
                                        total_reserved_non_members DECIMAL(20,2) DEFAULT 0,

                                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                        FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                        FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                        INDEX idx_profile (profile_id),
                                        INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6) Number of Manpower of the CU Movement
CREATE TABLE cu_movement_manpower (
                                      movement_manpower_id INT AUTO_INCREMENT PRIMARY KEY,
                                      profile_id INT NOT NULL,
                                      federation_id INT NOT NULL,

                                      elected_officers_male INT DEFAULT 0,
                                      elected_officers_female INT DEFAULT 0,
                                      elected_officers_total INT DEFAULT 0,

                                      senior_managers_male INT DEFAULT 0,
                                      senior_managers_female INT DEFAULT 0,
                                      senior_managers_total INT DEFAULT 0,

                                      staff_male INT DEFAULT 0,
                                      staff_female INT DEFAULT 0,
                                      staff_total INT DEFAULT 0,

                                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                      FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                      FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                      INDEX idx_profile (profile_id),
                                      INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Section B: Credit Union Federation Level
-- =====================================================

-- 1. General Information & 2. Membership Information
CREATE TABLE cu_federation_info (
                                    federation_info_id INT AUTO_INCREMENT PRIMARY KEY,
                                    profile_id INT NOT NULL,
                                    federation_id INT NOT NULL,

    -- General Information
                                    fed_name VARCHAR(255),
                                    reg_date DATE,
                                    reg_number VARCHAR(100),
                                    primary_activity TEXT,
                                    fed_address TEXT,
                                    fed_phone VARCHAR(50),
                                    fed_email VARCHAR(255),
                                    fed_website VARCHAR(255),

    -- Membership Information
                                    total_member_cus INT DEFAULT 0,
                                    active_member_cus INT DEFAULT 0,
                                    ind_member_total INT DEFAULT 0,
                                    ind_member_male INT DEFAULT 0,
                                    ind_member_female INT DEFAULT 0,
                                    membership_growth VARCHAR(50),

                                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                    FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                    FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                    INDEX idx_profile (profile_id),
                                    INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Financial Performance (Federation level)
CREATE TABLE cu_financial_performance (
                                          financial_performance_id INT AUTO_INCREMENT PRIMARY KEY,
                                          profile_id INT NOT NULL,
                                          federation_id INT NOT NULL,

    -- Assets
                                          assets_2024 DECIMAL(20,2) DEFAULT 0,
                                          assets_2025 DECIMAL(20,2) DEFAULT 0,
                                          assets_increase DECIMAL(10,2) DEFAULT 0,

    -- Loans Outstanding
                                          loans_outstanding_2024 DECIMAL(20,2) DEFAULT 0,
                                          loans_outstanding_2025 DECIMAL(20,2) DEFAULT 0,
                                          loans_outstanding_increase DECIMAL(10,2) DEFAULT 0,

    -- Share Capital
                                          share_capital_2024 DECIMAL(20,2) DEFAULT 0,
                                          share_capital_2025 DECIMAL(20,2) DEFAULT 0,
                                          share_capital_increase DECIMAL(10,2) DEFAULT 0,

    -- Deposits
                                          deposits_2024 DECIMAL(20,2) DEFAULT 0,
                                          deposits_2025 DECIMAL(20,2) DEFAULT 0,
                                          deposits_increase DECIMAL(10,2) DEFAULT 0,

    -- External Borrowings
                                          borrowings_2024 DECIMAL(20,2) DEFAULT 0,
                                          borrowings_2025 DECIMAL(20,2) DEFAULT 0,
                                          borrowings_increase DECIMAL(10,2) DEFAULT 0,

    -- Net Institutional Capital
                                          institutional_capital_2024 DECIMAL(20,2) DEFAULT 0,
                                          institutional_capital_2025 DECIMAL(20,2) DEFAULT 0,
                                          institutional_capital_increase DECIMAL(10,2) DEFAULT 0,

    -- NPL
                                          npl_2024 DECIMAL(20,2) DEFAULT 0,
                                          npl_2025 DECIMAL(20,2) DEFAULT 0,
                                          npl_increase DECIMAL(10,2) DEFAULT 0,

    -- ROE
                                          roe_2024 DECIMAL(10,2) DEFAULT 0,
                                          roe_2025 DECIMAL(10,2) DEFAULT 0,
                                          roe_increase DECIMAL(10,2) DEFAULT 0,

    -- Capital Adequacy Ratio
                                          car_2024 DECIMAL(10,2) DEFAULT 0,
                                          car_2025 DECIMAL(10,2) DEFAULT 0,
                                          car_increase DECIMAL(10,2) DEFAULT 0,

                                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                          FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                          FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                          INDEX idx_profile (profile_id),
                                          INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Business Operations & Services
CREATE TABLE cu_business_operations (
                                        business_operations_id INT AUTO_INCREMENT PRIMARY KEY,
                                        profile_id INT NOT NULL,
                                        federation_id INT NOT NULL,

                                        fed_services TEXT,
                                        staff_engage INT DEFAULT 0,

    -- Technology Usage
                                        core_banking ENUM('yes', 'no') DEFAULT 'no',
                                        mobile_banking ENUM('yes', 'no') DEFAULT 'no',
                                        internet_banking ENUM('yes', 'no') DEFAULT 'no',
                                        money_transfer ENUM('yes', 'no') DEFAULT 'no',
                                        other_digital_services TEXT,

    -- Product Offerings
                                        loan_products TEXT,
                                        savings_products TEXT,

    -- Training and Education
                                        professional_training ENUM('yes', 'no') DEFAULT 'no',
                                        technical_training ENUM('yes', 'no') DEFAULT 'no',
                                        basic_training ENUM('yes', 'no') DEFAULT 'no',
                                        consultancy ENUM('yes', 'no') DEFAULT 'no',

    -- Supervision and Monitoring
                                        auditing ENUM('yes', 'no') DEFAULT 'no',
                                        supervision ENUM('yes', 'no') DEFAULT 'no',
                                        stabilization ENUM('yes', 'no') DEFAULT 'no',

                                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                        FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                        FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                        INDEX idx_profile (profile_id),
                                        INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Board Members
CREATE TABLE cu_board_members (
                                  board_member_id INT AUTO_INCREMENT PRIMARY KEY,
                                  profile_id INT NOT NULL,
                                  federation_id INT NOT NULL,

                                  member_number INT NOT NULL,
                                  name VARCHAR(255),
                                  gender ENUM('Male', 'Female'),
                                  position VARCHAR(255),
                                  email VARCHAR(255),

                                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                  FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                  FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                  INDEX idx_profile (profile_id),
                                  INDEX idx_federation (federation_id),
                                  INDEX idx_member_number (member_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Federation Manpower
CREATE TABLE cu_federation_manpower (
                                        federation_manpower_id INT AUTO_INCREMENT PRIMARY KEY,
                                        profile_id INT NOT NULL,
                                        federation_id INT NOT NULL,

                                        total_employees_male INT DEFAULT 0,
                                        total_employees_female INT DEFAULT 0,

                                        exec_employees_male INT DEFAULT 0,
                                        exec_employees_female INT DEFAULT 0,

                                        fulltime_employees_male INT DEFAULT 0,
                                        fulltime_employees_female INT DEFAULT 0,

                                        parttime_employees_male INT DEFAULT 0,
                                        parttime_employees_female INT DEFAULT 0,

                                        exec_staff_names TEXT,

                                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                                        FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                                        FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                                        INDEX idx_profile (profile_id),
                                        INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Regulator
CREATE TABLE cu_regulator (
                              regulator_id INT AUTO_INCREMENT PRIMARY KEY,
                              profile_id INT NOT NULL,
                              federation_id INT NOT NULL,

                              regulator_name VARCHAR(255),
                              regulator_address TEXT,
                              regulator_tel VARCHAR(50),
                              regulator_fax VARCHAR(50),
                              regulator_email VARCHAR(255),
                              regulator_website VARCHAR(255),

                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

                              FOREIGN KEY (profile_id) REFERENCES cu_market_profile(profile_id) ON DELETE CASCADE,
                              FOREIGN KEY (federation_id) REFERENCES federation(id) ON DELETE CASCADE,
                              INDEX idx_profile (profile_id),
                              INDEX idx_federation (federation_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Challenges and Opportunities (stored in main profile table extension)
ALTER TABLE cu_market_profile
    ADD COLUMN major_challenges TEXT,
ADD COLUMN opportunities TEXT;

-- =====================================================
-- Create Views for Easy Data Retrieval
-- =====================================================

-- Complete Profile View
# CREATE VIEW vw_complete_profile AS
# SELECT
#     mp.*,
#     cp.*,
#     mem.*,
#     im.*,
#     ast.*,
#     fs.*,
#     mm.*,
#     fi.*,
#     fp.*,
#     bo.*,
#     fm.*,
#     reg.*
# FROM cu_market_profile mp
#          LEFT JOIN cu_country_profile cp ON mp.profile_id = cp.profile_id
#          LEFT JOIN cu_memberships mem ON mp.profile_id = mem.profile_id
#          LEFT JOIN cu_individual_members im ON mp.profile_id = im.profile_id
#          LEFT JOIN cu_assets ast ON mp.profile_id = ast.profile_id
#          LEFT JOIN cu_financial_structure fs ON mp.profile_id = fs.profile_id
#          LEFT JOIN cu_movement_manpower mm ON mp.profile_id = mm.profile_id
#          LEFT JOIN cu_federation_info fi ON mp.profile_id = fi.profile_id
#          LEFT JOIN cu_financial_performance fp ON mp.profile_id = fp.profile_id
#          LEFT JOIN cu_business_operations bo ON mp.profile_id = bo.profile_id
#          LEFT JOIN cu_federation_manpower fm ON mp.profile_id = fm.profile_id
#          LEFT JOIN cu_regulator reg ON mp.profile_id = reg.profile_id;

-- Summary Statistics View
# CREATE VIEW vw_federation_summary AS
# SELECT
#     f.federation_id,
#     f.federation_name,
#     COUNT(DISTINCT mp.profile_id) as total_profiles,
#     MAX(mp.submission_date) as latest_submission,
#     SUM(mem.total_cu) as total_credit_unions,
#     SUM(mem.total_members) as total_members,
#     SUM(ast.total_assets) as total_assets
# FROM federation f
#          LEFT JOIN cu_market_profile mp ON f.id = mp.federation_id
#          LEFT JOIN cu_memberships mem ON mp.profile_id = mem.profile_id
#          LEFT JOIN cu_assets ast ON mp.profile_id = ast.profile_id
# GROUP BY f.id, f.name;
#
-- =====================================================
-- Sample Data (Optional - for testing)
-- =====================================================
-- =====================================================
-- Useful Queries
-- =====================================================

-- Get all profiles for a specific federation
-- SELECT * FROM cu_market_profile WHERE federation_id = 1;

-- Get complete profile data for a specific profile
-- SELECT * FROM vw_complete_profile WHERE profile_id = 1;

-- Get board members for a specific profile
-- SELECT * FROM cu_board_members WHERE profile_id = 1 ORDER BY member_number;

-- Get federation summary statistics
-- SELECT * FROM vw_federation_summary;

-- Get financial performance comparison
-- SELECT
--     federation_id,
--     assets_2024,
--     assets_2025,
--     assets_increase,
--     loans_outstanding_2024,
--     loans_outstanding_2025
-- FROM cu_financial_performance
-- WHERE federation_id = 1;