BOOSTER REVIEWS
-
- Code challenge completed by Bryan Bassett

- Download, make env file, generate encryption key
- Database included if you want to just use that
- Otherwise - composer install, migrate:fresh, db:seed and login as one of the users (the seeder makes all passwords "password")
- then - php artisan serve

### **notes**
  
- i made a single unit test that practically tests the entire use case
- i included some files i wouldnt normally for quicker testing for you - aka the public folder, and the sqlite database
- if this was a real website I would do more data limiting, like length of entries etc.


- you can register with real email, but you must verify to create things (ensuring legit email)
- you can create fundraisers (but title is unique)
- you can review fundraisers (but only once per user)
- we store fundraiser name and description and who it was made by (visible in users dashboard)
- we store review rating, and text, who it was written by and when (also visible in user dashboard)
- we can read other reviews
- page auto updates when post review, or adding new fundraiser
- tried to make it as pretty as possible but im pressed for time - hope its pretty enough
