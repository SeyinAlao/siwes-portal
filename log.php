<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIWES Logbook</title>
    <link rel="stylesheet" href="logs.css">
</head>
<body>
    <?php include('index.php'); ?> <!-- This adds the sidebar -->

    <div class="container">
        <h1>SIWES Logbook</h1>
        <p id="week-heading">Week 1</p>
    <button id="export-btn">📤 Export Logs</button>
        <form id="log-form">
            <label>Monday:</label>
            <textarea id="monday" placeholder="Enter Monday log..." required></textarea>
            <p id="count-monday" class="word-count">Words: 0</p>

            <label>Tuesday:</label>
            <textarea id="tuesday" placeholder="Enter Tuesday log..." required></textarea>
            <p id="count-tuesday" class="word-count">Words: 0</p>

            <label>Wednesday:</label>
            <textarea id="wednesday" placeholder="Enter Wednesday log..." required></textarea>
            <p id="count-wednesday" class="word-count">Words: 0</p>

            <label>Thursday:</label>
            <textarea id="thursday" placeholder="Enter Thursday log..." required></textarea>
            <p id="count-thursday" class="word-count">Words: 0</p>

            <label>Friday:</label>
            <textarea id="friday" placeholder="Enter Friday log..." required></textarea>
            <p id="count-friday" class="word-count">Words: 0</p>

            <button type="submit">Submit Week</button>
        </form>
        <a href="history.html" class="link-button">View Submitted Logs</a>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
