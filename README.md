# Searching Airline's Website

This project is built on Learner Lab using AWS EC2 and RDS to create a searching airline's website.

## Getting Started

Follow these steps to set up the project:

1. Build your EC2 instance by following the instructions in the [AWS documentation](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.LaunchEC2.html).
   - Make sure to use an Elastic IP to ensure your Public IPv4 address does not change. You can allocate an Elastic IP address and associate it with your EC2 instance. Here's how to do it:
     - Go to "Elastic IPs" in the AWS Management Console.
     - Allocate an Elastic IP address.
     - Go to "Actions" and select "Associate Elastic IP address".
     - Choose your EC2 instance and enter your private IPv4 address.
     - Click "Associate".

2. Build your RDS database by following the instructions in the [AWS documentation](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateDBInstance.html).

3. Change the code in `airline.html`, `ctb.php`, and `index.php`.
   - Replace "YOUR EC2 IPV4" with your Public IPv4 address.

4. Build your S3 bucket and upload the following files:
   - `airline.html`
   - `ctb.php`
   - `index.php`
   - `101.jpg`
   - `123.jpg`
   - `789.jpg`

5. Install a web server on your EC2 instance by following the instructions in the [AWS documentation](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_Tutorials.WebServerDB.CreateWebServer.html).
   - Make sure to update the `dbinfo.inc` file with your `DB_SERVER`, `DB_USERNAME`, `DB_PASSWORD`, and `DB_DATABASE` information.

6. Transfer the files from S3 to your EC2 instance:
   ```bash
   cd /var/www/html

   sudo aws s3 cp ctb.php /var/www/html/
   sudo aws s3 cp airline.html /var/www/html/
   sudo aws s3 cp index.php /var/www/html/
   sudo aws s3 cp 101.jpg /var/www/html/
   sudo aws s3 cp 123.jpg /var/www/html/
   sudo aws s3 cp 789.jpg /var/www/html/
   
 7. Open your website by accessing the following URL in your web browser:
 ```bash
 http:// Public IPv4 address /airline.html

