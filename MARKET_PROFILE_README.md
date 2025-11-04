# CU Market Profile 2025 Module - UPDATED

## Overview

This module displays **aggregated CU Market Profile data** across all federations in the CUNM system. It provides summary views grouped by year, showing network-wide statistics collected from federations.

**IMPORTANT**: This is a **reporting/summary module**, NOT a data entry system. It displays aggregated data that has been submitted by federations through the cu_market_profile tables.

## Purpose

The Market Profile module provides:
- **Year-based views** of collected data
- **Aggregated statistics** across all countries and federations
- **Summary reports** similar to the Excel worksheets structure
- **Network-wide analytics** for the Asian credit union movement

## Database Schema

The module reads data from tables defined in `v2.sql`:

### Main Tables Used:
- **cu_market_profile** - Profile submissions (grouped by YEAR(created_at))
- **cu_country_profile** - Country statistics
- **cu_memberships** - CU and membership data (aggregated)
- **cu_individual_members** - Demographics (aggregated)
- **cu_assets** - Asset distribution (aggregated by country)
- **cu_financial_structure** - Financial data (aggregated by country)
- **cu_movement_manpower** - Workforce statistics (aggregated)
- **cu_federation_info** - Federation information
- **cu_financial_performance** - Performance metrics

## Routes and URLs

### Main Routes

| Route | Description |
|-------|-------------|
| `/market_profile` | Main dashboard showing available years |
| `/market_profile/year/:year` | Year overview with section navigation |

### Summary Report Routes

All routes follow pattern: `/market_profile/year/:year/{section}`

| Route | Description |
|-------|-------------|
| `/market_profile/year/:year/country_profile` | Country economic profiles |
| `/market_profile/year/:year/memberships` | CU memberships summary with totals |
| `/market_profile/year/:year/individual_members` | Demographics summary |
| `/market_profile/year/:year/assets` | Assets summary by country |
| `/market_profile/year/:year/financial_structure` | Financial structure by country |
| `/market_profile/year/:year/movement_manpower` | Manpower statistics |
| `/market_profile/year/:year/federation_info` | Federation information |
| `/market_profile/year/:year/financial_performance` | Performance comparison (2024 vs 2025) |

## File Structure

```
/home/nayana/code/cunm/
├── controller/
│   └── market_profile.php              # Aggregation controller (492 lines)
├── templates/
│   ├── layout.tpl                      # Master layout
│   └── market_profile/
│       ├── index.tpl                   # Year selection dashboard
│       ├── year_overview.tpl           # Section navigation for year
│       ├── country_profile_summary.tpl # Country profiles table
│       ├── memberships_summary.tpl     # Aggregated memberships
│       ├── individual_members_summary.tpl # Demographics summary
│       ├── assets_summary.tpl          # Assets by country
│       ├── financial_structure_summary.tpl # Financial data
│       ├── movement_manpower_summary.tpl # Manpower statistics
│       ├── federation_info_summary.tpl # Federation details
│       └── financial_performance_summary.tpl # Performance metrics
├── auth.php                            # Includes controller (line 1227)
└── v2.sql                              # Database schema
```

## How It Works

### 1. Year Grouping

All data is grouped by `YEAR(cu_market_profile.created_at)`:

```sql
SELECT YEAR(mp.created_at) as year, COUNT(*) as profiles
FROM cu_market_profile mp
GROUP BY YEAR(mp.created_at)
```

### 2. Aggregation Logic

For each section, data is:
1. **Joined** across cu_market_profile → federation → country
2. **Filtered** by year
3. **Aggregated** across all federations
4. **Displayed** in summary tables with:
   - Individual federation rows
   - Country subtotals (where applicable)
   - Grand totals

Example from memberships:
```php
// Calculate aggregated totals
$totals = array('urban_cu' => 0, 'rural_cu' => 0, 'total_cu' => 0, ...);
foreach ($memberships as $row) {
    foreach ($totals as $key => $value) {
        $totals[$key] += (int)$row[$key];
    }
}
```

### 3. Display Format

Tables show:
- **Federation level** data (one row per federation)
- **Country totals** (for financial data with different currencies)
- **Grand totals** (network-wide statistics)

## Usage Instructions

### Accessing the Module

1. Navigate to `/market_profile`
2. View available years with statistics
3. Click "View Summary" for desired year
4. Navigate to different sections

### Reading the Summaries

**Memberships Summary:**
- Shows Urban/Rural/Total breakdown
- CUs categorized by size (<300, 301-1000, etc.)
- Includes CUMI (microfinance) count
- Grand total row at bottom

**Individual Members Summary:**
- Demographics by area (Urban/Rural)
- Gender breakdown (Male/Female)
- Age categories (<20, 20-40, 40-60, >60)
- Network-wide totals

**Assets Summary:**
- Grouped by country (different currencies)
- Asset size categories
- Country subtotals
- Shows distribution across size ranges

**Financial Structure:**
- Share, Savings, Loans, Reserves
- Grouped by country with currency
- Country totals for each metric

**Financial Performance:**
- 2024 vs 2025 comparison
- Percentage change indicators
- Color-coded (green=positive, red=negative)

## Excel File Mapping

The summary views mirror the Excel worksheets structure:

| Excel Sheet | Maps to Summary Page |
|-------------|---------------------|
| 000 CU Review | memberships_summary + financial_structure_summary |
| 001 2021 Asset | assets_summary |
| 002 2021 Asian CU System | memberships_summary + financial_structure_summary |
| 003 Market Seg | individual_members_summary + memberships_summary |
| 004 CUMI 2021 | memberships_summary (CUMI column) |

## Key Features

### 1. Year-Based Views
- Automatic grouping by year from cu_market_profile.created_at
- Summary statistics per year (profiles, federations, countries)
- Historical comparison capability

### 2. Aggregated Totals
- Network-wide statistics across all federations
- Country-level subtotals for currency-specific data
- Automatic calculation of totals

### 3. Multi-Currency Support
- Assets and financial data grouped by country
- Currency displayed per country
- No cross-currency aggregation (shown separately)

### 4. Completion Tracking
- Year overview shows how many federations submitted each section
- Badge indicators (e.g., "15/20" means 15 of 20 federations submitted)

### 5. Formatted Tables
- Number formatting (thousands separators)
- Color-coded sections (Urban/Rural/Total)
- Responsive design with horizontal scrolling for wide tables

## Sample Queries

### Get all years with data:
```sql
SELECT DISTINCT YEAR(created_at) as year
FROM cu_market_profile
ORDER BY year DESC
```

### Get memberships for a year:
```sql
SELECT c.name as country, f.name as federation, m.*
FROM cu_memberships m
JOIN cu_market_profile mp ON m.profile_id = mp.profile_id
JOIN federation f ON mp.federation_id = f.id
JOIN country c ON f.country_id = c.id
WHERE YEAR(mp.created_at) = 2025
ORDER BY c.name, f.name
```

### Count submissions per section:
```sql
SELECT COUNT(DISTINCT profile_id) as count
FROM cu_memberships
WHERE profile_id IN (SELECT profile_id FROM cu_market_profile WHERE YEAR(created_at) = 2025)
```

## Data Entry

**Note:** This module is for **viewing/reporting** only. Data entry happens elsewhere (presumably through the individual federation portals or data import processes).

The module assumes data already exists in the cu_* tables and simply:
- Queries it
- Aggregates it
- Displays it in summary format

## Customization

### Adding New Summary Sections

1. **Add route** in `controller/market_profile.php`:
```php
$app->get('/market_profile/year/:year/new_section', function ($year) use ($app, $smarty) {
    $pdo = getDbHandler();

    // Query data
    $sql = "SELECT c.name as country_name, f.name as federation_name, ns.*
            FROM cu_new_section ns
            JOIN cu_market_profile mp ON ns.profile_id = mp.profile_id
            JOIN federation f ON mp.federation_id = f.id
            JOIN country c ON f.country_id = c.id
            WHERE YEAR(mp.created_at) = :year
            ORDER BY c.name, f.name";

    // Calculate aggregates
    // Assign to template
    $smarty->display('market_profile/new_section_summary.tpl');
});
```

2. **Create template** in `templates/market_profile/new_section_summary.tpl`

3. **Add link** in `year_overview.tpl`

### Modifying Aggregation Logic

To change how totals are calculated, edit the aggregation loop in the controller:

```php
foreach ($data as $row) {
    foreach ($totals as $key => $value) {
        $totals[$key] += (int)$row[$key];  // or (float) for decimals
    }
}
```

## Troubleshooting

### No years showing
- Check that cu_market_profile table has data
- Verify created_at dates are set

### Empty summaries
- Check that related tables (cu_memberships, etc.) have matching profile_id
- Verify foreign keys are correct

### Currency display issues
- Ensure country.currency field is populated
- Check cu_country_profile.local_currency matches

### Performance issues
- Add indexes on profile_id in all cu_* tables
- Add index on cu_market_profile.created_at
- Consider caching for large datasets

## Future Enhancements

1. **Export to Excel** - Generate Excel files from summary data
2. **PDF Reports** - Print-friendly summary reports
3. **Year Comparison** - Side-by-side year comparisons
4. **Charts/Graphs** - Visual data representation using Highcharts
5. **Data Validation** - Show data quality indicators
6. **Filters** - Filter by country, federation, region
7. **Search** - Search across all summaries
8. **Caching** - Cache aggregated results for performance

## Access Control

Currently, all authenticated users can view market profiles. To restrict access:

1. Check user level in controller
2. Filter data by user's country/federation if needed

Example:
```php
if ($_SESSION['user_level'] == 1) {
    // Federation user - show only their country
    $sql .= " AND c.id = :country_id";
}
```

## Credits

- Framework: Slim 2.x + Smarty 3.1
- Database schema: v2.sql (CU Market Profile 2025)
- Excel reference: input/cunm.xlsx
- Updated: 2025-11-04
- Purpose: Aggregated reporting and network-wide analytics

## Support

For issues or questions:
- Review controller logic in `controller/market_profile.php`
- Check template files in `templates/market_profile/`
- Verify database schema in `v2.sql`
- Check aggregation queries and totals calculation
