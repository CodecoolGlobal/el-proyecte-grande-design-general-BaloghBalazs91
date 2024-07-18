# El Proyecte Grande - Design

## Story
This project is a fullstack web application using `Laravel` backend, `Blade` templating engine and `mariadb` database. The project is about managing a gym's application.

## Details
- Users can create accounts, browse training methods, trainings and trainers
- Users can apply to the trainings, if there are free slots
- Trainers can create new trainings and training methods

## How to use
1. Pull down the repository
   `git clone https://github.com/CodecoolGlobal/el-proyecte-grande-design-general-BaloghBalazs91.git`
2. Rename `.env.example` file to `.env`
3. Run docker
   `docker-compose up`
4. Open a new terminal, run the following command, and copy `laravel.test` container id:
   `docker ps`
5. Step into the container and run the migration command:
    ```
    docker exec -it <container-id> bash
    php artisan migrate:fresh --seed
    ```
6. Run the app in the browser: `http://localhost:80`
