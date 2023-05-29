# Tic Tac Toe Game With Ai

# How it works

The approach used in the code is a heuristic-based strategy. It relies on a set of conditions and rules to make informed decisions about the AI's moves.

The code follows a specific order of moves based on the following conditions:

* First, it checks if the AI can win in the next move. If a winning move is available, the AI makes that move.
* If the AI cannot win in the next move, it checks if the human player can win in the next move. 
* If a blocking move is available, the AI makes that move.
* If neither a winning nor a blocking move is available, the AI selects a random empty cell to make a move.

The goal is to maximize the AI's chances of winning while also preventing the human player from winning.


# Why the front-end?

The reason for implementing the game logic on the frontend is because of responsiveness and scalibity the game can respond immediately to user actions without making round trips to the backend. This can result in a more seamless and interactive user experience, especially when multiple users are playing the game simultaneously.

## Installation Api

- Clone this repository 
- navigate to the `laravel-api` directory
- Copy `.env` file: `cp .env.example .env`
- Set the environment variables in `.env` file
- Install composer dependencies: `composer install`
- Generate key: `php artisan key:generate`
- Run migration and seeders: `php artisan migrate`
- serve app: `php artisan serve`


## Installation vue App

- navigate to the `vue-app` directory
- `npm install`
- `npm run dev`
- You can access the project at: `http://localhost:3000`
