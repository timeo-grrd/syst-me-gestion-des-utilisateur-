const input = document.getElementById("adresse");       
const suggestions = document.getElementById("suggestions");

input.addEventListener("input", async () => {
    const query = input.value.trim();

    // Si moins de 3 lettres, on cache la liste
    if (query.length < 3) {
        suggestions.style.display = "none";
        suggestions.innerHTML = "";
        return;
    }

    try {
        const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`);
        const data = await response.json();

        suggestions.innerHTML = "";
        suggestions.style.display = "block"; // On affiche la liste

        data.features.forEach((feature) => {
            const li = document.createElement("li");
            li.textContent = feature.properties.label;
            li.style.padding = "10px";
            li.style.cursor = "pointer";
            li.style.borderBottom = "1px solid #eee";

            // Quand on clique sur une adresse
            li.addEventListener("click", () => {
                input.value = feature.properties.label;
                suggestions.innerHTML = "";
                suggestions.style.display = "none";
            });

            suggestions.appendChild(li);
        });
    } catch (error) {
        console.error("Erreur API:", error);
    }
});