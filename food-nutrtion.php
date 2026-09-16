<?php
$pageTitle = "Lean'N'Green : Food Nutrition Guide";
$extraCss = 'assets/css/components/food-nutrition.css';
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
                            <div class="food-search-wrap">

                                <div class="input-container">
                                    <input type="text" id="searchInput" placeholder="Enter a food item (e.g., egg, apple, chicken)">
                                    <button id="searchButton">
                                        Search
                                    </button>
                                </div>
                                <div id="result"></div>
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
        document.getElementById('searchButton').addEventListener('click', performSearch);
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function performSearch() {
            const query = document.getElementById('searchInput').value.trim();
            if (query) {
                fetchDetails(query);
            }
        }

        function fetchDetails(query) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '<p class="no-results">Searching nutrition data...</p>';

            const apiUrl = `https://api.edamam.com/api/food-database/v2/parser?ingr=${encodeURIComponent(query)}&app_id=155a5345&app_key=485ea0358c8efe6de70541560fe0f44e`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.hints && data.hints.length > 0) {
                        displayResults(data.hints.slice(0, 6)); // Display 6 results (2 rows of 3)
                    } else {
                        resultDiv.innerHTML = '<p class="no-results">No results found for "' + query + '". Please try another item.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    resultDiv.innerHTML = '<p class="no-results">Error fetching data. Please try again later.</p>';
                });
        }

        function displayResults(foods) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = ''; // Clear previous results

            foods.forEach(foodItem => {
                const food = foodItem.food;
                const cal = food.nutrients.ENERC_KCAL ? Math.round(food.nutrients.ENERC_KCAL) + ' kcal' : 'N/A';
                const protein = food.nutrients.PROCNT ? Number(food.nutrients.PROCNT).toFixed(1) + ' g' : 'N/A';
                const fat = food.nutrients.FAT ? Number(food.nutrients.FAT).toFixed(1) + ' g' : 'N/A';
                const carbs = food.nutrients.CHOCDF ? Number(food.nutrients.CHOCDF).toFixed(1) + ' g' : 'N/A';
                const imageHtml = food.image ? `<img src="${food.image}" alt="${food.label}" class="recipe-img" onerror="this.style.display='none'">` : '';

                const foodHtml = `
                    <div class="recipe">
                        ${imageHtml}
                        <h3>${food.label}</h3>
                        ${food.category ? `<span class="category-badge">${food.category}</span>` : ''}
                        <div class="nutrients-list">
                            <div class="nutrient-item">
                                <span class="nutri-label">Calories</span>
                                <span class="nutri-val">${cal}</span>
                            </div>
                            <div class="nutrient-item">
                                <span class="nutri-label">Protein</span>
                                <span class="nutri-val">${protein}</span>
                            </div>
                            <div class="nutrient-item">
                                <span class="nutri-label">Fat</span>
                                <span class="nutri-val">${fat}</span>
                            </div>
                            <div class="nutrient-item">
                                <span class="nutri-label">Carbs</span>
                                <span class="nutri-val">${carbs}</span>
                            </div>
                        </div>
                    </div>
                `;
                resultDiv.insertAdjacentHTML('beforeend', foodHtml);
            });
        }
    </script>



    <section style="padding: 30px 0 60px 0; background: #f8fafc;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div style="background: #ffffff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
                        <?php include('comment.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?>