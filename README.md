# Issabel Backup Script

This PHP script is adapted from the original Issabel backup script to schedule backups and send the backup file via FTP.

## Requirements

- PHP 5.6 or higher
- Superuser access (root)

## Usage

1. Place the script content into a file named `issabel_backup.php`.
2. Modify the variables `$ftpuser`, `$ftppass`, and `$ftppath` with the details of your FTP server.
3. Run the script as superuser: `sudo php issabel_backup.php`.

## Description

This script performs the following steps:

1. Creates a scheduled backup of Issabel.
2. Sends the backup file to a specified FTP server.

Make sure to provide the correct FTP server details before running the script.

## Acknowledgements

This script is adapted from the original work done by the Issabel project.

## Notes

- Ensure you have the appropriate permissions to execute the script and access the required files and directories.
- This script is provided as-is and offers no warranties of any kind. Use it at your own risk.

