# VANILLA PHP

The vanilla PHP is a series of *challenges* I accomplish with a time frame of **1 hour each**. The intent of this is not
to show superpowers, the real reason
behind is to challenge myself to NOT USE any framework or library an let my abilities shine, sure, I will not reinvent
the wheel, and most important, all the considerations
like security, design, and other "*important*" stuff is omitted, just for the sake of complete the challenge as is
described.

---

## Notes

With the first challenge I notice a few things:

* I need to pre-configure the DB before any usage, and be sure is working, this takes me time if I already begin with the challenge
* I need to have the credentials for the DB, and this is because I don't start project so often and I tent to forget the keys (even if they're default).
* The first commit with the structure: ```challenge-[N]: add challenge files```. This is going to be the only commit that have the challenge at the time is over
* The next commits ```challenge-[N]: [something else]``` would be to include missing files like the SQL to create the structure for the challenge.

---

## Rules

The rules are simple, the time begins when I make the first commit of the challenge I'm currently doing (a ```index.php``` file empty), and the time
ends when I made the last commit of the challenge, so, in simple words the commits marks the beginning and the end of the challenge.

I will create a branch to store the changes and once the challenge is finished, I will PR this branch to main.

### Design and feel

The challenges doesn't need to have any kind of design, but for the sake of completion (for me), once I finish the challenge, I can add all
the styles I want, but just when the challenge is finished.

### Important
I can search for information before to begin to write any line of code, and have all the information available while I'm doing the challenge.
Ask for answers to AI tools (the solution code), or copy/paste code from any source is prohibited.

**NOTE**: I'm also going to include a screenshot of the timer.

---

## How to run challenges

**Requirements**

* Docker

Before running the docker services (containers), we need to configure the ```.env``` file, so first
copy the ```.env.example```, and rename the it to ```.env```.

```dotenv
# Project
CURRENT_PROJECT=

# DB
DB_HOST=db
DB_NAME=
DB_USER=
DB_PASS=
DB_INIT_FILE
```

Once you configure the ```.env``` file, you should run the command:

```shell
docker compose up
```

---

## ```.env``` configuration

### ```CURRENT_PROJECT```

This is the name of the project you want to use

e.g
```dotenv
CURRENT_PROJECT=01-simple-blog-system

# OTHER OPTIONS
# ...
```

### ```DB_HOST```
The name of the DB service, in this case ```db```, and it's already set in the ```.env.example```

### ```DB_NAME```
The name of the database, and this is used in PHP as a ```environment``` variable. The value could
be access with ```$_ENV``` super global array, or ```getenv()``` method.

### ```DB_USER```
The user for MySQL service, and this should be set, because this value is used to set when the service is first created.

### ```DB_PASS```
The user's password, and this as well as the user name, should be set, because this is set when the service is first created.

### ```DB_INIT_FILE```
This is the file that is run when the services is run the first time.

e.g
```dotenv
# OTHER OPTIONS
# ...

DB_INIT_FILE=01-simple-blog-system/database/structure.sql
```

<br>

#### Final notes
Not all the projects needs a database, so is not mandatory to provided the values for the DB in the```.env```
file, if the project doesn't need one.

If you want to delete all the files (```.gitkeep``` not included) from ```data/``` folder, run the next commands:

```shell
# Stop docker container and remove the services, and volumes.
docker compose stop && docker compose rm -v

# Next
find ./data ! -name '.gitkeep' ! -path ./data -exec rm -rf {} +
```

The last command will delete all the files, except ```.gitkeep```, and you can start with a new fresh version of

---

## Challenges

1. **Simple Blog System:**
    - Create a basic blog system with features like creating, updating, and deleting posts. Implement basic
      authentication for authors.

2. **CSV File Parser:**
    - Build a script to parse CSV files, extract data, and display it in a structured format. Allow users to upload CSV
      files for processing.

3. **URL Shortener:**
    - Develop a URL shortening service. Given a long URL, generate a unique short code, and create a mechanism to
      redirect users to the original URL.

4. **Image Gallery:**
    - Create a simple image gallery where users can upload images, view them, and delete them. Implement basic image
      validation.

5. **Quiz Generator:**
    - Build a quiz generator that allows users to create quizzes with questions and answers. Users should be able to
      take the quizzes, and the system should provide feedback on their performance.

6. **Weather API Integration:**
    - Integrate with a public weather API to fetch and display current weather information based on user input (e.g.,
      city name).

7. **User Profile System:**
    - Develop a user profile system with features such as profile creation, updating, and deletion. Include a profile
      picture upload functionality.

8. **Contact Form with Email Notification:**
    - Create a contact form that allows users to submit inquiries. Implement server-side validation and send email
      notifications upon form submission.

9. **Basic E-commerce Cart:**
    - Build a simple e-commerce cart system. Users should be able to add products to their cart, view the cart, and
      proceed to checkout.

10. **RSS Feed Reader:**
    - Develop a basic RSS feed reader that fetches and displays the latest articles from a given RSS feed URL. Display
      the article titles and links.

These challenges cover a variety of functionalities and can be completed using vanilla PHP within the specified time
frame. They are designed to test your ability to work with various aspects of web development, including file handling,
form processing, and API integration.

---

## Disclaimer

You don't need to trust me, this is for me and my learning purposes, you're welcome to contribute with your ideas or
commentaries, but please keep the language polite, I'm not a bad person, I'm just a programmer.