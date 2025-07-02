<p align="center"><img src="https://github.com/user-attachments/assets/2768e6b5-7cc2-47cf-aea5-5441e5c26432" width="400" alt="MyCinemaList Logo"></p>

<p align="center">
 A Laravel web application that allows you to organize, rate and monitor personalized lists of your favorite films in a simple and intuitive way.
</p>

## ℹ️ About

**MyCinemaList** is a platform designed for true film lovers who want a complete and personalized experience when organizing and sharing their opinions on films. Here, the user not only manages lists of movies with notes and viewing statuses, but also creates reviews with detailed recommendations, and can express positive, negative or mixed feelings.

The platform also allows users to create and personalize their profiles, follow their favourite people and films and explore the profiles of other users, actors, directors and other people who take part in the films. To ensure good content management, there is a robust administration panel where administrators have full control over movies, people and reviews.

In MyCinemaList, the evaluation of films is transparent and social: any user can see the average score and the percentage of recommendations, giving a clear and communal view of what each title is worth.

---

## ✨ Features

- **Detailed reviews:** Users can create reviews where they express whether they recommend, don't recommend or have mixed feelings about a movie.  
- **Personalized lists:** Create lists where you can rate each movie from 1 to 10, indicate whether you've seen it, left it or want to see it.  
- **Favorites:** Bookmark favorite people and movies to easily access what you like best.  
- **Profile management:** Allows you to change your username, password and profile picture easily and securely.  
- **Public browsing:** Both guests and registered users can view profiles, movie pages, reviews and search for movies, people and users.  
- **Full view:** See all the reviews, lists and favorites of any user.  
- **Admin panel:** Administrators have the power to create, edit and delete films, staff and reviews, ensuring control of the platform's content.  
- **Movie statistics:** On each movie page you can see the average rating and the percentage of users who recommend, don't recommend or have indifferent feelings.

---

## 🚀 Setup

1. **Clone the repository**

```bash
git clone https://github.com/anotherlusitano/MyCinemaList.git
cd MyCinemaList
```

2. **Configure the environment**

```bash
cp .env.example .env
php artisan key:generate
```

3. **Install dependencies**

```
composer install
npm install
```

4. **Create the database and start the application**

```bash
php artisan migrate --seed
php artisan serve
```

---

## Additional information

When you `seed` the database, it will generate two default accounts:
- `test@gmail.com` - account of a normal user
- `admin@gmail.com` - an administrator's account

And the password is `password`.
