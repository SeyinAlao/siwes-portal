document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("reportform");
    const exportBtn = document.getElementById("export-btn");

    // Auto-save textarea to localStorage
    document.querySelectorAll("textarea, input[type='text']").forEach((field) => {
        let key = field.id;
        field.value = localStorage.getItem(key) || "";

        field.addEventListener("input", () => {
            localStorage.setItem(key, field.value);
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = {
            adminName: document.getElementById("adminName").value,
            adminPosition: document.getElementById("adminPosition").value,
            experience: document.getElementById("experience").value,
        };

        // Save full report to localStorage
        localStorage.setItem("fullReport", JSON.stringify(formData));
        alert("Report saved! You can now export it.");
    });

    exportBtn.addEventListener("click", function () {
        const report = JSON.parse(localStorage.getItem("fullReport"));

        if (!report) {
            alert("No report found. Please fill and submit the form first.");
            return;
        }

        let content = `
        --- STUDENT REPORT FORM ---
        Name: ${report.adminName}
        Position: ${report.adminPosition}

        Experience:
        ${report.experience}

        ----------------------------
        `;

        const blob = new Blob([content], { type: "text/plain" });
        const a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = "Student_Report.txt";
        a.click();
    });
});
