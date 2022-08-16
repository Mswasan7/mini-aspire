# mini-aspire
It is an app that allows authenticated users to go through a loan application.


1. Execute Composer Install
2. Clone .env.example to .env 
3. Run php artisan migrate:fresh --seed  (It will seed migrations and seeders)
4. Seeders involved are as follows
a) Roles
b) Permissions
c) System Setting
d) Admin Account seeded is admin@aspire.com and Password admin@9015
e) Customer Accounts seeded are customer1@gmail.com, customer2@gmail.com with same password admin@9015

5. Login using above accounts (Check Postman collection for details)
6. Create Loan Request  (Check Postman collection for details)
7. Approve Loan Request (Check Postman collection for details)
8. View Loan Request (Check Postman collection for details)
9. Create Repayment 
