// Auto-save input values in local storage
document.querySelectorAll("textarea").forEach((textarea) => {
    let key = textarea.id;

    // Load saved value if available
    textarea.value = localStorage.getItem(key) || "";

    // Save value on input
    textarea.addEventListener("input", () => {
        localStorage.setItem(key, textarea.value);
    });
});

// Word count and minimum word check
document.querySelectorAll("textarea").forEach((textarea) => {
    let countDisplay = document.getElementById("count-" + textarea.id);

    textarea.addEventListener("input", () => {
        let words = textarea.value.trim().split(/\s+/).length;
        countDisplay.textContent = "Words: " + (textarea.value.trim() ? words : 0);

        // Change color if words are less than 10
        countDisplay.style.color = words < 10 ? "red" : "white";
    });
});

// Confetti function 🎀
function celebrate() {
    let duration = 3000; // 3 seconds of confetti
    let end = Date.now() + duration;

    function frame() {
        if (Date.now() > end) return;

        for (let i = 0; i < 10; i++) {
            let confetti = document.createElement("div");
            confetti.innerHTML = "🎀";
            confetti.style.position = "fixed";
            confetti.style.left = Math.random() * window.innerWidth + "px";
            confetti.style.top = "-20px";
            confetti.style.fontSize = Math.random() * 20 + 10 + "px";
            confetti.style.animation = "fall 2s linear";

            document.body.appendChild(confetti);

            setTimeout(() => confetti.remove(), 2000);
        }

        requestAnimationFrame(frame);
    }

    frame();
}

document.addEventListener("DOMContentLoaded", function () {
    const logForm = document.getElementById("log-form");
    const weekHeading = document.getElementById("week-heading");
    const logsContainer = document.getElementById("logs-container");
    const modeToggle = document.getElementById("mode-toggle");
    const exportBtn = document.getElementById("export-btn");

    let currentWeek = parseInt(localStorage.getItem("currentWeek")) || 1;
    let logs = JSON.parse(localStorage.getItem("logs")) || {};

    if (logForm) {
        weekHeading.textContent = `Week ${currentWeek}`;

        // Load previous entries
        ["monday", "tuesday", "wednesday", "thursday", "friday"].forEach((day) => {
            document.getElementById(day).value = logs[`week${currentWeek}`]?.[day] || "";
        });

        logForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Save logs
            logs[`week${currentWeek}`] = {
                monday: document.getElementById("monday").value,
                tuesday: document.getElementById("tuesday").value,
                wednesday: document.getElementById("wednesday").value,
                thursday: document.getElementById("thursday").value,
                friday: document.getElementById("friday").value,
            };

            localStorage.setItem("logs", JSON.stringify(logs));

            // Check if all days are filled
            let allFilled = Object.values(logs[`week${currentWeek}`]).every((log) => log.trim() !== "");

            if (allFilled) {
                celebrate(); // 🎀 Trigger confetti
            }

            if (currentWeek < 24) {
                currentWeek++;
                localStorage.setItem("currentWeek", currentWeek);
                setTimeout(() => window.location.reload(), 1000);
            } else {
                alert("You've completed all 24 weeks!");
            }
        });
    }

    if (logsContainer) {
        logsContainer.innerHTML = "";

        for (let i = 1; i <= 24; i++) {
            if (logs[`week${i}`]) {
                let weekBox = document.createElement("div");
                weekBox.classList.add("week-box");
                weekBox.textContent = `Week ${i}`;
                weekBox.onclick = function () {
                    window.location.href = `view-log.html?week=${i}`;
                };
                logsContainer.appendChild(weekBox);
            }
        }
    }

    // Dark/Light Mode Toggle
    function setTheme(mode) {
        document.body.classList.toggle("dark-mode", mode === "dark");
        localStorage.setItem("theme", mode);
    }

    if (modeToggle) {
        // Load saved theme
        let savedTheme = localStorage.getItem("theme") || "light";
        setTheme(savedTheme);

        modeToggle.addEventListener("click", function () {
            let currentMode = document.body.classList.contains("dark-mode") ? "light" : "dark";
            setTheme(currentMode);
        });
    }

    // Export Logs as JSON File
    if (exportBtn) {
        exportBtn.addEventListener("click", function () {
            let content = "";
    
            for (let week in logs) {
                content += `--- ${week.toUpperCase()} ---\n`;
    
                let days = logs[week];
                for (let day in days) {
                    content += `${day.charAt(0).toUpperCase() + day.slice(1)}: ${days[day]}\n`;
                }
    
                content += `\n-------------------------\n\n`;
            }
    
            let blob = new Blob([content], {
                type: "application/msword", // could also use text/plain
            });
    
            let a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = "logbook_entries.doc";
            a.click();
        });
    }    
    
});