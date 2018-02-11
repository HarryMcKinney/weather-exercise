### weather-exercise
Simple weather exercise to retrieve data from API and store into database
___
The steps I took to create this were:
1. Register with Open Weather Map and obtain their free API key.
2. Then, I echo'd everything I needed for this exercise out `[lines 14-75 in index.php]`.
3. Once I knew I had the required data in the appropiate format I created new database named `weather` and then a table to save the data to: `(using [create-table.php])`.
4. Next I added a `$_GET[' ']` parameter to the `index.php` url, although this isn't the best way with respect to security concerns I felt like it was ok since the city names aren't considered `sensitive data`.
5. I ran the code with each city and checked my MySQL database to confirm that everything was saving correctly `(using MySQL Pro)`.
6. I created a `local cron job` to run the `localhost:8888/` scripts every 10 minutes with the city names `[listed in config.php]`.
7. Screen shots of database readily available upon request.
8. I left ALL of my comments in the code as an explanation of logic.

>NOTE: My 1st response to this project was to use Laravel with Guzzle to retrieve the API and keep 90% of this logic in the controller. Laravel uses PDO (instead of MySQLi) so I beleive it would be more of a secure application/approach. After building the framework I decided a more `old school` basic approach was more appropiate for this exercise.
