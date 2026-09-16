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
                            <h2>Food Nutrition</h2>
                            <p>
                            <blockquote>"Food nutrition refers to the nutrients and energy provided by what we eat, supporting growth, repair, and overall health."</blockquote>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-right">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Food Nutrition</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="feature" style="padding: 50px 0 20px 0; background: #f8fafc;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="background: #ffffff; border-radius: 14px; border: 1px solid #e2e8f0; padding: 26px 30px; margin-bottom: 30px; box-shadow: 0 4px 16px rgba(15,23,42,0.04);">
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
                            <i class="fa fa-apple-alt text-emerald" style="margin-right: 8px;"></i> Nutritional Fundamentals
                        </h3>
                        <p style="color: #475569; font-size: 15px; line-height: 1.7; margin: 0; text-align: justify;">
                            Food nutrition is essential for maintaining overall health, peak athletic performance, and recovery. A balanced diet provides the body with vital macronutrients (protein, complex carbohydrates, healthy fats) and micronutrients (vitamins and minerals). Use our real-time database below to check calories, protein, and macros for any ingredient.
                        </p>
                    </div>

                    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 35px 28px; box-shadow: 0 6px 20px rgba(15,23,42,0.05); margin-bottom: 30px;">
                        <div style="text-align: center; margin-bottom: 20px;">
                            <div style="width: 60px; height: 60px; background: #ecfdf5; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px; border: 1.5px solid #a7f3d0;">
                                <i class="fa fa-utensils" style="font-size: 24px; color: #059669;"></i>
                            </div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; margin: 0;">
                                Search Nutrition Facts
                            </h2>
                            <p style="color: #64748b; font-size: 14px; margin-top: 6px;">Lookup detailed calories, protein, carbs, and fats per serving</p>
                        </div>

                        <div class="food-search-wrap">
                            <div class="input-container">
                                <input type="text" id="searchInput" placeholder="Enter a food item (e.g., egg, apple, oats, tofu)">
                                <button id="searchButton" type="button">
                                    <i class="fa fa-search" style="margin-right: 4px;"></i> Search
                                </button>
                            </div>

                            <!-- Quick Suggestion Tags -->
                            <div class="food-quick-tags">
                                <span style="font-size: 12.5px; color: #94a3b8; font-weight: 600; align-self: center; margin-right: 4px;">Popular:</span>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Apple')">Apple</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Banana')">Banana</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Oatmeal')">Oatmeal</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Eggs')">Eggs</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Chicken Breast')">Chicken Breast</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Tofu')">Tofu</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Almonds')">Almonds</button>
                                <button type="button" class="food-tag-btn" onclick="quickSearch('Lentils')">Lentils</button>
                            </div>

                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nutrition Search Script -->
    <script>
        document.getElementById('searchButton').addEventListener('click', performSearch);
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });

        function quickSearch(item) {
            document.getElementById('searchInput').value = item;
            performSearch();
        }

        function performSearch() {
            const query = document.getElementById('searchInput').value.trim();
            if (query) {
                fetchDetails(query);
            }
        }

        function fetchDetails(query) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '<p class="no-results"><i class="fa fa-spinner fa-spin" style="margin-right:8px;"></i> Searching nutrition data for "' + query + '"...</p>';

            const apiUrl = `https://api.edamam.com/api/food-database/v2/parser?ingr=${encodeURIComponent(query)}&app_id=155a5345&app_key=485ea0358c8efe6de70541560fe0f44e`;

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.hints && data.hints.length > 0) {
                        displayResults(data.hints.slice(0, 6));
                    } else {
                        resultDiv.innerHTML = '<p class="no-results">No nutrition records found for "' + query + '". Please try another ingredient.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    resultDiv.innerHTML = '<p class="no-results">Unable to load live data right now. Please check your network connection or try again shortly.</p>';
                });
        }

        function displayResults(foods) {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';

            foods.forEach(foodItem => {
                const food = foodItem.food;
                const cal = food.nutrients && food.nutrients.ENERC_KCAL ? Math.round(food.nutrients.ENERC_KCAL) + ' kcal' : 'N/A';
                const protein = food.nutrients && food.nutrients.PROCNT ? Number(food.nutrients.PROCNT).toFixed(1) + ' g' : 'N/A';
                const fat = food.nutrients && food.nutrients.FAT ? Number(food.nutrients.FAT).toFixed(1) + ' g' : 'N/A';
                const carbs = food.nutrients && food.nutrients.CHOCDF ? Number(food.nutrients.CHOCDF).toFixed(1) + ' g' : 'N/A';
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

    <section style="padding: 20px 0 60px 0; background: #f8fafc;">
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