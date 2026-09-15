<?php
$pageTitle = "Lean'N'Green : Food Nutrition Guide";
include('header.php');
?>


    <!-- Start single page header -->
    <section id="single-page-header">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-left">
                            <h2>food nutrtion</h2>
                            <p>
                            <blockquote>"Food nutrition refers to the nutrients and energy provided by what we eat, supporting growth, repair, and overall health."</blockquote>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-right">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li href="active">Food Nutrtion</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        .input-container {
            margin: 20px 0;
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .recipe {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 10px auto;
            max-width: 400px;
            background: #fafafa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }
    </style>

    <section id="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-area">
                        <p style="text-align: justify;">
                            Food nutrition is essential for maintaining overall health and well-being. A balanced
                            diet provides the body with vital nutrients such as carbohydrates,
                            proteins, fats, vitamins, and minerals. Proper nutrition supports growth,
                            boosts immunity, and helps prevent chronic diseases. Making healthy food choices
                            can improve energy levels and mental clarity. Understanding food nutrition empowers
                            individuals to lead healthier, more active lives.
                        </p>
                        <span class="line"></span>
                    </div>
                    <div class="errror-page-area">
                        <div class="error-content"></div>

                        <div class="blog-news-details blog-single-details">

                            <div class="blog-news-details blog-single-details" style="text-align: center;">
                                <br>
                                <h2>Search Food</h2><br>
                            </div> <br>
                            <div class="container" style="display: flex; flex-direction: column; align-items: center; font-size: 16px;">

                                <div class="input-container">
                                    <input type="text" id="searchInput" placeholder="Enter a food item (e.g., egg)"
                                        style="padding: 10px; font-size: 16px; width: 300px; border-radius: 5px; border: 1px solid #ccc;">
                                    <button id="searchButton"
                                        style="padding: 10px 20px; font-size: 16px; border-radius: 5px; border: none; background: #4CAF50; color: #fff; cursor: pointer; transition: background 0.2s;">
                                        Search
                                    </button>
                                </div>
                                <div id="result" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Form for taking values for calculations -->



    <!-- Move the script to after the HTML elements it uses -->
    <script>
        document.getElementById('searchButton').addEventListener('click', function () {
            const query = document.getElementById('searchInput').value.trim();
            if (query) {
                fetchDetails(query);
            }
        });

        function fetchDetails(query) {
            const apiUrl = `https://api.edamam.com/api/food-database/v2/parser?ingr=${encodeURIComponent(query)}&app_id=155a5345&app_key=485ea0358c8efe6de70541560fe0f44e`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.hints && data.hints.length > 0) {
                        displayResults(data.hints.slice(0, 6)); // Display only the first 6 results
                    } else {
                        document.getElementById('result').innerHTML = '<p>No results found.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.getElementById('result').innerHTML = '<p>Error fetching data.</p>';
                });
        }

        function displayResults(foods) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = ''; // Clear previous results

            foods.forEach(foodItem => {
                const food = foodItem.food;
                const foodHtml = `
            <div class="recipe">
                <h3>${food.label}</h3>
                <p>Category: ${food.category}</p>
                <p>Calories: ${food.nutrients.ENERC_KCAL ? food.nutrients.ENERC_KCAL + ' kcal' : 'N/A'}</p>
                <p>Protein: ${food.nutrients.PROCNT ? food.nutrients.PROCNT + ' g' : 'N/A'}</p>
                <p>Fat: ${food.nutrients.FAT ? food.nutrients.FAT + ' g' : 'N/A'}</p>
                <p>Carbs: ${food.nutrients.CHOCDF ? food.nutrients.CHOCDF + ' g' : 'N/A'}</p>
            </div>
        `;
                resultDiv.insertAdjacentHTML('beforeend', foodHtml);
            });
        }
    </script>


    <!-- Start blog navigation -->
    <div class="blog-navigation-area">
        <div class="blog-navigation-prev">
            <a href="#">
                <h5>Stories</h5>
                <span>Previous Post</span>
            </a>
        </div>
        <div class="blog-navigation-next">
            <a href="#">
                <h5>All about friends story</h5>
                <span>Next Post</span>
            </a>
        </div>
    </div>

    <div class="col-md-8">
        <div class="blog-archive-left">
            <?php include('comment.php'); ?>
        </div>
    </div>

    <?php include('footer.php'); ?>