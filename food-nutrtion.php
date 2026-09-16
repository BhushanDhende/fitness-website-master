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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        .food-search-wrap {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 16px;
        }

        .input-container {
            margin: 15px 0 30px;
            display: flex;
            gap: 12px;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 520px;
        }

        .input-container input {
            padding: 12px 16px;
            font-size: 15px;
            flex: 1;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-container input:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
        }

        .input-container button {
            padding: 12px 24px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            border: none;
            background: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            white-space: nowrap;
        }

        .input-container button:hover {
            background: #43a047;
        }

        .input-container button:active {
            transform: scale(0.98);
        }

        #result {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 30px;
            box-sizing: border-box;
        }

        @media (max-width: 991px) {
            #result {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 600px) {
            #result {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .input-container {
                flex-direction: column;
                width: 100%;
            }
            .input-container input,
            .input-container button {
                width: 100%;
            }
        }

        .recipe {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .recipe:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.09);
            border-color: #4CAF50;
        }

        .recipe-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 14px;
            background: #f3f4f6;
        }

        .recipe h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 8px 0;
            color: #1f2937;
            text-transform: capitalize;
            line-height: 1.35;
        }

        .recipe .category-badge {
            display: inline-block;
            align-self: flex-start;
            background: #e8f5e9;
            color: #2e7d32;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 14px;
        }

        .recipe .nutrients-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
        }

        .recipe .nutrient-item {
            background: #f9fafb;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #f0f2f5;
        }

        .recipe .nutri-label {
            display: block;
            color: #6b7280;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 2px;
        }

        .recipe .nutri-val {
            display: block;
            color: #111827;
            font-weight: 600;
            font-size: 14px;
        }

        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 16px;
            color: #6b7280;
            padding: 30px;
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