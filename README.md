# Final Shipping Cost Calculation System

This system calculates the final shipping cost based on a set of specified inputs.

## Requirements

- Enter final offer
- Enter transaction tax
- Enter Copart fee
- Enter AutoBidMaster transaction fee
- Enter document fee
- Enter transaction number
- Enter shipping cost
- Enter customs

## Calculation Method

1. **Collect input data**:
   - Final offer
   - Transaction tax
   - Copart fee
   - AutoBidMaster transaction fee
   - Document fee
   - Shipping cost
   - Customs

2. **Calculate the initial total**:
   - Initial total = final offer + Copart fee + AutoBidMaster fee + document fee + shipping cost + customs

3. **Calculate the tax amount**:
   - Tax amount = initial total × (transaction tax rate / 100)

4. **Calculate the final total**:
   - Final total = initial total + tax amount + 10

## Installation Instructions

### 1. Upload the Database File

- Upload the `database.sql` file to your database server. You can use tools like phpMyAdmin or the MySQL command line interface.

### 2. Edit the config.php File

- After uploading the database file, you need to edit the `config.php` file to configure the database connection settings. Open the `config.php` file and enter the following information:

```php
<?php
// Database settings
define('DB_HOST', 'localhost'); // Database host
define('DB_USER', 'username'); // Database username
define('DB_PASS', 'password'); // Database password
define('DB_NAME', 'database_name'); // Database name
?>
